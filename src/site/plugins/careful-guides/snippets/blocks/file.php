<?php /** @var \Kirby\Cms\Block $block */ ?>

<div class="container m-2 p-2 bg-light">
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
