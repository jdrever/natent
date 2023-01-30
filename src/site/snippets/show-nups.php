<?php
$buttonText=isset($buttonText) ? $buttonText : 'FIND OUT MORE';
$counter=1;
?>

<?php foreach($nups as $nup): ?>
<div class="container m-2 p-2 text-white bg-info">
  <div class="row">
  <?php if ($image=$nup->image()) :?>
    <div class="col-sm-3">
      <img src="<?=$image->resize(200)->url() ?>" alt="<? $image->alt()->isNotEmpty() ? $image->alt() : ''  ?>" >
    </div>
    <?php endif ?>
    <div class="col">
      <h2><?=$nup->nupTitle()->isNotEmpty() ? $nup->nupTitle() : $nup->title()?></h2>
      <button class="btn btn-outline-light btn-sml" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNUP<?=$counter?>" aria-expanded="false" aria-controls="collapseNUP<?=$counter?>">
          <?=t($buttonText)?></button>
    </div>
  </div>
  <div class="collapse p-2" id="collapseNUP<?=$counter?>">
    <div class="card-body">
      <p class="card-text"><?=$nup->description()?></p>
    </div>
  </div>
</div>
<?php $counter++; ?>
<?php endforeach ?>
