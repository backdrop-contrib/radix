<?php
/**
 * @file
 * Template for a 2 column layout.
 */
?>
<div class="<?php print implode(' ', $classes); ?> layout--two-column"<?php print backdrop_attributes($attributes); ?>>

  <div class="page">
    <?php if (!empty($content['header'])): ?>
      <header class="page__header" role="header">
        <?php print $content['header']; ?>
      </header>
    <?php endif; ?>

    <?php if ($content['top']): ?>
      <section class="page__top">
        <div class="container">
          <?php print $content['top']; ?>
        </div>
      </section>
    <?php endif; ?>

    <?php if ($messages): ?>
      <section class="page__messages">
        <div class="container">
          <?php print $messages; ?>
        </div>
      </section>
    <?php endif; ?>

    <?php if ($tabs): ?>
      <div class="page__tabs">
        <div class="container">
          <?php print $tabs; ?>
        </div>
      </div>
    <?php endif; ?>

    <main class="page__content" role="main">
      <div class="container">
        <?php if ($title): ?>
          <div class="page-header">
            <h1 class="page__title title">
              <?php print $title; ?>
            </h1>
          </div>
        <?php endif; ?>

        <div class="row">
          <div class="col-md-8 content">
            <?php print $content['content']; ?>
          </div>
          <div class="col-md-4 sidebar">
            <?php print $content['sidebar']; ?>
          </div>
        </div>
      </div>
    </main>

    <?php if ($content['footer']): ?>
      <footer class="page__footer" role="footer">
        <div class="container">
          <?php print $content['footer']; ?>
        </div>
      </footer>
    <?php endif; ?>
  </div>

</div>
