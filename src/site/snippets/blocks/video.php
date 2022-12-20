<?php
use Kirby\Cms\Html;

/** @var \Kirby\Cms\Block $block */
?>
<figure>
<?php if(str_contains($block->url(),'youtu')): ?>
<?php
$ytUrl = str_replace("https://","",$block->url());
if (str_starts_with($ytUrl, "youtu.be/"))
{
    $ytId=str_replace("youtu.be/", "", $ytUrl);
}
elseif (str_starts_with($ytUrl, "www.youtube.com/embed/"))
{
    
    $ytId=substr(str_replace("www.youtube.com/embed/", "", $ytUrl),0,11);
}
else
{
    parse_str( parse_url( $ytUrl, PHP_URL_QUERY ), $ytUrlVars );
    $ytId=$ytUrlVars['v'];
}
?>

  <lite-youtube videoid="<?=$ytId?>" playlabel="<?=$block->caption()?>"></lite-youtube>
<?php elseif ($video = Html::video($block->url())): ?>
  <?= $video ?>
<?php endif ?>
<?php if ($block->caption()->isNotEmpty()): ?>
  <figcaption><?= $block->caption() ?></figcaption>
<?php endif ?>
</figure>
