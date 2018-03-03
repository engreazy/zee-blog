<section class="categories">
<h2>List of All Users</h2>
<a class="newCategory" href="?route=register/create">+New User</a>
<h5>Total Users <?=htmlspecialchars($totalUsers)?></h5>
<table class="categoryList">
  <thead>
    <th>First Name</th>
    <th>Email</th>
    <th>Edit Role</th>
    <th>Remove User</th>
  </thead>
  <tbody>
<?php foreach($users as $user): ?>
  <tr>
    <td>
      <h5><?=htmlspecialchars($user->firstname)?></h5>
    </td>
    <td>
      <p><?=htmlspecialchars($user->email)?></p>
    </td>
    <td>
      <a href="?route=user/permissions&id=<?=htmlspecialchars(urlencode($user->id)) ?>">Edit Role</a>
    </td>
    <td>
      <button class="action" value="<?=htmlspecialchars($user->id)?>">Delete</button>
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
      <p>Delete User</p>
      <span class="close">X</span>
      <p>Are you Sure you want to delete this user?</p>
      <form action="?route=user/delete" method="post" id="deleteEntry">
        <input type="hidden" name="id" value="" id="delete">
        <input type="submit" value="Delete">
        <button type="button" id="cancel" class="cancel">Cancel</button>
      </form>
    </div>
  </div>
  </tbody>
</table>
</section>
<script src="scripts/userlist.js"></script>