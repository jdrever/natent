<div class="container-fluid bg-light p-1">
  <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb mx-4">
    <?php foreach($site->breadcrumb()->filterBy('template','!=','country') as $crumb):  ?>
      <?php if ($crumb->title()!='Home') :?>
    <li class="breadcrumb-item">
      <a href="<?= $crumb->url() ?>" <?= e($crumb->isActive(), 'aria-current="page"') ?>>
        <?= $crumb->pageTitle()->isNotEmpty() ? html($crumb->pageTitle()) : html($crumb->title()) ?>
      </a>
    </li>
      <?php endif ?>
    <?php endforeach ?>
  </ol>
</nav>
</div>



