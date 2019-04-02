<?php

class reedwanThemePanelOptions 
{
	
	public function __construct()
	{
		include_once('panel-ui.php');
	}
	public function textarea($id, $label, $desc)
	{ ?>
		<div class='field upload'>
			<label for='reedwan_<?php echo $id; ?>'><?php echo $label; ?></label>
			<div class='input'>
				<textarea name='reedwan_<?php echo $id; ?>' id='reedwan_<?php echo $id; ?>'><?php echo get_option('reedwan_' . $id); ?></textarea>
				<?php if($desc): ?>
				<div class='desc'><?php echo $desc; ?></div>
				<?php endif; ?>
			</div>
			
		</div>
	<?php }
	public function text($id, $label, $desc)
	{ ?>
		<div class='field text'>
			<label for='reedwan_<?php echo $id; ?>'><?php echo $label; ?></label>
			<div class='input'>
				<input name='reedwan_<?php echo $id; ?>' type='text' id='reedwan_<?php echo $id; ?>' value='<?php echo get_option('reedwan_' . $id); ?>' />
				<?php if($desc): ?>
				<div class='desc'><?php echo $desc; ?></div>
					<?php endif; ?>
			</div>
			
		</div>
	<?php }
	public function upload($id, $label, $desc)
	{ ?>
	<div class='field upload'>
			<label for='reedwan_<?php echo $id; ?>_label'><?php echo $label; ?></label>
			<div class='input'>
				<input class='reedwan_upload' name='reedwan_<?php echo $id; ?>' id='reedwan_<?php echo $id; ?>_label' type='text' value='<?php echo get_option('reedwan_' . $id); ?>' />
				<?php if($desc): ?>
			<p class='desc'><?php echo $desc; ?></p>
			<?php endif; ?>
			
				
			</div><div id='reedwan_<?php echo $id; ?>' class='button_upload'>Upload</div>
			
			
		</div>
		
		
	<?php }
	public function select($id, $options = array(), $label = '', $desc = '')
	{ ?>
		<div class='field select'>
			<label for='reedwan_<?php echo $id; ?>'><?php echo $label; ?></label>
			<div class='input'>
				<select name='reedwan_<?php echo $id; ?>' id='reedwan_<?php echo $id; ?>'>
					<?php foreach($options as $key => $value): ?>
					<?php
					if(get_option('reedwan_' . $id) == $key) {
						$selected = 'selected="selected"';
					} else {
						$selected = '';
					}
					?>
					<option <?php echo $selected; ?> value='<?php echo $key; ?>'><?php echo $value; ?></option>
					<?php endforeach; ?>
				</select>
				<?php if($desc): ?>
			<div class='desc'><?php echo $desc; ?></div>
			<?php endif; ?>
			</div>
		</div>
	<?php }
	
	public function checkbox($id, $label)
	{ ?>
		<?php
		if(get_option('reedwan_' . $id) == 'On') {
			$checked = 'checked="checked"';
		}
		?>
		<div class='field checkbox'>
			<div class='input'>
				<input name='reedwan_<?php echo $id; ?>' type='hidden' value='Off' />
				<input <?php echo $checked; ?> name='reedwan_<?php echo $id; ?>' type='checkbox' id='reedwan_<?php echo $id; ?>' value='On' />
				<label for='reedwan_<?php echo $id; ?>'><strong><?php echo $label; ?></strong></label>
			</div>
		</div>
	<?php }
	public function checkboxes($ids = array(), $title = '') { ?>
		<div class='field checkbox'>
			<p style='margin-top: 0;'><strong><?php echo $title; ?></strong></p>
			<?php foreach($ids as $id => $label): ?>
				<?php
				if(get_option('reedwan_' . $id) == 'On') {
					$checked = 'checked="checked"';
				} else {
					$checked = '';
				}
				?>
				<div class='input'>
					<input name='reedwan_<?php echo $id; ?>' type='hidden' value='Off' />
					<input <?php echo $checked; ?> name='reedwan_<?php echo $id; ?>' type='checkbox' id='reedwan_<?php echo $id; ?>' value='On' />
					<label for='reedwan_<?php echo $id; ?>'><?php echo $label; ?></label>
				</div>
			<?php endforeach; ?>
		</div>
	<?php }
	public function pattern($id, $images = array(), $label, $desc = '') { ?>
		<div class='field images'>
			<label><?php echo $label; ?></label>
			<div class='input'>
				<?php foreach($images as $name => $image): ?>
				<?php
				if(get_option('reedwan_' . $id) == $name) {
					$selected = 'selected';
				} else {
					$selected = '';
				}
				?>
				<img src='<?php echo $image ?>' class='<?php echo $selected; ?>' id='<?php echo $name; ?>' alt='<?php echo ucwords(str_replace('_', ' ', $id)); ?>' title='<?php echo ucwords(str_replace('_', ' ', $id)); ?>' width='60px' height='60px' />
				<?php endforeach; ?>
				<input type='hidden' name='reedwan_<?php echo $id; ?>' value='<?php echo get_option('reedwan_' . $id); ?>' />
			</div>
			<?php if($desc): ?>
			<div class='desc'><?php echo $desc; ?></div>
			<?php endif; ?>
		</div>
	<?php }
	
	
	
	
	public function colorpicker($id, $label, $desc = '') 
	{ ?>
		<script type='text/javascript'>
		jQuery(document).ready(function() {
			// Colorpicker
			jQuery('#colorpicker_<?php echo $id; ?> .colorSelector').ColorPicker({
				color: '#<?php echo get_option('reedwan_' . $id); ?>',
				onShow: function (colpkr) {
					jQuery(colpkr).fadeIn(500);
					return false;
				},
				onHide: function (colpkr) {
					jQuery(colpkr).fadeOut(500);
					return false;
				},
				onChange: function (hsb, hex, rgb) {
					jQuery('#colorpicker_<?php echo $id; ?> .colorSelector div').css('backgroundColor', '#' + hex);
					jQuery('#colorpicker_<?php echo $id; ?> input').val(hex);
				}
			});
		});
		</script>
		<div class='field colorpicker_wrapper' id='colorpicker_<?php echo $id; ?>'>
			<label name='reedwan_<?php echo $id; ?>'><?php echo $label; ?></label>
			<div class='input'>
				<input type='text' value='<?php echo get_option('reedwan_' . $id); ?>' name='reedwan_<?php echo $id; ?>' id='reedwan_<?php echo $id; ?>' />
				<?php if($desc): ?>
			<div class='desc'><?php echo $desc; ?></div>
			<?php endif; ?>
			</div>
			<div class="colorSelector"><div style='background-color: #<?php echo get_option('reedwan_' . $id); ?>;'></div></div>
			
		</div>
	<?php 
	}
	
}?>