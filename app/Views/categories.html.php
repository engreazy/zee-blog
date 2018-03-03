<section class="categories">
  <h2>List of Categories</h2>
<a class="newCategory" href="?route=category/create">+New Category</a>
<table class="categoryList">
  <thead>
    <th>Category Name</th>
    <th>Edit Category</th>
    <th>Delete Category</th>
  </thead>
  <tbody>
<?php foreach($categories as $category): ?>
  <tr>
    <td>
      <p><?=htmlspecialchars($category->name)?></p>
    </td>
    <td>
      <a href="?route=category/create&id=<?=htmlspecialchars($category->id) ?>">Edit</a>
    </td>
    <td>
      <button class="action" value="<?=htmlspecialchars($category->id)?>">Delete</button>
    </td>
  </tr>
<?php endforeach; ?>
  </tbody>
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
      <form action="?route=category/delete" method="post" id="deleteEntry">
        <input type="hidden" name="id" value="" id="delete">
        <input type="submit" value="Delete">
        <button type="button" id="cancel" class="cancel">Cancel</button>
      </form>
    </div>
  </div>
</table>
</section>
<script src="scripts/categories.js"></script>