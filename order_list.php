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

echo $order_list;

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
		<table>
			<tr>
				<th>주문번호</th>
				<th>주문자</th>
				<th>제품</th>
				<th>수량</th>
				<th>받는사람</th>
				<th>배송지</th>
				<th>수령인연락처</th>
				<th>선택</th>
			</tr>
			<tr>
				<td>103</td>
				<td>황혁주</td>
				<td>횡성한우</td>
				<td>2</td>
				<td>김남석</td>
				<td>김해시 장유면</td>
				<td>010-1111-2222</td>
				<td><input type="radio" name="selectedOrder" value='1' checked></td>
			</tr>
			<tr>
				<td>299</td>
				<td>황혁주</td>
				<td>황사마스크</td>
				<td>5</td>
				<td>박준수</td>
				<td>진주시 가좌동</td>
				<td>010-3333-4444</td>
				<td><input type="radio" name="selectedOrder" value='2'></td>
			</tr>
			<tr>
				<td>564</td>
				<td>이자룡</td>
				<td>햇반</td>
				<td>1</td>
				<td>최이삭</td>
				<td>대전시 은행동</td>
				<td>010-5555-6666</td>
				<td><input type="radio" name="selectedOrder" value='3'></td>
			</tr>
		</table>

		<h4>선택한 것을</h4>
		<input type="submit" name="update" value="수정">
		<input type="submit" name="delete" value="삭제">
	</form>
</body>
</html>

