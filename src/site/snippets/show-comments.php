<?php
//TODO: add proper url
$otherTeamPage="";
if (count($comments)>0) :
?>
  <button class="btn-outline-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseComments<?=$contentId?>" aria-expanded="false" aria-controls="collapseComments<?=$contentId?>">

   <?=t("See Comments")?> <span class="badge bg-secondary"><?=count($comments)?></span> 
  </button>
  <div class="collapse" id="collapseComments<?=$contentId?>">
    <div class="card card-body">
  <?php foreach ($comments as $comment) :?>
    <div class="p-1 border"><i class="bi bi-chat-fill"></i><i><?=$comment['comment'] ?></i> <a href="<?=$otherTeamPage?>?teamId=<?=$comment['team_id']?>"><?=$comment['team_name']?></a>
    <?php
            $uniqueId=uniqid();
?>

<button class="btn-outline-primary btn-sm" type="button" onclick="getTranslation('<?=$comment['comment'] ?>','<?=$uniqueId?>')">Translate to English</button></div>
<div id="<?=$uniqueId?>"></div>
<?php snippet('show-appreciation-button',['contentType'=>'Comment', 'contentId'=>$comment['id']]) ?>

  <?php endforeach
?>
        </div>
    </div>
<?php endif ?>