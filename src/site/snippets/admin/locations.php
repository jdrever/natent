<h3><?= t("Adding a New Location","Adding a New Location") ?></h3>
<div class="container m-2 p-2 bg-light">
    <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
        <input type="hidden" id="action" name="action" value="ADD-NEW-LOCATION">
        <label for="locationName"><?= t("Location name") ?></label>
        <input type="text" class="form-control" name="locationName" id="locationName" placeholder="<?= t("Enter the new Location name","Enter the new Location name") ?>" aria-label="<?= t("Enter the new Location name", "Enter the new Location name") ?>" required>            
        <label for="locationLatitude"><?= t("Location latitude") ?></label>
        <input type="text" class="form-control" name="locationLatitude" id="locationLatitude" placeholder="<?= t("Enter the new Location latitude (e.g. 52.588667 - available in Google Maps)","Enter the new Location latitude (e.g. 52.588667 - available in Google Maps)") ?>" aria-label="<?= t("Enter the new Location latitude (e.g. 52.588667 - available in Google Maps)", "Enter the new Location latitude (e.g. 52.588667 - available in Google Maps)") ?>" required>
        <label for="locationLongitude"><?= t("Location longitude") ?></label>
        <input type="text" class="form-control" name="locationLongitude" id="locationLongitude" placeholder="<?= t("Enter the new Location longitude (e.g. -1.072479 - available in Google Maps)","Enter the new Location longitude (e.g. -1.072479 - available in Google Maps)") ?>" aria-label="<?= t("Enter the new Location longitude (e.g. -1.072479 - available in Google Maps)","Enter the new Location longitude (e.g. -1.072479 - available in Google Maps)") ?>" required>
        <?php
if ($team['role']=='GLOBAL') : ?>
        <div class="mb-3">
            <label for="countryId"><?= t("Select a Country for the new Location","Select a Country for the new Location") ?> :</label>
            <select class="form-select" name="countryId" id="countryId" required>
                <option selected value=""><?= t("Select a Country for the new Location","Select a Country for the new Location") ?></option>
    <?php foreach ($countries as $country) : ?>

                    <option value="<?= $country['id'] ?>"><?= $country['name'] ?></option>
    <?php endforeach ?>
            </select>
        </div>

<?php else: ?>
        <input type="hidden" name="countryId" id="countryId" value="<?=$team['country_id']?>">     
<?php endif ?>
        <input type="submit" class="btn btn-primary" value="<?= t("ADD NEW LOCATION","ADD NEW LOCATION") ?>">
    </form>
</div>

<h3><?= t("Editing an Existing Location","Editing an Existing Location") ?></h3>

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
                    <input type="text" class="form-control" name="locationName" id="locationName" value="<?= $location['name'] ?>" placeholder="<?= t("Location name","Location name") ?>" aria-label="<?= t("Location name") ?>" required>            
                    <label for="locationLatitude"><?= t("Latitude","Latitude") ?></label>
                    <input type="text" class="form-control" name="locationLatitude" id="locationLatitude" value="<?= $location['latitude'] ?>" placeholder="<?= t("Latitude") ?>" aria-label="<?= t("Latitude") ?>" required>
                    <label for="locationLongitude"><?= t("Longitude","Longitude") ?></label>
                    <input type="text" class="form-control" name="locationLongitude" id="locationLongitude" value="<?= $location['longitude'] ?>" placeholder="<?= t("Longitude") ?>" aria-label="<?= t("Longitude") ?>" required>

                    <input type="submit" class="btn btn-primary" value="<?= t("UPDATE","UPDATE") ?>">
                </form>
            </td>
            <td>
<?php
if ($team['location_id']==$location['id'])
{
?>
    <div class="alert alert-info" role="alert"><?=t("You are currently logged in as this Location and therefore cannot remove it","You are currently logged in as this Location and therefore cannot remove it")?>.</div>
<?php
}
else
{
?>

                <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
                    <input type="hidden" id="action" name="action" value="REMOVE-LOCATION">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="locationCheck<?= $location['id'] ?>" id="locationCheck<?= $location['id'] ?>" placeholder="<?= t("Type the Location name to confirm","Type the Location name to confirm") ?>" aria-label="<?= t("Type the Location name to confirm","Type the Location name to confirm") ?>" required pattern="<?= $location['name'] ?>">
                        <label for="locationCheck<?= $location['id'] ?>"><?= t("Type the Location name to confirm","Type the Location name to confirm") ?></label>
                    </div>
                    <input type="hidden" id="locationId" name="locationId" value="<?= $location['id'] ?>">
                    <input type="submit" class="btn btn-danger" value="<?= t("REMOVE LOCATION AND ALL OF THEIR WORK","REMOVE LOCATION AND ALL OF THEIR WORK") ?>">
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