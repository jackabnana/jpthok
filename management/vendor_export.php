<?php
// Database Connection
include ('include/functions.php');
$user = new Admin();
if (!$user->get_session())
{
	header("location:login.php");
}
//output headers so that the file is downloaded rather than displayed
header('Content-type: text/csv');
header('Content-Disposition: attachment; filename="vendor_export.csv"');
 
// do not cache the file
header('Pragma: no-cache');
header('Expires: 0');
 
// create a file pointer connected to the output stream
$file = fopen('php://output', 'w');
 
// send the column headers
fputcsv($file, array('id','vendor_id','username', 'email','mobile','pincode','lastlogin','bussiness_name', 'bussiness_type', 'pan_card_no', 'tin_vat', 'tan','business_status','store_name','store_address','store_status','account_name', 'account_no', 'ifsc_code', 'bank_name', 'state', 'city', 'branch', 'bank_status'));

// Sample data. This can be fetched from mysql too

$select_table=mysql_query("SELECT * FROM admin_login WHERE vendor_id > 0 ");

$i=1;
while($row = mysql_fetch_array($select_table))
{
	    $vendor_id = $row['vendor_id'];
	   
	   
	    $buss_detail = mysql_query("SELECT * FROM business_details WHERE vendor_id = '$vendor_id' ");
		$row_buss_detail = mysql_fetch_array($buss_detail);
		
		
		$store_details = mysql_query("SELECT * FROM store_details WHERE vendor_id = '$vendor_id' ");
		$row_store_details = mysql_fetch_array($store_details);
		
		$bank_detail = mysql_query("SELECT * FROM bank_detail WHERE vendor_id = '$vendor_id' ");
		$row_bank_detail = mysql_fetch_array($bank_detail);
		
		

	    
	   
		$data[] = array($i,$row['vendor_id'],$row['username'],$row['email'],$row['mobile'],$row['pincode'],$row['lastlogin'],$row_buss_detail['buss_name'],$row_buss_detail['buss_type'],$row_buss_detail['pan_card'],$row_buss_detail['tin_vat'],$row_buss_detail['tan'],$row_buss_detail['status'],$row_store_details['dis_name'],$row_store_details['description'],$row_store_details['status'],$row_bank_detail['account_name'],$row_bank_detail['account_no'],$row_bank_detail['ifsc_code'],$row_bank_detail['bank_name'],$row_bank_detail['state'],$row_bank_detail['city'],$row_bank_detail['branch'],$row_bank_detail['status']);
		
		//echo '<pre>';
		//print_r($data);
		//echo '</pre>';
		//die;
		
		$i++;	
	
}


// output each row of the data
foreach ($data as $row)
{
    fputcsv($file, $row);
}

exit();



/*

if($_REQUEST['export'] == 1)
{

// Fetch Record from Database

$output = "";
$sql = mysql_query("select userid AS User_Name , orderid AS ORDER_ID , 	prod_id AS Product_Name , attribute_option_id AS Attribute, invoice_number AS Invoice_Number from order_prodcut_details ");

$columns_total = mysql_num_fields($sql);

// Get The Field Name

for ($i = 0; $i < $columns_total; $i++) 
{
	$heading = mysql_field_name($sql, $i);
	$output .= '"'.$heading.'",';
}
$output .="\n";

// Get Records from the table

while ($row = mysql_fetch_array($sql)) 
{
	
	//echo '<pre>';
	//print_r($row);
	//echo '</pre>';
	
	 $username = $get->get_user_name($row[0]);
	 $prod_name = $get->get_product_name($row[2]);
	 $att_name = $get->get_attribute_option_name($row[3]);
	
	
	//echo $columns_total;
	
	for ($i = 0; $i < $columns_total; $i++) 
	{
		
		$output .= $username;
		$output .= $row[1];
		$output .= $prod_name;
		$output .= $att_name;
		$output .= $row[4];
		
		
		$output .='"'.$row["$i"].'",';
	}
	
	
	$output .="\n";
	
}

// Download the file

//$filename = "".$_REQUEST['tablename'].".csv";

$filename = "order_summery.csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);
echo $output;
exit;
}
*/
?>