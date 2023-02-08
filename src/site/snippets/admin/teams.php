<?php
use carefulcollab\helpers as helpers;
if ($adminLocation>0) :
?>




<ul class="nav nav-tabs" id="adminTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link<?=($selectedTab==='add') ? ' active' : '' ?>" id="add-tab" data-bs-toggle="tab" data-bs-target="#add" type="button" role="tab"
      aria-controls="add" aria-selected="<?=($selectedTab==='add') ? 'true' : 'false' ?>" ><?= t("Add a New Team","Add a New Team") ?></button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link<?=($selectedTab==='edit') ? ' active' : '' ?>" id="edit-tab" data-bs-toggle="tab" data-bs-target="#edit" type="button" role="tab"
      aria-controls="edit"
      aria-selected="<?=($selectedTab==='edit') ? 'true' : 'false' ?>"><?= t("Edit an Existing Team", "Edit an Existing Team") ?></button>
  </li>
</ul>
<div class="tab-content" id="adminTabContent">
  <div class="tab-pane fade<?=$selectedTab==='add' ? ' show active' : ''?>" id="add" role="tabpanel" aria-labelledby="add-tab">
    <div class="container mt-2 mb-4 border bg-white p-3">
      <form method="post" id="createTeamForm" name="createTeamForm">
        <input type="hidden" id="action" name="action" value="CREATE-TEAM">
        <input type="hidden" id="locationId" name="locationId" value="<?=$adminLocation?>">
        <div class="mb-3">
          <label for="teamName" class="form-label"><?=t('Team Name','Team Name')?></label>
          <input type="text" class="form-control" id="teamName" name="teamName" aria-describedby="teamNameHelp"
            required>
          <div id="teamNameHelp" class="form-text"><span style="font-size: 1.2em;"><strong><?=t('Please don\'t use anyone\'s real names!','Please don\'t use anyone\'s real names!')?></strong></span></div>
        </div>
        <div class="mb-3">
          <label for="teamPasword" class="form-label"><?=t('Password','Password')?></label>
          <input type="text" class="form-control" id="teamPassword" name="teamPassword" value="<?=$newPassword?>"
            aria-describedby="passwordHelp" required readonly>
          <div id="passwordHelp" class="form-text"><span style="font-size: 1.2em;"><strong><?=t('You need to note this password down NOW - you won\'t get to see it again!','You need to note this password down NOW - you won\'t get to see it again!')?></strong></span></div>
        </div>
        <button type="submit" name="createTeamButton" id="createTeamButton" class="btn btn-primary"><?=t('ADD TEAM','ADD TEAM')?></button>
      </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="passwordModalLabel"><?=t('Make a note of this password','Make a note of this password')?></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <?=t('You need to note this password down NOW - you won\'t get to see it again!','You need to note this password down NOW - you won\'t get to see it again!')?>
            <br><br>
            <?=t('Password','Password')?>: <?=$newPassword?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?=t('CANCEL','CANCEL')?></button>
            <button type="button" class="btn btn-primary" id="createTeamModalButton" name="createTeamModalButton"><?=t('ADD TEAM','ADD TEAM')?></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="tab-content" id="adminTabContent">
  <div class="tab-pane fade<?=($selectedTab==='edit') ? ' show active' : ''?>" id="edit" role="tabpanel" aria-labelledby="edit-tab">
    <table class="table m-2 p-2 border bg-white">
      <tr>
        <th><?= t("Team Name","Team Name") ?></th>
        <th><?= t("Reset Password To","Reset Password To") ?></th>
        <th><?= t("Remove","Remove") ?></th>
      </tr>

      <?php
    foreach ($teams as $thisTeam)
    {
      $newResetPassword=helpers\DataHelper::random_str(8);
    ?>
      <tr>
          <th colspan=3><?=$thisTeam['name']?></th>
    </tr>
      <tr>
        <td>
          <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
            <input type="hidden" id="action" name="action" value="RENAME-TEAM">
            <label for="teamName" class="form-label">Enter the new name below:</lablel>
            <input type="text" class="form-control m-2" id="teamName" name="teamName" value="<?= $thisTeam['name'] ?>" required>
            <input type="hidden" id="teamId" name="teamId" value="<?= $thisTeam['id'] ?>">
            <input type="hidden" id="oldTeamName" name="oldTeamName" value="<?= $thisTeam['name'] ?>">
            <input type="submit" class="btn btn-primary" value="<?= t("RENAME","RENAME") ?>">
          </form>
        </td>
        <td>
          <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
            <input type="hidden" id="action" name="action" value="RESET-PASSWORD">
            <input type="text" id="password" name="password" value="<?= $newResetPassword ?>" required
              aria-describedby="passwordHelp" readonly>
            <div id="passwordHelp" class="form-text"><span style="font-size: 1.2em;"><strong><?=t('Note this password down NOW before clicking RESET','Note this password down NOW before clicking RESET')?></strong></span></div>
            <input type="hidden" id="teamName" name="teamName" value="<?= $thisTeam['name'] ?>">
            <input type="submit" class="btn btn-primary" value="<?= t("RESET","RESET") ?>">
          </form>
        </td>

        <td>
          <?php 
        if ($thisTeam['id']==$team['id'])
        { ?>
          <div class="alert alert-info" role="alert">
            <?=t("You are currently logged in as this Team and therefore cannot remove it","You are currently logged in as this Team and therefore cannot remove it")?>.
          </div>
          <?php
        }
        else
        {
?>
          <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
            <input type="hidden" id="action" name="action" value="REMOVE-TEAM">
            <div class="form-floating">
              <input type="text" class="form-control" name="teamCheck<?= $thisTeam['id'] ?>"
                id="teamCheck<?= $thisTeam['id'] ?>"
                placeholder="<?= t("Type the Team name to confirm","Type the Team name to confirm") ?>"
                aria-label="<?= t("Type the Team name to confirm","Type the Team name to confirm") ?>" required
                pattern="<?= $thisTeam['name'] ?>">
              <label
                for="teamCheck<?= $thisTeam['id'] ?>"><?= t("Type the Team name to confirm","Type the Team name to confirm") ?></label>
            </div>
            <input type="hidden" id="teamId" name="teamId" value="<?= $thisTeam['id'] ?>">
            <input type="hidden" id="teamName" name="teamName" value="<?= $thisTeam['name'] ?>">
            <input type="submit" class="btn btn-danger"
              value="<?= t("REMOVE TEAM AND ALL OF THEIR WORK","REMOVE TEAM AND ALL OF THEIR WORK") ?>">
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

<script>
  let createTeamButton = document.getElementById('createTeamButton');
  let createTeamForm = document.getElementById('createTeamForm');
  let createTeamModalButton = document.getElementById('createTeamModalButton');
  const passwordModal = new bootstrap.Modal('#passwordModal');
  createTeamButton.addEventListener('click', function(event) {
    passwordModal.show();
    event.preventDefault();
  });
  createTeamModalButton.addEventListener('click', function(event) {
    // Check if valid using HTML5 checkValidity() builtin function
    if (createTeamForm.checkValidity()) {
      console.log('valid');
      createTeamForm.submit();
    } else {
      passwordModal.hide();
      createTeamForm.reportValidity();
      console.log('not valid');
    }
  });
</script>
<?php endif ?>