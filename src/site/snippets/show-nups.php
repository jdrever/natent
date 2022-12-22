<?php
$buttonText=isset($buttonText) ? $buttonText : 'FIND OUT MORE';
$counter=1;
?>

<?php foreach($nups as $nup): ?>
<div class="card m-2 text-white bg-info">
  <div class="card-header">
      <h2>
          <?=$nup->nupTitle()->isNotEmpty() ? $nup->nupTitle() : $nup->title()?>&nbsp;
          <button class="btn btn-outline-light btn-sml" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNUP<?=$counter?>" aria-expanded="false" aria-controls="collapseNUP<?=$counter?>">
          <?=t($buttonText)?></button>
      </h2>
  </div>
  <div class="collapse" id="collapseNUP<?=$counter?>">
      <div class="card-body">
          <p class="card-text"><?=$nup->description()?></p>
      </div>
  </div>
</div>
<?php $counter++; ?>
<?php endforeach ?>
