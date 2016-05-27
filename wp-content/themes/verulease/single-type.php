<?php get_header(); ?>

<main role="main">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">            
                <?php breadcrumb() ?>
            </div>
        </div>
    </div>
    <!-- section -->
    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-9">            
                    <div id="inner-content">                                                            
                        <!-- post title -->
                        <h1 class="title"><?php the_title(); ?></h1>
                        <!-- /post title -->
                        <?php if (have_posts()): while (have_posts()) : the_post(); ?>

                                <!-- article -->
                                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                                    <!-- post thumbnail -->
                                    <?php if (has_post_thumbnail()) : // Check if Thumbnail exists ?>
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                            <?php the_post_thumbnail(); // Fullsize image for the single post ?>
                                        </a>
                                    <?php endif; ?>
                                    <!-- /post thumbnail -->                                    

                                    <!-- post details -->
                                    <span class="date"><?php the_time('m/j/Y'); ?></span>
                                    <!-- /post details -->

                                    <?php the_content(); // Dynamic Content ?>
                                    
                                    <?php edit_post_link(); // Always handy to have Edit Post Links available ?>        

                                </article>
                                <!-- /article -->

                            <?php endwhile; ?>
<?php post_related_by_category();?>
<?php else: ?>

                            <!-- article -->
                            <article>

                                <h1><?php _e('Sorry, nothing to display.', 'html5blank'); ?></h1>

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
    <!-- /section -->
</main>


<?php get_footer(); ?>
