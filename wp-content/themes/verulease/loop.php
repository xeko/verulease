<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<!-- article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<!-- post thumbnail -->
		<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
			</a>
		<?php endif; ?>
		<!-- /post thumbnail -->

		<!-- post title -->
                <h3 class="title">
                    <?php if(get_the_content() == ""):?>
                        【<?php the_title(); ?>】
                    <?php else:?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">【<?php the_title(); ?>】</a>
                    <?php endif;?>
		</h3>
		<!-- /post title -->

		<!-- post details -->
		<span class="date"><i class="fa fa-calendar" aria-hidden="true"></i> <?php the_time('m d, Y'); ?></span>
		<!-- /post details -->

		<span class="post-desc clearfix">
                    <?php
                    if (!has_excerpt(get_the_ID())) {
                        echo shika_substr(strip_tags(strip_shortcodes(get_the_content())), 200);
                        
                    } else {
                        the_excerpt();
                    }
                    ?>
                    
                </span>

		<?php edit_post_link(); ?>

	</article>
	<!-- /article -->

<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>
