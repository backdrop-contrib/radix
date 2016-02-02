<?php
/**
 * @file
 * Display generic site information such as logo, site name, etc.
 */
?>
<nav class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
        <span class="sr-only"><?php print t('Toggle navigation'); ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php if ($site_name || $logo): ?>
        <a href="<?php print $front_page; ?>" class="navbar-brand" rel="home" title="<?php print t('Home'); ?>">
          <?php if ($logo): ?>
            <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" id="logo" />
          <?php endif; ?>
          <?php if ($site_name): ?>
            <span class="site-name"><?php print $site_name; ?></span>
          <?php endif; ?>
        </a>
      <?php endif; ?>
    </div>

    <div class="collapse navbar-collapse" id="navbar-collapse">
      <?php if ($main_menu): ?>
        <ul class="nav navbar-nav">
          <?php print render($main_menu); ?>
        </ul>
      <?php endif; ?>
      <?php if ($search_form): ?>
        <?php print $search_form; ?>
      <?php endif; ?>
    </div>
  </div>
</nav>
