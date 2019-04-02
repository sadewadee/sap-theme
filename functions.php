<?php	
 


require get_template_directory() . '/bootstrap-walker.php';

/*=============================================
=            BREADCRUMBS			            =
=============================================*/
//  to include in functions.php
function the_breadcrumb() {
    $sep = ' > ';
    if (!is_front_page()) {
	
	// Start the breadcrumb with a link to your homepage
        echo '<div class="breadcrumbs">';
        echo '<a href="';
        echo get_option('home');
        echo '">';
        bloginfo('name');
        echo '</a>' . $sep;
	
	// Check if the current page is a category, an archive or a single page. If so show the category or archive name.
        if (is_category() || is_single() ){
            the_category(' / ');
        } elseif (is_archive() || is_single()){
            if ( is_day() ) {
                printf( __( '%s', 'text_domain' ), get_the_date() );
            } elseif ( is_month() ) {
                printf( __( '%s', 'text_domain' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'text_domain' ) ) );
            } elseif ( is_year() ) {
                printf( __( '%s', 'text_domain' ), get_the_date( _x( 'Y', 'yearly archives date format', 'text_domain' ) ) );
            } else {
                _e( 'Blog Archives', 'text_domain' );
            }
        }
	
	// If the current page is a single post, show its title with the separator
        if (is_single()) {
            echo $sep;
            the_title();
        }
	
	// If the current page is a static page, show its title.
        if (is_page()) {
            echo the_title();
        }
	
	// if you have a static page assigned to be you posts list page. It will find the title of the static page and display it. i.e Home >> Blog
        if (is_home()){
            global $post;
            $page_for_posts_id = get_option('page_for_posts');
            if ( $page_for_posts_id ) { 
                $post = get_page($page_for_posts_id);
                setup_postdata($post);
                the_title();
                rewind_posts();
            }
        }
        echo '</div>';
    }
}
/*#BREADCRUMBS	*/



/**
 * Customized menu output
 */ 
// Variable & intelligent excerpt length.
function print_excerpt($length) { // Max excerpt length. Length is set in characters
	global $post;
	$text = $post->post_excerpt;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
	}
	$text = strip_shortcodes($text); // optional, recommended
	$text = strip_tags($text); // use ' $text = strip_tags($text,'<p><a>'); ' if you want to keep some tags

	$text = substr($text,0,$length);
	$excerpt = reverse_strrchr($text, '.', 1);
	if( $excerpt ) {
		echo apply_filters('the_excerpt',$excerpt);
	} else {
		echo apply_filters('the_excerpt',$text);
	}
}

// Returns the portion of haystack which goes until the last occurrence of needle
function reverse_strrchr($haystack, $needle, $trail) {
    return strrpos($haystack, $needle) ? substr($haystack, 0, strrpos($haystack, $needle) + $trail) : false;
}

add_theme_support('post-thumbnails');
add_image_size('slideshow_home',1280,600,true);
add_image_size('imagestop',1280,320,true);
add_image_size('post-thumbnails-sq',500,344,true);
add_image_size('post-thumbnails',300,168,true);
add_image_size('testi-thumbnails',300,300,true);

function create_post_type(){
register_post_type('Jobs',array('labels'=>array('name'=>__('Jobs Manager'),
'singular_name'=>__('Jobs'),
'all_items'=>__('All Jobs','text_domain'),
'add_new'=>'Add New Jobs','add_new_item'=>'Add New Jobs','show_ui'=>'true','hierarchical'=>'true',),
'public'=>true,'has_archive'=>true,'rewrite'=>array('slug'=>'jobs'),
'supports'=>array('title','editor','thumbnail','post-formats','page-attributes'),'menu_icon'=>'dashicons-groups'));


register_post_type('Testimonial',array('labels'=>array('name'=>__('Testimonial'),
'singular_name'=>__('Testimonial'),
'all_items'=>__('All testimonial','text_domain'),
'add_new'=>'Add New testimonial','add_new_item'=>'Add New Team','show_ui'=>'true','hierarchical'=>'true',),
'public'=>true,'has_archive'=>true,'rewrite'=>array('slug'=>'testimonial'),
'supports'=>array('title','editor','thumbnail','post-formats','page-attributes'),'menu_icon'=>'dashicons-format-image'));

register_post_type('slideshow_home',array('labels'=>array('name'=>__('Slideshow Home'),
'singular_name'=>__('Slideshow Home'),
'all_items'=>__('All Slideshow Home','text_domain'),
'add_new'=>'Add New Slideshow Home','add_new_item'=>'Add New Slideshow Home','show_ui'=>'true','hierarchical'=>'true',),
'public'=>true,'has_archive'=>true,'rewrite'=>array('slug'=>'slideshow_home'),
'supports'=>array('title','editor','author','thumbnail','excerpt','post-formats','page-attributes'),'menu_icon'=>'dashicons-format-image'));
}
add_action('init','create_post_type');




function mytheme_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard">
        <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        <?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
    </div>
    <?php if ( $comment->comment_approved == '0' ) : ?>
         <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
          <br />
    <?php endif; ?>

    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
        <?php
        /* translators: 1: date, 2: time */
        printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '  ', '' );
        ?>
    </div>

    <?php comment_text(); ?>

    <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
    <?php
    }
	
	
// custom admin login logo
function custom_login_logo() {
	echo '<style type="text/css" class="logooo">
	h1 a { background-image: url('.get_bloginfo('template_directory').'/images/logo-boc-digital.png)!important; background-size:100%!important; width: auto!important;}
	</style>';
}
add_action('login_head', 'custom_login_logo');


//icon dasboard//
function wps_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('about');
    $wp_admin_bar->remove_menu('wporg');
    $wp_admin_bar->remove_menu('documentation');
    $wp_admin_bar->remove_menu('support-forums');
    $wp_admin_bar->remove_menu('feedback');
    //bagian menambahkan link
        $wp_admin_bar->add_menu( array(
            'id'    => 'wp-logo',
            'title' => '<img src=" '.get_bloginfo('template_directory').'/images/themeoptions-icon.png" width="15" height="10" />',
            'href'  => self_admin_url( '' ),
            'meta'  => array(
                'title' => __('Service AC'),
            ),
        ) );
}
add_action( 'wp_before_admin_bar_render', 'wps_admin_bar' );




 // pagenav 1 2 3
function wp_pagenavi($before = '', $after = '') {
global $wpdb, $wp_query;
if (is_single())
return;
$pagenavi_options = array();
$pagenavi_options['pages_text'] = __('Page %CURRENT_PAGE% of %TOTAL_PAGES%');
$pagenavi_options['current_text'] = '%PAGE_NUMBER%';
$pagenavi_options['page_text'] = '%PAGE_NUMBER%';
$pagenavi_options['first_text'] = __('&#9668; First');
$pagenavi_options['last_text'] = __('Last &#9658;');
$pagenavi_options['next_text'] = __('&#9658;');
$pagenavi_options['prev_text'] = __('&#9668;');
$pagenavi_options['dotright_text'] = __('...');
$pagenavi_options['dotleft_text'] = __('...');
$pagenavi_options['style'] = 1;
$pagenavi_options['num_pages'] = 5;
$pagenavi_options['always_show'] = 0;
$request = $wp_query->request;
$posts_per_page = intval(get_query_var('posts_per_page'));
$paged = intval(get_query_var('paged'));
$numposts = $wp_query->found_posts;
$max_page = intval($wp_query->max_num_pages);
if (empty($paged) || $paged == 0)
$paged = 1;
$pages_to_show = intval($pagenavi_options['num_pages']);
$larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
$larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
$pages_to_show_minus_1 = $pages_to_show - 1;
$half_page_start = floor($pages_to_show_minus_1/2);
$half_page_end = ceil($pages_to_show_minus_1/2);
$start_page = $paged - $half_page_start;
if ($start_page <= 0)
$start_page = 1;
$end_page = $paged + $half_page_end;
if (($end_page - $start_page) != $pages_to_show_minus_1) {
$end_page = $start_page + $pages_to_show_minus_1;
}
if ($end_page > $max_page) {
$start_page = $max_page - $pages_to_show_minus_1;
$end_page = $max_page;
}
if ($start_page <= 0)
$start_page = 1;
$larger_pages_array = array();
if ( $larger_page_multiple )
for ( $i = $larger_page_multiple; $i <= $max_page; $i += $larger_page_multiple )
$larger_pages_array[] = $i;
if ($max_page > 1 || intval($pagenavi_options['always_show'])) {
$pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
$pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
echo $before.'<div class="wp-pagenavi">'."\n";
switch(intval($pagenavi_options['style'])) {
// Normal
case 1:
if (!empty($pages_text)) {
echo '<span class="pages">'.$pages_text.'</span>';
}
if ($start_page >= 2 && $pages_to_show < $max_page) {
$first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
echo '<a href="'.clean_url(get_pagenum_link()).'" class="first" title="'.$first_page_text.'">'.$first_page_text.'</a>';
if (!empty($pagenavi_options['dotleft_text'])) {
echo '<span class="extend">'.$pagenavi_options['dotleft_text'].'</span>';
}
}
$larger_page_start = 0;
foreach($larger_pages_array as $larger_page) {
if ($larger_page < $start_page && $larger_page_start < $larger_page_to_show) {
$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($larger_page), $pagenavi_options['page_text']);
echo '<a href="'.clean_url(get_pagenum_link($larger_page)).'" class="page" title="'.$page_text.'">'.$page_text.'</a>';
$larger_page_start++;
}
}
previous_posts_link($pagenavi_options['prev_text']);
for($i = $start_page; $i <= $end_page; $i++) {
if ($i == $paged) {
$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
echo '<span class="current">'.$current_page_text.'</span>';
} else {
$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
echo '<a href="'.clean_url(get_pagenum_link($i)).'" class="page" title="'.$page_text.'">'.$page_text.'</a>';
}
}
next_posts_link($pagenavi_options['next_text'], $max_page);
$larger_page_end = 0;
foreach($larger_pages_array as $larger_page) {
if ($larger_page > $end_page && $larger_page_end < $larger_page_to_show) {
$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($larger_page), $pagenavi_options['page_text']);
echo '<a href="'.clean_url(get_pagenum_link($larger_page)).'" class="page" title="'.$page_text.'">'.$page_text.'</a>';
$larger_page_end++;
}
}
if ($end_page < $max_page) {
if (!empty($pagenavi_options['dotright_text'])) {
echo '<span class="extend">'.$pagenavi_options['dotright_text'].'</span>';
}
$last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
echo '<a href="'.clean_url(get_pagenum_link($max_page)).'" class="last" title="'.$last_page_text.'">'.$last_page_text.'</a>';
}
break;
// Dropdown
case 2;
echo '<form action="'.htmlspecialchars($_SERVER['PHP_SELF']).'" method="get">'."\n";
echo '<select size="1" onchange="document.location.href = this.options[this.selectedIndex].value;">'."\n";
for($i = 1; $i <= $max_page; $i++) {
$page_num = $i;
if ($page_num == 1) {
$page_num = 0;
}
if ($i == $paged) {
$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
echo '<option value="'.clean_url(get_pagenum_link($page_num)).'" selected="selected" class="current">'.$current_page_text."</option>\n";
} else {
$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
echo '<option value="'.clean_url(get_pagenum_link($page_num)).'">'.$page_text."</option>\n";
}}
echo "</select>\n";
echo "</form>\n";
break;}
echo '</div>'.$after;
}}

register_nav_menus( array(
'primary' => esc_html__( 'Primary Menu', 'ultrabootstrap' ),
	'menufooter' => __( 'Footer Navigation', 'promotion' ),
) );



// Register Widgetized Areas
if(function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Kosong',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span></h3>',
	));
	register_sidebar(array(
		'name' => 'Sidebar',
		'before_widget' => ' <div class="text-widget">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
	));
	register_sidebar(array(
		'name' => 'Icons',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	register_sidebar(array(
		'name' => 'Footer',
		'before_widget' => '<div class="col-md-2 col-sm-12"> <div class="widget link-widget clearfix"> ',
		'after_widget' => '</div> </div>',
		'before_title' => '<div class="widget-title"><h4 class="title">',
		'after_title' => '</h4> </div>',
	));	
	register_sidebar(array(
		'name' => 'Footer 1',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h4 class="title">',
		'after_title' => '</h4>',
	));			
}



// Exclude page from search 
function SearchFilter($query) {
if ($query->is_search) {
$query->set('post_type',  array( 'post', 'reviews'));
}
return $query;
}
add_filter('pre_get_posts','SearchFilter'); 

// Add post thumbnail functionality
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support('post-thumbnails', array('post','reviews'));
	add_image_size('review-thumb', 140, 140, true);
	add_image_size('big-post-thumb', 300, 190, true);
	add_image_size('small-post-thumb', 120, 120, true);
	add_image_size('related-thumb', 300, 190, true);
	add_image_size('big-nivo-thumb', 1200, 400, true);
	add_image_size('small-nivo-thumb', 620, 340, true);
	add_image_size('featured-thumb', 620, 450, true);
	add_image_size('full-featured-thumb', 1000, 500, true);
	add_image_size('blog1-thumb', 300, 190, true);
}

// Widgets
include_once('panel/widgets/list.php');
include_once('panel/widgets/social-widget.php');
include_once('panel/widgets/search-widget.php');
include_once('panel/widgets/facebook-like-widget.php');
include_once('panel/widgets/video-widget.php');
include_once('panel/widgets/recent-posts-widget.php');




// UI Panel Options
include_once('panel/panel-options.php');
// Include reedwan framework file for the Koran Renon theme panel
include_once('panel/framework.php');

// Translation
load_theme_textdomain('reedwan', get_template_directory() . '/languages');

// Adds RSS feeds link
if(!get_option('reedwan_feedburner')) {
	add_theme_support('automatic-feed-links');
}

// How comments are displayed
function reedwan_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
	
		<div class="the-comment">
			<div class="alignleft">
				<?php echo get_avatar($comment,$size='70'); ?>
				<div class="clear"></div>
				<div class="reply-comment"><?php comment_reply_link(array_merge( $args, array('reply_text' => 'Reply', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
			</div>
			<div class="comment-box">
				<div class="comment-author">
					<span class="name"><?php echo get_comment_author_link() ?></span>
					<small><?php printf(__('%1$s at %2$s', 'DF'), get_comment_date(),  get_comment_time()) ?><a><?php edit_comment_link(__(' Edit','DF')) ?></a></small>
				</div>
			
				<div class="comment-text">
					<?php if ($comment->comment_approved == '0') : ?>
					<em><?php _e('Your comment is awaiting moderation.', 'DF') ?></em>
					<br />
					<?php endif; ?>
					<?php comment_text() ?>
				</div>
			
			</div>
			
		</div>

<?php }

// Related Post..//
function get_related_posts($post_id, $tags = array()) {
	$query = new WP_Query();
	
	$post_types = get_post_types();
	unset($post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);
	
	if($tags) {
		foreach($tags as $tag) {
			$tagsA[] = $tag->term_id;
		}
	}
	$query = new WP_Query( array('showposts' => 4,'post_type' => $post_types,'post__not_in' => array($post_id),'tag__in' => $tagsA,'ignore_sticky_posts' => 1,
	));
  	return $query;
}

// Kresi Pagination
function kriesi_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'><span class='arrows'>&laquo;</span> First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'><span class='arrows'>&lsaquo;</span> Previous</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>Next <span class='arrows'>&rsaquo;</span></a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last <span class='arrows'>&raquo;</span></a>";
         echo "</div>\n";
     }
}

// Limit Word
function string_limit_words($string, $word_limit)
{
	$words = explode(' ', $string, ($word_limit + 1));
	
	if(count($words) > $word_limit) {
		array_pop($words);
	}
	
	return implode(' ', $words);
}

//construct


abstract class WPOrg_Meta_Box
{
    public static function add()
    {
        $screens = ['jobs', 'wporg_cpt'];
        foreach ($screens as $screen) {
            add_meta_box(
                'wporg_box_id',          // Unique ID
                'Locations', // Box title
                [self::class, 'html'],   // Content callback, must be of type callable
                $screen                  // Post type
            );
        }
    }
 
    public static function save($post_id)
    {
        if (array_key_exists('wporg_field', $_POST)) {
            update_post_meta(
                $post_id,
                '_wporg_meta_key',
                $_POST['wporg_field']
            );
        }
    }
 
    public static function html($post)
    {
        $value = get_post_meta($post->ID, '_wporg_meta_key', true);
        ?>
        <select name="wporg_field" id="wporg_field" class="postbox">
            <option value="">Select Locations</option>
					<option value="AF" <?php selected($value, 'AF'); ?>>Afghanistan</option>
		   			<option value="AL" <?php selected($value, 'AL'); ?>>Albania</option>
		   			<option value="DZ" <?php selected($value, 'DZ'); ?>>Algeria</option>
		   			<option value="AS" <?php selected($value, 'AS'); ?>>American Samoa</option>
		   			<option value="AD" <?php selected($value, 'AD'); ?>>Andorra</option>
		   			<option value="AO" <?php selected($value, 'AO'); ?>>Angola</option>
		   			<option value="AI" <?php selected($value, 'AI'); ?>>Anguilla</option>
		   			<option value="AQ" <?php selected($value, 'QA'); ?>>Antarctica</option>
		   			<option value="AG" <?php selected($value, 'AG'); ?>>Antigua And Barbuda</option>
		   			<option value="AR" <?php selected($value, 'AR'); ?>>Argentina</option>
		   			<option value="AM" <?php selected($value, 'AM'); ?>>Armenia</option>
		   			<option value="AW" <?php selected($value, 'AW'); ?>>Aruba</option>
		   			<option value="AU" <?php selected($value, 'AU'); ?>>Australia</option>
		   			<option value="AT" <?php selected($value, 'AT'); ?>>Austria</option>
		   			<option value="AZ" <?php selected($value, 'AZ'); ?>>Azerbaijan</option>
		   			<option value="BS" <?php selected($value, 'BS'); ?>>Bahamas The</option>
		   			<option value="BH" <?php selected($value, 'BH'); ?>>Bahrain</option>
		   			<option value="BD" <?php selected($value, 'BD'); ?>>Bangladesh</option>
		   			<option value="BB" <?php selected($value, 'BB'); ?>>Barbados</option>
		   			<option value="BY" <?php selected($value, 'BY'); ?>>Belarus</option>
		   			<option value="BE" <?php selected($value, 'BE'); ?>>Belgium</option>
		   			<option value="BZ" <?php selected($value, 'BZ'); ?>>Belize</option>
		   			<option value="BJ" <?php selected($value, 'BJ'); ?>>Benin</option>
		   			<option value="BM" <?php selected($value, 'BM'); ?>>Bermuda</option>
		   			<option value="BT" <?php selected($value, 'BT'); ?>>Bhutan</option>
		   			<option value="BO" <?php selected($value, 'BO'); ?>>Bolivia</option>
		   			<option value="BA" <?php selected($value, 'BA'); ?>>Bosnia and Herzegovina</option>
		   			<option value="BW" <?php selected($value, 'BW'); ?>>Botswana</option>
		   			<option value="BV" <?php selected($value, 'BV'); ?>>Bouvet Island</option>
		   			<option value="BR" <?php selected($value, 'BR'); ?>>Brazil</option>
		   			<option value="IO" <?php selected($value, 'IO'); ?>>British Indian Ocean Territory</option>
		   			<option value="BN" <?php selected($value, 'BN'); ?>>Brunei</option>
		   			<option value="BG" <?php selected($value, 'BG'); ?>>Bulgaria</option>
		   			<option value="BF" <?php selected($value, 'BF'); ?>>Burkina Faso</option>
		   			<option value="BI" <?php selected($value, 'BI'); ?>>Burundi</option>
		   			<option value="KH" <?php selected($value, 'KH'); ?>>Cambodia</option>
		   			<option value="CM" <?php selected($value, 'CM'); ?>>Cameroon</option>
		   			<option value="CA" <?php selected($value, 'CA'); ?>>Canada</option>
		   			<option value="CV" <?php selected($value, 'CV'); ?>>Cape Verde</option>
		   			<option value="KY" <?php selected($value, 'KY'); ?>>Cayman Islands</option>
		   			<option value="CF" <?php selected($value, 'CF'); ?>>Central African Republic</option>
		   			<option value="TD" <?php selected($value, 'TD'); ?>>Chad</option>
		   			<option value="CL" <?php selected($value, 'CL'); ?>>Chile</option>
		   			<option value="CN" <?php selected($value, 'CN'); ?>>China</option>
		   			<option value="CX" <?php selected($value, 'CX'); ?>>Christmas Island</option>
		   			<option value="CC" <?php selected($value, 'CC'); ?>>Cocos (Keeling) Islands</option>
		   			<option value="CO" <?php selected($value, 'CO'); ?>>Colombia</option>
		   			<option value="KM" <?php selected($value, 'KM'); ?>>Comoros</option>
		   			<option value="CK" <?php selected($value, 'CK'); ?>>Cook Islands</option>
		   			<option value="CR" <?php selected($value, 'CR'); ?>>Costa Rica</option>
		   			<option value="CI" <?php selected($value, 'CI'); ?>>Cote D'Ivoire (Ivory Coast)</option>
		   			<option value="HR" <?php selected($value, 'HR'); ?>>Croatia (Hrvatska)</option>
		   			<option value="CU" <?php selected($value, 'CU'); ?>>Cuba</option>
		   			<option value="CY" <?php selected($value, 'CY'); ?>>Cyprus</option>
		   			<option value="CZ" <?php selected($value, 'CZ'); ?>>Czech Republic</option>
		   			<option value="CD" <?php selected($value, 'CD'); ?>>Democratic Republic Of The Congo</option>
		   			<option value="DK" <?php selected($value, 'DK'); ?>>Denmark</option>
		   			<option value="DJ" <?php selected($value, 'DJ'); ?>>Djibouti</option>
		   			<option value="DM" <?php selected($value, 'DM'); ?>>Dominica</option>
		   			<option value="DO" <?php selected($value, 'DO'); ?>>Dominican Republic</option>
		   			<option value="TP" <?php selected($value, 'TP'); ?>>East Timor</option>
		   			<option value="EC" <?php selected($value, 'EC'); ?>>Ecuador</option>
		   			<option value="EG" <?php selected($value, 'EG'); ?>>Egypt</option>
		   			<option value="SV" <?php selected($value, 'SV'); ?>>El Salvador</option>
		   			<option value="GQ" <?php selected($value, 'GQ'); ?>>Equatorial Guinea</option>
		   			<option value="ER" <?php selected($value, 'ER'); ?>>Eritrea</option>
		   			<option value="EE" <?php selected($value, 'EE'); ?>>Estonia</option>
		   			<option value="ET" <?php selected($value, 'ET'); ?>>Ethiopia</option>
		   			<option value="XA" <?php selected($value, 'XA'); ?>>External Territories of Australia</option>
		   			<option value="FK" <?php selected($value, 'FK'); ?>>Falkland Islands</option>
		   			<option value="FO" <?php selected($value, 'FO'); ?>>Faroe Islands</option>
		   			<option value="FJ" <?php selected($value, 'FJ'); ?>>Fiji Islands</option>
		   			<option value="FI" <?php selected($value, 'FI'); ?>>Finland</option>
		   			<option value="FR" <?php selected($value, 'FR'); ?>>France</option>
		   			<option value="GF" <?php selected($value, 'GF'); ?>>French Guiana</option>
		   			<option value="PF" <?php selected($value, 'PF'); ?>>French Polynesia</option>
		   			<option value="TF" <?php selected($value, 'TF'); ?>>French Southern Territories</option>
		   			<option value="GA" <?php selected($value, 'GA'); ?>>Gabon</option>
		   			<option value="GM" <?php selected($value, 'GM'); ?>>Gambia The</option>
		   			<option value="GE" <?php selected($value, 'GE'); ?>>Georgia</option>
		   			<option value="DE" <?php selected($value, 'DE'); ?>>Germany</option>
		   			<option value="GH" <?php selected($value, 'GH'); ?>>Ghana</option>
		   			<option value="GI" <?php selected($value, 'GI'); ?>>Gibraltar</option>
		   			<option value="GR" <?php selected($value, 'GR'); ?>>Greece</option>
		   			<option value="GL" <?php selected($value, 'GL'); ?>>Greenland</option>
		   			<option value="GD" <?php selected($value, 'GD'); ?>>Grenada</option>
		   			<option value="GP" <?php selected($value, 'GP'); ?>>Guadeloupe</option>
		   			<option value="GU" <?php selected($value, 'GU'); ?>>Guam</option>
		   			<option value="GT" <?php selected($value, 'GT'); ?>>Guatemala</option>
		   			<option value="XU" <?php selected($value, 'XU'); ?>>Guernsey and Alderney</option>
		   			<option value="GN" <?php selected($value, 'GN'); ?>>Guinea</option>
		   			<option value="GW" <?php selected($value, 'GW'); ?>>Guinea-Bissau</option>
		   			<option value="GY" <?php selected($value, 'GY'); ?>>Guyana</option>
		   			<option value="HT" <?php selected($value, 'HT'); ?>>Haiti</option>
		   			<option value="HM" <?php selected($value, 'HM'); ?>>Heard and McDonald Islands</option>
		   			<option value="HN" <?php selected($value, 'HN'); ?>>Honduras</option>
		   			<option value="HK" <?php selected($value, 'HK'); ?>>Hong Kong S.A.R.</option>
		   			<option value="HU" <?php selected($value, 'HU'); ?>>Hungary</option>
		   			<option value="IS" <?php selected($value, 'IS'); ?>>Iceland</option>
		   			<option value="IN" <?php selected($value, 'IN'); ?>>India</option>
		   			<option value="ID" <?php selected($value, 'ID'); ?>>Indonesia</option>
		   			<option value="IR" <?php selected($value, 'IR'); ?>>Iran</option>
		   			<option value="IQ" <?php selected($value, 'IQ'); ?>>Iraq</option>
		   			<option value="IE" <?php selected($value, 'IE'); ?>>Ireland</option>
		   			<option value="IL" <?php selected($value, 'IL'); ?>>Israel</option>
		   			<option value="IT" <?php selected($value, 'IT'); ?>>Italy</option>
		   			<option value="JM" <?php selected($value, 'JM'); ?>>Jamaica</option>
		   			<option value="JP" <?php selected($value, 'JP'); ?>>Japan</option>
		   			<option value="XJ" <?php selected($value, 'XJ'); ?>>Jersey</option>
		   			<option value="JO" <?php selected($value, 'JO'); ?>>Jordan</option>
		   			<option value="KZ" <?php selected($value, 'KZ'); ?>>Kazakhstan</option>
		   			<option value="KE" <?php selected($value, 'KE'); ?>>Kenya</option>
		   			<option value="KI" <?php selected($value, 'KI'); ?>>Kiribati</option>
		   			<option value="KP" <?php selected($value, 'KP'); ?>>Korea North</option>
		   			<option value="KR" <?php selected($value, 'KR'); ?>>Korea South</option>
		   			<option value="KW" <?php selected($value, 'KW'); ?>>Kuwait</option>
		   			<option value="KG" <?php selected($value, 'KG'); ?>>Kyrgyzstan</option>
		   			<option value="LA" <?php selected($value, 'LA'); ?>>Laos</option>
		   			<option value="LV" <?php selected($value, 'LV'); ?>>Latvia</option>
		   			<option value="LB" <?php selected($value, 'LB'); ?>>Lebanon</option>
		   			<option value="LS" <?php selected($value, 'LS'); ?>>Lesotho</option>
		   			<option value="LR" <?php selected($value, 'LR'); ?>>Liberia</option>
		   			<option value="LY" <?php selected($value, 'LY'); ?>>Libya</option>
		   			<option value="LI" <?php selected($value, 'LI'); ?>>Liechtenstein</option>
		   			<option value="LT" <?php selected($value, 'LT'); ?>>Lithuania</option>
		   			<option value="LU" <?php selected($value, 'LU'); ?>>Luxembourg</option>
		   			<option value="MO" <?php selected($value, 'MO'); ?>>Macau S.A.R.</option>
		   			<option value="MK" <?php selected($value, 'MK'); ?>>Macedonia</option>
		   			<option value="MG" <?php selected($value, 'MG'); ?>>Madagascar</option>
		   			<option value="MW" <?php selected($value, 'MW'); ?>>Malawi</option>
		   			<option value="MY" <?php selected($value, 'MY'); ?>>Malaysia</option>
		   			<option value="MV" <?php selected($value, 'MV'); ?>>Maldives</option>
		   			<option value="ML" <?php selected($value, 'ML'); ?>>Mali</option>
		   			<option value="MT" <?php selected($value, 'MT'); ?>>Malta</option>
		   			<option value="XM" <?php selected($value, 'XM'); ?>>Man (Isle of)</option>
		   			<option value="MH" <?php selected($value, 'MH'); ?>>Marshall Islands</option>
		   			<option value="MQ" <?php selected($value, 'MQ'); ?>>Martinique</option>
		   			<option value="MR" <?php selected($value, 'MR'); ?>>Mauritania</option>
		   			<option value="MU" <?php selected($value, 'MU'); ?>>Mauritius</option>
		   			<option value="YT" <?php selected($value, 'YT'); ?>>Mayotte</option>
		   			<option value="MX" <?php selected($value, 'MX'); ?>>Mexico</option>
		   			<option value="FM" <?php selected($value, 'FM'); ?>>Micronesia</option>
		   			<option value="MD" <?php selected($value, 'MD'); ?>>Moldova</option>
		   			<option value="MC" <?php selected($value, 'MC'); ?>>Monaco</option>
		   			<option value="MN" <?php selected($value, 'MN'); ?>>Mongolia</option>
		   			<option value="MS" <?php selected($value, 'MS'); ?>>Montserrat</option>
		   			<option value="MA" <?php selected($value, 'MA'); ?>>Morocco</option>
		   			<option value="MZ" <?php selected($value, 'MZ'); ?>>Mozambique</option>
		   			<option value="MM" <?php selected($value, 'MM'); ?>>Myanmar</option>
		   			<option value="NA" <?php selected($value, 'NA'); ?>>Namibia</option>
		   			<option value="NR" <?php selected($value, 'NR'); ?>>Nauru</option>
		   			<option value="NP" <?php selected($value, 'NP'); ?>>Nepal</option>
		   			<option value="AN" <?php selected($value, 'AN'); ?>>Netherlands Antilles</option>
		   			<option value="NL" <?php selected($value, 'NL'); ?>>Netherlands The</option>
		   			<option value="NC" <?php selected($value, 'NC'); ?>>New Caledonia</option>
		   			<option value="NZ" <?php selected($value, 'NZ'); ?>>New Zealand</option>
		   			<option value="NI" <?php selected($value, 'NI'); ?>>Nicaragua</option>
		   			<option value="NE" <?php selected($value, 'NE'); ?>>Niger</option>
		   			<option value="NG" <?php selected($value, 'NG'); ?>>Nigeria</option>
		   			<option value="NU" <?php selected($value, 'NU'); ?>>Niue</option>
		   			<option value="NF" <?php selected($value, 'NF'); ?>>Norfolk Island</option>
		   			<option value="MP" <?php selected($value, 'MP'); ?>>Northern Mariana Islands</option>
		   			<option value="NO" <?php selected($value, 'NO'); ?>>Norway</option>
		   			<option value="OM" <?php selected($value, 'OM'); ?>>Oman</option>
		   			<option value="PK" <?php selected($value, 'PK'); ?>>Pakistan</option>
		   			<option value="PW" <?php selected($value, 'PW'); ?>>Palau</option>
		   			<option value="PS" <?php selected($value, 'PS'); ?>>Palestinian Territory Occupied</option>
		   			<option value="PA" <?php selected($value, 'PA'); ?>>Panama</option>
		   			<option value="PG" <?php selected($value, 'PG'); ?>>Papua new Guinea</option>
		   			<option value="PY" <?php selected($value, 'PY'); ?>>Paraguay</option>
		   			<option value="PE" <?php selected($value, 'PE'); ?>>Peru</option>
		   			<option value="PH" <?php selected($value, 'PH'); ?>>Philippines</option>
		   			<option value="PN" <?php selected($value, 'PN'); ?>>Pitcairn Island</option>
		   			<option value="PL" <?php selected($value, 'PT'); ?>>Poland</option>
		   			<option value="PT" <?php selected($value, 'PT'); ?>>Portugal</option>
		   			<option value="PR" <?php selected($value, 'PR'); ?>>Puerto Rico</option>
		   			<option value="QA" <?php selected($value, 'QA'); ?>>Qatar</option>
		   			<option value="CG" <?php selected($value, 'CG'); ?>>Republic Of The Congo</option>
		   			<option value="RE" <?php selected($value, 'RE'); ?>>Reunion</option>
		   			<option value="RO" <?php selected($value, 'RO'); ?>>Romania</option>
		   			<option value="RU" <?php selected($value, 'RU'); ?>>Russia</option>
		   			<option value="RW" <?php selected($value, 'RW'); ?>>Rwanda</option>
		   			<option value="SH" <?php selected($value, 'SH'); ?>>Saint Helena</option>
		   			<option value="KN" <?php selected($value, 'KN'); ?>>Saint Kitts And Nevis</option>
		   			<option value="LC" <?php selected($value, 'LC'); ?>>Saint Lucia</option>
		   			<option value="PM" <?php selected($value, 'PM'); ?>>Saint Pierre and Miquelon</option>
		   			<option value="VC" <?php selected($value, 'VC'); ?>>Saint Vincent And The Grenadines</option>
		   			<option value="WS" <?php selected($value, 'WS'); ?>>Samoa</option>
		   			<option value="SM" <?php selected($value, 'SM'); ?>>San Marino</option>
		   			<option value="ST" <?php selected($value, 'ST'); ?>>Sao Tome and Principe</option>
		   			<option value="SA" <?php selected($value, 'SA'); ?>>Saudi Arabia</option>
		   			<option value="SN" <?php selected($value, 'SN'); ?>>Senegal</option>
		   			<option value="RS" <?php selected($value, 'RS'); ?>>Serbia</option>
		   			<option value="SC" <?php selected($value, 'SC'); ?>>Seychelles</option>
		   			<option value="SL" <?php selected($value, 'SL'); ?>>Sierra Leone</option>
		   			<option value="SG" <?php selected($value, 'SG'); ?>>Singapore</option>
		   			<option value="SK" <?php selected($value, 'SK'); ?>>Slovakia</option>
		   			<option value="SI" <?php selected($value, 'SI'); ?>>Slovenia</option>
		   			<option value="XG" <?php selected($value, 'XG'); ?>>Smaller Territories of the UK</option>
		   			<option value="SB" <?php selected($value, 'SB'); ?>>Solomon Islands</option>
		   			<option value="SO" <?php selected($value, 'SO'); ?>>Somalia</option>
		   			<option value="ZA" <?php selected($value, 'ZA'); ?>>South Africa</option>
		   			<option value="GS" <?php selected($value, 'GS'); ?>>South Georgia</option>
		   			<option value="SS" <?php selected($value, 'SS'); ?>>South Sudan</option>
		   			<option value="ES" <?php selected($value, 'ES'); ?>>Spain</option>
		   			<option value="LK" <?php selected($value, 'LK'); ?>>Sri Lanka</option>
		   			<option value="SD" <?php selected($value, 'SD'); ?>>Sudan</option>
		   			<option value="SR" <?php selected($value, 'SR'); ?>>Suriname</option>
		   			<option value="SJ" <?php selected($value, 'SJ'); ?>>Svalbard And Jan Mayen Islands</option>
		   			<option value="SZ" <?php selected($value, 'SZ'); ?>>Swaziland</option>
		   			<option value="SE" <?php selected($value, 'SE'); ?>>Sweden</option>
		   			<option value="CH" <?php selected($value, 'CH'); ?>>Switzerland</option>
		   			<option value="SY" <?php selected($value, 'SY'); ?>>Syria</option>
		   			<option value="TW" <?php selected($value, 'TW'); ?>>Taiwan</option>
		   			<option value="TJ" <?php selected($value, 'TJ'); ?>>Tajikistan</option>
		   			<option value="TZ" <?php selected($value, 'TZ'); ?>>Tanzania</option>
		   			<option value="TH" <?php selected($value, 'TH'); ?>>Thailand</option>
		   			<option value="TG" <?php selected($value, 'TG'); ?>>Togo</option>
		   			<option value="TK" <?php selected($value, 'TK'); ?>>Tokelau</option>
		   			<option value="TO" <?php selected($value, 'TO'); ?>>Tonga</option>
		   			<option value="TT" <?php selected($value, 'TT'); ?>>Trinidad And Tobago</option>
		   			<option value="TN" <?php selected($value, 'TN'); ?>>Tunisia</option>
		   			<option value="TR" <?php selected($value, 'TR'); ?>>Turkey</option>
		   			<option value="TM" <?php selected($value, 'TM'); ?>>Turkmenistan</option>
		   			<option value="TC" <?php selected($value, 'TC'); ?>>Turks And Caicos Islands</option>
		   			<option value="TV" <?php selected($value, 'TV'); ?>>Tuvalu</option>
		   			<option value="UG" <?php selected($value, 'UG'); ?>>Uganda</option>
		   			<option value="UA" <?php selected($value, 'UA'); ?>>Ukraine</option>
		   			<option value="AE" <?php selected($value, 'UA'); ?>>United Arab Emirates</option>
		   			<option value="GB" <?php selected($value, 'GB'); ?>>United Kingdom</option>
		   			<option value="US" <?php selected($value, 'US'); ?>>United States</option>
		   			<option value="UM" <?php selected($value, 'UM'); ?>>United States Minor Outlying Islands</option>
		   			<option value="UY" <?php selected($value, 'UY'); ?>>Uruguay</option>
		   			<option value="UZ" <?php selected($value, 'UZ'); ?>>Uzbekistan</option>
		   			<option value="VU" <?php selected($value, 'VU'); ?>>Vanuatu</option>
		   			<option value="VA" <?php selected($value, 'VA'); ?>>Vatican City State (Holy See)</option>
		   			<option value="VE" <?php selected($value, 'VE'); ?>>Venezuela</option>
		   			<option value="VN" <?php selected($value, 'VN'); ?>>Vietnam</option>
		   			<option value="VG" <?php selected($value, 'VG'); ?>>Virgin Islands (British)</option>
		   			<option value="VI" <?php selected($value, 'VI'); ?>>Virgin Islands (US)</option>
		   			<option value="WF" <?php selected($value, 'WF'); ?>>Wallis And Futuna Islands</option>
		   			<option value="EH" <?php selected($value, 'EH'); ?>>Western Sahara</option>
		   			<option value="YE" <?php selected($value, 'YE'); ?>>Yemen</option>
		   			<option value="YU" <?php selected($value, 'YU'); ?>>Yugoslavia</option>
		   			<option value="ZM" <?php selected($value, 'ZM'); ?>>Zambia</option>
		   			<option value="ZW" <?php selected($value, 'ZW'); ?>>Zimbabwe</option>
        </select>
        <?php
    }
}
 
add_action('add_meta_boxes', ['WPOrg_Meta_Box', 'add']);
add_action('save_post', ['WPOrg_Meta_Box', 'save']);

function custom_post_type() {
 
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Movies', 'Post Type General Name', 'twentythirteen' ),
        'singular_name'       => _x( 'Movie', 'Post Type Singular Name', 'twentythirteen' ),
        'menu_name'           => __( 'Movies', 'twentythirteen' ),
        'parent_item_colon'   => __( 'Parent Movie', 'twentythirteen' ),
        'all_items'           => __( 'All Movies', 'twentythirteen' ),
        'view_item'           => __( 'View Movie', 'twentythirteen' ),
        'add_new_item'        => __( 'Add New Movie', 'twentythirteen' ),
        'add_new'             => __( 'Add New', 'twentythirteen' ),
        'edit_item'           => __( 'Edit Movie', 'twentythirteen' ),
        'update_item'         => __( 'Update Movie', 'twentythirteen' ),
        'search_items'        => __( 'Search Movie', 'twentythirteen' ),
        'not_found'           => __( 'Not Found', 'twentythirteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
    );
     
// Set other options for Custom Post Type
     
    $args = array(
        'label'               => __( 'movies', 'twentythirteen' ),
        'description'         => __( 'Movie news and reviews', 'twentythirteen' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
         
        // This is where we add taxonomies to our CPT
        'taxonomies'          => array( 'category' ),
    );
     
    // Registering your Custom Post Type
    register_post_type( 'movies', $args );
 
}
 
/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/
 
add_action( 'init', 'custom_post_type', 0 );

function people_init() {
    // create a new taxonomy
  register_taxonomy('jobs','jobs',array(
    'hierarchical' => false,
    'label' => 'Jobs Category',
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'jobs' ),
  ));
}
//add_action( 'init', 'people_init' );

add_action( 'init', 'create_jobs_taxo', 0 );
 
//create a custom taxonomy name it "type" for your posts
function create_jobs_taxo() {
 
  $labels = array(
    'name' => _x( 'Jobs Category', 'taxonomy general name' ),
    'singular_name' => _x( 'jobs', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Types' ),
    'all_items' => __( 'All Jobs' ),
    'parent_item' => __( 'Parent Jobs' ),
    'parent_item_colon' => __( 'Parent Jobs:' ),
    'edit_item' => __( 'Edit Jobs' ), 
    'update_item' => __( 'Update Jobs' ),
    'add_new_item' => __( 'Add New Jobs' ),
    'new_item_name' => __( 'New Jobs Category' ),
    'menu_name' => __( 'Jobs Category' ),
  );    
 
  register_taxonomy('jobs',array('jobs'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'jobs' ),
  ));
}