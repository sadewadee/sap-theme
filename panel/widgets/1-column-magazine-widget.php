<?php
add_action('widgets_init', 'Reedwan_Magazine_load_widgets');

function Reedwan_Magazine_load_widgets()
{
	register_widget('Reedwan_Magazine_Widget');
}

class Reedwan_Magazine_Widget extends WP_Widget {
	
	function Reedwan_Magazine_Widget()
	{
		$widget_ops = array('classname' => 'reedwan_magazine', 'description' => '1 Column magazine recent posts widget for magazine widget.');

		$control_ops = array('id_base' => 'reedwan_magazine-widget');

		$this->WP_Widget('reedwan_magazine-widget', '#INDEX News', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		
		$title = $instance['title'];
		$post_type = 'all';
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		$show_image = isset($instance['show_image']) ? 'true' : 'false';
		echo $before_widget;
		?>
		
		<?php
		$post_types = get_post_types();
		unset($post_types['page'],$post_types['reviews'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);
		
		if($post_type == 'all') {
			$post_type_array = $post_types;
		} else {
			$post_type_array = $post_type;
		}
		?>
		
		<div class="clearfix" style="position:relative">
			<?php
			$recent_posts = new WP_Query(array(
				'showposts' => $posts,
				'post_type' => $post_type_array,
				'cat' => $categories,
			));
			?>
			<?php
			$big_count = round($posts / 5);
			if(!$big_count) { $big_count = 1; }
			?>
			<?php
			$counter = 1; 
			while($recent_posts->have_posts()): $recent_posts->the_post(); 
			if(has_post_format('video')) 
			{
				$format_icon = 'class="video-format-icon"';
				$format_icon_small = ' (Video)';
			}
			else if (has_post_format('audio'))
			{
				$format_icon = 'class="audio-format-icon"';
				$format_icon_small = ' (Audio)';
			}
			else if (has_post_format('gallery'))
			{
				$format_icon = 'class="gallery-format-icon"';
				$format_icon_small = ' (Gallery)';
			}
			else {
				$format_icon = 'class="standard-format-icon"';
				$format_icon_small = '';
			}
			?>
			<?php if($counter <= $big_count): ?>
			<?php if($counter == $big_count) { $last = 'block-big-last'; } else { $last = ''; }?>
			
            <div class="blog-title"><h2><?php echo get_cat_name(23);?></h2></div>
			<div class="col-xs-12 col-sm-6 col-md-6 ">
               <div class="row">
                 <div class="item">
                <div class="grid">
				<figure class="effect-ruby">
				<?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('post-thumbnails'); ?>
                <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/images/no-blog-thumbnail.jpg" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="img-responsive" />
                <?php endif; ?>  
                <figcaption>
                  <div class="box1">
                  <a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'> 
                  <h3><?php the_title(); ?></h3>
                 </a>
                   <span class="date"><i class="fa fa-clock-o"></i>  &nbsp;<?php the_time('l, F jS, Y') ?></span>
                  </div>   

    <a href="<?php the_permalink(); ?>" >Selengkapnya</a>
                </figcaption>			
            </figure>
            </div> </div>
               </div>
				</div>
			<?php else: ?>
			<?php if($show_image == 'true'): ?>
			<div class="block-small col-xs-12 col-sm-6 col-md-3<?php if($counter%2 != 0) { echo " right"; } else { echo " left"; }?>">
            <div class="row">
              <div class="grid">
				<figure class="effect-ruby">
				<?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('post-thumbnails'); ?>
                <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/images/no-blog-thumbnail.jpg" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" class="img-responsive" />
                <?php endif; ?>  
                <figcaption>
                  <div class="box1">
                  <a href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'> 
                  <h3><?php the_title(); ?></h3>  
                  </a>
                   <span class="date"><i class="fa fa-clock-o"></i>  &nbsp;<?php the_time('l, F jS, Y') ?> </span>
                  </div>   

    <a href="<?php the_permalink(); ?>" >Selengkapnya</a>
                </figcaption>			
            </figure>
            </div>
			</div>
            	</div>
			<?php endif; ?>
			<?php if($show_image == 'false'): ?>
			<div class="block-small-noimage<?php if($counter%2 != 0) { echo " right"; } else { echo " left"; }?>">
				<h3><a class="des-title" href='<?php the_permalink(); ?>' title='<?php the_title(); ?>'><?php the_title(); ?><?php echo $format_icon_small; ?></a></h3>
			</div>
			<?php endif; ?>
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
		$instance['show_image'] = $new_instance['show_image'];
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Recent Posts', 'post_type' => 'all', 'categories' => 'all', 'posts' => 5, 'show_image'=>null );
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>">Filter by Category</label> 
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>">Number of posts</label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
			
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_image'], 'on'); ?> id="<?php echo $this->get_field_id('show_image'); ?>" name="<?php echo $this->get_field_name('show_image'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_image'); ?>">Show thumbnail image</label>
		</p>
		
	<?php }
}
?>