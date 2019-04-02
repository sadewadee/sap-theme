<?php
add_action('widgets_init', 'reedwan_homepage_9col_load_widgets');

function reedwan_homepage_9col_load_widgets()
{
	register_widget('Reedwan_homepage_9col_Widget');
}

class Reedwan_homepage_9col_Widget extends WP_Widget {
	
	function Reedwan_homepage_9col_Widget()
	{
		$widget_ops = array('classname' => 'reedwan_homepage_9col', 'description' => '22 Column magazine recent posts widget for magazine widget.');

		$control_ops = array('id_base' => 'reedwan_homepage_9col-widget');

		$this->WP_Widget('reedwan_homepage_9col-widget', '#INDEX Testimonial', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		
		$title = $instance['title'];
		$post_type = 'all';
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		$images = true;

		$title_4 = $instance['title_4'];
		$post_type_4 = 'all';
		$categories_4 = $instance['categories_4'];
		$posts_4 = $instance['posts_4'];
		$images_4 = true;
		
		echo $before_widget;
		?>
        
        
		
		<?php
		$post_types = get_post_types();
		unset($post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);
		
		if($post_type == 'all') {
			$post_type_array = $post_types;
		} else {
			$post_type_array = $post_type;
		}
		?>

   <div class="spacer-testi">
    <div class="container">
        <div class="row">
	
		<div class="widget-magazine half">
			<?php if($title) {	echo $before_title.$title.$after_title;	} ?>
			
			<?php
			$recent_posts = new WP_Query(array(
				'showposts' => $posts,
				'post_type' => $post_type_array,
				'cat' => $categories,
			));
			?>
            <div class="">
<div class="large-12 columns">
<div class="owl-carousel owl-one" >
			<?php 
			$counter = 1; 
			while($recent_posts->have_posts()): $recent_posts->the_post(); 
			if(has_post_format('video')) 
			{
				$format_icon = 'class="video-format-icon"';
			}
			else if (has_post_format('audio'))
			{
				$format_icon = 'class="audio-format-icon"';
			}
			else if (has_post_format('gallery'))
			{
				$format_icon = 'class="gallery-format-icon"';
			}
			else {
				$format_icon = 'class="standard-format-icon"';
			}
			?>
  
<div class="col-xs-12 col-sm-12 col-md-12 ">
        <div class="grid">
            <figure class="effect-romeo xx">
            <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('review-thumb'); ?> 
            <?php else : ?>
            <img src="<?php echo get_template_directory_uri(); ?>/images/no-blog-thumbnail.jpg" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="img-responsive" />
            <?php endif; ?>  
            </figure>
        </div>
    

    <div class="description">
        <h3 class="title red"> <a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h3>
        <p><?php echo string_limit_words(get_the_excerpt(), 18); ?></p>
         <a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' class="readmore"> read more</a> 
    </div>
</div>            
<?php $counter++; endwhile; ?>
</div>   
   
</div>      
</div>
	</div>
    
</div>
</div>
    
</div>
		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['post_type'] = 'all';
		$instance['categories'] = $new_instance['categories'];
		$instance['posts'] = $new_instance['posts'];
		$instance['show_images'] = true;
		
		$instance['title_4'] = $new_instance['title_4'];
		$instance['post_type_4'] = 'all';
		$instance['categories_4'] = $new_instance['categories_4'];
		$instance['posts_4'] = $new_instance['posts_4'];
		$instance['show_images_4'] = true;
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Recent Posts', 'post_type' => 'all', 'categories' => 'all', 'posts' => 4, 'title_4' => 'Recent Posts', 'post_type_4' => 'all', 'categories_4' => 'all', 'posts_4' => 4);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<h3>Column One</h3>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>">Filter by Category:</label> 
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>">Number of posts:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
		</p>
		
		
	<?php }
}
?>