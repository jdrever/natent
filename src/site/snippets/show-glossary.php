<?php
if (count($glossary)>0) :
?>
<table class="table">
  <thead>
    <tr>
      <th><?=t('Term','Term')?></th>
      <th><?=t('Definition','Definition')?></th>
    </tr>
  </thead>
  <tbody>

    <?php foreach($glossary as $glossaryItem): ?>
    <tr>
      <th>
        <a
          href="<?=$glossaryItem->url()?>"><?= $glossaryItem->term()->isNotEmpty() ? $glossaryItem->term() : $glossaryItem->title()?></a>
      </th>
      <td><?=$glossaryItem->definition()?></td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>
<?php endif ?>