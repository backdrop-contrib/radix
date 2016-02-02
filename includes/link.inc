<?php
/**
 * @file
 * Theme and preprocess functions for links.
 */

/**
 * Implements template_preprocess_links__header_menu().
 */
function radix_preprocess_links(&$variables) {
  if ($variables['theme_hook_original'] == 'links__header_menu') {
    $variables['attributes']['class'][] = 'menu';
    $variables['attributes']['class'][] = 'nav';
    $variables['attributes']['class'][] = 'navbar-nav';
  }
}
