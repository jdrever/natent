<?php
use carefulcollab\helpers as helpers;
if ($userRole=='TEACHER'||$userRole=='ADMIN'||$userRole=="GLOBAL")
{
  $locationId=Cookie::exists('adminLocation') ? Cookie::get('adminLocation') : $team['location_id'];
  $moderationQueue=helpers\DataHelper::getModerationQueue($locationId);
  if ($moderationQueue)
  {
    $moderationPage=$site->index()->find('/platform/admin/content');;
?>
    <div class="alert alert-warning mb-1" role="alert"><a class="btn btn-primary btn-outline" href="<?=$moderationPage->url() ?>"><i class="bi bi-exclamation-triangle-fill"></i><?=t("You have content waiting to moderate","You have content waiting to moderate")?>:<br> <?=count($moderationQueue) ?> <?=t("item(s)","item(s)")?></a></div>
<?php
  }
}
?>