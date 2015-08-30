<?php
/**
 * @file
 * Theme hooks for Radix.
 */

require_once dirname(__FILE__) . '/includes/utilities.inc';
require_once dirname(__FILE__) . '/includes/layout.inc';
require_once dirname(__FILE__) . '/includes/theme.inc';
require_once dirname(__FILE__) . '/includes/structure.inc';
require_once dirname(__FILE__) . '/includes/block.inc';
require_once dirname(__FILE__) . '/includes/form.inc';
require_once dirname(__FILE__) . '/includes/menu.inc';
require_once dirname(__FILE__) . '/includes/comment.inc';
require_once dirname(__FILE__) . '/includes/view.inc';
require_once dirname(__FILE__) . '/includes/admin.inc';
require_once dirname(__FILE__) . '/includes/contrib.inc';

/**
 * Implements template_preprocess_html().
 */
function radix_preprocess_html(&$variables) {
  global $base_url;

  // Add Bootstrap JS from CDN if bootstrap library is not installed.
  if (!module_exists('bootstrap_library')) {
    $base = parse_url($base_url);
    $url = $base['scheme'] . '://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js';
    backdrop_add_js($url, 'external');
  }

  // Add support for the Modenizr module.
  // Load modernizr.js only if modernizr module is not present.
  if (!module_exists('modernizr')) {
    backdrop_add_js(backdrop_get_path('theme', 'radix') . '/assets/javascripts/modernizr.js');
  }

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
  // Unset some panopoly css.
  $panopoly_admin_path = backdrop_get_path('module', 'panopoly_admin');
  if (isset($css[$panopoly_admin_path . '/panopoly-admin.css'])) {
    unset($css[$panopoly_admin_path . '/panopoly-admin.css']);
  }

  $panopoly_magic_path = backdrop_get_path('module', 'panopoly_magic');
  if (isset($css[$panopoly_magic_path . '/css/panopoly-modal.css'])) {
    unset($css[$panopoly_magic_path . '/css/panopoly-modal.css']);
  }

  // Unset some core css.
  unset($css['modules/system/system.menus.css']);
}

/**
 * Implements hook_js_alter().
 */
function radix_js_alter(&$javascript) {
  // Add radix-modal when required.
  $ctools_modal = backdrop_get_path('module', 'ctools') . '/js/modal.js';
  $radix_modal = backdrop_get_path('theme', 'radix') . '/assets/javascripts/radix-modal.js';
  if (!empty($javascript[$ctools_modal]) && empty($javascript[$radix_modal])) {
    $javascript[$radix_modal] = array_merge(
      backdrop_js_defaults(), array('group' => JS_THEME, 'data' => $radix_modal));
  }

  // Add radix-field-slideshow when required.
  $field_slideshow = backdrop_get_path('module', 'field_slideshow') . '/field_slideshow.js';
  $radix_field_slideshow = backdrop_get_path('theme', 'radix') . '/assets/javascripts/radix-field-slideshow.js';
  if (!empty($javascript[$field_slideshow]) && empty($javascript[$radix_field_slideshow])) {
    $javascript[$radix_field_slideshow] = array_merge(
      backdrop_js_defaults(), array('group' => JS_THEME, 'data' => $radix_field_slideshow));
  }

  // Add radix-progress when required.
  $progress = 'misc/progress.js';
  $radix_progress = backdrop_get_path('theme', 'radix') . '/assets/javascripts/radix-progress.js';
  if (!empty($javascript[$progress]) && empty($javascript[$radix_progress])) {
    $javascript[$radix_progress] = array_merge(
      backdrop_js_defaults(), array('group' => JS_THEME, 'data' => $radix_progress));
  }
}

/**
 * Implements template_preprocess_header().
 */
function radix_preprocess_header(&$variables) {
  // Add search_form to theme.
  $variables['search_form'] = '';
  if (module_exists('search') && user_access('search content')) {
    $search_box_form = backdrop_get_form('search_form');
    $search_box_form['basic']['keys']['#title'] = '';
    $search_box_form['basic']['keys']['#size'] = 20;
    $search_box_form['basic']['keys']['#attributes'] = array('placeholder' => 'Search');
    $search_box_form['basic']['keys']['#attributes']['class'][] = 'form-control';
    $search_box_form['basic']['submit']['#value'] = t('Search');
    $search_box_form['#attributes']['class'][] = 'navbar-form';
    $search_box_form['#attributes']['class'][] = 'navbar-right';
    $search_box = backdrop_render($search_box_form);
    $variables['search_form'] = (user_access('search content')) ? $search_box : NULL;
  }
}

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
