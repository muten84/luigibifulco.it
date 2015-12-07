<hr>
<?php if(!$page->related()->empty()): ?>
<h4> <?php echo l::get('related') ?></h6>
<ul>
  <?php foreach($page->related()->pages() as $item): ?>
  <li>
    <a href="<?php echo $item->url() ?>">
      <?php echo $item->title()->html() ?>
    </a>
  </li>
  <?php endforeach ?>
</ul>
<?php endif ?>
<hr>