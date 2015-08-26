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
require_once dirname(__FILE__) . '/includes/panel.inc';
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
    drupal_add_js($url, 'external');
  }

  // Add support for the Modenizr module.
  // Load modernizr.js only if modernizr module is not present.
  if (!module_exists('modernizr')) {
    drupal_add_js(drupal_get_path('theme', 'radix') . '/assets/javascripts/modernizr.js');
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
  drupal_add_html_head($element, 'bootstrap_responsive');

  // Add some custom classes for panels pages.
  if (module_exists('page_manager') && count(page_manager_get_current_page())) {
    $variables['is_panel'] = TRUE;

    // Get the current panel display and add some classes to body.
    if ($display = panels_get_current_page_display()) {
      $variables['classes_array'][] = 'panel-layout-' . $display->layout;

      // Add a custom class for each region that has content.
      $regions = array_keys($display->panels);
      foreach ($regions as $region) {
        $variables['classes_array'][] = 'panel-region-' . $region;
      }
    }
  }
}

/**
 * Implements hook_css_alter().
 */
function radix_css_alter(&$css) {
  // Unset some panopoly css.
  $panopoly_admin_path = drupal_get_path('module', 'panopoly_admin');
  if (isset($css[$panopoly_admin_path . '/panopoly-admin.css'])) {
    unset($css[$panopoly_admin_path . '/panopoly-admin.css']);
  }

  $panopoly_magic_path = drupal_get_path('module', 'panopoly_magic');
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
  $ctools_modal = drupal_get_path('module', 'ctools') . '/js/modal.js';
  $radix_modal = drupal_get_path('theme', 'radix') . '/assets/javascripts/radix-modal.js';
  if (!empty($javascript[$ctools_modal]) && empty($javascript[$radix_modal])) {
    $javascript[$radix_modal] = array_merge(
      drupal_js_defaults(), array('group' => JS_THEME, 'data' => $radix_modal));
  }

  // Add radix-field-slideshow when required.
  $field_slideshow = drupal_get_path('module', 'field_slideshow') . '/field_slideshow.js';
  $radix_field_slideshow = drupal_get_path('theme', 'radix') . '/assets/javascripts/radix-field-slideshow.js';
  if (!empty($javascript[$field_slideshow]) && empty($javascript[$radix_field_slideshow])) {
    $javascript[$radix_field_slideshow] = array_merge(
      drupal_js_defaults(), array('group' => JS_THEME, 'data' => $radix_field_slideshow));
  }

  // Add radix-progress when required.
  $progress = 'misc/progress.js';
  $radix_progress = drupal_get_path('theme', 'radix') . '/assets/javascripts/radix-progress.js';
  if (!empty($javascript[$progress]) && empty($javascript[$radix_progress])) {
    $javascript[$radix_progress] = array_merge(
      drupal_js_defaults(), array('group' => JS_THEME, 'data' => $radix_progress));
  }
}

/**
 * Implements template_preprocess_header().
 */
function radix_preprocess_header(&$variables) {
  // Add search_form to theme.
  $variables['search_form'] = '';
  if (module_exists('search') && user_access('search content')) {
    $search_box_form = drupal_get_form('search_form');
    $search_box_form['basic']['keys']['#title'] = '';
    $search_box_form['basic']['keys']['#size'] = 20;
    $search_box_form['basic']['keys']['#attributes'] = array('placeholder' => 'Search');
    $search_box_form['basic']['keys']['#attributes']['class'][] = 'form-control';
    $search_box_form['basic']['submit']['#value'] = t('Search');
    $search_box_form['#attributes']['class'][] = 'navbar-form';
    $search_box_form['#attributes']['class'][] = 'navbar-right';
    $search_box = drupal_render($search_box_form);
    $variables['search_form'] = (user_access('search content')) ? $search_box : NULL;
  }

  // Format and add specified menu to theme.
  $menu = $variables['menu-name'] ? menu_navigation_links($variables['menu-name']) : NULL;
  $variables['menu'] = $menu ? theme('links__header_menu', array('links' => $menu, 'attributes' => array('class' => array('menu', 'nav', 'navbar-nav')))) : NULL;
}
