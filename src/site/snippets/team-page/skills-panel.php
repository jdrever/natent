<h4><?=t("Skills")?></h4>
<?php
$teamSkills=(!empty($viewedTeam['skills'])) ? $viewedTeam['skills'] : '';
?>


<ul class="list-group">
<?php foreach ($skills as $skill) : 
    $skillName=$skill['name'];
?>
        <?php if (strpos($teamSkills,$skillName)!==false) : ?>
  <li class="list-group-item"><?=t($skillName, $skillName)?></li>
        <?php endif ?>
<?php endforeach ?>
</ul>
