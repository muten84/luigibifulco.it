<!DOCTYPE html>
<html lang="en">

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

    <meta name="author" content="Luigi Bifulco">

    <meta property="og:title" content="<?php echo html($page->title()) ?> | <?php echo html($site->title()) ?>"/>
    <meta property="og:site_name" content="<?php echo html($site->title()) ?>">	
    <meta property="og:url" content="<?php echo rawurlencode ($page->url()); ?>"/>
    <meta property="og:description" content="<?php echo html($page->description()) ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="article:author" content="http://www.luigibifulco.it">


    <link rel="author" href="https://www.linkedin.com/in/luigibifulco“/>
    <link rel="publisher" href="https://www.linkedin.com/in/luigibifulco“/>

    <title>Programming and Applications Development: <?php echo html($page->title()) ?> | <?php echo html($site->title()) ?></title>

    <link rel="alternate" type="application/rss+xml" href="<?php echo url('feed') ?>" title="Luigi's Dev Corner" />
	
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo url('assets/css/clean-blog.min.css') ?>" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo url('assets/oembed/oembed.css') ?>">

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
 <!-- Place this snippet wherever appropriate -->
<script type="text/javascript">
  (function() {
    var li = document.createElement('script'); li.type = 'text/javascript'; li.async = true;
    li.src = ('https:' == document.location.protocol ? 'https:' : 'http:') + '//platform.stumbleupon.com/1/widgets.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(li, s);
  })();
</script> 
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-62800249-2', 'auto');
  ga('send', 'pageview');

</script>
</head>
<body>
<?php snippet('bootstrap-menu') ?>
<?php snippet('bootstrap-article-header') ?>

  <main role="main">
 <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
					<?php echo kirbytext($page->text()) ?>
					<ul class="pager">
					<li class="previous">
					
						<a href="<?php echo url() ?>">&larr; <?php echo l::get('back') ?></a>
					
					</li>
                    
                </ul>
	
	<?php snippet('bootstrap-article-related') ?>
	
	<div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <ul class="list-inline text-center">
                        <li>
                            <a target="blank" title="Tweet this" href="https://twitter.com/intent/tweet?source=webclient&text=<?php echo rawurlencode($page->title()); ?>%20<?php echo rawurlencode($site->title()) ?>%20<?php echo rawurlencode ($page->url()); ?>%20<?php echo ('via @luigi84bifulco')?>">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a target="blank" title="Share on Google+" href="https://plusone.google.com/_/+1/confirm?hl=it&url=<?php echo rawurlencode ($page->url()); ?>&title=<?php echo rawurlencode($page->title()); ?>">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a target="blank" title="Share on Linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo rawurlencode ($page->url()); ?>&title=<?php echo rawurlencode($page->title()); ?>&summary=<?php echo rawurlencode($page->description()); ?>&source=">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>                   
                </div>
            </div>
	    <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                   <ul class="list-inline text-center">
			<li><su:badge layout="2"></su:badge></li>			
			<li<a href="//www.reddit.com/submit" onclick="window.location = '//www.reddit.com/submit?url=' + encodeURIComponent(window.location); return false"> <img src="//www.redditstatic.com/spreddit12.gif" alt="submit to reddit" border="0" /> </a></li>	
		</ul>
               </div>
            </div>
	     <?php snippet('disqus', array('disqus_shortname' => 'luigisdevcorner')) ?>
	</div>
       </div>
       </div>
    </article>
			
  </main>
    <hr>
<?php snippet('bootstrap-article-footer') ?>
  </body>

</html>