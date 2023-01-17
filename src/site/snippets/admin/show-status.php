<?php
if (isset($_POST['action'])) 
{ 
    if ($result->wasSuccessful)
    {
?>
        <div class="alert alert-success mb-1" role="alert"><i class="bi-hand-thumbs-up-fill"></i>The <?=$actionType ?> was successful.</div>
<?php
    }
    else
    {
    ?>
        <div class="alert alert-danger mb-1" role="alert"><i class="bi-hand-thumbs-down-fill"></i>The <?=$actionType ?> was not successful.  <?=$result->errorMessage ?></div>
<?php
    }
}
?>