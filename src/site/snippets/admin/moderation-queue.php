<?php 
if ($adminLocation>0)
{
  if ($items)
  {
?>

<p><?=t("Below is a list of all content that requires moderation","Below is a list of all content that requires moderation")?>:</P>

<table class="table m-2 p-2 border">
    <tr>
        <th><?=t("Type of Content","Type of Content")?></th>
        <th><?=t("Content","Content")?></th>
        <th><?=t("Created By","Created By")?></th>
        <th><?=t("Created When","Created When")?></th>
        <th></th>
    </tr>

<?php
    foreach ($items as $item)
    {

?>
    <tr>
        <td><?=$item['content_type']?></td>
        <td><?php snippet('admin/show-moderation-content', ['contentType'=>$item['content_type'], 'contentId'=>$item['content_id']])?></td>
        
        <td><?=$item['created_by']?></td>
        <td><?=$item['created_date']?></td>
        <td>
            <form action="<?=$_SERVER['REQUEST_URI'] ?>" method="post">
                <input type="hidden" id="action" name="action" value="APPROVE">
                <input type="hidden" id="contentType" name="contentType" value="<?=$item['content_type']?>">  
                <input type="hidden" id="contentId" name="contentId" value="<?=$item['content_id']?>">  
                <input type="submit" class="btn btn-primary" value="<?=t("APPROVE","APPROVE")?>">
            </form>
            <form action="<?=$_SERVER['REQUEST_URI'] ?>" method="post">
                <input type="hidden" id="action" name="action" value="REJECT">
                <input type="hidden" id="contentType" name="contentType" value="<?=$item['content_type']?>">  
                <input type="hidden" id="contentId" name="contentId" value="<?=$item['content_id']?>">  
                <input type="submit" class="btn btn-warning mt-1" value="<?=t("REJECT","REJECT")?>">
            </form>
        </td>
    </tr>        
 <?php
    }
?>
</table>  
<form action="<?=$_SERVER['REQUEST_URI'] ?>" method="post">
    <input type="hidden" id="action" name="action" value="APPROVE-ALL">
    <input type="submit" class="btn btn-primary" value="<?=t("APPROVE ALL","APPROVE ALL")?>">
</form>
<?php
}
else
{
?>
    <div class="alert alert-info" role="alert"><?=t("You do not have any items to moderate","You do not have any items to moderate")?>.</div>
<?php
  }
}
?>