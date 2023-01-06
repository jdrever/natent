<form>
  <label>Country</label>
  <select>
    <option>UK</option>
  </select>
  <label>School</label>
  <select>
    <option>Example School</option>
  </select>
</form>

<div class="container m-2 border border-primary bg-light p-3">
  <h2>Create a New Team</h2>

  <form method="post">
    <div class="mb-3">
      <label for="teamName" class="form-label">Team Name</label>
      <input type="text" class="form-control" id="teamName" name="teamName" aria-describedby="teamNameHelp">
      <div id="teamNameHelp" class="form-text"><span style="font-size: 1.2em;">Please <strong>don't use anyone's real names!</strong></span></div>
    </div>
    <div class="mb-3">
      <label for="teamPasword" class="form-label">Password</label>
      <input type="text" class="form-control" id="teamPassword" name="teamPassword" value="<?=$newPassword?>" aria-describedby="passwordHelp">
      <div id="passwordHelp" class="form-text"><span style="font-size: 1.2em;">You need to <strong>note this password down NOW</strong> - you won't get to see it again!</span></div>
    </div>
    <button type="submit" class="btn btn-primary">CREATE TEAM</button>
  </form>
</div>
<h2>Existing Teams</h2>

<table class="table m-2 p-2 border">
    <tr>
        <th><?= t("Team Name","Team Name") ?></th>
        <th><?= t("Reset Password","Reset Password") ?></th>
        <th><?= t("Remove","Remove") ?></th>
    </tr>

    <?php
    foreach ($teams as $thisTeam)
    {
    ?>
        <tr>
            <td>
                <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
                    <input type="hidden" id="action" name="action" value="RENAME-TEAM">
                    <input type="text" id="teamName" name="teamName" value="<?= $thisTeam['name'] ?>" required>
                    <input type="hidden" id="teamId" name="teamId" value="<?= $thisTeam['id'] ?>">
                    <input type="submit" class="btn btn-primary" value="<?= t("RENAME","RENAME") ?>">
                </form>
            </td>
            <td>
                <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
                    <input type="hidden" id="action" name="action" value="RESET-PASSWORD">
                    <input type="text" id="password" name="password" value="<?= $newPassword ?>" required aria-describedby="passwordHelp">
                    <div id="passwordHelp" class="form-text"><span style="font-size: 1.2em;"><strong>Note this password down NOW before clicking RESET</strong></span></div>
                    <input type="hidden" id="teamId" name="teamId" value="<?= $thisTeam['id'] ?>">
                    <input type="submit" class="btn btn-primary" value="<?= t("RESET","RESET") ?>">
                </form>
            </td>

            <td>
<?php 
        if ($thisTeam['id']==$team['id'])
        { ?>
<div class="alert alert-info" role="alert"><?=t("You are currently logged in as this Team and therefore cannot remove it","You are currently logged in as this Team and therefore cannot remove it")?>.</div>
<?php
        }
        else
        {
?>              
                <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
                    <input type="hidden" id="action" name="action" value="REMOVE-TEAM">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="teamCheck<?= $thisTeam['id'] ?>" id="teamCheck<?= $thisTeam['id'] ?>" placeholder="<?= t("Type the Team name to confirm","Type the Team name to confirm") ?>" aria-label="<?= t("Type the Team name to confirm","Type the Team name to confirm") ?>" required pattern="<?= $thisTeam['name'] ?>">
                        <label for="teamCheck<?= $thisTeam['id'] ?>"><?= t("Type the Team name to confirm","Type the Team name to confirm") ?></label>
                    </div>
                    <input type="hidden" id="teamId" name="teamId" value="<?= $thisTeam['id'] ?>">
                    <input type="submit" class="btn btn-danger" value="<?= t("REMOVE TEAM AND ALL OF THEIR WORK","REMOVE TEAM AND ALL OF THEIR WORK") ?>">
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