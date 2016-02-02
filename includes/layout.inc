<?php
/**
 * @file
 * Theme and preprocess functions for layouts.
 */



/**
 * Implements template_preprocess_header().
 */
function radix_preprocess_header(&$variables) {
  // Format and add main menu to theme.
  $variables['main_menu'] = _radix_dropdown_menu_tree(variable_get('menu_main_links_source', 'main-menu'), array(
    'min_depth' => 1,
    'max_depth' => 2,
  ));

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

  // Fix logo path.
  $variables['logo'] = base_path() . backdrop_get_path('theme', _radix_current_theme()) . '/logo.png';
}
