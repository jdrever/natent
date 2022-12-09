<div class="container">
        <h2><?=$page->addToCommonsHeading()?></h2>

        <label for="resources" class="m-1"><?=$page->addToCommonsLabel() ?></label>
        <div id="resources" class="container">
            <?php
                for ($x = 1; $x <= 4; $x++) {
                    if ($x==2) {
            ?>

            <button type="button" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"> <?=$page->addMoreResourcesButton()?> </button>

            <div class="collapse" id="collapseExample">
            
            <?php } ?>

                <h5><?=$page->resourceHeading()?> <?=$x?></h5>
                <div class="container border bg-light p-2 m-2">
                    <label for="resourceTitle<?=$x?>" class="m-1"><?=$page->resourceTitleLabel()?>:</label>
                    <input class="form-control m-1" type="text" id="resourceTitle<?=$x?>" name="resourceTitle<?=$x?>">
                    <label for="resourceDescription<?=$x?>" class="m-1"><?=$page->resourceDescriptionLabel()?>:</label>
                    <textarea class="form-control m-1" aria-label="With textarea" id="resourceDescription<?=$x?>" name="resourceDescription<?=$x?>" rows="8"></textarea>
                    <label for="resourceUrl<?=$x?>"><?=$page->resourceWebsiteLabel()?>:</label>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="https-addon">https://</span>
                        </div>
                        <input class="form-control" type="text" id="resourceUrl<?=$x?>" name="resourceUrl<?=$x?>"   aria-describedby="https-addon">
                    </div>

                    <label for="fileUpload<?=$x?>"><?=$page->resourceUploadLabel()?>:</label>
                    <input type="file" name="fileUpload<?=$x?>" id="fileUpload<?=$x?>">
                </div>
            <?php } ?>
            </div>
        </div>
    </div>