<?php

namespace MarkHowellsMead\RedbubbleAtom;

class Options
{

	public function __construct()
	{
		add_action('admin_menu', [$this, 'createAdminMenu']);
	}

	public function createAdminMenu()
	{
		add_submenu_page('options-general.php', _x('Redbubble Atom Settings', 'Label for page title', 'mhm-redbubble'), _x('Redbubble Atom', 'Label for menu entry', 'mhm-redbubble'), 'manage_options', 'mhm-redbubble', [$this, 'settingsPage']);
		add_action('admin_init', [$this, 'registerPluginSettings']);
	}

	public function registerPluginSettings()
	{
		register_setting('mhm-redbubble', 'mhm-redbubble');
	}

	public function settingsPage()
	{
		echo '<div class="wrap">
            <h1>' . _x('Custom menu page', 'Label for page title', 'mhm-redbubble') . '</h1>
            <form method="post" action="options.php">
            ';
		settings_fields('mhm-redbubble');
		echo '<table class="form-table">
			<tr valign="top">
				<th scope="row">' . __('Atom Feed URL', 'mhm-redbubble') . '</th>
				<td>
					<input id="url" type="url" name="mhm-redbubble[url]" value="' . esc_attr($this->get('url')) . '" class="regular-text ltr" />
					<p class="description" id="contact_email-description">' . __('The full URL of the Atom feed.', 'mhm-redbubble') . '</p>
				</td>
			</tr>
        </table>';
		submit_button();
		echo '</form>
        </div>';
	}

	public function get($key = '')
	{
		if (empty($key)) {
			return get_option('mhm-redbubble');
		} else {
			$options = get_option('mhm-redbubble');
			return isset($options[$key]) ? $options[$key] : '';
		}
	}
}
