<?php 
$conn = mysqli_connect(
	'localhost',
	'jony',
	'111111',
	'jony');

$sql = "SELECT Product_Quantity FROM product WHERE Product_id=".
	"${_POST['Product_ID']}";
$result = mysqli_query($conn, $sql);
$product_quantity = mysqli_fetch_array($result);

print_r($_POST);
print_r($product_quantity);
print_r($product_quantity['Product_Quantity']);

$product_quantity = $product_quantity['Product_Quantity'];

echo "eee";

print_r($product_quantity);

// if(){

// } else {

// }

if($result === false){
	error_log(mysqli_error($conn));
}
?>

