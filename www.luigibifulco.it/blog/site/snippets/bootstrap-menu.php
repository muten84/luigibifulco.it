    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--<a class="navbar-brand" href="http://www.luigibifulco.it">Home</a>-->
				<a title="Check my Github projects" target="blank" href="https://github.com/muten84/">
                                <span class="fa-stack fa-lg">
                                    <!--<i class="fa fa-circle fa-stack-1x"></i>-->
                                    <i class="fa fa-github fa-stack-2x "></i>
                                </span>
                </a>		
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <?php foreach($pages->visible() as $item): ?>
					<li><a<?php ecco($item->isOpen(), ' class="active"') ?> href="<?php echo $item->url() ?>"><?php echo $item->title() ?></a></li>
					<?php endforeach ?>
			<!--<?php foreach($site->languages() as $language): ?>
			    <li<?php e($site->language() == $language, ' class="active"') ?>>
			      <a href="<?php echo $language->url() ?>">
				        <?php echo html($language->name()) ?>
			      </a>
			    </li>
		      <?php endforeach ?> -->
		 <?php foreach($site->languages() as $language): ?>
		    <li<?php e($site->language() == $language, ' class="active"') ?>>
		      <a href="<?php echo $page->url($language->code()) ?>">
		        <?php echo html($language->name()) ?>
		      </a>
		    </li>
		    <?php endforeach ?>
               </ul>
			   
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>