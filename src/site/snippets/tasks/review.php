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

<h2><?=t("What have you learned through this process?","What have you learned through this process?")?></h2>

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
            <label for="question<?=$questionId?>" class="m-1"><?= t($question['question'],$question['question']) ?></label>
            <div class="row row-cols-1 row-cols-sm-5">
            <?php
            for ($x = 1; $x <= 5; $x++) 
            {
              $buttonColour=($x==1||$x==5) ? 'light' : 'dark';
            ?>
              <div class="col">
                <div class="form-check form-check-inline p-2 likert-<?=$x?>">
                <input type="radio" class="btn-check" name="question<?=$questionId?>" id="question<?=$questionId?>-<?=$x?>" value="<?=$x?>" autocomplete="off" required>
                <label class="btn btn-outline-<?=$buttonColour?>" for="question<?=$questionId?>-<?=$x?>"><?=$x?></label>
                <input type="hidden" name="question<?=$questionId?>ResponseType" value="NUMERIC"> 

                <?php
                if ($x == 1)
                {
                    echo(t("Strongly Disagree"));
                }
                if ($x == 5)
                {
                    echo(t("Strongly Agree"));
                }
                ?>
                </div>
              </div>
            <?php
            } ?>
            </div>
<?php
        }
        if ($question['question_type'] == 'TEXT')
        {
        ?>
        <div class="container p-2 m-2 border border-info rounded">  
            <label for="question<?=$questionId?>"><?= t($question['question'],$question['question']) ?></label>
            <textarea class="form-control" rows="8" name="question<?=$questionId?>" id="question<?=$questionId?>"></textarea>  
            <input type="hidden" name="question<?=$questionId?>ResponseType" value="TEXT"> 
        </div>
    <?php
    }
    ?>
    </div>
<?php
}
?>

<input type="hidden" name="questionIds" id="questionIds" value="<?= $questionIds ?>">
<?php snippet('guide-navigation', ['taskButton' =>t('SHARE YOUR FINAL REVIEW','SHARE YOUR FINAL REVIEW')]) ?>

</form>

<br>

</div>