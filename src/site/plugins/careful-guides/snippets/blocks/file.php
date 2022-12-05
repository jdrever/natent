<?php /** @var \Kirby\Cms\Block $block */ ?>

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
        <a class="download-button" href="<?= $file->url()?>" target="_blank"><?=t("View")?> </a>
    <?php else: ?>
        <p><?=t("No file")?></p>
    <?php endif?>
</div>
