<?php
// Database Connection
include ('../management/include/functions.php');
$user = new Admin();
if (!$user->get_session())
{
	header("location:login.php");
}
//output headers so that the file is downloaded rather than displayed
header('Content-type: text/csv');
header('Content-Disposition: attachment; filename="order_export.csv"');
 
// do not cache the file
header('Pragma: no-cache');
header('Expires: 0');
 
// create a file pointer connected to the output stream
$file = fopen('php://output', 'w');
 
// send the column headers
fputcsv($file, array('id','Order_Id','Total_Price', 'TAX', 'Payment_Mode', 'Tracking_Status', 'Order_Date','Settlement_Value'));

// Sample data. This can be fetched from mysql too

$select_table=mysql_query("SELECT * FROM order_prodcut_details WHERE vendor_id= '".$_SESSION['vendor_id']."' GROUP BY orderid ORDER BY id DESC");

$i=1;
$total_settlement="";
while($row = mysql_fetch_array($select_table))
{
	
	$get_sql = mysql_query("SELECT * FROM cancel_order WHERE order_id = '".$row['orderid']."' AND detail_id = '".$row['id']."' ");
	$count = mysql_num_rows($get_sql);
	if($count < 1)
	{
		
		
		$settlement = $get->get_order_total_vendor($_SESSION['vendor_id'],$row['orderid']) - $get->get_order_total_tax($_SESSION['vendor_id'],$row['orderid']);
		$total_settlement +=  $settlement;
		
		$total_price = $get->get_order_total_vendor($_SESSION['vendor_id'],$row['orderid']);
		$TAX = $get->get_order_total_tax($_SESSION['vendor_id'],$row['orderid']);
		$Payment_Mode = $get->get_payment_method($row['orderid']);
		$Tracking_Status =	$get->get_order_tracking_status($row['orderid']);
		$Order_Date = $get->get_order_date($row['orderid']);
		
		
		$data[] = array($i,$row['orderid'],$total_price,$TAX,$Payment_Mode,$Tracking_Status,$Order_Date,$settlement);
	}
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