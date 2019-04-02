<?php

	class Flickr_Widget_Reedwan extends WP_Widget {
	function Flickr_Widget_Reedwan() {
		$widget_ops = array('classname' => 'flickr_stream', 'description' => 'Flickr Widget' );
		$this->WP_Widget('flickr_stream', '* Flickr Widget ', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
        $user = empty($instance['user']) ? ' ' : apply_filters('widget_user', $instance['user']);
        $counter = empty($instance['counter']) ? ' ' : apply_filters('widget_counter', $instance['counter']);
		echo $before_title;
        echo $title;
		echo $after_title;
        echo '
		<div class="flickr_stream">
		<script src="http://www.flickr.com/badge_code_v2.gne?show_name=1&amp;count='.$counter.'&amp;display=latest&amp;size=s&amp;layout=v&amp;source=user&amp;user='.$user.'" type="text/javascript">
		</script>
		</div>'
		;
        echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
        $instance['user'] = strip_tags($new_instance['user']);
        $instance['counter'] = strip_tags($new_instance['counter']);
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'user' => '', 'counter' => '' ) );
		$title = strip_tags($instance['title']);
        $user = strip_tags($instance['user']);
        $counter = strip_tags($instance['counter']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('user'); ?>">Flickr User ID: <input class="widefat" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" type="text" value="<?php echo $instance['user']; ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('counter'); ?>">Counter: 3, 6 or 9 <input class="widefat" id="<?php echo $this->get_field_id('counter'); ?>" name="<?php echo $this->get_field_name('counter'); ?>" type="text" value="<?php echo $instance['counter']; ?>" /></label></p>
<?php
	}
}
register_widget('Flickr_Widget_Reedwan');






