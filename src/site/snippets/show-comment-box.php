<?php snippet('show-comments', ['comments'=>$comments]) ?>
<form class="form-inline" method="post" action="$collaborationPointPage">
    <input type="hidden" name="point" id="point" value="Comment">
    <input type="hidden" name="contentType" id="contentType" value="<?=$contentType?>">
    <input type="hidden" name="contentId" id="contentId" value="<?=$contentId?>">
    <textarea name="comment" id="comment" required></textarea>
    <button type="submit" class="btn btn-outline-primary btn-outline btn-sm"><i class="bi bi-chat-fill"></i><?=t('Comment')?></button>
</form>