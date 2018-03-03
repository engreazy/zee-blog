<?php if(empty($post->id) || $post->userid === $user->id || $user->hasPermission(\Models\Entities\User::DELETE_POST)) : ?>
<form class="postForm" method="post" action="">
  <ul>
    <li><span class="<?=isset($class)?htmlspecialchars($class):''?>">
        <?=isset($msg)?htmlspecialchars($msg):''?></span>
    </li>
    <li>
      <input type="hidden" name="id" value="<?=isset($post->id)?htmlspecialchars($post->id):''?>">
    </li>
    <li>
      <label>Select Category</label>
      <select name="categoryid">
          <?php foreach ($categories as $category): ?>
          <option value="<?=isset($category->id)?htmlspecialchars($category->id):'' ?>"><?=isset($category->name)?$category->name:'' ?></option>
          <?php endforeach; ?>
      </select>
    </li>
    <li>
      <label>Title</label>
        <input type="text" name="title" value="<?=isset($post->title)?htmlspecialchars($post->title):''?>">
    </li>
    <li>
      <label>Post Content</label>
      <textarea name="content" id="myTextarea"><?=isset($post->content)?htmlspecialchars($post->content):''?></textarea>
    </li>
    <li>
      <input type="hidden" name="dateposted" value="<?=isset($post->date)?htmlspecialchars($post->date):''; ?>" >
    </li>
    <li>
      <input type="submit" value="Submit">
    </li>
  </ul>
</form>
<?php else: ?>
<p>You may only edit articles  that you posted</p>
<?php endif; ?>
<script src='tinymce/tinymce.min.js'></script>
<script src="scripts/editor.js"></script>
