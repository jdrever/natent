
    <form  method="post">
        <input type="hidden" id="action" name="action" value="SELECT-CURRENT-TEAM">
        <input type="hidden" id="userId" name="userId" value="<?=$team['user_id']?>">
        <label for="teamId"><?=t("Select Your Current Team","Select Your Current Team")?> :</label>
        <select class="form-select" name="teamId" id="teamId" required>
    <?php
    
    foreach ($teams as $thisTeam)   
    {  
    ?>         

            <option value="<?=$thisTeam['id'] ?>" <?php if ($thisTeam['id']==$team['id']) {?> selected="selected" <?php } ?>><?=$thisTeam['name']?> <?php if ($team['role']=='ADMIN'||$team['role']=='GLOBAL') { echo '(' . $thisTeam['location_name'] . ')'; } ?></option>
    <?php
    }
    ?>
        </select>
        <input type="submit" class="btn btn-sm btn-primary" value="<?= t("SELECT", "SELECT") ?>">
    </form>