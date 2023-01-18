<?php if ($team['role']==='GLOBAL'||$team['role']==='ADMIN') :?>
<div class="container bg-light p-3 m-3">
  <?php if ($team['role']==='GLOBAL') :?>
  <form class="form-inline" method="post" action="/admin-controller">
    <input type="hidden" name="action" id="action" value="select-country">
    <div class="row g-3 align-items-center mb-2">
      <div class="col-2">
        <label for="countryId" class="form-label">Country</label>
      </div>
      <div class="col-3">
        <select class="form-select" name="countryId" id="countryId" required>
          <?php if ($adminCountry==0) : ?>
          <option selected value=""><?= t("Select a Country","Select a Country") ?></option>
          <?php endif ?>
          <?php foreach ($countries as $country) : ?>
          <option value="<?= $country['id'] ?>" <?=($adminCountry==$country['id'] ? 'selected' : '')?>>
            <?= $country['name'] ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="col-2">
        <input type="submit" class="btn btn-primary btn-sm" value="SELECT">
      </div>
    </div>
  </form>
  <?php endif ?>
  <?php if (($team['role']==='ADMIN'||$team['role']==='GLOBAL')&&count($locations)>0) :?>
  <form class="form-inline" method="post" action="/admin-controller">
    <input type="hidden" name="action" id="action" value="select-location">
    <div class="row g-3 align-items-center">
      <div class="col-2">
        <label for="locationId" class="form-label">School</label>
      </div>
      <div class="col-3">
        <select class="form-select" id="locationId" name="locationId">
        <?php if ($adminLocation==0) : ?>
          <option selected value=""><?= t("Select a School","Select a School") ?></option>
          <?php endif ?>
          <?php foreach ($locations as $location) : ?>
          <option value="<?=$location['id']?>" <?=($adminLocation==$location['id'] ? 'selected' : '')?>><?=$location['name']?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="col-2">
        <input type="submit" class="btn btn-primary btn-sm" value="SELECT">
      </div>
    </div>
  </form>
  <?php endif ?>
</div>
<?php endif ?>