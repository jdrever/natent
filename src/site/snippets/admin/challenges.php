<?php

use carefulcollab\helpers as helpers;

?>

<ul class="nav nav-tabs" id="adminTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="add-tab" data-bs-toggle="tab" data-bs-target="#add" type="button" role="tab"
      aria-controls="add"
      aria-selected="true"><?= t("Adding a New Challenge for", "Adding a New Challenge for") . ' '.  $team['country_name'] ?></button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="edit-tab" data-bs-toggle="tab" data-bs-target="#edit" type="button" role="tab"
      aria-controls="edit"
      aria-selected="false"><?= t("Edit an existing Challenge", "Edit an existing Challenge") ?></button>
  </li>
</ul>
<div class="tab-content" id="adminTabContent">
<div class="tab-pane fade show active" id="add" role="tabpanel" aria-labelledby="add-tab">
<div class="container m-2 p-2 bg-light">
  <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
    <input type="hidden" id="action" name="action" value="ADD-NEW-CHALLENGE">
    <div class="form-floating">
      <input type="text" class="form-control" name="challengeName" id="challengeName" placeholder="<?= t("Enter the new Challenge name","Enter the new Challenge name") ?>" aria-label="<?= t("Enter the new Challenge name") ?>" required>
      <label for="teamName"><?= t("Enter the new Challenge name","Enter the new Challenge name") ?></label>
    </div>
    <label for="challengeDescription" class="m-1"><?= t("Enter a description","Enter a description") ?>:</label>
    <textarea class="form-control m-1" aria-label="With textarea" id="challengeDescription" name="challengeDescription" rows="8" required></textarea>
    <label for="school-info" class="m-1"><?= t("Enter further information (displayed as second paragraph)", "Enter further information (displayed as second paragraph)") ?>:</label>
    <textarea class="form-control m-1" aria-label="With textarea" id="challengeFurtherInformation" name="challengeFurtherInformation" rows="8"></textarea>

    <?php

    $topics = helpers\DataHelper::getAreasToInvestigate();
    $challenges = helpers\DataHelper::getChallengesForCountry($userId);

    ?>
    <div class="mb-3">
      <label for="topicId"><?= t("Select a Topic for the new Challenge","Select a Topic for the new Challenge") ?> :</label>
      <select class="form-select" name="topicId" id="topicId" required>
        <option selected value=""><?= t("Select a Topic for the new Challenge", "Select a Topic for the new Challenge") ?></option>
        <?php
        foreach ($topics as $topic)
        {
        ?>

          <option value="<?= $topic['id'] ?>"><?= $topic['id'] ?> : <?= $topic['name'] ?></option>
        <?php
        }
        ?>
      </select>
    </div>

    <button class="btn-outline-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#topicCollapse" aria-expanded="false" aria-controls="topicCollapse">
              <?= t("ADD MORE TOPICS", "ADD MORE TOPICS") ?>
            </button>
          <div class="collapse" id="topicCollapse">
    <?php
for ($x = 2; $x <= 5; $x++) 
{
?>
    <div class="mb-3">
      <label for="topicId"><?= t("Select another Topic for the new Challenge", "Select another Topic for the new Challenge") ?> :</label>
      <select class="form-select" name="topicId<?=$x?>" id="topicId<?=$x?>">
        <option selected value=""><?= t("Select another Topic for the new Challenge", "Select another Topic for the new Challenge") ?></option>
        <?php
        foreach ($topics as $topic)
        {
        ?>

          <option value="<?= $topic['id'] ?>"><?= $topic['id'] ?> : <?= $topic['name'] ?></option>
        <?php
        }
        ?>
      </select>
    </div>
<?php
}
?>
        </div>
    <input type="submit" class="btn btn-primary" value="<?= t("ADD NEW CHALLENGE", "ADD NEW CHALLENGE") ?>">
  </form>
</div>
</div>
</div>
<div class="tab-content" id="adminTabContent">
<div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">


<table class="table">
  <tr>
    <th><?=t("Challenge", "Challenge")?></th>
    <th><?=t("REMOVE CHALLENGE","REMOVE CHALLENGE")?></th>
  </tr>


  <?php

  foreach ($challenges as $challenge)
  {

  ?>
    <tr>
      <td style="width:75%">
        <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
          <input type="hidden" id="action" name="action" value="UPDATE-CHALLENGE">
          <input type="hidden" id="challengeId" name="challengeId" value="<?= $challenge['id'] ?>">
          <div class="mb-3">
            <label for="challengeName" class="m-1"><?= t("Name", "Name") ?>:</label>
            <input class="form-control m-1" type="text" id="challengeName" name="challengeName" value="<?= $challenge['name'] ?>">
            <button class="btn-outline-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $challenge['id'] ?>" aria-expanded="false" aria-controls="collapse<?= $challenge['id'] ?>">
              <?= t("EDIT", "EDIT") ?>
            </button>
          </div>
          <div class="collapse" id="collapse<?= $challenge['id'] ?>">
            <label for="challengeDescription" class="m-1"><?= t("Description","Description") ?>:</label>
            <textarea class="form-control m-1" aria-label="With textarea" id="challengeDescription" name="challengeDescription" rows="8" required><?= $challenge['description'] ?></textarea>
            <label for="school-info" class="m-1"><?= t("Further information","Further information") ?>:</label>
            <textarea class="form-control m-1" aria-label="With textarea" id="challengeFurtherInformation" name="challengeFurtherInformation" rows="8"><?= $challenge['further_information'] ?></textarea>

            <div class="mb-3">
              <label for="topicId"><?= t("Select a Topic","Select a Topic") ?> :</label>
              <select class="form-select" name="topicId" id="topicId" required>
                <option selected value=""><?= t("Select a Topic","Select a Topic") ?></option>
                <?php
                foreach ($topics as $topic)
                {
                ?>

                  <option value="<?= $topic['id'] ?>" <?php if ($topic['id'] == $challenge['area_id'])
                                                      { ?> selected="selected" <?php } ?>><?= $topic['id'] ?> : <?= $topic['name'] ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <button class="btn-outline-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#topicCollapse<?= $challenge['id'] ?>" aria-expanded="false" aria-controls="topicCollapse<?= $challenge['id'] ?>">
              <?= t("EDIT MORE TOPICS", "EDIT MORE TOPICS") ?>
            </button>
          <div class="collapse" id="topicCollapse<?= $challenge['id'] ?>">
    <?php
for ($x = 2; $x <= 5; $x++) 
{
?>
    <div class="mb-3">
      <label for="topicId"><?= t("Select another Topic", "Select another Topic") ?> :</label>
      <select class="form-select" name="topicId<?=$x?>" id="topicId<?=$x?>">
        <option selected value=""><?= t("Select another Topic", "Select another Topic") ?></option>
        <?php
        foreach ($topics as $topic)
        {
        ?>

          <option value="<?= $topic['id'] ?>" <?php if ($topic['id'] == $challenge['area_id' .$x])
                                                      { ?> selected="selected" <?php } ?>><?= $topic['id'] ?> : <?= $topic['name'] ?></option>
        <?php
        }
        ?>
      </select>
    </div>
<?php
}
?>
          </div>
            <input type="submit" class="btn btn-primary" value="<?= t("UPDATE CHALLENGE") ?>">
            </form>
          </div>
      </td>
      <td>
        <?php
        if (helpers\DataHelper::hasChallengeBeenUsed($challenge['id']))
        {
        ?>
          <div class="alert alert-warning" role="alert">You cannot remove this Challenge as it is already being used</div>
        <?php
        }
        else
        {
        ?>
          <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
            <input type="hidden" id="action" name="action" value="REMOVE-CHALLENGE">
            <input type="hidden" id="challengeId" name="challengeId" value="<?= $challenge['id'] ?>">
            <input type="submit" class="btn btn-primary" value="<?= t("REMOVE CHALLENGE", "REMOVE CHALLENGE") ?>">
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