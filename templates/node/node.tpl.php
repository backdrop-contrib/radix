<?php

/**
 * @file
 * Template display a node.
 */
?>
<article class="<?php print implode(' ', $classes); ?> clearfix"<?php print backdrop_attributes($attributes); ?>>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <?php if ($display_submitted): ?>
    <div class="submitted text-muted">
      <?php print $submitted; ?>
    </div>
  <?php endif; ?>

  <div class="content"<?php print backdrop_attributes($content_attributes); ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
  </div>

  <?php print render($content['links']); ?>

  <?php print render($comments); ?>

</article>
