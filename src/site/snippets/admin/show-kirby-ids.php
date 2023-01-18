<?php 
$users = $kirby->users();
foreach ($users as $user) : ?>

<p><?=$user->email()?>: <?=$user->id()?></p>

<?php endforeach ?>
