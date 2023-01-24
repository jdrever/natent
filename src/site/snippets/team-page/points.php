<button class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePoints"
  aria-expanded="false" aria-controls="collapsePoints">
  <?=t("See Points Audit Trail", "See Points Audit Trail")?>
</button>
<div class="collapse" id="collapsePoints">

  <table class="table">
    <tr>
      <th><?=t("Type of Points","Type of Points")?></th>
      <th><?=t("Points Added","Points Added")?></th>
      <th><?=t("Date/Time","Date/Time")?></th>
    </tr>
    <?php foreach ($pointsAuditTrail as $point) : ?>
    <tr>
      <td><?=$point['points_type']?></td>
      <td><?=$point['points_added']?></td>
      <td><?=$point['date_added']?></td>
    </tr>
    <?php endforeach ?>
  </table>
</div>