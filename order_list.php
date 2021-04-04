<?php 
$conn = mysqli_connect(
	'localhost',
	'jony',
	'111111',
	'jony');

$sql = "SELECT
			order.Order_ID,
			Name,
			Product_Name,
			Order_Quantity,
			To_Name,
			To_Address,
			To_Phone 
		FROM `order`
		INNER JOIN `demand` ON order.Order_ID = demand.Order_ID
		INNER JOIN `product` ON demand.Product_ID = product.Product_ID
		INNER JOIN `customer` ON order.Customer_ID = customer.Customer_ID;
	";
$result = mysqli_query($conn, $sql);

//시작 데이터
$order_list = '<table>
					<tr>
						<th>주문번호</th>
						<th>주문자</th>
						<th>제품</th>
						<th>수량</th>
						<th>받는사람</th>
						<th>배송지</th>
						<th>수령인연락처</th>
						<th>선택</th>
					</tr>';

//첫번째 데이터 (radio default checked 위함)
$order_list = $order_list.'<tr>';
$row = mysqli_fetch_array($result);
$order_list = $order_list.
	'<td>'.$row['Order_ID'].'</td>'.
	'<td>'.$row['Name'].'</td>'.
	'<td>'.$row['Product_Name'].'</td>'.
	'<td>'.$row['Order_Quantity'].'</td>'.
	'<td>'.$row['To_Name'].'</td>'.
	'<td>'.$row['To_Address'].'</td>'.
	'<td>'.$row['To_Phone'].'</td>'.
	'<td><input type = "radio" name="selectedOrder" value='.
	$row['Order_ID'].' checked>'.
	'</td>';
$order_list = $order_list.'</tr>';

//첫번째 이후 데이터
while($row = mysqli_fetch_array($result)){
	$order_list = $order_list.
		'<td>'.$row['Order_ID'].'</td>'.
		'<td>'.$row['Name'].'</td>'.
		'<td>'.$row['Product_Name'].'</td>'.
		'<td>'.$row['Order_Quantity'].'</td>'.
		'<td>'.$row['To_Name'].'</td>'.
		'<td>'.$row['To_Address'].'</td>'.
		'<td>'.$row['To_Phone'].'</td>'.
		'<td><input type = "radio" name="selectedOrder" value='.
		$row['Order_ID'].'>'.
		'</td>';
	$order_list = $order_list.'</tr>';
}
$order_list = $order_list.'</tr></table>';

if ($result === false) {
		error_log(mysqli_error($conn));
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>쿠팽은 미사일배송!</title>
</head>
<style>
	table, th, td {
		border: 1px solid black;
	}
</style>
<body>
	<a href="index.php">첫 페이지로 돌아가기</a>
	<h1>주문목록</h1>
	<form action="update_or_delete.php" method="POST">
		<?=$order_list?>
		<h4>선택한 것을</h4>
		<input type="submit" name="update" value="수정">
		<input type="submit" name="delete" value="삭제">
	</form>
</body>
</html>

