<?php
add_action('widgets_init', 'reedwan_homepage_2col_load_widgets');

function reedwan_homepage_2col_load_widgets()
{
	register_widget('Reedwan_Homepage_2col_Widget');
}

class Reedwan_Homepage_2col_Widget extends WP_Widget {
	
	function Reedwan_Homepage_2col_Widget()
	{
		$widget_ops = array('classname' => 'reedwan_homepage_2col', 'description' => '2 Column magazine recent posts widget for magazine widget.');

		$control_ops = array('id_base' => 'reedwan_homepage_2col-widget');

		$this->WP_Widget('reedwan_homepage_2col-widget', ' Menu 2 Column', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		
		$title = $instance['title'];
		$post_type = 'all';
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		$images = true;

		$title_2 = $instance['title_2'];
		$post_type_2 = 'all';
		$categories_2 = $instance['categories_2'];
		$posts_2 = $instance['posts_2'];
		$images_2 = true;
		
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
		
		<div class="col-xs-12 col-sm-6 col-md-6 widget-magazine half">
			<div class="row"><?php
			if($title) {
				echo $before_title.$title.$after_title;
			}
			?>
			</div>
			<?php
			$recent_posts = new WP_Query(array(
				'showposts' => $posts,
				'post_type' => $post_type_array,
				'cat' => $categories,
			));
			?>
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
			<?php if($counter == 1): ?>
			<div class="block-small">
				
				<?php if(has_post_thumbnail()): ?>

				<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'small-post-thumb'); ?>
                	<div class="magz-image"><a <?php echo $format_icon; ?> href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img class="fadeover" src="<?php echo $image[0]; ?>"  width='150' height='110' /></a></div>
                    
				<?php else: ?>
				<div class="magz-image"><a <?php echo $format_icon; ?> href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img class="fadeover" src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo get_template_directory_uri(); ?>/images/thumbnail.png&w=150&h=110"  width='150' height='110' /></a></div>
				<?php endif; ?>
				<div class="description">
					<h4 class="des-title"> <a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h4>
                    <p><?php echo string_limit_words(get_the_excerpt(), 20); ?>...</p>
                    <a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' class="readmore"> read more</a>
				</div>
			</div>
			<?php else: ?>
            
			<div class="block-small">
				<?php if(has_post_thumbnail()): ?>
					<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'small-post-thumb'); ?>
					<div class="magz-image"><a <?php echo $format_icon; ?> href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img class="fadeover" src="<?php echo $image[0]; ?>"  width='150' height='110' /></a></div>
					<?php else: ?>
					<div class="magz-image"><a <?php echo $format_icon; ?> href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img class="fadeover" src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo get_template_directory_uri(); ?>/images/thumbnail.png&w=150&h=110"  width='150' height='110' /></a></div>
				<?php endif; ?>
				<div class="description">
					<h4 class="des-title" ><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h4>
                    <p><?php echo string_limit_words(get_the_excerpt(), 20); ?>...</p>  
                           <a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' class="readmore"> read more</a> 
				</div>
			</div>
            
			<?php endif; ?>
			<?php $counter++; endwhile; ?>
            
		</div>
		
		<?php
		$post_types = get_post_types();
		unset($post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);
		
		if($post_type_2 == 'all') {
			$post_type_2_array = $post_types;
		} else {
			$post_type_2_array = $post_type;
		}
		?>
		
		<div class="col-xs-12 col-sm-6 col-md-6  widget-magazine half">
			<div class="row"><?php
			if($title) {
				echo $before_title.$title_2.$after_title;
			}
			?></div>

			<?php
			$recent_posts = new WP_Query(array(
				'showposts' => $posts_2,
				'post_type' => $post_type_2_array,
				'cat' => $categories_2,
			));
			?>			
			<?php $counter = 1; while($recent_posts->have_posts()): $recent_posts->the_post(); ?>
			<?php
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
			<?php if($counter == 1): ?>
				<div class="block-small">
				<?php if(has_post_thumbnail()): ?>
				<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'small-post-thumb'); ?>
                	<div class="magz-image"><a <?php echo $format_icon; ?> href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img class="fadeover" src="<?php echo $image[0]; ?>"  width='150' height='110' /></a></div>
				<?php else: ?>
				<div class="magz-image"><a <?php echo $format_icon; ?> href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img class="fadeover" src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo get_template_directory_uri(); ?>/images/thumbnail.png&w=150&h=110" alt="<?php the_title(); ?>"  width='150' height='110' /></a></div>
				<?php endif; ?>
				<div class="description">
					<h4 class="des-title"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h4>
					
                    <p><?php echo string_limit_words(get_the_excerpt(), 20); ?>...</p>
                            <!--a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' class="readmore"> read more</a-->
				</div>
			</div>
			<?php else: ?>
			<div class="block-small">
				<?php if(has_post_thumbnail()): ?>
					<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'small-post-thumb'); ?>
					<div class="magz-image"><a <?php echo $format_icon; ?> href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img class="fadeover" src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" width='150' height='110' /></a></div>
					<?php else: ?>
					<div class="magz-image"><a <?php echo $format_icon; ?> href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><img class="fadeover" src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo get_template_directory_uri(); ?>/images/thumbnail.png&w=150&h=110" alt="<?php the_title(); ?>"  width='150' height='110' /></a></div>
				<?php endif; ?>
				<div class="description">
					<h4 class="des-title"><a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?></a></h4>
                    <p><?php echo string_limit_words(get_the_excerpt(), 20); ?>...</p>
                            <!--a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>' class="readmore"> read more</a-->
				</div>
			</div>
			<?php endif; ?>
			<?php $counter++; endwhile; ?>
			
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
		
		$instance['title_2'] = $new_instance['title_2'];
		$instance['post_type_2'] = 'all';
		$instance['categories_2'] = $new_instance['categories_2'];
		$instance['posts_2'] = $new_instance['posts_2'];
		$instance['show_images_2'] = true;
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Recent Posts', 'post_type' => 'all', 'categories' => 'all', 'posts' => 4, 'title_2' => 'Recent Posts', 'post_type_2' => 'all', 'categories_2' => 'all', 'posts_2' => 4);
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
		
		<h3 style='margin-top: 40px;'>Column Two</h3>
		
		<p>
			<label for="<?php echo $this->get_field_id('title_2'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title_2'); ?>" name="<?php echo $this->get_field_name('title_2'); ?>" value="<?php echo $instance['title_2']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('categories_2'); ?>">Filter by Category:</label> 
			<select id="<?php echo $this->get_field_id('categories_2'); ?>" name="<?php echo $this->get_field_name('categories_2'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories_2']) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories_2']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('posts_2'); ?>">Number of posts:</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts_2'); ?>" name="<?php echo $this->get_field_name('posts_2'); ?>" value="<?php echo $instance['posts_2']; ?>" />
		</p>
	<?php }
}
?>