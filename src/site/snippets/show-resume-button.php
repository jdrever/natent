<?php
if ($isNonLearningJourneyPage==true&&Cookie::exists('resumePage')) :
?>
<div class="d-flex justify-content-end">
    <a href="<?=Cookie::get('resumePage')?>" class="btn btn-info btn-sml"><i class="bi bi-arrow-left"></i> <?=t('RESUME YOUR LEARING JOURNEY','RESUME YOUR LEARING JOURNEY')?></a>  
</div>
<?php endif ?>