<?php /** @var \Kirby\Cms\Block $block */ 
$div="";
?>

<style>
.file-block {
    background-color: #ddf1ce;
    display: block;
    padding: 1em;
}

.download-button {
    background-color: #32373c;
    border-radius: 33px;
    padding: 0.5em 1em;
    margin-left: 0.5em;
    color: #ffffff;
    text-decoration: none;
}

.download-button:hover {
    color: #ffffff;
}
</style>

<div class="file-block">
    <?php if($file = $block->file()->toFile()): ?>
        <a href="<?= $file->url()?>" target="_blank"><?=$block->label() != "" ? $block->label() : $file->filename()?></a>
        <a class="download-button" href="<?= $file->url()?>" download><?=I18n::translate("field.blocks.file.download")?> </a>
    <?php else: ?>
        <p><?=I18n::translate("field.blocks.file.nofile")?></p>
    <?php endif?>
</div>
