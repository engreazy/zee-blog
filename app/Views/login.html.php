<div style="text-align: center;">
    <h2>Welcome Administrator</h2>
    <p>enter your email and password to log in</p>
</div>
<form class="regform" method="POST" action="">
  <ul>
    <li><span class="<?=isset($class)?htmlspecialchars($class):''; ?>">
        <?=isset($msg)?htmlspecialchars($msg):''; ?></span>
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
        <input type="submit" value="Log in"/>
    </li>
  </ul>
</form>