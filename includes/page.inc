<?php
/**
 * @file
 * Theme and preprocess functions for the main page.
 */

/**
 * Implements template_preprocess_page().
 */
function radix_preprocess_page(&$variables) {
  // Add meta for Bootstrap Responsive.
  // <meta name="viewport" content="width=device-width, initial-scale=1.0">
  $element = array(
    '#tag' => 'meta',
    '#attributes' => array(
      'name' => 'viewport',
      'content' => 'width=device-width, initial-scale=1.0',
    ),
  );

  backdrop_add_html_head($element, 'bootstrap_responsive');
}

/**
 * Implements hook_css_alter().
 */
function radix_css_alter(&$css) {
  // Unset some core css.
  unset($css['core/modules/system/css/system.theme.css']);
}

/**
 * Implements hook_js_alter().
 */
function radix_js_alter(&$javascript) {
  // Add radix-progress when required.
  $progress = 'misc/progress.js';
  $radix_progress = backdrop_get_path('theme', 'radix') . '/assets/javascripts/radix-progress.js';
  if (!empty($javascript[$progress]) && empty($javascript[$radix_progress])) {
    $javascript[$radix_progress] = array_merge(
      backdrop_js_defaults(), array('group' => JS_THEME, 'data' => $radix_progress));
  }
}
