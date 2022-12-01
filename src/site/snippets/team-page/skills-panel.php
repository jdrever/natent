<h4><?=t("Skills")?></h4>
<div class="container">
    <div class="row">
<?php foreach ($skills as $skill) : 
    $skillName=$skill['name'];
?>
        <div class="col border border-secondary p-2 <?php if (strpos($viewedTeam['skills'],$skillName)!==false) { echo("bg-success text-white"); } ?>" >
        <?php if (strpos($viewedTeam['skills'],$skillName)!==false) : ?>
            <i class="bi bi-check-square-fill"></i>
        <?php else : ?>
            <i class="bi bi-square"></i>
        <?php endif ?>
            <br><?=t($skillName, $skillName)?>
        </div>
<?php endforeach ?>
    </div>
</div>
