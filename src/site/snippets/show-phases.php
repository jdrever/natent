<?php 
$phaseNumber=1;

$width=300;
$height=200;

?>
<h2>The Phases</h2>
      Country: <?php snippet('country-switcher') ?>
      <p>Work through each Phase in order.</p>

<?php foreach ($phases as $phase) : 
    $pagesInPhase=$page->children()->filterBy('phase', strtolower($phase->title()));
    if ($pagesInPhase):
      $countryPhase=$pagesInPhase->filterBy('countries', '*=', str_replace(" ","-",strtolower($country)))->first();
      if ($countryPhase) :
        if ($phaseNumber==1) : ?>
      <a href="<?=$countryPhase->url()?>" class="btn btn-primary m-2"><?=t('GET STARTED', 'GET STARTED')?> →</a>
        <?php endif ?>
      <a href="<?=$countryPhase->url()?>">   
        <figure class="figure">
          <figcaption class="figure-caption">
            <?=$phaseNumber?>. <?=$countryPhase->title()?>
          </figcaption>
            <?php if ($image = $phase->mainImage()->toImage()) : 
             $altText=$phase->mainImage()->toImage()->imageTitle() . " by " . $phase->mainImage()->toImage()->photographer() . " is marked with " . $phase->mainImage()->toImage()->license();
            
            ?>
                <img class="figure-img img-fluid rounded"
    src="<?=$image->clip($width)->url()?>" 
    alt="<?=$altText?>"
    width="<?=$width?>"
    height="<?= $height ?>"
    loading="lazy"
    > 
            <?php endif ?>
        </figure>
      </a>
      <br>
<?php
    endif;
  endif;  
  $phaseNumber++; 
endforeach; 
?>
      <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        <button class="btn btn-primary btn-sm m-2" type="button" data-bs-toggle="collapse"
          data-bs-target="#collapseImageCredits" aria-expanded="false" aria-controls="collapseImageCredits">
          See Image Credits
        </button>
        <div class="collapse" id="collapseImageCredits">
<?php foreach ($phases as $phase) : ?>
  <?php if ($image = $phase->mainImage()->toImage()) : 
$creditText=$phase->mainImage()->toImage()->imageTitle() . " by " . $phase->mainImage()->toImage()->photographer() . " is marked with " . $phase->mainImage()->toImage()->license();
  ?>
          <p>
            <small>
              <b><?=$phase->title()?></b>
              <?=$creditText?>
              <?php if ($licenseUrl=$phase->mainImage()->toImage()->licenseUrl()) : ?>
              To see license terms, visit <a href="<?=$licenseUrl?>" target="_blank"><?=$licenseUrl?></a>
              <?php endif ?>
            </small>
          </p>

    <?php endif ?>
  <?php endforeach ?>
        </div>
  </div>

 