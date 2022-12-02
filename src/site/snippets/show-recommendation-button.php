<?php
if (empty($resourceId)) return;
if ($userRole!='ADMIN'&&$userRole!="GLOBAL") return;


   if ($recommend==1)
      $recommendButtonText=t('Recommend');
   else
      $recommendButtonText=t('Remove Recommendation');

   $collaborationPointPage=$site->find('collab-controller');
  ?>
<form class="form-inline" method="post" action="$collaborationPointPage->url()">
    <input type="hidden" name="point" id="point" value="Recommend">
    <input type="hidden" name="resourceId" id="contentId" value="$resourceId">
    <input type="hidden" name="recommend" id="recommend" value="$recommend">
    <div class="d-flex align-items-end justify-content-end">
      <div>
          <button type="submit" class="btn btn-outline-primary btn-outline btn-sm"><i class="bi bi-hand-thumbs-up-fill"></i><?=t($recommendButtonText,$recommendButtonText)?></button>
      </div>
    </div>
</form>
  