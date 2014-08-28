<?php

if (!current_user_can('wp_power_stats_configure')) wp_die(__('You do not have sufficient permissions to manage options for this site.'));

$title = __('WP Power Stats Settings','wp-power-stats');
$timezone_format = _x('Y-m-d G:i:s', 'timezone date format');