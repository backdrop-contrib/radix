<?php
/**
 * @file
 * Helper functions for the Radix theme.
 */

/**
 * Returns the current active theme.
 */
function _radix_current_theme() {
  global $custom_theme, $theme;

  if (!empty($custom_theme)) {
    $current_theme = $custom_theme;
  }
  else {
    $current_theme = $theme ? $theme : variable_get('theme_default', 'garland');
  }

  return $current_theme;
}
