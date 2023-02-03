<?php
$posts=$page->children()->filterBy('template','blog-post');
// add the tag filter
if($tag = param('tag')) {
  $posts = $posts->filterBy('tags', $tag, ',');
}
if (count($posts)>0) :
?>
<?php foreach ($posts as $post) :  ?>
<h2><?= $post->title() ?></h2>
<p><strong><?= $post->publishedDate() ?></strong></p>
<p><?= $post->openingContent() ?>
  <p><a href="<?=$post->url()?>" type="button" class="btn btn-primary m-2"><?=t('READ MORE','READ MORE')?> &rarr;</a></p>
  <?php endforeach ?>

  <?php endif ?>