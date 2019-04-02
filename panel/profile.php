<?php
add_action('show_user_profile', 'wpsplash_extraProfileFields');
add_action('edit_user_profile', 'wpsplash_extraProfileFields');
add_action('personal_options_update', 'wpsplash_saveExtraProfileFields');
add_action('edit_user_profile_update', 'wpsplash_saveExtraProfileFields');

function wpsplash_saveExtraProfileFields($userID) {

	if (!current_user_can('edit_user', $userID)) {
		return false;
	}

	update_user_meta($userID, 'twitter', $_POST['twitter']);
	update_user_meta($userID, 'facebook', $_POST['facebook']);
	update_user_meta($userID, 'google_plus', $_POST['google_plus']);
	update_user_meta($userID, 'flickr', $_POST['flickr']);
}

function wpsplash_extraProfileFields($user)
{
?>
	<h3>Social Information</h3>

	<table class='form-table'>
		<tr>
			<th><label for='twitter'>Twitter</label></th>
			<td>
				<input type='text' name='twitter' id='twitter' value='<?php echo esc_attr(get_the_author_meta('twitter', $user->ID)); ?>' class='regular-text' />
				<br />
				<span class='description'>Please enter your Twitter username. http://www.twitter.com/<strong>username</strong></span>
			</td>
		</tr>
		<tr>
			<th><label for='facebook'>Facebook</label></th>
			<td>
				<input type='text' name='facebook' id='facebook' value='<?php echo esc_attr(get_the_author_meta('facebook', $user->ID)); ?>' class='regular-text' />
				<br />
				<span class='description'>Please enter your Facebook username/alias. http://www.facebook.com/<strong>username</strong></span>
			</td>
		</tr>
		<tr>
			<th><label for='google_plus'>Google Plus</label></th>
			<td>
				<input type='text' name='google_plus' id='google_plus' value='<?php echo esc_attr(get_the_author_meta('google_plus', $user->ID)); ?>' class='regular-text' />
				<br />
				<span class='description'>Please enter your Google Plus username/alias. http://plus.google.com/<strong>username</strong></span>
			</td>
		</tr>
		<tr>
			<th><label for='flickr'>flickr</label></th>
			<td>
				<input type='text' name='flickr' id='flickr' value='<?php echo esc_attr(get_the_author_meta('flickr', $user->ID)); ?>' class='regular-text' />
				<br />
				<span class='description'>Please enter your Flickr username/alias. http://www.flickr.com/photos/<strong>username</strong></span>
			</td>
		</tr>
	</table>
<?php } ?>