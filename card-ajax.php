<?php
global $product;
$pid = $product->get_id();
$item_brand = $product->get_attribute( 'brand' );
$post_img = wp_get_attachment_image_src(get_post_thumbnail_id($pid), 'thumbnail'); 
$post_title = get_the_title($pid);
$item_price = $product->get_price_html();
?>

                <div class="popup-gallery">
                    <img alt="img" src="<?php if ($post_img) { echo $post_img[0]; } else { echo '' . get_template_directory_uri() . '/img/confetti.jpg'; } ?>">
                </div>
                <div class="popup-info-container">
                    <div class="popup-info">
                        <span class="popup-brand"><?php echo $item_brand; ?></span>
                        <h2><?php echo $post_title; ?></h2>
                        <div class="popup-details">
 <?php
if ($product->product_type == "variable") {  ?>
 <span class="popup-price"></span> 
   <?php } else {  ?>
 <span class="popup-price"><?php echo $item_price; ?></span> 
 <?php } ?>  

  <span class="popup-availability">
  <?php if( $avail_type == 0 ) {  ?>
                        <span class="item-available"><?php echo 'Disponibile'; ?></span>
                    <?php } elseif( $avail_type == 1 ) { ?>
                        <span class="item-finishing"><?php echo 'Meno di 5 rimasti!'; ?></span>
                    <?php } elseif( $avail_type == 2 ) { ?>
                        <span class="item-available"><?php echo 'Disponibile a breve'; ?></span>
                    <?php } else { ?>
                        <span class="item-unavailable"><?php echo 'Terminato!'; ?></span>
                    <?php } ?>
                           </span>
                        </div>
 <div class="popup-version">
<?php
$variation_ids = $product->get_children();
if( $variation_ids ) {
$i = 0;
    foreach ( $variation_ids as $id ) {
    	$v_product = wc_get_product($id);
   if ($i == 0) {
        $firstel = "selekted";
        $ides = $v_product->get_id();
     //  $pricesat = strip_tags($v_product->get_price_html());
    } else {
    	$firstel = "";
    }
        $product_attributes = wc_get_formatted_variation( $v_product, true, false, false );
        echo '<span id="'. $firstel .'" class="variation_price" idat="'. $v_product->get_id() .'" prat="'. strip_tags(wc_price( $v_product->get_price() )) .'">'. $product_attributes .'</span>';
    $i++;
    }
    }
              ?>

 </div>
    <?php
if ($product->product_type == "variable") {  ?>
                <form class="cart">
<input type="hidden" name="product_id" id="product_id" value="<?php echo $pid; ?>">
<input type="hidden" name="variation_id" id="variation_id" value="<?php echo $ides; ?>">
<input type="hidden" name="qty" value="1">
<button type="submit" name="add-to-cart" value="<?php echo $pid; ?>" id="butons">Aggiungi al carrello</button>
</form>   
   <?php } else {  ?>
                 <form class="cart">
<input type="hidden" name="product_id"  id="product_id" value="<?php echo $pid; ?>">
<input type="hidden" name="qty" value="1">
<button type="submit" name="add-to-cart" value="<?php echo $pid; ?>" id="butons">Aggiungi al carrello</button>
</form>   
 <?php } ?>  
                   
</div>
                </div>
