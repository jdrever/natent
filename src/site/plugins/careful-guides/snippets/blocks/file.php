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
        <?php if ($file->extension()=='pdf') : ?>
            <iframe src="https://docs.google.com/viewer?url=<?=$file->url()?>&embedded=true" frameborder="0" height="300px" width="100%"></iframe>
        <?php endif ?>    
        <a href="<?= $file->url()?>" target="_blank"><?=$block->label() != "" ? $block->label() : $file->filename()?></a>
        <a class="btn btn-primary btn-sm" href="<?= $file->url()?>" target="_blank"><?=t('VIEW','VIEW')?> </a>
    <?php else: ?>
        <p><?=t("No file")?></p>
    <?php endif?>
</div>
