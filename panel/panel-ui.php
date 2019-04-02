<script type='text/javascript'>
jQuery(document).ready(function() {
	//AJAX Upload
	jQuery('.button_upload').each(function(){
		
		var clickedObject = jQuery(this);
		var clickedID = jQuery(this).attr('id');
		
		new AjaxUpload(clickedID, {
			  action: '<?php echo admin_url("admin-ajax.php"); ?>',
			  name: clickedID, // File upload name
			  data: { // Additional data to send
					action: 'reedwan_upload',
					type: 'upload',
					data: clickedID },
			  autoSubmit: true, // Submit file after selection
			  responseType: false,
			  onChange: function(file, extension){},
			  onSubmit: function(file, extension){
				  this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
			  },
			  onComplete: function(file, response) {
				  this.enable();

				  jQuery('[name="'+clickedID+'"]').val(response);

				  jQuery('.save_tip').fadeIn(400).delay(5000).fadeOut(400);
			  }
		});
	
	});

	// Save Changes
	jQuery('.save_changes').click(function(e) {
		e.preventDefault();

		var form = jQuery(this).parents('form');
		
		jQuery.ajax({
			url: '<?php echo admin_url("admin-ajax.php"); ?>',
			data: jQuery(form).serialize()+'&action=reedwan_save_fields',
			type: 'POST',
			success: function() {
				jQuery('.save_tip').fadeIn(400).delay(5000).fadeOut(400);
			}
		});
	});

	// Reset Changes
	jQuery('.reset_btn').click(function(e) {
		e.preventDefault();

		var form = jQuery(this).parents('form');
		
		jQuery.ajax({
			url: '<?php echo admin_url("admin-ajax.php"); ?>',
			data: 'action=reedwan_reset_fields',
			type: 'POST',
			success: function() {
				jQuery('.reset_tip').fadeIn(400).delay(5000).fadeOut(400);
				setTimeout('location.reload(true);', 1200)
			}
		});
	});



	// Main tabs
	jQuery('.main_tabs a').click(function(e) {
		e.preventDefault();

		var href = jQuery(this).attr('href')
		var parent = jQuery(href).parent();
		var name = href.replace('#', '');
		
		jQuery(this).parents('ul').find('li').removeClass('selected');
		jQuery(this).parent().addClass('selected');
		jQuery(parent).find('> div.tabs').fadeOut();
		jQuery(href).fadeIn();
	});

	
	// Images
	jQuery('.images img').live('click', function(e) {
		e.preventDefault();

		var id = jQuery(this).attr('id');

		jQuery(this).parent().find('img').removeClass('selected');
		jQuery(this).addClass('selected');
		
		jQuery(this).parent().find('input').val(id);
	});
	
	jQuery('.images img.selected').live('click', function(e) {
		e.preventDefault();

		jQuery(this).removeClass('selected');
		jQuery(this).parent().find('input').val('');
	});
});
</script>
<div class='reedwan'>
	<!-- Begin Main Tabs -->
	<ul class='main_tabs'>
		<div class="header"><img src='<?php echo get_template_directory_uri(); ?>/images/df-logo.png' width="200" alt='' /></div>
		<li class='selected'><a class='general' href='#generalTab'>Option SAR</a></li>
	</ul>
	<!-- End Main Tabs -->
	
	
	<!-- Begin Container -->
	<div class='reedwan_container' >
	<div style='clear: both;'></div>
	<form action='' enctype='multipart/form-data'>
	
	<div id='generalTab' class='tabs'>	
		<?php $this->upload('favicon', 'Favicon', 'Upload your Favicon'); ?>
		<?php $this->upload('logo', 'Logo', 'Upload your logo (ideal size : 300x60 px)'); ?>
         <?php $this->textarea('header_phone', ' Header Email & Phone', ''); ?>
	</div>
	<div id='topAddsTab' style='display: none;' class='tabs'>
		<?php $this->checkbox('adds_toggle', 'Active Top Adds Toggle'); ?>
		<?php $this->text('adds_title', 'Top Adds Title', ''); ?>
		<?php $this->text('adds_url', 'Top Adds URL', ''); ?>
		<?php $this->upload('adds_image', 'Top Adds Image', 'Upload adds Image, recomended width:1000px'); ?>
		<?php $this->textarea('adds_text', 'Top Adds Custom Code', ''); ?>
	</div>
	
	<div id='headerTab' style='display: none;' class='tabs'>
		<?php $this->checkbox('show_top_container', 'Show top content (top menu)'); ?>
		<?php $this->checkbox('show_date_time', 'Show date and time on top content'); ?>
		<?php $this->checkbox('show_social_header', 'Show social network on header'); ?>
		<?php $this->checkbox('show_search_header', 'Show search form on header'); ?>
		<?php $this->text('header_height', 'Header Height', '(Height) in pixel. Note: Recomended height is 70px '); ?>
		<?php $this->upload('logo', 'Logo', 'Upload your logo'); ?>
		
	</div>
	

	<div style='clear: both;'></div>
	<!-- Begin Button Save and Reset -->
	<div class='reset_save'>
		<div class='reset_button'>
			<input onclick='return confirm("Click OK to reset. Any settings will be lost!");' type='submit' name='reset' value='RESET' class='reset_btn' />
			<img class='reset_tip' style='display: none;' src='<?php echo get_template_directory_uri(); ?>/panel/images/reset_tip.png' alt='' />
		</div>
		<div class='save_button'>
			<img class='save_tip' style='display: none;' src='<?php echo get_template_directory_uri(); ?>/panel/images/save_tip.png' alt='' />
			<input type='submit' name='save_changes' value='SAVE' class='save_changes' />	
		</div>
		<div style='clear: both;'></div>
	</div>
	<!-- End Button Save and Reset -->
	</form>
	
	</div>
	<!-- End Container -->

</div>