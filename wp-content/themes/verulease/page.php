<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">            
            <?php breadcrumb() ?>
        </div>
    </div>
</div>
<section id="content">    
    <div class="container">
        <div class="row">
            <div class="col-md-9">            
                <div id="inner-content">
                <h1 class="title"><?php the_title(); ?></h1>
                
                <?php if (have_posts()): while (have_posts()) : the_post(); ?>

                        <!-- article -->
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                            <?php the_content(); ?>

                            <?php comments_template('', true); // Remove if you don't want comments ?>

                            <br class="clear">

                            <?php edit_post_link(); ?>

                        </article>
                        <!-- /article -->

                    <?php endwhile; ?>

                <?php else: ?>

                    <!-- article -->
                    <article>

                        <h2><?php _e('Sorry, nothing to display.', 'html5blank'); ?></h2>

                    </article>
                    <!-- /article -->

                <?php endif; ?>
                </div>
            </div>
            <div class="col-md-3">
                <?php get_sidebar(); ?>
            </div>    
        </div>
    </div>

</section>
<?php
get_footer();
