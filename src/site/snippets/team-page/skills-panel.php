<h4><?=t("Skills")?></h4>
<?php
$teamSkills=(!empty($viewedTeam['skills'])) ? $viewedTeam['skills'] : '';
?>


<div class="container">
    <div class="row">
<?php foreach ($skills as $skill) : 
    $skillName=$skill['name'];
?>
        <div class="col border border-secondary p-2 <?php if (strpos($teamSkills,$skillName)!==false) { echo("bg-success text-white"); } ?>" >
        <?php if (strpos($teamSkills,$skillName)!==false) : ?>
            <i class="bi bi-check-square-fill"></i>
        <?php else : ?>
            <i class="bi bi-square"></i>
        <?php endif ?>
            <br><?=t($skillName, $skillName)?>
        </div>
<?php endforeach ?>
    </div>
</div>
