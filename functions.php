 <?php
function cp_enqueue_scripts() {
   wp_enqueue_script( 'cp_loc_file', get_stylesheet_directory_uri() . '/assets/js/script.js');
    wp_enqueue_script( 'cp_loc_file', get_stylesheet_directory_uri() . '/assets/js/var.js');
    wp_localize_script('cp_loc_file', 'cp_loc_ajaxpath', admin_url('admin-ajax.php'));
}
add_action('wp_enqueue_scripts', 'cp_enqueue_scripts');

/* quick view modal */

add_action("wp_ajax_nopriv_cp_get_product_details", "cp_get_product_details");
add_action("wp_ajax_cp_get_product_details", "cp_get_product_details");

function cp_get_product_details() {
	global $post, $product, $woocommerce;

    $prod_id = isset( $_POST['cp_productId']) ? $_POST['cp_productId'] : false;
    $post = get_post( $prod_id );
    $product = get_product( $prod_id );

  ob_start();
    woocommerce_get_template( 'card-ajax.php');
    $output = ob_get_contents();
ob_end_clean();

    echo $output;
    
    wp_die();
}

/* load modal */

function cp_inject_modal() {
    ?>
    <div class="cp_modal_loader popup-bg">
        <div class="lds-ripple"><div></div><div></div></div>
    </div>
    <div class="cp_modal_wrapper popup">
    	<div class="popup-close">×</div>
        <div class="cp_modal_content popup-content">
          <!-- inject content -->
        </div>
    </div>
    <?php
}
add_action('wp_footer', 'cp_inject_modal');
?>
