<nav class="menu cf" role="navigation">
  <ul class="cf">
    <li><a class="active" href="http://www.luigibifulco.it">Home</a></li>
    <?php foreach($pages->visible() as $item): ?>
    <li><a<?php ecco($item->isOpen(), ' class="active"') ?> href="<?php echo $item->url() ?>"><?php echo $item->title() ?></a></li>
    <?php endforeach ?>
  </ul>
  <form class="search" role="search" action="<?php echo url('search') ?>">
    <label class="vh" for="search"><?php echo l::get('search') ?></label>
    <input type="search" class="searchword" name="q" id="search" placeholder="<?php echo l::get('search') ?>..."/>
  </form>
</nav>
