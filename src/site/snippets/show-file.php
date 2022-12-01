<div>
<?php
$fileExt = pathinfo($fileUrl, PATHINFO_EXTENSION);
if(preg_match('(jpg|jpeg|png|gif)', $fileExt) === 1) :?>
  <a target="_blank" href="<?=$fileUrl ?>"><img class="img-fluid" src="<?=$fileUrl ?>" alt="<?=$altText?>" /></a>
<?php endif;
if ($fileExt=="pdf") : ?>
  <iframe src="https://docs.google.com/viewer?url=<?=$fileUrl?>&embedded=true" frameborder="0" height="300px" width="100%"></iframe>
  <a target="_blank" href="<?=$fileUrl ?>" class="btn btn-outline-primary btn-outline btn-sm">DOWNLOAD</a>
<?php endif ?>
</div>