<div class="categories">
  <h2>Edit <?=htmlspecialchars($user->firstname)?>'s Permissions</h2>
  <form action="" method="post" style="display: flex;flex-direction: column; border:2px solid green; width:50vw; padding: 0.5em; margin:1em;">
    <?php foreach($permissions as $name => $value ): ?>
      <div style="padding: 0.5em;line-height: 1em;">
        <input name="permissions[]" type="checkbox" value="<?=htmlspecialchars($value)?>
        <?php if($user->hasPermission($value)):
              echo 'checked';
              endif;?>
        "/>
        <label><?=htmlspecialchars($name)?></label>
      </div>
    <?php endforeach; ?>
    <input type="submit" value="Submit" style="margin-right: auto; border: 2px solid green;">
  </form>
</div>