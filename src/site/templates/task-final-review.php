<?php snippet('header') ?>
<?php snippet('platform-menu') ?>
<?php snippet('breadcrumb') ?>
<?php snippet('show-status') ?>
<?php snippet('open-platform-content') ?>
<?php snippet('show-blocks') ?>

<style>
    .likert-5 {
        background-color: green;
        color: yellow;
    }

    .likert-4 {
        background-color: lightgreen;
        color: brown;
    }

    .likert-3 {
        background-color: yellow;
        color: brown;
    }

    .likert-2 {
        background-color: orange;
        color: white;
    }

    .likert-1 {
        background-color: red;
        color: white;
    }
</style>

<h2><?=t("What have you learned through this process?")?></h2>

<div class="container bg-light p-3">

<form class="form-inline" method="post" action="<?= $page->url() ?>" enctype="multipart/form-data">
    <input type="hidden" id="collabType" name="collabType" value="Functions">
    <?php
    $questionIds = '';
    foreach ($questions as $question)
    {
        $questionId = $question['id'];
        $questionIds .= $questionId . ',';
        if ($question['question_type'] == 'LIKERT')
        {
    ?>  
        <div class="container p-2 m-2 border border-info rounded">    
            <label for="question<?=$questionId?>" class="m-1"><?= t($question['question']) ?></label>
            <br>

            <?php
            for ($x = 1; $x <= 5; $x++) 
            {
            ?>
                <div class="form-check form-check-inline p-2 likert-<?=$x?>">
                <?php
                if ($x == 1)
                {
                    echo(t("Strongly Disagree"));
                }
                ?>
                <input type="radio" class="btn-check" name="question<?=$questionId?>" id="question<?=$questionId?>-<?=$x?>" value="<?=$x?>" autocomplete="off" required>
                <label class="btn btn-outline-dark" for="question<?=$questionId?>-<?=$x?>"><?=$x?></label>
                <input type="hidden" name="question<?=$questionId?>ResponseType" value="NUMERIC"> 

                <?php
                if ($x == 5)
                {
                    echo(t("Strongly Agree"));
                }
                ?>
                </div>
            <?php
            }
        }
        if ($question['question_type'] == 'TEXT')
        {
        ?>
        <div class="container p-2 m-2 border border-info rounded">  
            <div class="form-floating">
                <textarea class="form-control" placeholder="<?= t($question['question']) ?>" rows="8" name="question<?=$questionId?>" id="question<?=$questionId?>"></textarea>
                <label for="question<?=$questionId?>"><?= t($question['question']) ?></label>
                <input type="hidden" name="question<?=$questionId?>ResponseType" value="TEXT"> 
            </div>
        </div>
    <?php
    }
    ?>
    </div>
<?php
}
?>

<input type="hidden" name="questionIds" id="questionIds" value="<?= $questionIds ?>">
<input type="submit" class="btn btn-primary float-end" value="<?= t("SHARE YOUR FINAL REVIEW") ?> &#8594;">

</form>

<br>

</div>
<?php snippet('close-platform-content') ?>
<?php snippet('footer') ?>