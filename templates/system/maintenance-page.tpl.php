<!DOCTYPE html>
<html<?php print backdrop_attributes($html_attributes); ?>>
  <head>
    <title><?php print $head_title; ?></title>
    <?php print backdrop_get_html_head(); ?>
    <?php print backdrop_get_css(); ?>
    <?php print backdrop_get_js(); ?>
  </head>
  <body class="<?php print implode(' ', $classes); ?>">

  <header id="header" class="header" role="header">
    <nav class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php print $front_page; ?>" id="logo" class="navbar-brand">
            <?php print $site_name; ?>
          </a>
        </div> <!-- /.navbar-header -->
      </div> <!-- /.container -->
    </nav>
  </header>

  <div id="main-wrapper">
    <div id="main" class="main container">
      <div class="row">
        <?php if (!empty($sidebar_first)): ?>
          <div class="col-md-3 sidebar">
            <?php print $sidebar_first; ?>
          </div>
        <?php endif ?>
        <div class="col-md-9">
          <?php if ($title): ?>
            <h1 class="page-header"><?php print $title; ?></h1>
          <?php endif; ?>
          <?php print $content; ?>
        </div>
      </div>
    </div> <!-- /#main -->
  </div> <!-- /#main-wrapper -->

  </body>
</html>
