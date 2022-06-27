<?php 
include ('../management/include/functions.php');
?>

<? if(isset($_REQUEST['id'])){ ?> 
<div class="hidden iswf" >
	<table style="width:100%; margin:0;">		
		<tr>
		<td align="center">
		Attribute Option
		</td>
		<td>
		Price
		</td>
		<td>
		Discount Price
		</td>
		<td>
		Stock
		</td>
		<td>
		Action
		</td>
		</tr>	
		
		<tr>
		<td align="center" width="25%">
		<? 
		//echo "SELECT * FROM attribute_group WHERE attri_group_id='{$_REQUEST['id']}' ";die;
		$select_attribute_group = mysql_query("SELECT * FROM attribute_group WHERE attri_group_id='{$_REQUEST['id']}' ");
		$row_group=mysql_fetch_array($select_attribute_group);
		$attribute = explode(",",$row_group['attribute_ids']);
        $count_att = sizeof($attribute);?>
        <input type="hidden" name="att_number" id="att_number" value="<?=$count_att?>">
		<?
		for($a=0;$a<sizeof($attribute);$a++):
		$select_attribute = mysql_query("SELECT * FROM attribute WHERE attribute_required=1 and attribute_id='$attribute[$a]' ORDER BY attribute_name*1 ASC");
		$i =1;
		while($select_attri=mysql_fetch_array($select_attribute))
		{
			$id = $select_attri['attribute_id'];	
			?>
			<input type="hidden" value="<?=$_REQUEST['id']?>" name="stock_group_id" />
			<input type="hidden" value="<?=$select_attri['attribute_id']?>" name="stock_id[]" />
			<select required name="stock_option_id[]">
				<option value="">Select <?=$select_attri['attribute_name']?></option>
				<? 
					$select_sub_attribute = mysql_query("SELECT * FROM attribute_option WHERE attribute_id='{$select_attri['attribute_id']}' ORDER BY attribute_position ASC");
					while($row=mysql_fetch_array($select_sub_attribute)):
				?>
				<option value="<?=$row['id']?>"><?=$row['attribute_option_name']?></option>
				<? endwhile; ?>
			</select>
			<? $i++; 
		} endfor;	?>
		</td>
		<input type="hidden" value="<?=$i?>" name="stock_required" />
		<td  width="22%">
		<input required type="text" name="stock_price[]" id="stock_price" />
		</td>
		<td align="center" width="22%">
		<input  type="text" name="stock_dis_price[]" id="stock_dis_price" />
		</td>
		<td width="15%">
		<input required type="text" name="stock_stock[]" id="stock_stock" />
		</td>
		<td width="35%">
		<a href="#" id="addNewstocka" class="green_button">Add Rows Active</a>
		</td>
		</tr>
		<tr>
		<td colspan="5">
		<div id="addinputstocka">
		</div>
		</td>
		</tr>
	</table>
</div>
<script type="text/javascript">
var addDiv = $('#addinputstocka');
		$('#addinputstocka').html('');
		//alert($('#addinputstocka p').size());
        var i = $('#addinputstocka p').size() + 1;
        $('#addNewstocka').live('click', function() {
			
			   var cnt = $("#att_number").val();
				
                $('<p style="width:100%; margin:0; padding:0;"><table style="width:100%; margin:0;"><tr><td align="center" width="25%"><? $select_attribute_group = mysql_query("SELECT * FROM attribute_group WHERE attri_group_id='{$_REQUEST['id']}' ");	$row_group=mysql_fetch_array($select_attribute_group); $attribute = explode(",",$row_group['attribute_ids']); for($a=0;$a<sizeof($attribute);$a++):	$select_attribute = mysql_query("SELECT * FROM attribute WHERE attribute_required=1 and attribute_id='$attribute[$a]' ORDER BY attribute_name ASC"); $i =1; while($select_attri=mysql_fetch_array($select_attribute)) { $id = $select_attri['attribute_id']; ?><input type="hidden" value="<?=$select_attri['attribute_id']?>" name="stock_id[]" /><select required name="stock_option_id[]"><option value="">Select <?=$select_attri['attribute_name']?></option><? $select_sub_attribute = mysql_query("SELECT * FROM attribute_option WHERE attribute_id='{$select_attri['attribute_id']}' ORDER BY attribute_option_name ASC");  while($row=mysql_fetch_array($select_sub_attribute)):?><option value="<?=$row['id']?>"><?=$row['attribute_option_name']?></option><? endwhile; ?></select><? $i++; } endfor;?>	<input type="hidden" name="attribute_size" value="<?=$i-1?>"></td><td  width="22%"><input required type="text" name="stock_price[]" id="stock_price" /></td><td align="center" width="22%"><input type="text" name="stock_dis_price[]" id="stock_dis_price" /></td><td width="15%"><input required type="text" name="stock_stock[]" id="stock_stock" /></td><td width="35%"><a href="#" id="remNewstock1" class="green_button">Delete Active</a></td></tr></table></p>').appendTo(addDiv);
                i++;
                return false;
        });
        $('#remNewstock1').live('click', function() { 
                if( i > 1 ) {
                        $(this).parents('p').remove();
                        i--;
                }
                return false;
        });
</script>
<? 
}

if(isset($_REQUEST['att_id']))
{ 
	$qry = "DELETE FROM product_attribute WHERE id  = '".$_REQUEST['att_id']."' ";
	if(mysql_query($qry))
	{
		echo 'success';
		
	}
}
if(isset($_REQUEST['pid']))
{ 
	
	$qry = mysql_query("SELECT * FROM product WHERE prod_id  = '".$_REQUEST['pid']."' ");
	$res = mysql_fetch_array($qry);
	
	
	if($res['prodcut_discount_rate'] > 0)
	{
		$prate =  $res['prodcut_discount_rate'];
	}
	else
	{
		$prate =  $res['product_rate'];
	}
	
	
	$comm = $get->get_commission_according_category($_REQUEST['pid']);
	$comm_rs = ($comm*$prate)/100;
	
	
	//$comm= $get->get_commission();
	
	$service = $get->get_service_tax();
	$collection_fee = $get->get_collection_fee();
	$fixed_fee = $get->get_fixed_fee();
	//$comm_rs = (($prate*$comm)/100);
	$service_rs = (($prate*$service)/100);
	
	$SwachhBharat = $get->get_swachh_bharat();
	$rupee_SwachhBharat = ($prate*$SwachhBharat)/100;
	$web_name = $get->get_website_name();
	
	$settlement = $prate-(round($comm_rs,2)+$collection_fee+$fixed_fee+round($service_rs,2)+round($rupee_SwachhBharat,2));
	
	
	echo '<div class="dropdown-panel">
	<div class="row-fluid">
	<div class="heading">
	<h5>Commission Calculator 
	<span class="pull-right cross-white calculator-close" onclick="hide_filter()">X</span>
	</h5>
	</div>
	<div class="body commission-calculator">
	<ul class="nav nav-tabs">
	<li  class="active"><a>Selling Price</a></li>
	</ul>
	<form name="editPriceform">
		<div class="margin-bottom-20px">
		<strong>Set Selling Price :</strong>
		<input type="text" name="selling_price" value="'.$prate.'" readonly>
		</div>


		<table class="table table-bordered">
		<thead>
		<tr style="font-size:13px;">
		<th>Commission ( <i class="fa fa-inr" aria-hidden="true"></i> )</th>
		<th>Collection Fee ( <i class="fa fa-inr" aria-hidden="true"></i> )</th>
		<th>Fixed Fee ( <i class="fa fa-inr" aria-hidden="true"></i> )</th>
		<th>Service Tax ( <i class="fa fa-inr" aria-hidden="true"></i> )</th>
		<th>Swachh Bharat Tax ( <i class="fa fa-inr" aria-hidden="true"></i> )</th>
		</tr>
		</thead>
		<tbody class="row-fluid container-popover">
		<tr>
			<td>'.round($comm_rs,2).'<br/><p class="gery">('.$comm.'%)</p></td>
			<td>'.$collection_fee.'</td>
			<td>'.$fixed_fee.'</td>
			<td>'.round($service_rs,2).'<br/><p class="gery">('.$service.'%)</p></td>
			<td>'.round($rupee_SwachhBharat,2).'<br/><p class="gery">('.$SwachhBharat.'%)</p></td>
		</tr>
		</tbody>
		</table>


		<div>
		<div class="pull-right">
		<h5 class="settlement-value">Settlement Value: 
		<span class="rupee-parent"><i class="fa fa-inr" aria-hidden="true"></i>&nbsp;&nbsp;'.$settlement.'</span>
		</h5>
		</div>
		</div>

		<div class="clear-both">
		<hr>
		<p class="disclaimer-text">Disclaimer:</p>
		<ul class="disclaimer-text">
		<li>The commission and discount are based on the current rate card. The actual charges may vary depending on date of order.</li>
		<li>Collection fee is Rs. '.$collection_fee.' of total sale value.</li>
		<li>The calculated Settlement Value does not include '.$web_name.' shipping charges to seller. Learn more about '.$web_name.' rate card</a>.</li>
		</ul>
		</div>

	</form>
	</div>
	</div>
	</div>';
	
	
}
?>