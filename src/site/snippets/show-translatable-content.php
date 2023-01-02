<?php
if(!isset($content)||empty($content)) return;
if(!isset($showContent)) $showContent=true;
if(!isset($showButton)) $showButton=true;
if ($showContent) :?>
<p><?=$content?></p>
<?php endif ?>
<?php if ($showButton) : 
      $uniqueId=uniqid();
?>
<button class="btn-outline-primary btn-sm" type="button" onclick="getTranslation('<?=$content ?>','<?=$uniqueId?>')">Translate to English</button>
<div id="<?=$uniqueId?>"></div>
<?php endif ?>