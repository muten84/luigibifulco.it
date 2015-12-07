<!DOCTYPE html>
<html lang="it">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if($page->description() != ''): ?>
	<meta name="description" content="<?php echo html($page->description()) ?>" />
	<?php else: ?>
	<meta name="description" content="<?php echo html($site->description()) ?>" />
	<?php endif ?>
	<meta name="apple-mobile-web-app-title" content="<?php echo html($site->title()) ?>">
	
    <meta name="author" content="">

    <title><?php echo html($page->title()) ?> | <?php echo html($site->title()) ?></title>

	<link rel="alternate" type="application/rss+xml" href="<?php echo url('feed') ?>" title="Luigi's Dev Corner" />
	
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo url('assets/css/clean-blog.min.css') ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<?php snippet('bootstrap-menu') ?>
<?php snippet('bootstrap-header') ?>

 <main role="main">
 <!-- Main Content -->
 <?php $articles = $pages->find('blog')->children()->visible()->flip()->paginate(3) ?>
 
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">                
			<?php foreach($articles as $article): // article overview ?>
					<div class="post-preview">
					<a href="<?php echo $article->url() ?>">
                        <h2 class="post-title">
                            <?php echo html($article->title()) ?>
                        </h2>
                        <h3 class="post-subtitle">                          
						   <?php echo $article->description() ?>
						 </h3>
						<h4 class="post-subtitle">						   
						   <?php echo excerpt($article->text(), 150) ?>
                        </h4>
                    </a>
                    <p class="post-meta">Posted by <a href="http://www.luigibifulco.it">Luigi Bifulco</a> on <time datetime="<?php echo $article->date('c') ?>"><?php echo $article->date('F dS, Y'); ?></time></p>
					</div>
                <hr>
			<?php endforeach // article overview ends ?>
	  <!-- Pager -->	
	 <?php if($articles->pagination()->hasPages()): // pagination ?>
	  <!-- Pager -->
                <ul class="pager">
					<li class="previous">
					 <?php if($articles->pagination()->hasPrevPage()): ?>
						<a href="<?php echo $articles->pagination()->prevPageURL() ?>">&larr; Newer Posts</a>
					<?php endif ?>
					</li>
                    <li class="next">
						<?php if($articles->pagination()->hasNextPage()): ?>						
						<a href="<?php echo $articles->pagination()->nextPageURL() ?>">Older Posts &rarr;</a>
						<?php endif ?>                        
                    </li>
                </ul>
            </div>
        </div>
    </div>
	 <?php endif ?>
	<hr>
	</main>
  <?php snippet('bootstrap-footer') ?>
  </body>

</html>