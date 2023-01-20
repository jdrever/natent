<?php if ($userLoggedIn) : ?>
<div class="container mt-2">
  <div class="alert alert-info" role="alert"><i class="bi bi-exclamation-square-fill h1"></i> <?=t("Have any resources helped you with this stage of the process? Share them with other Teams by adding them to The Commons.")?>
  <button type="button" class="btn btn-primary m-2" data-bs-toggle="collapse" data-bs-target="#collapseCommons" aria-expanded="false" aria-controls="collapseCommons">Share Your Resources</button>
  <div class="collapse" id="collapseCommons">
        <div id="resources" class="container">
            <?php
                for ($x = 1; $x <= 4; $x++) {
                    if ($x==2) {
            ?>

            <button type="button" class="btn btn-secondary" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"> <?=t("Got More Resources to Share?","Got More Resources to Share?")?> </button>

            <div class="collapse" id="collapseExample">
            
            <?php } ?>

                <h5><?=t("Resource")?> <?=$x?></h5>
                <div class="container border bg-light p-2 m-2">
                    <label for="resourceTitle<?=$x?>" class="m-1"><?=t("What is the title of your resource?","What is the title of your resource?")?></label>
                    <input class="form-control m-1" type="text" id="resourceTitle<?=$x?>" name="resourceTitle<?=$x?>">
                    <label for="resourceDescription<?=$x?>" class="m-1"><?=t("Give a description of your resource","Give a description of your resource")?>:</label>
                    <textarea class="form-control m-1" aria-label="With textarea" id="resourceDescription<?=$x?>" name="resourceDescription<?=$x?>" rows="8"></textarea>
                    <label for="resourceUrl<?=$x?>"><?=t("Enter the website location for your resource (if one exists)", "Enter the website location for your resource (if one exists)")?>:</label>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="https-addon">https://</span>
                        </div>
                        <input class="form-control" type="text" id="resourceUrl<?=$x?>" name="resourceUrl<?=$x?>"   aria-describedby="https-addon">
                    </div>

                    <label for="fileUpload<?=$x?>"><?=t("Upload a document (optional - image or PDF only)","Upload a document (optional - image or PDF only)")?>:</label>
                    <input type="file" name="fileUpload<?=$x?>" id="fileUpload<?=$x?>">
                </div>
            <?php } ?>
                    </div>
            </div>
        </div>
    </div>
</div>
<?php endif ?>