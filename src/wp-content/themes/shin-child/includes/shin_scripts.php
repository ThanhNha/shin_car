<?php

// add_action('wp_head', 'shin_head_script_callback');
function shin_head_script_callback()
{
  $script_content = get_field('header_scripts', 'option');
  echo($script_content);
}


// add_action('wp_footer', 'shin_footer_script_callback');
function shin_footer_script_callback() {
  $script_content = get_field('footer_scripts', 'option');
  echo($script_content);

};
