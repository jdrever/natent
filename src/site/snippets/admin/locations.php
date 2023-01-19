<?php if ($adminCountry>0) :?>

<ul class="nav nav-tabs" id="adminTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link<?=($selectedTab==='add') ? ' active' : '' ?>" id="add-tab" data-bs-toggle="tab"
      data-bs-target="#add" type="button" role="tab" aria-controls="add"
      aria-selected="<?=($selectedTab==='add') ? 'true' : 'false' ?>"><?= t("Adding a New Location","Adding a New Location") ?></button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link<?=($selectedTab==='edit') ? ' active' : '' ?>" id="edit-tab" data-bs-toggle="tab"
      data-bs-target="#edit" type="button" role="tab" aria-controls="edit"
      aria-selected="<?=($selectedTab==='edit') ? 'true' : 'false' ?>"><?= t("Editing an Existing Location","Editing an Existing Location") ?></button>
  </li>
</ul>
<div class="tab-content" id="adminTabContent">
  <div class="tab-pane fade<?=$selectedTab==='add' ? ' show active' : ''?>" id="add" role="tabpanel"
    aria-labelledby="add-tab">
    <div class="container m-2 p-2 bg-white">
      <form method="post">
        <input type="hidden" id="action" name="action" value="ADD-NEW-LOCATION">
        <div class="mb-3">
          <label for="locationName" class="form-label"><?= t("Location name","Location name") ?></label>
          <input type="text" class="form-control" name="locationName" id="locationName"
            placeholder="<?= t("Enter the new Location name","Enter the new Location name") ?>"
            aria-label="<?= t("Enter the new Location name", "Enter the new Location name") ?>" required>
        </div>
        <div class="mb-3">
          <label for="locationLatitude" class="form-label"><?= t("Location latitude","Location latitude") ?></label>
          <input type="text" class="form-control" name="locationLatitude" id="locationLatitude"
            placeholder="<?= t("Enter the new Location latitude (e.g. 52.588667 - available in Google Maps)","Enter the new Location latitude (e.g. 52.588667 - available in Google Maps)") ?>"
            aria-label="<?= t("Enter the new Location latitude (e.g. 52.588667 - available in Google Maps)", "Enter the new Location latitude (e.g. 52.588667 - available in Google Maps)") ?>"
            required>
        </div>
        <div class="mb-3">
          <label for="locationLongitude" class="form-label"><?= t("Location longitude","Location longitude") ?></label>
          <input type="text" class="form-control" name="locationLongitude" id="locationLongitude"
            placeholder="<?= t("Enter the new Location longitude (e.g. -1.072479 - available in Google Maps)","Enter the new Location longitude (e.g. -1.072479 - available in Google Maps)") ?>"
            aria-label="<?= t("Enter the new Location longitude (e.g. -1.072479 - available in Google Maps)","Enter the new Location longitude (e.g. -1.072479 - available in Google Maps)") ?>"
            required>
        </div>
        <input type="hidden" name="countryId" id="countryId" value="<?=$adminCountry?>">
        <input type="submit" class="btn btn-primary" value="<?= t("ADD NEW LOCATION","ADD NEW LOCATION") ?>">
      </form>
    </div>
  </div>
  <div class="tab-pane fade<?=($selectedTab==='edit') ? ' show active' : ''?>" id="edit" role="tabpanel"
    aria-labelledby="edit-tab">

    <table class="table m-2 p-2 border">
      <tr>
        <th><?= t("Location") ?></th>
        <th>REMOVE</th>
      </tr>

      <?php
    foreach ($locations as $location)
    {
    ?>
      <tr>
        <td>
          <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
            <input type="hidden" id="action" name="action" value="UPDATE-LOCATION">
            <input type="hidden" id="locationId" name="locationId" value="<?= $location['id'] ?>">
            <label for="locationName"><?= t("Location name","Location name") ?></label>
            <input type="text" class="form-control" name="locationName" id="locationName"
              value="<?= $location['name'] ?>" placeholder="<?= t("Location name","Location name") ?>"
              aria-label="<?= t("Location name") ?>" required>
            <label for="locationLatitude"><?= t("Latitude","Latitude") ?></label>
            <input type="text" class="form-control" name="locationLatitude" id="locationLatitude"
              value="<?= $location['latitude'] ?>" placeholder="<?= t("Latitude") ?>" aria-label="<?= t("Latitude") ?>"
              required>
            <label for="locationLongitude"><?= t("Longitude","Longitude") ?></label>
            <input type="text" class="form-control" name="locationLongitude" id="locationLongitude"
              value="<?= $location['longitude'] ?>" placeholder="<?= t("Longitude") ?>"
              aria-label="<?= t("Longitude") ?>" required>

            <input type="submit" class="btn btn-primary" value="<?= t("UPDATE","UPDATE") ?>">
          </form>
        </td>
        <td>
          <?php
if ($team['location_id']==$location['id'])
{
?>
          <div class="alert alert-info" role="alert">
            <?=t("You are currently logged in as this Location and therefore cannot remove it","You are currently logged in as this Location and therefore cannot remove it")?>.
          </div>
          <?php
}
else
{
?>

          <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
            <input type="hidden" id="action" name="action" value="REMOVE-LOCATION">
            <div class="form-floating">
              <input type="text" class="form-control" name="locationCheck<?= $location['id'] ?>"
                id="locationCheck<?= $location['id'] ?>"
                placeholder="<?= t("Type the Location name to confirm","Type the Location name to confirm") ?>"
                aria-label="<?= t("Type the Location name to confirm","Type the Location name to confirm") ?>" required
                pattern="<?= $location['name'] ?>">
              <label
                for="locationCheck<?= $location['id'] ?>"><?= t("Type the Location name to confirm","Type the Location name to confirm") ?></label>
            </div>
            <input type="hidden" id="locationId" name="locationId" value="<?= $location['id'] ?>">
            <input type="submit" class="btn btn-danger"
              value="<?= t("REMOVE LOCATION AND ALL OF THEIR WORK","REMOVE LOCATION AND ALL OF THEIR WORK") ?>">
          </form>
          <?php
}
?>
        </td>
      </tr>
      <?php
    }
    ?>
    </table>
  </div>
</div>
<?php endif ?>