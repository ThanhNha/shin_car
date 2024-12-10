<?php


/**
 * Remove CPT Slug Setting
 *
 * @package Shin
 */

namespace SHIN_THEME\Inc;

use SHIN_THEME\Inc\Traits\Singleton;

class Remove_CPT_Slug
{

  use Singleton;

  private array $shin_cpt_selected = [];
  private array $shin_cpt_selected_keys = [];

  private static $instance = null;

  protected function __construct()
  {
    $post_type = array('properties');
    //load all class in here
    $this->set_hooks($post_type);
  }

  private function set_hooks($post_type)
  {
    // Load user settings from database
    $this->shin_cpt_selected = array_flip($post_type);
    $this->shin_cpt_selected_keys = array_keys($this->shin_cpt_selected);

    // Register hooks
    add_filter('post_type_link', [$this, 'remove_slug'], 10, 3);
    add_action('template_redirect', [$this, 'redirect_old_urls'], 1);
    add_filter('request', [$this, 'handle_custom_rewrites']);
  }


  public function remove_slug($permalink, $post, $leavename)
  {
    global $wp_post_types;

    foreach ($wp_post_types as $type => $custom_post) {

      if ($custom_post->_builtin == false && $type == $post->post_type && isset($this->shin_cpt_selected[$post->post_type])) {
        $slug = trim($custom_post->rewrite['slug'], '/');
        $permalink = str_replace('/' . $slug . '/', '/', $permalink);
      }
    }
    return $permalink;
  }

  public function get_current_url()
  {
    $request_uri = strtok($_SERVER['REQUEST_URI'], '?');
    $scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';
    return $scheme . $_SERVER['SERVER_NAME'] . $request_uri;
  }

  public function redirect_old_urls()
  {
    global $post;
    if (!is_preview() && is_single() && is_object($post) && isset($this->shin_cpt_selected[$post->post_type])) {
      $new_url = get_permalink();
      $real_url = $this->get_current_url();

      if (substr_count($new_url, '/') != substr_count($real_url, '/') && strpos($real_url, $new_url) === false) {
        remove_filter('post_type_link', [$this, 'remove_slug'], 10);
        $old_url = get_permalink();
        add_filter('post_type_link', [$this, 'remove_slug'], 10, 3);
        $fixed_url = str_replace($old_url, $new_url, $real_url);
        wp_redirect($fixed_url, 301);
        exit();
      }
    }
  }

  public function handle_custom_rewrites($query_vars)
  {
    if (
      !is_admin() && !isset($query_vars['post_type']) &&
      ((isset($query_vars['error']) && $query_vars['error'] == 404) ||
        isset($query_vars['pagename']) || isset($query_vars['attachment']) ||
        isset($query_vars['name']) || isset($query_vars['category_name']))
    ) {

      $web_roots = [site_url()];
      if (site_url() != home_url()) {
        $web_roots[] = home_url();
      }
      if (function_exists('pll_home_url') && site_url() != pll_home_url()) {
   
        $web_roots[] = pll_home_url();
      }

      foreach ($web_roots as $web_root) {
        $path = $this->get_current_url();
        $path = str_replace($web_root, '', $path);
        $path = trim($path, '/');

        $path = explode('/', $path);
        foreach ($path as $i => $path_part) {
          if (isset($query_vars[$path_part])) {
            $path = array_slice($path, 0, $i);
            break;
          }
        }
        $path = implode('/', $path);

        $post_data = get_page_by_path($path, OBJECT, 'post');
        if (!($post_data instanceof WP_Post)) {
          $post_data = get_page_by_path($path);
          if (!is_object($post_data)) {
            $post_data = get_page_by_path($path, OBJECT, $this->shin_cpt_selected_keys);
            if (is_object($post_data)) {
              $post_name = $post_data->post_name;
              if ($this->shin_cpt_selected[$post_data->post_type] == 1) {
                $ancestors = get_post_ancestors($post_data->ID);
                foreach ($ancestors as $ancestor) {
                  $post_name = get_post_field('post_name', $ancestor) . '/' . $post_name;
                }
              }
              unset($query_vars['error'], $query_vars['pagename'], $query_vars['attachment'], $query_vars['category_name']);
              $query_vars['page'] = '';
              $query_vars['name'] = $path;
              $query_vars['post_type'] = $post_data->post_type;
              $query_vars[$post_data->post_type] = $path;
              break;
            } else {
              global $wp_rewrite;
              foreach ($this->shin_cpt_selected_keys as $post_type) {
                $query_var = get_post_type_object($post_type)->query_var;
                foreach ($wp_rewrite->rules as $pattern => $rewrite) {
                  if (strpos($pattern, $query_var) !== false) {
                    if (strpos($pattern, '(' . $query_var . ')') === false) {
                      preg_match_all('#' . $pattern . '#', '/' . $query_var . '/' . $path, $matches, PREG_SET_ORDER);
                    } else {
                      preg_match_all('#' . $pattern . '#', $query_var . '/' . $path, $matches, PREG_SET_ORDER);
                    }

                    if (count($matches) !== 0 && isset($matches[0])) {
                      $rewrite = str_replace('index.php?', '', $rewrite);
                      parse_str($rewrite, $url_query);
                      foreach ($url_query as $key => $value) {
                        $value = (int)str_replace(['$matches[', ']'], '', $value);
                        if (isset($matches[0][$value])) {
                          $value = $matches[0][$value];
                          $url_query[$key] = $value;
                        }
                      }

                      if (isset($url_query[$query_var])) {
                        $post_data = get_page_by_path('/' . $url_query[$query_var], OBJECT, $this->shin_cpt_selected_keys);
                        if (is_object($post_data)) {
                          unset($query_vars['error'], $query_vars['pagename'], $query_vars['attachment'], $query_vars['category_name']);
                          $query_vars['page'] = '';
                          $query_vars['name'] = $path;
                          $query_vars['post_type'] = $post_data->post_type;
                          $query_vars[$post_data->post_type] = $path;
                          foreach ($url_query as $key => $value) {
                            if ($key != 'post_type' && substr($value, 0, 8) != '$matches') {
                              $query_vars[$key] = $value;
                            }
                          }
                          break 3;
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
    return $query_vars;
  }
}
