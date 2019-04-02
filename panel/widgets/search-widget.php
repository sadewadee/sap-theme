<?php
add_action('widgets_init','reedwan_search_load_widgets');


function reedwan_search_load_widgets(){
		register_widget("Reedwan_Search_Widget");
}


class Reedwan_Search_Widget extends WP_widget{
	
	function Reedwan_Search_Widget(){
		$widget_ops = array('classname' => 'reedwan_search_widget', 'description' => 'Search form for sidebar');

		$control_ops = array('id_base' => 'reedwan_search_widget');

		$this->WP_Widget('reedwan_search_widget', '* Search', $widget_ops, $control_ops);
		
	}
	
	function widget($args,$instance){
		extract($args);
		
		?>
       <div class="row"> 
		<div class="search-sidebar">
		<form method="get" id="search" action="<?php echo home_url(); ?>/">
			<div><input type="text" name="s" id="s" value="<?php _e('Search The Site ...','Backstreet'); ?>" onfocus='if (this.value == "<?php _e('Search The Site ...', 'Backstreet'); ?>") { this.value = ""; }' onblur='if (this.value == "") { this.value = "<?php _e('Search The Site ...', 'Backstreet'); ?>"; }' /></div>
			<div><button type="submit" id="searchbutton">Search</button></div>
		</form>
		</div>
        </div> 
		<?php
		
	}
	
	function update($new_instance, $old_instance){
		
	}
	
	function form($instance){
		
	}
}
?>