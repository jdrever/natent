
<?php snippet('show-appreciations', ['appreciations'=>$profileAppreciations]) ?>
<form class="form-inline" method="post" action="$collaborationPointPage">
    <input type="hidden" name="point" id="point" value="Appreciate">
    <input type="hidden" name="contentType" id="contentType" value="<?=$contentType?>">
    <input type="hidden" name="contentId" id="contentId" value="<?=$contentId?>">
    <button type="submit" class="btn btn-outline-primary btn-outline btn-sm"><i class="bi bi-stars"></i><?=t('Appreciate')?></button>
</form>
  