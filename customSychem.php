<?php
/**
 * Plugin Name:       Sychem Customisations 👩‍🔬🔥
 * Plugin URI:        #
 * Description:       Custom CSS, JS & PHP modifications for the Sychem website
 * Version:           1.2
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Sam Tarling
 * Author URI:        #
 * License:           Copyright (C) All Rights Reserved
 * License URI:       
 * Text Domain:       customsychem
 * Domain Path:       /customsychem
 */

defined( 'ABSPATH' ) || exit;

require_once(__DIR__."/inc/plugin-update-checker-4.9/plugin-update-checker.php");
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://apps.tsgroupinternational.com/wp-plugins/customSychem/plugin.json',
	__FILE__, //Full path to the main plugin file or functions.php.
	'customsychem'
);

//Actions
add_action('wp_enqueue_scripts','cs_registerScripts');


//Functions
/**
 * Register CSS files
 *
 * @return void
 */
function cs_registerScripts()
{
    wp_enqueue_style( 'cs_style', plugins_url( 'css/cs_style.css' , __FILE__ ) );
}

/**
 * Move the price of a variable product up next to the dropdown
 *
 * @return void
 */
function cs_move_variable_product_price() { ?>
    <script>
    jQuery(function ($)
	{
        $('.variations_form').on('woocommerce_variation_has_changed', function ()
		{
			
			var e = document.getElementById("sc_variant");

			if(e.options[e.selectedIndex].value == "")
			{
				$('.cs_moved_price').html('');
			}
			else
			{
				$('.cs_moved_price').html('');
            	$('.cs_moved_price').html($('.woocommerce-variation-price .woocommerce-Price-amount').html());
			}
            
        });
    });

    </script>
<?php }
add_action( 'wp_footer', 'cs_move_variable_product_price' );