<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <title><?php wp_title(''); ?><?php
            if (wp_title('', false)) {
                echo ' :';
            }
            ?> <?php bloginfo('name'); ?></title>

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?php bloginfo('description'); ?>">

<?php wp_head(); ?>        

    </head>
    <body <?php body_class(); ?>>
        <div id="back-to-top"><i class="fa fa-arrow-circle-up"></i></div>
        <div class="container-fluid">
            <div class="row">
                <header id="topmain" class="clearfix">
                    <div class="col-md-9">
                        <img src="<?php echo get_bloginfo('template_url') ?>/img/banner.png" class="img-responsive" id="banner" />
                    </div>
                    <div class="col-md-3">
                        <?php
                                    top_menu();
                        ?>
                    </div>
                </header>
                <!-- header -->
                <nav class="navbar navbar-default">
                    
                      <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-menu" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                            <i class="fa fa-bars"></i>
                        </button>
                      </div>
                        <div class="collapse navbar-collapse" id="nav-menu">
<?php main_nav(); ?>
                            <form role="search" class="navbar-form navbar-right custom-right" id="searchform">
                                <div class="form-group">
                                    <input type="text" placeholder="検索" class="form-control">
                                    <input type="submit" name="searchbtn" id="searchbtn" value="">
                                </div>
                            </form>
                        </div>
                    
                </nav>
                <!-- /nav -->
                
                
                