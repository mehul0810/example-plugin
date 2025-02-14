<?php
/*
Plugin Name: Example Plugin
Plugin URI: https://github.com/mehul0810/example-update-plugin
Description: An example plugin to test UpdateSync automatic update functionality.
Version: 1.0.0
Author: Mehul Gohil
Author URI: https://mehulgohil.com
Update URI: https://github.com/mehul0810/example-plugin
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Ensure Composer autoloader is loaded.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/vendor/autoload.php';
} else {
    // Optionally display an admin notice if autoloader is missing.
    add_action( 'admin_notices', function() {
        echo '<div class="error"><p>Composer autoloader not found. Please run <code>composer install</code> in the plugin directory.</p></div>';
    } );
    return;
}

use MG\UpdateSync\ProviderFactory;

/**
 * Initializes the update functionality.
 */
function example_update_plugin_init() {
    // For testing purposes, we're using GitHub updates.
    // (In a live scenario, the update server URL in the header is used by UpdateSync.)
    $provider = ProviderFactory::create( 'github', __FILE__ );
    $provider->run();
}
add_action( 'admin_init', 'example_update_plugin_init' );
