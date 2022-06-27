<? 
include 'include/functions.php';
$attribute_option_id = $_REQUEST['weight'];
$related_prod_id = $_REQUEST['pid'];
$prodcut_discount_rate = $get->get_attribute_option_disprice($attribute_option_id,$related_prod_id);
$product_rate = $get->get_attribute_option_price($attribute_option_id,$related_prod_id);
$attribute_stock = $get->get_attribute_fetch_stock($attribute_option_id,$related_prod_id);
?>
<? if($prodcut_discount_rate != 0 ){ ?>
Rs. <?=$prodcut_discount_rate?>
<input type="hidden" value="<?=$prodcut_discount_rate?>" name="product_price" />                  
<? } else { ?>
Rs. <?=$product_rate?>  
<input type="hidden" value="<?=$product_rate?>" name="product_price" />                                  
<? } ?>