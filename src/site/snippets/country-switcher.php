<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    <?=$country?>
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <?php foreach($countries as $countryOption): ?>
    <a class="dropdown-item <?php e($countryOption->title() == $country, ' active') ?>"
      href="/country-controller?country=<?=$countryOption->title() ?>" >
      <?php t($countryOption->title(),$countryOption->title()) ?>
    </a>
    <?php endforeach ?>
  </div>
</div>
