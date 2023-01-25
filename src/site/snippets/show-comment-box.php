<?php 
if (!empty($contentId)) :
  if (!isset($comments)) $comments='';
  snippet('show-comments', compact('comments','contentType','contentId' )) ?>
<form class="form-inline" method="post" action="/collab-controller">
    <input type="hidden" name="point" id="point" value="Comment">
    <input type="hidden" name="contentType" id="contentType" value="<?=$contentType?>">
    <input type="hidden" name="contentId" id="contentId" value="<?=$contentId?>">
    <textarea name="comment" id="comment" required></textarea>
    <button type="submit" class="btn btn-outline-primary btn-sm"><i class="bi bi-chat-fill"></i><?=t('Comment')?></button>
</form>
<?php endif ?>