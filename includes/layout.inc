<?php
/**
 * @file
 * Theme and preprocess functions for layouts.
 */

/**
 * Provides a list of layouts that can be used within the Layout module.
 *
 * This hook returns an array keyed by a unique identifier for a layout name.
 *
 * The contents of this hook are merged with layout information provided by
 * stand-alone layouts with their own .info files. Generally, the data returned
 * here matches the keys used within layout .info files.
 *
 * @return array
 *   Each item in the returned array of info should have the following keys:
 *   - title: The human-readable name of the layout.
 *   - path: A local path within the providing module to files needed by this
 *     layout, such as associated CSS, the icon image, and template file.
 *   - regions: A list of regions this layout provides, keyed by a machine name
 *     with a human label value.
 *   - preview: Optional. An image representing the appearance of this layout.
 *     If left empty, "preview.png" will be used.
 *   - stylesheets: An array of CSS file used whenever this layout is presented.
 *     If left empty, "layout.css" will be used for all media types.
 *   - template: The name of the template file (without the extension) used for
 *     this layout. All layouts should always be named with a "layout--" prefix,
 *     so that the default variables may be provided in
 *     template_preprocess_layout(). If left empty, "layout--[key]" will be
 *     used, with underscores converted to hyphens in the layout key.
 *   - file: The name of a PHP file to be included prior to any rendering of
 *     this layout. This may be used to provide preprocess functions to prepare
 *     variables for the use of the layout.
 */
//function radix_layout_info() {
//  dpm('dadas');
//  $layouts['radix_default'] = array(
//    'title' => t('Radix Default'),
//    'path' => 'layouts/radix_default',
//    'regions' => array(
//      'header' => t('Header'),
//      'content' => t('Content'),
//      'footer' => t('Footer'),
//    ),
//  );
//  return $layouts;
//}