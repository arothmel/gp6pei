<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"><div class="node-inner">

  <?php if (!$page): ?>
    <h2 class="title"><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>

  <?php if ($unpublished): ?>
    <div class="unpublished"><?php print t('Unpublished'); ?></div>
  <?php endif; ?>

  <?php if ($submitted || $terms): ?>
    <div class="meta">
      <?php if ($terms && $type == 'story' && $page): ?>
        <div class="terms terms-inline"><?php print $terms; ?></div>
      <?php endif; ?>
      <?php if ($submitted) { ?>
        <?php $submitted = $date; ?>
      <?php } elseif ($submitted) { ?>
        <?php $submitted = str_replace('Submitted b', 'B', $submitted);?>
        <?php $submitted = str_replace('Soumis p', 'P', $submitted);?>
      <?php } ?>
      <span class="submitted"><?php print $submitted; ?></span>
    </div>
  <?php endif; ?>

  <div class="content">
    <?php print $content; ?>
  </div>
  
  <div class="go-to-article"><h2><?php print $node->field_source_link[0]['view']; ?></h2></div>

  <?php print $links; ?>

</div></div> <!-- /node-inner, /node -->
