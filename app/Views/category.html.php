<form class="postForm" method="post" action="">
  <ul>
    <li><span class="<?=isset($class)?htmlspecialchars($class):''?>">
      <?=isset($msg)?htmlspecialchars($msg):''?></span>
    </li>
    <li>
      <input type="hidden" name="id" value="<?=isset($category->id)?htmlspecialchars($category->id):''?>">
    </li>
    <li>
      <label>Category Name</label>
      <input type="text" name="name" value="<?=isset($category->name)?htmlspecialchars($category->name):''?>">
    </li>
    <li>
      <input type="submit" value="Submit">
    </li>
  </ul>
</form>