<?php foreach ($comments as $comment) : ?>
<p class="p-1 border">
  <small>
    <i class="bi bi-chat-fill"></i>
    on your <?=$comment['content_type']?> by
    <a href="/other-team-page/?teamId=<?=$comment['team_id']?>"><?=$comment['team_name']?></a>
    <br>
    <i class="bi bi-quote"></i>
    <i><?=$comment['comment']?></i>
    <i class="bi bi-three-dots"></i>
  </small>
</p>
<?php endforeach ?>