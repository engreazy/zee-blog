<form class="regform" method="POST" action="">
  <ul>
    <li><span class="<?=isset($class)?htmlspecialchars($class):''; ?>">
        <?=isset($msg)?htmlspecialchars($msg):''; ?></span>
    </li>
    <li><input type="hidden" name="id" value="<?=isset($id)?htmlspecialchars($id):''; ?>"></li>
    <li>
        <label>First Name:</label>
        <input type="text" name="firstname" value="<?=isset($firstname)?htmlspecialchars($firstname):''; ?>">
    </li>
    <li>
        <label>Last Name:</label>
        <input type="text" name="lastname" value="<?=isset($lastname)?htmlspecialchars($lastname):''; ?>">
    </li>
    <li>
        <label>email:</label>
        <input type="text" name="email" placeholder="example@doe.com" value="<?=isset($email)?htmlspecialchars($email):''; ?>">
    </li>
    <li>
        <label>password</label>
        <input type="text" name="password" value="<?=isset($password)?htmlspecialchars($password):''; ?>" >
    </li>
    <li>
        <input type="submit" value="Add Account"/>
    </li>
  </ul>
</form>