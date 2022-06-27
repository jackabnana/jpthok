<?php 
include ('include/functions.php');
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
?>