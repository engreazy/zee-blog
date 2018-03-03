<article>
  <div class="contentPage">
    <h2><?=isset($post->title)?htmlspecialchars($post->title):'' ?></h2>
    <div>
      <p><?=isset($post->content)?htmlspecialchars($post->content):''?></p>
    </div>
  </div>
</article>