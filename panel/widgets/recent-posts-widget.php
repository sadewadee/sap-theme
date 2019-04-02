<?php
add_action('widgets_init', 'reedwan_posts_load_widgets');

function reedwan_posts_load_widgets()
{
	register_widget('Reedwan_Posts_Widget');
}

class Reedwan_Posts_Widget extends WP_Widget {
	
	function Reedwan_Posts_Widget()
	{
		$widget_ops = array('classname' => 'reedwan_posts_widget', 'description' => 'Recent Posts');

		$control_ops = array('id_base' => 'reedwan_posts_widget');

		$this->WP_Widget('reedwan_posts_widget', '* Recent Posts', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		
		$title = $instance['title'];
		$post_type = 'all';
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		$images = true;
		
		echo $before_widget;
		?>
		<!-- BEGIN WIDGET -->
		<?php
		if($title) {
			echo $before_title.$title.$after_title;
		}
		?>
		
		<?php
		$post_types = get_post_types();
		unset($post_types['page'], $post_types['reviews'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);
		
		if($post_type == 'all') {
			$post_type_array = $post_types;
		} else {
			$post_type_array = $post_type;
		}
		?>
		<div class="tab_content">
		<?php $recent_posts = new WP_Query(array('showposts' => $posts,'post_type' => $post_type_array,'cat' => $categories,)); ?>
					
		<?php while($recent_posts->have_posts()): $recent_posts->the_post(); ?>
		<?php
			if(has_post_format('video') || has_post_format('audio') || has_post_format('gallery')) 
			{
				$format_icon = 'class="' . get_post_format() . '-format-icon"';
				}
				else {
				$format_icon = 'class="standard-format-icon"';
				}
		?>
		<div class="block-tabs">
			<?php if($images && has_post_thumbnail()): ?>
			<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'small-post-thumb'); ?>
			<div class="tabs-image"><a <?php echo $format_icon; ?> href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img class="fadeover" src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>"  width='75' height='60' /></a></div>
			<?php else: ?>
			<div class="tabs-image"><a <?php echo $format_icon; ?> href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img class="fadeover" src="<?php echo get_template_directory_uri(); ?>/images/thumbnail-sar.jpg" alt="<?php the_title(); ?>"  width='75' height='60' /></a></div>
			<?php endif; ?>
			<div class="description">
				<h3><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h3>
				<div class="tabs-meta">
				<?php the_time(get_option('date_format')); ?>
				</div>
			</div>
		</div>
		<?php endwhile; ?>
		</div>
		<!-- END WIDGET -->
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
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Recent Posts', 'post_type' => 'all', 'categories' => 'all', 'posts' => 3);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
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
		
	<?php 
	}
}
?>