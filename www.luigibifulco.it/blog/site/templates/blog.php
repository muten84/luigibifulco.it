<!DOCTYPE html>
<html lang="it">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<?php if($page->description() != ''): ?>
	<meta name="description" content="<?php echo html($page->description()) ?>" />
	<?php else: ?>
	<meta name="description" content="<?php echo html($site->description()) ?>" />
	<?php endif ?>

     -->
    <meta name="description" content="Luigi's Dev Corner is a Blog about programming, application development, design pattern, computer science, build tools, Java programming, Object oriented programming, Javascript, Typescript, C, C++. Programming tricks. Share of development experiences." />
    <meta name="apple-mobile-web-app-title" content="<?php echo html($site->title()) ?>">	
    <meta name="author" content="Luigi Bifulco">

    <meta property="og:site_name" content="<?php echo html($site->title()) ?>">
    <meta property="og:title" content="Programming and Applications Development: <?php echo html($page->title()) ?> | <?php echo html($site->title()) ?>"/>	
    <meta property="og:url" content="http://www.luigibifulco.it/blog"/>
    <meta property="og:description" content="Luigi's Dev Corner is a Blog about programming, application development, design pattern, computer science, build tools, Java programming, Object oriented programming, Javascript, Typescript, C, C++. Programming tricks. Share of development experiences."/>
    <meta property="article:author" content="http://www.luigibifulco.it">


    <link rel="author" href="https://www.linkedin.com/in/luigibifulco“/>
    <link rel="publisher" href="https://www.linkedin.com/in/luigibifulco“/>
    <link rel="alternate" type="application/rss+xml" href="<?php echo url('feed') ?>" title="Luigi's Dev Corner" />

    <title>Programming and Applications Development: <?php echo html($page->title()) ?> | <?php echo html($site->title()) ?></title>
	
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo url('assets/cookie/cookiecuttr.css') ?>">

    <link rel="stylesheet" href="<?php echo url('assets/oembed/oembed.css') ?>">

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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script type="text/javascript" src="<?php echo url('assets/cookie/cookie.js') ?>">
    <script type="text/javascript" src="<?php echo url('assets/cookie/cookiecuttr.js') ?>"></script>
    <script type="text/javascript">
	$(document).ready(function () {
  		$.cookieCuttr();
	});
	
    </script>    
<!-- Place this snippet wherever appropriate -->
<script type="text/javascript">
  (function() {
    var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
    li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
  })();
</script>      

<script>
if (jQuery.cookie('cc_cookie_accept') == "cc_cookie_accept") {
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-62800249-2', 'auto');
  ga('send', 'pageview');
}
else{
    console.log('cookie declined');
}
</script>
</head>
<body>

<?php snippet('bootstrap-menu') ?>
<?php snippet('bootstrap-header') ?>

 <main role="main">
 <!-- Main Content -->
 <?php $articles = $pages->find('blog')->children()->visible()->flip()->paginate(5) ?>
 
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">   
		    <?php if(param('tag')): 
			$articles = $page->children()
       	          ->visible()
	                 ->filterBy('tags', param('tag'), ',')
	                 ->flip()
			   ->paginate(5);
			// show tag results ?>
			 <?php endif ?>
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