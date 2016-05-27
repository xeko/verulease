<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

require_once('lib/postrecent.php');

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// Main navigation
function main_nav()
{
    wp_nav_menu(
        array(
            'theme_location'  => 'header-menu',
            'menu'            => '',
            'container' => 'div',
            'container_class' => 'navbar-collapse collapse',
            'container_id' => 'nav',
            'menu_class' => 'nav navbar-nav',
            'menu_id' => '',
            'echo' => true,
            'fallback_cb' => 'wp_page_menu',
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'items_wrap' => '<ul class="%2$s" id="main-menu">%3$s</ul>',
            'depth' => 0,
            'walker' => ''
        )
    );
}
//Top Menu
function top_menu(){
    wp_nav_menu(
        array(
            'theme_location'  => 'top-menu',
            'menu'            => '',
            'container' => '',
            'container_class' => '',
            'container_id' => 'nav',
            'menu_class' => 'list-unstyled text-center',
            'menu_id' => '',
            'echo' => true,
            'fallback_cb' => 'wp_page_menu',
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'items_wrap' => '<ul class="%2$s" id="top-menu">%3$s</ul>',
            'depth' => 0,
            'walker' => ''
        )
    );
}

//Footer Menu
function footer_menu(){
    wp_nav_menu(
        array(
            'theme_location'  => 'footer-menu',
            'menu'            => '',
            'container' => '',
            'container_class' => '',
            'container_id' => 'nav',
            'menu_class' => 'list-inline text-center',
            'menu_id' => '',
            'echo' => true,
            'fallback_cb' => 'wp_page_menu',
            'before' => '',
            'after' => '',
            'link_before' => '',
            'link_after' => '',
            'items_wrap' => '<ul class="%2$s" id="footer-menu">%3$s</ul>',
            'depth' => 0,
            'walker' => ''
        )
    );
}

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

    	wp_register_script('scripts', get_template_directory_uri() . '/js/scripts.js', array('bootstrap'), false, true); // Custom scripts
        wp_enqueue_script('scripts'); // Enqueue it!

        wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.6');
        wp_enqueue_script('bootstrap'); // Enqueue it!
    }
}

// Load HTML5 Blank styles
function html5blank_styles()
{
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.6', 'all');
    wp_enqueue_style('bootstrap'); // Enqueue it!

    wp_register_style('style', get_template_directory_uri() . '/style.css', array('bootstrap'), 'all');
    wp_enqueue_style('style'); // Enqueue it!

    wp_register_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.6.1', 'all');
    wp_enqueue_style('font-awesome'); // Enqueue it!       
}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
        'top-menu' => __('Top Menu', 'html5blank'), // Sidebar Navigation
        'footer-menu' => __('Footer Menu', 'html5blank') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
//add_action('init', 'create_post_type_html5'); // Add our HTML5 Blank Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called HTML5-Blank
function create_post_type_html5()
{
    register_taxonomy_for_object_type('category', 'html5-blank'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'html5-blank');
    register_post_type('html5-blank', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('HTML5 Blank Custom Post', 'html5blank'), // Rename these to suit
            'singular_name' => __('HTML5 Blank Custom Post', 'html5blank'),
            'add_new' => __('Add New', 'html5blank'),
            'add_new_item' => __('Add New HTML5 Blank Custom Post', 'html5blank'),
            'edit' => __('Edit', 'html5blank'),
            'edit_item' => __('Edit HTML5 Blank Custom Post', 'html5blank'),
            'new_item' => __('New HTML5 Blank Custom Post', 'html5blank'),
            'view' => __('View HTML5 Blank Custom Post', 'html5blank'),
            'view_item' => __('View HTML5 Blank Custom Post', 'html5blank'),
            'search_items' => __('Search HTML5 Blank Custom Post', 'html5blank'),
            'not_found' => __('No HTML5 Blank Custom Posts found', 'html5blank'),
            'not_found_in_trash' => __('No HTML5 Blank Custom Posts found in Trash', 'html5blank')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}

function breadcrumb($divOption = array("id" => "breadcrumb", "class" => "breadcrumb inner wrap cf")) {
    global $post;
    $str = '';
    if (!is_home() && !is_front_page() && !is_admin()) {
        $tagAttribute = '';
        foreach ($divOption as $attrName => $attrValue) {
            $tagAttribute .= sprintf(' %s="%s"', $attrName, $attrValue);
        }
        $str.= '<div' . $tagAttribute . '>';
        $str.= '<ul>';
        $str.= '<li itemtype="//data-vocabulary.org/Breadcrumb"><a href="' . home_url() . '/" itemprop="url"><i class="fa fa-home"></i><span itemprop="title"></span></a></li>';

        if (is_category()) {
            $cat = get_queried_object();
            if ($cat->parent != 0) {
                $ancestors = array_reverse(get_ancestors($cat->cat_ID, 'category'));
                foreach ($ancestors as $ancestor) {
                    $str.=' <i class="fa fa-angle-double-right" aria-hidden="true"></i> <li itemtype="//data-vocabulary.org/Breadcrumb"><a href="' . get_category_link($ancestor) . '" itemprop="url"><span itemprop="title">' . get_cat_name($ancestor) . '</span></a></li>';
                }
            }
            $str.=' <i class="fa fa-angle-double-right" aria-hidden="true"></i> <li itemtype="//data-vocabulary.org/Breadcrumb"><span itemprop="title">' . $cat->name . '</span></li>';
        } elseif (is_single()) {
            $categories = get_the_category($post->ID);
            $cat = $categories[0];
            if ($cat->parent != 0) {
                $ancestors = array_reverse(get_ancestors($cat->cat_ID, 'category'));
                foreach ($ancestors as $ancestor) {
                    $str.='<li itemtype="//data-vocabulary.org/Breadcrumb"><a href="' . get_category_link($ancestor) . '" itemprop="url"><span itemprop="title">' . get_cat_name($ancestor) . '</span></a></li>';
                }
            }
            $str.=' <i class="fa fa-angle-double-right" aria-hidden="true"></i> <li itemtype="//data-vocabulary.org/Breadcrumb"><a href="' . get_category_link($cat->term_id) . '" itemprop="url"><span itemprop="title">' . $cat->cat_name . '</span></a></li>';
            $str.= ' <i class="fa fa-angle-double-right" aria-hidden="true"></i> <li itemtype="//data-vocabulary.org/Breadcrumb">' . $post->post_title . '</li>';
        } elseif (is_page()) {
            if ($post->post_parent != 0) {
                $ancestors = array_reverse(get_post_ancestors($post->ID));
                foreach ($ancestors as $ancestor) {
                    $str.=' <i class="fa fa-angle-double-right" aria-hidden="true"></i> <li itemtype="//data-vocabulary.org/Breadcrumb"><a href="' . get_permalink($ancestor) . '" itemprop="url"><span itemprop="title">' . get_the_title($ancestor) . '</span></a></li>';
                }
            }
            $str.= ' <i class="fa fa-angle-double-right" aria-hidden="true"></i> <li itemtype="//data-vocabulary.org/Breadcrumb"><span itemprop="title">' . $post->post_title . '</span></li>';
        } elseif (is_date()) {
            if (is_year()) {
                $str.= ' <i class="fa fa-angle-double-right" aria-hidden="true"></i> <li>' . get_the_time('Y') . '年</li>';
            } else if (is_month()) {
                $str.= ' <i class="fa fa-angle-double-right" aria-hidden="true"></i> <li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '年</a></li>';
                $str.= ' <i class="fa fa-angle-double-right" aria-hidden="true"></i> <li>' . get_the_time('n') . '月</li>';
            } else if (is_day()) {
                $str.= ' <i class="fa fa-angle-double-right" aria-hidden="true"></i> <li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '年</a></li>';
                $str.= ' <i class="fa fa-angle-double-right" aria-hidden="true"></i> <li><a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('n') . '月</a></li>';
                $str.= ' <i class="fa fa-angle-double-right" aria-hidden="true"></i> <li>' . get_the_time('j') . '日</li>';
            }
            if (is_year() && is_month() && is_day()) {
                $str.= ' <i class="fa fa-angle-double-right" aria-hidden="true"></i> <li>' . wp_title('', false) . '</li>';
            }
        } elseif (is_search()) {
            $str.=' <i class="fa fa-angle-double-right" aria-hidden="true"></i> <li itemtype="//data-vocabulary.org/Breadcrumb"><span itemprop="title">「' . get_search_query() . '」で検索した結果</span></li>';
        } elseif (is_author()) {
            $str .=' <i class="fa fa-angle-double-right" aria-hidden="true"></i> <li itemtype="//data-vocabulary.org/Breadcrumb"><span itemprop="title">投稿者 : ' . get_the_author_meta('display_name', get_query_var('author')) . '</span></li>';
        } elseif (is_tag()) {
            $str.=' <i class="fa fa-angle-double-right" aria-hidden="true"></i> <li itemtype="//data-vocabulary.org/Breadcrumb"><span itemprop="title">タグ : ' . single_tag_title('', false) . '</span></li>';
        } elseif (is_attachment()) {
            $str.= ' <i class="fa fa-angle-double-right" aria-hidden="true"></i> <li itemtype="//data-vocabulary.org/Breadcrumb"><span itemprop="title">' . $post->post_title . '</span></li>';
        } elseif (is_404()) {
            $str.=' <i class="fa fa-angle-double-right" aria-hidden="true"></i> <li>ページがみつかりません。</li>';
        } else {
            $str.=' <i class="fa fa-angle-double-right" aria-hidden="true"></i> <li itemtype="//data-vocabulary.org/Breadcrumb"><span itemprop="title">' . wp_title('', true) . '</span></li>';
        }
        $str.='</ul>';
        $str.='</div>';
    }
    echo $str;
}

add_action('init', 'type_post_type', 0);

function type_post_type() {

    $labels = array(
        'name' => 'Type',
        'singular_name' => 'type',
    );
    $args = array(
        'description' => 'All Type',
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail'),
        'taxonomies' => array(''),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 16,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'menu_icon' => get_bloginfo('template_url') . '/img/icons/icon_64.png',
        'can_export' => true,
        'has_archive' => false,
        'rewrite' => false,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('type', $args);
    flush_rewrite_rules(false);
}

add_action('init', 'verusystem_post_type', 0);

function verusystem_post_type() {

    $labels = array(
        'name' => 'Veru System',
        'singular_name' => 'verusystem',
    );
    $args = array(
        'description' => 'All',
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail'),
        'taxonomies' => array(''),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 17,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'menu_icon' => get_bloginfo('template_url') . '/img/icons/veru_system.png',
        'can_export' => true,
        'has_archive' => false,
        'rewrite' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('verusystem', $args);
    flush_rewrite_rules(false);
}

function shika_substr($str, $length, $minword = 3) {
    $sub = '';
    $len = 0;
    foreach (explode('。', $str) as $word) {
        $part = (($sub != '') ? ' ' : '') . $word;
        $sub .= $part;
        $len += strlen($part);

        if (strlen($word) > $minword && strlen($sub) >= $length) {
            break;
        }
    }
    return $sub . (($len < strlen($str)) ? '。' : '');
}

register_sidebar(array(
  'name'          => 'サイドバー',
  'id'            => 'sidebar',
  'description'   => 'サイドバーに入るウィジェットエリアです。',
  'before_widget' => '<div id="%1$s" class="%2$s side-widget"><div class="side-widget-inner">',
  'after_widget'  => '</div></div>',
  'before_title'  => '<h4 class="side-title"><span class="side-title-inner">',
  'after_title'   => '</span></h4>'
));

add_action('init', 'partner_post_type', 0);

function partner_post_type() {

    $labels = array(
        'name' => 'Partner',
        'singular_name' => 'partner',
    );
    $args = array(
        'description' => 'All',
        'labels' => $labels,
        'supports' => array(''),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 18,
        'show_in_admin_bar' => false,
        'show_in_nav_menus' => false,
        'menu_icon' => get_bloginfo('template_url') . '/img/icons/Partnership-128.png',
        'can_export' => true,
        'has_archive' => false,
        'rewrite' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
    );
    register_post_type('partner', $args);
    flush_rewrite_rules(false);
}

function load_admin_things() {
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');
}

add_action('admin_enqueue_scripts', 'load_admin_things');

add_filter('manage_edit-partner_columns', 'my_edit_partner_columns');

function my_edit_partner_columns($columns) {

    $columns = array(
        'cb' => '<input type="checkbox" />',
        'shortcode' => __('Shortcode'),
        'edit' => __('修正'),
        'date' => __('日時')
    );

    return $columns;
}

add_action('manage_partner_posts_custom_column', 'my_manage_partner_columns', 10, 2);

function my_manage_partner_columns($column, $post_id) {

    switch ($column) {
        case 'shortcode' :
            echo "<input type=\"text\" readonly=\"readonly\" onfocus=\"this.select();\" class=\"shortcode-in-list-table wp-ui-text-highlight code\" value=\"[partner_code id={$post_id}]\" />";
            break;
        case 'edit':
            echo edit_post_link('修正');
            break;
        default :
            break;
    }
}

add_filter('manage_edit-partner_sortable_columns', 'my_partner_sortable_columns');

function my_partner_sortable_columns($columns) {

    $columns['shortcode'] = 'shortcode';

    return $columns;
}

function partner_shortcode($atts, $content = null) {
    $partner_url_str = get_post_meta($atts['id'], 'partner_url', true);
    $partner_name_str = get_post_meta($atts['id'], 'partner_name', true);

    $partner_url_list = unserialize($partner_url_str);
    $partner_name_list = unserialize($partner_name_str);

    $images = miu_get_images($atts['id']);
    $image = "<ul id='partner' class='list-unstyled'>";
    
    $text_join = '';
    foreach ($images as $k => $value) {
        $partner_url = $partner_url_list[$k];
        $partner_name = $partner_name_list[$k];
        if ($partner_url != '')
            $text_join .= '<li><a href="' . $partner_url . '" title="' . $partner_name . '" class="thumbnail" target="_blank"><img src="' . $value . '" class="img-responsive"/></a></li>';
        else
            $text_join .= '<li><img src="' . $value . '" class="img-responsive clearfix" /></li>';        
    }
    $image .= $text_join;
    $image .= '</ul>';
    return $image;
}

add_shortcode('partner_code', 'partner_shortcode');

function post_related_by_category() {
    global $post;
    $categories = get_the_category($post->ID);
    if ($categories):
        $category_ids = array();
        foreach ($categories as $individual_category):
            $category_ids[] = $individual_category->term_id;
            $args = array(
                'category__in' => $category_ids,
                'post__not_in' => array($post->ID),
                'showposts' => 5,
                'ignore_sticky_posts' => 1,
                'orderby' => 'date',
                'order' => 'DESC');
            $my_query = new wp_query($args);
        endforeach;
        if ($my_query->have_posts()):
            if (is_single()):
                ?>
                        <h3 class="clearfix">関連記事</h3>
                        <ul class="list-group" id="list-post">
                                <?php
                                while ($my_query->have_posts()):
                                    $my_query->the_post();
                                    ?>
                                <li class="">
                                <?php
                                if (has_post_thumbnail($post->ID, 'related_post')) {
                                    $image_id = get_post_thumbnail_id($post->ID);
                                    $image_url = wp_get_attachment_image_src($image_id, array(100, 80), true);
                                    ?>
                                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><img src="<?php echo $image_url[0]; ?>" alt="" class=""/></a>
                                    <?php
                                }
                                ?>
                                        <span class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></span>
                                     <span class="small"><?php echo get_the_time('d-m-Y', $post->ID); ?></span>
                                </li>

                <?php endwhile; ?>

                        </ul><!--End #list-post-->
                    
                <?php
            endif;
        endif;
    endif;
    wp_reset_query();
}