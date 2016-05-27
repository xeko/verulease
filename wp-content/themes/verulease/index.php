<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <section id="wrapper">
                <h1 class="h-title">店舗MAP</h1>
                <!-- tabs right -->
                <div class="tabbable clearfix" id="map-view">                    
                    <ul class="nav nav-pills nav-stacked col-sm-3 col-sm-push-9">
                        <h3 class="s-title text-center">店舗一覧</h3>
                        <li><a href="#d" data-toggle="tab">藤沢市</a></li>
                        <li><a href="#e" data-toggle="tab">茅ヶ崎市</a></li>
                        <li><a href="#f" data-toggle="tab">寒川町</a></li>
                        <li><a href="#g" data-toggle="tab">横浜市</a></li>
                    </ul>
                    <div class="tab-content col-sm-9  col-sm-pull-3">
                        <div id="first-content">
                            <iframe src="https://www.google.com/maps/d/embed?mid=1ZdKJeiR86scuipOzto_AdkX_Z_E" width="100%" height="480"></iframe>
                        </div>
                        <div class="tab-pane fade" id="d"><img src="<?php echo get_bloginfo('template_url') ?>/img/fujisawa.jpg" class="img-responsive" /></div>
                        <div class="tab-pane fade" id="e"><img src="<?php echo get_bloginfo('template_url') ?>/img/fujisawa.jpg" class="img-responsive" /></div>
                        <div class="tab-pane fade" id="f"><img src="<?php echo get_bloginfo('template_url') ?>/img/chigasaki_samukawa.jpg" class="img-responsive" /></div>
                        <div class="tab-pane fade" id="g"><img src="<?php echo get_bloginfo('template_url') ?>/img/chigasaki_samukawa.jpg" class="img-responsive" /></div>
                    </div>
                </div>
                <!-- /tabs -->

                <div class="col-md-9">
                    <h1 class="h-title">ヴェルボックスの種類（使い方）</h1>
                    <div id="type" class="clearfix">
                        <?php
                        $args = array('post_type' => 'type', 'post_status' => 'publish', 'posts_per_page' => 3);
                        $loop_type = new WP_Query($args);

                        if ($loop_type->have_posts()): while ($loop_type->have_posts()) : $loop_type->the_post();
                                ?>
                                <div class="col-md-4">
                                    <div class="type-box">
                                        <?php if (get_the_post_thumbnail()) { ?>                                       
                                            <a href="<?php the_permalink(); ?>" rel="nofollow"><?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?></a>
                                        <?php } ?>
                                        <h3 class="p-title text-center">
                                            <a href="<?php the_permalink(); ?>" rel="nofollow"><?php the_title() ?></a>
                                        </h3>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata() ?>
                        <?php endif; ?>
                    </div><!--End #type-->

                    <div id="system">
                        <h1 class="h-title">ヴェルボックスのココがPOINT</h1>
                        <?php
                        $args = array('post_type' => 'verusystem', 'post_status' => 'publish', 'posts_per_page' => 9);
                        $loop_verusystem = new WP_Query($args);

                        if ($loop_verusystem->have_posts()): while ($loop_verusystem->have_posts()) : $loop_verusystem->the_post();
                                ?>
                                <div class="col-md-4">
                                    <div class="type-box">
                                        <figure class="system">
                                            <?php if (get_the_post_thumbnail()) { ?>
                                                <?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
                                            <?php } ?>                                                
                                            <figcaption>
                                                <h3 class="title"><?php the_title(); ?></h3>
                                                <p><?php the_excerpt(); ?></p>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata() ?>
                        <?php endif; ?>
                    </div><!--En #system-->

                    <div id="news" class="clearfix">
                        <div class="col-md-6">
                            <h1 class="text-left"><img src="<?php echo get_bloginfo('template_url') ?>/img/icons/news_newspaper.png" /> 新着ニュース</h1>
                            <div class="wrap-content">
                                <?php
                                $post_news = get_posts(array(
                                    'numberposts' => 6,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'category',
                                            'field' => 'slug',
                                            'terms' => 'news',
                                        ),
                                    )
                                ));

                                foreach ($post_news as $post): setup_postdata($post);
                                    ?>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="clearfix"><h3><?php the_title(); ?> <span class="small"><?php the_time('m d, Y'); ?></span></h3></a>
                                    <span class="post-desc clearfix">
                                        <?php
                                        if (!has_excerpt(get_the_ID())) {
                                            echo shika_substr(strip_tags(strip_shortcodes(get_the_content())), 100);
                                        } else {
                                            the_excerpt();
                                        }
                                        ?>

                                    </span>

    <?php
endforeach;
wp_reset_postdata();
?>
                            </div><!--End #wrap-content-->
                        </div>
                        <div class="col-md-6" id="blogger">
                            <h1 class="text-left"><img src="<?php echo get_bloginfo('template_url') ?>/img/icons/Blog_ICON.png" /> ブログ情報</h1>
                            <div class="wrap-content">
                                <?php
                                $blog = get_posts(array(
                                    'numberposts' => -1,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'category',
                                            'field' => 'slug',
                                            'terms' => 'blog',
                                        ),
                                    ),
                                    'fields' => 'ids', // Only get post IDs
                                ));

                                foreach ($blog as $post): setup_postdata($post);
                                    ?>
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="clearfix"><h3><?php the_title(); ?> <span class="small"><?php the_time('m d, Y'); ?></span></h3></a>
                                    <span class="post-desc clearfix">
                                        <?php
                                        if (!has_excerpt(get_the_ID())) {
                                            echo shika_substr(strip_tags(strip_shortcodes(get_the_content())), 100);
                                        } else {
                                            the_excerpt();
                                        }
                                        ?>

                                    </span>

    <?php
endforeach;
wp_reset_postdata();
?>
                            </div><!--End #wrap-content-->
                        </div>
                    </div><!--End #news-->
                </div>
                <div class="col-md-3">
<?php get_sidebar(); ?>
                </div>


<?php get_template_part('pagination'); ?>

            </section><!--End #wrapper-->
        </div>
    </div>
</div>

<?php
get_footer();
