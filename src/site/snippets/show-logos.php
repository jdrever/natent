<section class="logo-list">
    <div class="container">
      <div class="row">
<?php 

$partnersPage=$site->find('project-partners');
$partners=$partnersPage->children();
foreach ($partners as $partner) : 
  $partnerLogo=$partner->logo()->toImage()->resize(300);
  ?>
        <div class="col-lg-2 col-md-4 col-6">
          <a href="<?=$partner->website() ?>">

            <img src="<?=$partnerLogo->url()?>"
                 class="img-fluid"
                 alt="<?=$partner->name()?> logo" style="width:300">
          </a>
        </div>
<?php endforeach ?>
       </div>
    </div>
  </section>
