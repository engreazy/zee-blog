<section class="contact">
  <h2>Contact Us</h2>
  <form class="contactForm" method="post" action="">
    <ul>
      <li><span class="<?=isset($class)?htmlspecialchars($class):''?>">
        <?=isset($msg)?htmlspecialchars($msg):''?></span>
     </li>
      <li>
        <input type="text" name="name" placeholder="John Doe">
        <input type="email" name="email" placeholder="example@doe.com">
      </li>
      <li class="message">
        <label>Message:</label>
        <textarea placeholder="Enter Message" name="message">
        </textarea>
      </li>
      <li>
        <input type="submit" value="Say Hello">
      </li>
    </ul>
  </form>
</section>