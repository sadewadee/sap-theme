<?php
add_action('widgets_init','Reedwan_socialnetworks');
function Reedwan_socialnetworks(){
register_widget("Reedwan_socialnetworks");}


class Reedwan_socialnetworks extends WP_widget{
	
	function Reedwan_socialnetworks(){
		$options = array(
				"classname" => "socialnetworks",
				"description" => "Social networks links for sidebar and footer widget"
		);
		$this->WP_widget("socialnetworks","* Social networks",$options);
	}
	
	function widget($args,$d){
		extract($args);
		echo $before_widget;
		echo $before_title;
		echo $d['title'];
		echo $after_title;
		

		
		
		echo '<ul class="list-inline social-small">';
				if($d['title_mail']) {
        echo '<li ><a href="mailto:'.$d['ID_mail'].'"><i class="fa fa-envelope"></i></a> </li>';
        }
     
		if($d['title_snapchat']) {
        echo '<li ><a href="http://www.snapchat.com/'.$d['ID_snapchat'].'"><i class="fa fa-snapchat-ghost"></i></a></li>';
        }
		
		if($d['title_soundcloud']) {
		   echo '<li ><a href="http://www.soundcloud.com/'.$d['ID_soundcloud'].'"><i class="fa fa-soundcloud"></i></a></li>';
        }
		
		if($d['title_linkedin']) {
        echo '<li ><a href="http://www.linkedin.com/'.$d['ID_linkedin'].'"><i class="fa fa-linkedin"></i></a></li>';
        }
		if($d['title_youtube']) {
        echo '<li><a href="http://www.youtube.com/'.$d['ID_youtube'].'"><i class="fa fa-youtube-play"></i></a></li>';
        }
		if($d['title_instagram']) {
        echo '<li><a href="http://www.instagram.com/'.$d['ID_instagram'].'"><i class="fa fa-instagram"></i></a></li>';
        }
		if($d['title_twitter']) {
        echo '<li><a href="http://www.twitter.com/'.$d['ID_twitter'].'"><i class="fa fa-twitter"></i></a></li>';
        }

		if($d['title_facebook']) {
        echo '<li ><a href="http://www.facebook.com/'.$d['ID_facebook'].'"><i class="fa fa-facebook"></i></a></li>';
        }
	
		if($d['title_googleplus']) {
        echo '<li ><a href="https://plus.google.com/'.$d['ID_googleplus'].'"><i class="fa fa-google-plus"></i></a></li>';
        }

		if($d['title_rss']) {
        echo '<li ><a href="http://www.rss.com/'.$d['ID_rss'].'"><i class="fa fa-rss"></i></a></li>';
        }

		
        echo '</ul>';
		echo $after_widget;
	}
	
	function update($new,$old){
		return $new;
	}
	
	function form($d){
		?>
<p>
<label for="<?php echo $this->get_field_id('title'); ?>">Title :</label>
<input name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title') ; ?>" type="text" value="<?php echo $d['title']; ?>" />
</p>

        
        
<p>
<label for="<?php echo $this->get_field_id('title_googleplus'); ?>">G+ text :</label>
<input name="<?php echo $this->get_field_name('title_googleplus'); ?>" id="<?php echo $this->get_field_id('title_googleplus') ; ?>" type="text" value="<?php echo $d['title_googleplus']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('ID_googleplus'); ?>">G+ ID :</label>
<input name="<?php echo $this->get_field_name('ID_googleplus'); ?>" id="<?php echo $this->get_field_id('ID_googleplus') ; ?>" type="text" value="<?php echo $d['ID_googleplus']; ?>" />
</p>
       

<p>
<label for="<?php echo $this->get_field_id('title_facebook'); ?>">Facebook text :</label>
<input name="<?php echo $this->get_field_name('title_facebook'); ?>" id="<?php echo $this->get_field_id('title_facebook') ; ?>" type="text" value="<?php echo $d['title_facebook']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('ID_facebook'); ?>">Facebook ID :</label>
<input name="<?php echo $this->get_field_name('ID_facebook'); ?>" id="<?php echo $this->get_field_id('ID_facebook') ; ?>" type="text" value="<?php echo $d['ID_facebook']; ?>" />
</p>
       
<p>
<label for="<?php echo $this->get_field_id('title_twitter'); ?>">Twitter text :</label>
<input name="<?php echo $this->get_field_name('title_twitter'); ?>" id="<?php echo $this->get_field_id('title_twitter') ; ?>" type="text" value="<?php echo $d['title_twitter']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('ID_twitter'); ?>">Twitter ID :</label>
<input name="<?php echo $this->get_field_name('ID_twitter'); ?>" id="<?php echo $this->get_field_id('ID_twitter') ; ?>" type="text" value="<?php echo $d['ID_twitter']; ?>" />
</p>
        
<p>
<label for="<?php echo $this->get_field_id('title_instagram'); ?>">instagram text :</label>
<input name="<?php echo $this->get_field_name('title_instagram'); ?>" id="<?php echo $this->get_field_id('title_instagram') ; ?>" type="text" value="<?php echo $d['title_instagram']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('ID_instagram'); ?>">instagram ID :</label>
<input name="<?php echo $this->get_field_name('ID_instagram'); ?>" id="<?php echo $this->get_field_id('ID_instagram') ; ?>" type="text" value="<?php echo $d['ID_instagram']; ?>" />
</p>       
      
<p>
<label for="<?php echo $this->get_field_id('title_youtube'); ?>">Youtube text :</label>
<input name="<?php echo $this->get_field_name('title_youtube'); ?>" id="<?php echo $this->get_field_id('title_youtube') ; ?>" type="text" value="<?php echo $d['title_youtube']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('ID_youtube'); ?>">Youtube ID :</label>
<input name="<?php echo $this->get_field_name('ID_youtube'); ?>" id="<?php echo $this->get_field_id('ID_youtube') ; ?>" type="text" value="<?php echo $d['ID_youtube']; ?>" />
</p>
        
<p>
<label for="<?php echo $this->get_field_id('title_linkedin'); ?>">linkedin text :</label>
<input name="<?php echo $this->get_field_name('title_linkedin'); ?>" id="<?php echo $this->get_field_id('title_linkedin') ; ?>" type="text" value="<?php echo $d['title_linkedin']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('ID_linkedin'); ?>">linkedin ID :</label>
<input name="<?php echo $this->get_field_name('ID_linkedin'); ?>" id="<?php echo $this->get_field_id('ID_linkedin') ; ?>" type="text" value="<?php echo $d['ID_linkedin']; ?>" />
</p> 

<p>
<label for="<?php echo $this->get_field_id('title_soundcloud'); ?>">Soundcloud text :</label>
<input name="<?php echo $this->get_field_name('title_soundcloud'); ?>" id="<?php echo $this->get_field_id('title_soundcloud') ; ?>" type="text" value="<?php echo $d['title_soundcloud']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('ID_soundcloud'); ?>">Soundcloud  ID :</label>
<input name="<?php echo $this->get_field_name('ID_soundcloud'); ?>" id="<?php echo $this->get_field_id('ID_soundcloud') ; ?>" type="text" value="<?php echo $d['ID_soundcloud']; ?>" />
</p> 

<p>
<label for="<?php echo $this->get_field_id('title_snapchat'); ?>">Snapchat text :</label>
<input name="<?php echo $this->get_field_name('title_snapchat'); ?>" id="<?php echo $this->get_field_id('title_snapchat') ; ?>" type="text" value="<?php echo $d['title_snapchat']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('ID_snapchat'); ?>">Snapchat ID :</label>
<input name="<?php echo $this->get_field_name('ID_snapchat'); ?>" id="<?php echo $this->get_field_id('ID_snapchat') ; ?>" type="text" value="<?php echo $d['ID_snapchat']; ?>" />
</p> 

<p>
<label for="<?php echo $this->get_field_id('title_mail'); ?>">Mail text :</label>
<input name="<?php echo $this->get_field_name('title_mail'); ?>" id="<?php echo $this->get_field_id('title_mail') ; ?>" type="text" value="<?php echo $d['title_mail']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('ID_mail'); ?>">Mail ID :</label>
<input name="<?php echo $this->get_field_name('ID_mail'); ?>" id="<?php echo $this->get_field_id('ID_mail') ; ?>" type="text" value="<?php echo $d['ID_mail']; ?>" />
</p> 
        
<p>
<label for="<?php echo $this->get_field_id('title_rss'); ?>">rss text :</label>
<input name="<?php echo $this->get_field_name('title_rss'); ?>" id="<?php echo $this->get_field_id('title_rss') ; ?>" type="text" value="<?php echo $d['title_rss']; ?>" />
</p>
<p>
<label for="<?php echo $this->get_field_id('ID_rss'); ?>">rss ID :</label>
<input name="<?php echo $this->get_field_name('ID_rss'); ?>" id="<?php echo $this->get_field_id('ID_rss') ; ?>" type="text" value="<?php echo $d['ID_rss']; ?>" />
</p>



        
        
    
        <?php
	}
}
?>