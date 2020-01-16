<?php 
include_once('../../mangaku/conn.php');
include_once('../../mangaku/templates/templateschapter.php');
$sql = "SELECT * FROM `image` WHERE chapter = '$title'";
$query = mysqli_query($conn, $sql);
include('../../mangaku/templates/header.php');
?>
<body>
<div style="background: black;">
	<center>
	<?php 
	while ($row = mysqli_fetch_array($query)){
	echo '<img src="'.$row['image'].'">';
	}
	?>
	</center>
</div>
</body>
<?php 
include('../../mangaku/templates/footer.php');
?>