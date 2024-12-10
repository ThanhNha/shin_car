<?php
function slugify($string)
{
  // Convert the string to lowercase
  $string = strtolower($string);

  // Replace spaces and special characters with dashes
  $string = preg_replace('/[^a-z0-9]+/', '_', $string);

  // Remove leading and trailing dashes
  $string = trim($string, '_');

  return $string;
}

function pr($data)
{
  echo '<style>
  #debug_wrapper {
    position: fixed;
    top: 0px;
    left: 0px;
    z-index: 999;
    background: #fff;
    color: #000;
    overflow: auto;
    width: 100%;
    height: 100%;
  }</style>';
  echo '<div id="debug_wrapper"><pre>';

  print_r($data); // or var_dump($data);
  echo "</pre></div>";
  die;
}


add_filter('wp_kses_allowed_html', 'acf_add_allowed_iframe_tag', 10, 2);
function acf_add_allowed_iframe_tag($tags, $context)
{
  if ($context === 'post') {
    $tags['iframe'] = array(
      'src'          => true,
      'height'       => true,
      'width'        => true,
      'frameborder'  => true,
      'allowfullscreen' => true,
    );
  }

  return $tags;
}


// Get all categories Properties

function categories_properties()
{

  $args = array(
    'parent' => 41,
    'taxonomy' => 'categories_properties',
    'hide_empty' => false
  );
  $terms = get_terms($args);
  return $terms;
}

function properties_city()
{

  $args = array(
    // 'fields' => 'id=>slug',
    'taxonomy' => 'property_city',
    'hide_empty' => false
  );
  $terms = get_terms($args);
  return $terms;
}

function convert_slug_to_name($input)
{
  // Replace hyphens with spaces
  $output = str_replace('-', ' ', $input);
  // Capitalize the first letter of the second word
  $parts = explode(' ', $output);
  if (isset($parts[1])) {
    $parts[1] = ucfirst($parts[1]);
  }

  // Recombine the parts
  $output = implode(' ', $parts);
  return $output;
}
