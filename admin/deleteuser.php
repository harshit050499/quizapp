
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php 
		
	include('connection.php');
	$check=$db->prepare('SELECT * FROM user_details');
	$data=array();
	$check->execute($data);
	?>
	<table>
		<tr>
			<th>NAME</th>
			<th>EMAIL</th>
			<th>ROLE</th>
			<th>ACTION</th>
		</tr>
	<?php
	while($datarow = $check->fetch())
	{
	?>
		<tr>
			<td><?php echo $datarow['name'];?></td>
			<td><?php echo $datarow['email'];?></td>
			<td><?php echo $datarow['status'];?></td>
			<td><a href="delete.php?id=<?php echo $datarow['id']?>">DELETE</a></td>
		</tr>
	<?php
	}
	?>
	</table>
	<?php
?>
</body>
</html>