<?php if($totalPost > 0): ?>
<article>
    <?php foreach($posts as $post): ?>
  <div class="blogList">
    <h2><?=htmlspecialchars($post->title)?></h2>
    <div>Posted by: <strong><?=htmlspecialchars($post->getUser()->firstname)?></strong>
      <span>on :<?=htmlspecialchars($post->dateposted) ?></span>
    </div>
    <div class="postList">
      <?=htmlspecialchars(substr($post->content,0,200)) ?>
      ...<a href="?route=post/content&id=<?=htmlspecialchars(urlencode($post->id))?>>">[read more]</a>
    </div>
  </div>
  <?php endforeach; ?>
</article>
<input type="hidden" id="total" value="<?=$numPages ?>"/>
<input type="hidden" id="current" value="<?=$currentPage ?>"/>
<div id="paginationContainer" style="display:flex;">
  <strong>page:</strong>
  <a id="prev" style=" padding: 0.5em;border:1px solid black;width: 100px;margin-right:0.5em;cursor: pointer;">&lArr;previous</a>
  <a  id="next" style="padding: 0.5em;cursor: pointer;width: 100px;border:1px solid black;margin-left:0.5em;">&rArr;next</a>
</div>
<script src="scripts/bloglist.js"></script>
<?php else: ?>
  <h2>You have not posted anything yet (:</h2>
  <a href="?route=article/edit">Click here to create a new post now</a>
<?php endif;?>
