<?php $tagcloud = tagcloud(page('blog'), array('limit' => 1000)) ?>
<!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
	<?php $img = $page->image('header.jpg') ?>
	<?php if($img) : ?>
		<header class="intro-header" style="background-image: url('<?php echo $img->url()?>')">
	<?php else : ?>
		<header class="intro-header" style="background-image: url('<?php echo url('assets/img/home-bg.jpg') ?>')">
    <?php endif ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading">
                        <h1><?php echo html($page->title()) ?></h1>
						<hr class="small">
                        <span class="subheading">Reading time: <?php echo $page->text()->readingtime() ?>
						<?php if($page->tags() != ''): ?>					
							<?php foreach(str::split($page->tags()) as $tag): ?>
							<!--<a href="<?php echo url('tag:' . urlencode($tag)) ?>">#<?php echo $tag; ?></a></li>-->
							<?php foreach($tagcloud as $tagc): ?>
								<?php if($tag == $tagc->name()): ?>
									<a href="<?php echo $tagc->url() ?>"><?php echo $tagc->name() ?></a>
								<?php endif ?>
							<?php endforeach ?>
						<?php endforeach ?>						  
						 <?php endif ?>
						<!--<?php foreach($tagcloud as $tag): ?>
							<a href="<?php echo $tag->url() ?>"><?php echo $tag->name() ?></a>
						<?php endforeach ?>-->
				</span>                  
                    </div>
                </div>
            </div>
        </div>
    </header>   