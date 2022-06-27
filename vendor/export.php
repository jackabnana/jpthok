<?
include ('include/functions.php');
$user = new Admin();


// output headers so that the file is downloaded rather than displayed
header('Content-type: text/csv');
header('Content-Disposition: attachment; filename="export.csv"');
 
// do not cache the file
header('Pragma: no-cache');
header('Expires: 0');
 
// create a file pointer connected to the output stream
$file = fopen('php://output', 'w');
 
// send the column headers
fputcsv($file, array('Product id', 'Product Code', 'Product Name', 'Quantity' ,'Product Rate','Discount Rate','Delivery Days','Status'));
 
// Sample data. This can be fetched from mysql too

$select_table=mysql_query("Select prod_id, product_code, product_name,product_qty, product_rate, prodcut_discount_rate, product_delivery_day, status from product");

while($rows = mysql_fetch_assoc($select_table))
{
	
	//$num = $get->get_user_total_order($rows['user_id']);
	$data[] = array($rows['prod_id'],$rows['product_code'],$rows['product_name'],$rows['product_qty'],$rows['product_rate'],$rows['prodcut_discount_rate'],$rows['product_delivery_day'],$rows['status']);
	
}


// output each row of the data
foreach ($data as $row)
{
    fputcsv($file, $row);
}

exit();