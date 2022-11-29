<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    <?=$kirby->language()->name()?>
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <?php foreach($kirby->languages() as $language): ?>
    <a class="dropdown-item <?php e($kirby->language() == $language, ' active') ?>"
      href="<?php e($page->translation($language->code())->exists(), $page->url($language->code()), $language->url()) ?>" hreflang="<?php echo $language->code() ?>">
      <?php echo html($language->name()) ?>
    </a>
    <?php endforeach ?>
  </div>
</div>
