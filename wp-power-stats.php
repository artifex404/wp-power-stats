<?php
/*
Plugin Name: Power Stats
Plugin URI: http://www.websivu.com/wp-power-stats/
Description: Clean & simple statistics for your wordpress site.
Version: 1.4
Author: Igor Buyanov
Text Domain: wp-power-stats
Author URI: http://www.websivu.com
License: GPL2
*/

/*  Copyright 2013  IGOR BUYANOV  (email : info@websivu.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (get_option('timezone_string')) {
	date_default_timezone_set(get_option('timezone_string'));
}

	
define('WP_POWER_STATS_VERSION', '1.4');
update_option('wp_power_stats_plugin_version', WP_POWER_STATS_VERSION);

if (!defined('WP_POWER_STATS_PLUGIN_DIR')) define('WP_POWER_STATS_PLUGIN_DIR', untrailingslashit(dirname(__FILE__)));

function wp_power_stats_install() {
	global $table_prefix;
	
	if (empty($table_prefix)) $table_prefix = "wp";
	
    $create_browsers = "CREATE TABLE IF NOT EXISTS `{$table_prefix}power_stats_browsers` (
      `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
      `browser` varchar(255) NOT NULL,
      `count` int(11) NOT NULL,
      PRIMARY KEY  (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    
    $create_os = "CREATE TABLE IF NOT EXISTS `{$table_prefix}power_stats_os` (
      `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
      `os` varchar(255) NOT NULL,
      `count` int(11) NOT NULL,
      PRIMARY KEY  (`id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    
    $create_pageviews = "CREATE TABLE IF NOT EXISTS `{$table_prefix}power_stats_pageviews` (
      `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
      `date` date NOT NULL,
      `hits` int(10) unsigned NOT NULL,
      PRIMARY KEY  (`id`),
      UNIQUE KEY `post_id` (`date`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    
    $create_posts = "CREATE TABLE IF NOT EXISTS `{$table_prefix}power_stats_posts` (
      `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
      `post_id` int(16) NOT NULL,
      `date` date NOT NULL,
      `hits` int(10) unsigned NOT NULL,
      PRIMARY KEY  (`id`),
      UNIQUE KEY `post_id` (`post_id`,`date`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=1;";
    
    $create_searches = "CREATE TABLE IF NOT EXISTS `{$table_prefix}power_stats_searches` (
      `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
      `terms` varchar(255) DEFAULT NULL,
      `count` int(11) NOT NULL,
      PRIMARY KEY  (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    
    $create_visits = "CREATE TABLE IF NOT EXISTS `{$table_prefix}power_stats_visits` (
      `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
      `date` date NOT NULL,
      `ip` varchar(20) NOT NULL,
      `time` time NOT NULL,
      `country` varchar(4) NOT NULL,
      `device` varchar(16) NOT NULL,
      `referer` text NOT NULL,
      `browser` varchar(255) NOT NULL,
      `browser_version` varchar(16) NOT NULL,
      `os` varchar(255) NOT NULL,
      `is_search_engine` tinyint(4) NOT NULL,
      `is_bot` tinyint(4) NOT NULL,
      `user_agent` text NOT NULL,
      PRIMARY KEY  (`id`),
      UNIQUE KEY `date` (`date`,`ip`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
    
    $create_referers = "CREATE TABLE IF NOT EXISTS `{$table_prefix}power_stats_referers` (
      `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
      `referer` text NOT NULL,
      `count` int(11) NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
	
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			
	dbDelta($create_browsers);
	dbDelta($create_os);
	dbDelta($create_pageviews);
	dbDelta($create_posts);
	dbDelta($create_searches);
	dbDelta($create_visits);
	dbDelta($create_referers);
	
    $role = get_role("administrator");
    if (is_object($role) && method_exists($role, 'add_cap')) {
        $role->add_cap('wp_power_stats_view');
        $role->add_cap('wp_power_stats_configure');
    }
	
}

// Initialize widget
require_once('widget.php');
function register_wp_power_stats_widget() {
    register_widget('PowerStatsWidget');
}
add_action('widgets_init', 'register_wp_power_stats_widget');


function wp_power_stats_activate() {

	if (is_admin()) {

        global $wpdb;

		if (function_exists('is_multisite') && is_multisite()) {

            // If network activation, run the install for each blog       
	        if (isset($_GET['networkwide']) && ($_GET['networkwide'] == 1)) {

                $old_blog = $wpdb->blogid;

	            // Get all blog ids
	            $blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");

	            foreach ($blogids as $blog_id) {
	                switch_to_blog($blog_id);
	                wp_power_stats_install();
	            }

	            switch_to_blog($old_blog);
	            return;
	        }
	        
		} else {
			
			wp_power_stats_install();
			
		}

	
	}
	
}	
register_activation_hook(__FILE__, 'wp_power_stats_activate');


function set_tracking_cookie() {
	if(!session_id()) session_start();
}
add_action('init', 'set_tracking_cookie');


function intern() {
    		
	// Internationalization
	load_plugin_textdomain('wp-power-stats', false, basename(dirname(__FILE__)) . '/languages');
	
}
add_action('plugins_loaded', 'intern');


function wp_power_stats_settings_init() {

    $role = get_role("administrator");
    $role->add_cap('wp_power_stats_view');
    $role->add_cap('wp_power_stats_configure');
    
    register_setting('wp-power-stats-settings', 'wp_power_stats_view_roles', 'wp_power_stats_save_view_roles');
	register_setting('wp-power-stats-settings', 'wp_power_stats_configuration_roles', 'wp_power_stats_save_configuration_roles');
    register_setting('wp-power-stats-settings', 'wp_power_stats_ignore_admins');
	register_setting('wp-power-stats-settings', 'wp_power_stats_ignore_bots');
	register_setting('wp-power-stats-settings', 'wp_power_stats_ip_exclusion', 'wp_power_stats_save_ip_exclusion');

	add_settings_section('wp_power_stats_setting_access_section', 'Access Levels', 'wp_power_stats_access_section', 'wp-power-stats-settings');
	add_settings_section('wp_power_stats_setting_exclusion_section', 'Exclusions', 'wp_power_stats_exclusion_section', 'wp-power-stats-settings');
	
}
add_action('admin_init', 'wp_power_stats_settings_init');


function wp_power_stats_access_section() {

    _e('<p>Customize which user roles have access to the statistics and the settings of WP Power Stats.</p>','wp-power-stats');
	add_settings_field('view_statistics', __('View','wp-power-stats'), 'wp_power_stats_setting_view_roles', 'wp-power-stats-settings', 'wp_power_stats_setting_access_section');
    add_settings_field('manage_statistics', __('Configuration','wp-power-stats'), 'wp_power_stats_configuration_roles', 'wp-power-stats-settings', 'wp_power_stats_setting_access_section');
	
}


function wp_power_stats_exclusion_section() {

    _e('<p>Configure which statistics are not logged.</p>','wp-power-stats');
    add_settings_field('ignore_hits', __('Ignore hits from','wp-power-stats'), 'wp_power_stats_setting_ignore_hits', 'wp-power-stats-settings', 'wp_power_stats_setting_exclusion_section');
    add_settings_field('ip_exclusion', __('Excluded IP addresses','wp-power-stats'), 'wp_power_stats_ip_exclusion', 'wp-power-stats-settings', 'wp_power_stats_setting_exclusion_section');

}


function wp_statistics_clean_capability($roles, $capability) {

	global $wp_roles;
	
	if (is_array($roles) && !empty($roles)) {
    	$role_list = $wp_roles->get_names();
    	foreach ($role_list as $role => $cap) {
            if (!in_array($role, $roles)) {
                $obj_role = get_role($role);
                if (is_object($obj_role) && method_exists($obj_role, 'remove_cap')) $obj_role->remove_cap($capability);
            }
    	}
	}
}

function is_valid_mask($mask) {

    $validMasks = array('255.255.255.255','255.255.255.254','255.255.255.252','255.255.255.248','255.255.255.240','255.255.255.224','255.255.255.192','255.255.255.128','255.255.255.0','255.255.254.0','255.255.252.0','255.255.248.0','255.255.240.0','255.255.224.0','255.255.192.0','255.255.128.0','255.255.0.0','255.254.0.0','255.252.0.0','255.248.0.0','255.240.0.0','255.224.0.0','255.192.0.0','255.128.0.0','255.0.0.0','254.0.0.0','252.0.0.0','248.0.0.0','240.0.0.0','224.0.0.0','192.0.0.0','128.0.0.0','0.0.0.0');
    
    return (in_array($mask, $validMasks)) ? true : false;
}

function wp_power_stats_save_ip_exclusion($input) {
    
    if (!empty($input)) {
    
        $input_ip = array();
        $validated_ip = array();
    
        if (strstr($input, "\n")) $input_ip = explode("\n", $input);
        else $input_ip[] = $input;

        foreach ($input_ip as $ip) {
        
            if (strstr($ip, "/")) { // matches mask
                
                $arr_ip = explode("/", $ip);
                $ip = $arr_ip[0];
                $mask = $arr_ip[1];
                
                if (strlen($mask) > 0 && strlen($mask) <= 2 && $mask > 0 && $mask <= 32) { // 192.168.0.0/24
                    
                    $filtered = filter_var(trim($ip), FILTER_VALIDATE_IP);
                    if (!empty($filtered)) $validated_ip[] = $filtered . "/" . $mask;
                    
                } else { // 192.168.0.0/255.255.255.0
                    
                    if (is_valid_mask($mask)) {
                        
                        $filtered = filter_var(trim($ip), FILTER_VALIDATE_IP);
                        if (!empty($filtered)) $validated_ip[] = $filtered . "/" . $mask;
                        
                    }
                    
                }
                
            } else { // 192.168.0.0
            
                $filtered = filter_var(trim($ip), FILTER_VALIDATE_IP);
                if (!empty($filtered)) $validated_ip[] = $filtered; 
                
            }
            
        }        
    
        return implode("\n", $validated_ip);
        
    }

    return "";
    
}

function wp_power_stats_save_view_roles($input) {

    global $wp_roles, $current_user;
    
    if (is_array($input) && !in_array("administrator", $input)) $input[] = "administrator";
    
    if (is_array($input)) {
        foreach ($input as $role) {
            $role = get_role($role);
            if (is_object($role) && method_exists($role, 'add_cap')) $role->add_cap('wp_power_stats_view');
        }
    } else {
        $role = get_role("administrator");
        if (is_object($role) && method_exists($role, 'add_cap')) $role->add_cap('wp_power_stats_view');
    }
    
    wp_statistics_clean_capability($input, "wp_power_stats_view");
    
    if (is_array($input)) return implode(",", $input);
    else return $input;
}

function wp_power_stats_save_configuration_roles($input) {

    global $current_user;
    
    if (is_array($input) && !in_array("administrator", $input)) $input[] = "administrator";
    
    if (is_array($input)) {

        foreach ($input as $role) {
            $role = get_role($role);
            if (is_object($role) && method_exists($role, 'add_cap')) $role->add_cap('wp_power_stats_configure');
        }        
        
    } else {
        $role = get_role("administrator");
        if (is_object($role) && method_exists($role, 'add_cap')) $role->add_cap('wp_power_stats_configure');
    }
    
    wp_statistics_clean_capability($input, "wp_power_stats_configure");
    
    if (is_array($input)) return implode(",", $input);
    else return $input;
}

function wp_power_stats_get_ip() {
	
	    $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');

	    foreach ($ip_keys as $key) {
	        if (array_key_exists($key, $_SERVER) === true) {
	            foreach (explode(',', $_SERVER[$key]) as $ip) {
	                $ip = filter_var(trim($ip), FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
	            }
	        }
	    }
	    
	    if (!empty($ip)) return $ip;
	    else return "";
	    
	}

function wp_power_stats_ip_exclusion() {

    $ip_exclusion = get_option('wp_power_stats_ip_exclusion');

    echo '<fieldset><textarea name="wp_power_stats_ip_exclusion" id="" cols="30" rows="5">'. $ip_exclusion .'</textarea><p class="description">' . __('Enter IP addresses to exclude from statistics. One IP address/range per line.','wp-power-stats') .'<br />'. __('Accepted formats: 192.168.0.0, 192.168.0.0/24 and 192.168.0.0/255.255.255.0','wp-power-stats') .'</p></fieldset><br />';
    
    if (wp_power_stats_get_ip()) echo '<input name="" id="" class="button action" value="Add '. wp_power_stats_get_ip() .'" type="button" onclick="var el = jQuery(this).prev().prev(\'fieldset\').children(\'textarea\'); if (el.val()) el.val(el.val() + \'\n\'); el.val(el.val() + \''. wp_power_stats_get_ip() .'\')" /> <p class="description">'. __('This is your current address.','wp-power-stats') .'</p>';
}

function wp_power_stats_configuration_roles() {

    global $wp_roles;

	$roles = $wp_roles->get_names();
    $roles_options = '';
    
    $read_roles = explode(",", get_option('wp_power_stats_configuration_roles', 'administrator'));
    
    if (is_array($read_roles) && !in_array("administrator", $read_roles)) $read_roles[] = "administrator";
    
	foreach ($roles as $key => $cap) {
		$selected = (is_array($read_roles) && in_array($key, $read_roles)) ? " selected" : "";
		$roles_options .= "<option value='{$key}'{$selected}>{$key}</option>";
	}

    echo '<fieldset><label for="wp_power_stats_configuration_roles[]"><select id="wp_power_stats_configuration_roles[]" size="6" multiple height="6" name="wp_power_stats_configuration_roles[]">'. $roles_options .'</select></label><p class="description">'. __('Select roles that can change WP Power Stats settings. Administrator is always selected.','wp-power-stats') .'</p></fieldset><br />';
}

function wp_power_stats_setting_view_roles() {

    global $wp_roles;

	$roles = $wp_roles->get_names();
    $roles_options = '';
    
    $read_roles = explode(",", get_option('wp_power_stats_view_roles', 'administrator'));
    
    if (is_array($read_roles) && !in_array("administrator", $read_roles)) $read_roles[] = "administrator";
    
	foreach ($roles as $key => $cap) {
		$selected = (is_array($read_roles) && in_array($key, $read_roles)) ? " selected" : "";
		$roles_options .= "<option value='{$key}'{$selected}>{$key}</option>";
	}

    echo '<fieldset><label for="wp_power_stats_view_roles[]"><select id="wp_power_stats_view_roles[]" size="6" multiple height="6" name="wp_power_stats_view_roles[]">'. $roles_options .'</select></label><p class="description">'. __('Select roles that can view statistics. Administrator is always selected.','wp-power-stats') .'</p></fieldset><br />';
}

function wp_power_stats_setting_ignore_hits() {
    echo '<fieldset><label for="wp_power_stats_ignore_admins"><input name="wp_power_stats_ignore_admins" id="wp_power_stats_ignore_admins" type="checkbox" value="1" class="code" ' . checked( 1, get_option('wp_power_stats_ignore_admins'), false ) . ' /> '. __('Administrators','wp-power-stats') .'</label><br />';
    echo '<label for="wp_power_stats_ignore_bots"><input name="wp_power_stats_ignore_bots" id="wp_power_stats_ignore_bots" type="checkbox" value="1" class="code" ' . checked( 1, get_option('wp_power_stats_ignore_bots'), false ) . ' /> '. __('Bots','wp-power-stats') .'</label></fieldset>';
}

function net_match($network, $ip) {

    $ip_arr = explode('/', $network);
    
    if (!isset($ip_arr[1])) $ip_arr[1] = 32;
    $network_long = ip2long($ip_arr[0]);
    
    $x = ip2long($ip_arr[1]);
    $mask =  long2ip($x) == $ip_arr[1] ? $x : 0xffffffff << (32 - $ip_arr[1]);
    $ip_long = ip2long($ip);
    
    return ($ip_long & $mask) == ($network_long & $mask);
}

function current_ip_ignored() {
    
	$subnets = explode("\n", get_option('wp_power_stats_ip_exclusion'));
	$current_ip = wp_power_stats_get_ip();
	
	foreach ($subnets as $subnet) {
		$subnet = trim($subnet);
		if (strlen($subnet) > 6) {
			if (net_match($subnet, $current_ip)) {
				return true;
			}
		}
	}
	
    return false;
}

function wp_power_stats_ignore() {

    return ((get_option('wp_power_stats_ignore_admins') && current_user_can('manage_options')) || current_ip_ignored()) ? true : false; 

}
 

function wp_power_stats_init() {
	
	global $wpdb, $table_prefix, $post;
	
	if (!is_admin() && !wp_power_stats_ignore()) { // Do not track administration backend hits and site hits if meets the criterias
		require_once WP_POWER_STATS_PLUGIN_DIR . '/powerStats.class.php';
		if (!class_exists('Mobile_Detect')) require_once WP_POWER_STATS_PLUGIN_DIR . '/vendor/mobile-detect/Mobile_Detect.php';
		require_once WP_POWER_STATS_PLUGIN_DIR . '/vendor/search-terms/SearchEngines.php';
		require_once WP_POWER_STATS_PLUGIN_DIR . '/vendor/browser-os/Browser.php';
		$power_stats = new PowerStats($wpdb, $table_prefix, $post);
	}

}
add_action('shutdown', 'wp_power_stats_init');


function wp_power_stats_statistics_help() {

    $screen = get_current_screen();

    if ($screen->id != 'toplevel_page_wp-power-stats')
        return;

    $screen->add_help_tab(array(
        'id'	=> 'my_help_tab',
        'title'	=> __('Overview','wp-power-stats'),
        'content'	=> '<p>'.__('The regions on your Statistics screen are:','wp-power-stats').'</p>
<p><strong>'.__('Summary','wp-power-stats').'</strong> - '.__('Shows the number of visitors and page views during different time periods: today, this week, this month.','wp-power-stats').'</p>
<p><strong>'.__('Devices','wp-power-stats').'</strong> - '.__('Shows the top 3 devices your visitors are using.','wp-power-stats').'</p>
<p><strong>'.__('Visitors & Page Views','wp-power-stats').'</strong> - '.__('Shows a graph of visitors and page views during the last 11 days. You can view the precise numbers when you hover the graph with your mouse.','wp-power-stats').'</p>
<p><strong>'.__('Traffic Source','wp-power-stats').'</strong> - '.__('Displays the traffic source to your web site.','wp-power-stats').'</p>
<p><strong>'.__('Browsers','wp-power-stats').'</strong> - '.__('Displays the top 3 most used web browser of your visitors.','wp-power-stats').'</p>
<p><strong>'.__('Operating Systems','wp-power-stats').'</strong> - '.__('Displays the top 3 most used operating system of your visitors.','wp-power-stats').'</p>
<p><strong>'.__('Visitor Map','wp-power-stats').'</strong> - '.__('Shows the geoprahical map of your visitors. Hover over a country, to see the exact visitor number to your site from that country.','wp-power-stats').'</p>
<p><strong>'.__('Top Posts','wp-power-stats').'</strong> - '.__('Shows the most viewed posts of your wordpress site.','wp-power-stats').'</p>
<p><strong>'.__('Top Links','wp-power-stats').'</strong> - '.__('Shows the most common referer to your site.','wp-power-stats').'</p>
<p><strong>'.__('Top Search Terms','wp-power-stats').'</strong> - '.__('Shows the most used keywords used to find your website.','wp-power-stats').'</p>'
    ));
}

function current_role_capability() {
    global $current_user;

	$current_role = reset($current_user->roles);
	$role = get_role($current_role);

	foreach ($role->capabilities as $key => $capability) {
		return $key;
	}
	
     
}

function wp_power_stats_manage_capability() {
  return current_role_capability();
}

add_filter('option_page_capability_wp-power-stats-settings', 'wp_power_stats_manage_capability');

function wp_power_stats_menu() {

    $wp_version = get_bloginfo('version');
    
    if (current_user_can('wp_power_stats_view') || current_user_can('manage_options')) {
    
        wp_enqueue_style('grid', plugin_dir_url(__FILE__) . '/styles/grid.css', true, '1.0');
        wp_enqueue_style('layout', plugin_dir_url(__FILE__) . '/styles/styles.css', true, '1.0');
    	if (doubleval($wp_version) < 3.8) {wp_enqueue_style('layout-fix', plugin_dir_url(__FILE__) . '/styles/styles-before-3.8.css', true, '1.0');}
    	
    	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
    	wp_enqueue_script('google-charts', 'https://www.google.com/jsapi');	
        
        $power_stats_icon = (doubleval($wp_version) >= 3.8) ? "dashicons-chart-pie" : "div";
        $statistics_menu = add_menu_page(__('Statistics','wp-power-stats'), __('Statistics','wp-power-stats'), current_role_capability(), 'wp-power-stats', 'wp_power_stats', $power_stats_icon, 3.119);
        add_action('load-'.$statistics_menu, 'wp_power_stats_statistics_help');
        
    }
    
    if (current_user_can('wp_power_stats_configure') || current_user_can('manage_options')) {

        $settings_menu = add_submenu_page('options-general.php', __('WP Power Stats','wp-power-stats'), __('WP Power Stats','wp-power-stats'), current_role_capability(), 'wp-power-stats-settings', 'wp_power_stats_settings');

    }
	
}
add_action('admin_menu', 'wp_power_stats_menu');


function wp_power_stats() {

	global $wpdb;

	require_once WP_POWER_STATS_PLUGIN_DIR . '/admin.php';
	require_once WP_POWER_STATS_PLUGIN_DIR . '/views/dashboard.php';

}

function wp_power_stats_settings() {

    global $wpdb;
    
    require_once WP_POWER_STATS_PLUGIN_DIR . '/settings.php';
    require_once WP_POWER_STATS_PLUGIN_DIR . '/views/settings.php';

}