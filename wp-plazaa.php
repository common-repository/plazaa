<?php

/*
Plugin Name: Plazaa
Plugin URI: http://wordpress.org/extend/plugins/plazaa/
Description: Widgets mit Deinen Bewertungen zu den besten Locations der Stadt von Plazaa.de
Version: 1.0.5
Author: Plazaa.de
Author URI: http://plazaa.de
License: GPL2
*/

include(dirname(__FILE__) . '/includes/wpPlazaaClass.php');
include(dirname(__FILE__) . '/widgets/widgetLastRatings.php');
include(dirname(__FILE__) . '/widgets/widgetPolaroids.php');
include(dirname(__FILE__) . '/widgets/widgetProfile.php');

$wpPlazaa = new wpPlazaaClass();

if (!get_option('plazaaNoCss')) {
    wp_register_style('plazaaCss', plugins_url('plazaa/templates/plazaaStylesheet.css', dirname(__FILE__)));
    wp_enqueue_style('plazaaCss');
}

if (is_admin()) {
    add_option('plazaaUsername', '');
    add_option('plazaaUsernameTested', '');
    add_option('plazaaUsernameOk', false);
    add_option('plazaaCacheTimeout', 8);
    add_option('plazaaNoCss', 0);
    
    add_action('admin_menu', array($wpPlazaa, 'setupSettingsMenu'));
    add_action('admin_init', array($wpPlazaa, 'registerSettings'));    
}
