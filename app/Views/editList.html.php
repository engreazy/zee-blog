<?php if($user): ?>
<section class="categories">
<h2>List of Entries</h2>
<a class="newCategory" href="?route=article/edit">+New Post</a>
<h5>Total Articles <?=htmlspecialchars($totalPost)?></h5>
<table class="categoryList">
  <thead>
    <th>Post Title</th>
    <th>Edit Post</th>
    <th>Delete Post</th>
    <th>Author</th>
    <th>Date Posted</th>
    <th>Post Category</th>
  </thead>
  <tbody>
<?php foreach($posts as $post): ?>
  <tr>
    <td>
      <h5><?=htmlspecialchars($post->title)?></h5>
    </td>
  <?php if($user->id == $post->userid || $user->hasPermission(\Models\Entity\User::EDIT_POST)): ?>
    <td>
      <a href="?route=article/edit&id=<?=htmlspecialchars(urlencode($post->id)) ?>">Edit</a>
    </td>
  <?php endif; ?>
  <?php if($user->id == $post->userid || $user->hasPermission(\Models\Entity\User::DELETE_POST)): ?>
    <td>
      <button class="action" value="<?=htmlspecialchars($post->id)?>">Delete</button>
    </td>
  <?php endif;?>
    <td>
      <p><strong><?=htmlspecialchars($post->getUser()->firstname)?></strong></p>
    </td>
    <td>
      <p><?=htmlspecialchars($post->dateposted) ?></p>
    </td>
    <td>
      <p><?=htmlspecialchars($post->getCategory()->name)?></p>
    </td>
  </tr>
<?php endforeach; ?>
<ul class="verticalNav" style="float:right;width:15vw;text-align: center;">
  <li><a href="?route=zee/home">Home</a></li>
  <li><a href="?route=article/list">Post</a></li>
  <li><a href="?route=category/view">Category</a></li>
  <li><a href="?route=user/view">Users</a></li>
  <li><a href="?route=user/logout">Log out</a></li>
</ul>
  <div><br/><br/>
    <input type="hidden" id="total" value="<?=$numPages ?>"/>
    <input type="hidden" id="current" value="<?=$currentPage ?>"/>
    <div id="paginationContainer" style="display:flex;">
      <strong>page:</strong>
      <a id="prev" style=" padding: 0.5em;border:1px solid black;width: 100px;margin-right:0.5em;cursor: pointer;">&lArr;previous</a>
      <a  id="next" style="padding: 0.5em;cursor: pointer;width: 100px;border:1px solid black;margin-left:0.5em;">&rArr;next</a>
    </div>
  </div>
  <div class="modal">
    <div class="modal-content">
      <p>Delete Entry</p>
      <span class="close">X</span>
      <p>Are you Sure you want to delete this entry?</p>
      <form action="?route=article/delete" method="post" id="deleteEntry">
        <input type="hidden" name="id" value="" id="delete">
        <input type="submit" value="Delete">
        <button type="button" id="cancel" class="cancel">Cancel</button>
      </form>
    </div>
  </div>
  </tbody>
</table>
</section>
<script src="scripts/articlelist.js"></script>
<?php endif; ?>
