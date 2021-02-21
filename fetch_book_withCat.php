<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title>Defence University Collage of Engineering Library Management System</title>
	<!-- BOOTSTRAP CORE STYLE  -->
	<link href="assets/css/bootstrap.css" rel="stylesheet" />
	<!-- FONT AWESOME STYLE  -->
	<link href="assets/css/font-awesome.css" rel="stylesheet" />
	<!-- DATATABLE STYLE  -->
	<link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
	<!-- CUSTOM STYLE  -->
	<link href="assets/css/style.css" rel="stylesheet" />
	<!-- GOOGLE FONT -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<?php include('includes/header.php');?>
    <style>
        #BookA:hover{
            background-color: #48d1cc;
/*            cursor: pointer;
*/        }
    </style>
</head>

<body>
	<div id="mytable" class="container" style="margin-top:20px;">
		<div class="row">
			<div class="col-md-6">
				<h2><strong style="text-decoration: underline;">List of Available Books</strong></h2><br>
				<table id="table_format" class="table table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>Category Name</th>
						<th>Status</th>
						<th>Creation Date</th>
						<th>Udate Date</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$db = new PDO("mysql:host=localhost;dbname=library", "root", "");
						$stmt = $db->prepare("select * from tblcategory");
						$stmt->execute();
						while($row=$stmt->fetch()){
					 ?>
					 <tr id = 'BookA'>
						<td> <?php 
						$catid = $row['id']; 
						echo $row['id'] ?></td>

						<?php $idd = $row['id']; echo "<td onmouseover='loadList({$idd});'>" . $row['CategoryName'] ?> </td>
						<td  class="center"><?php if($row['Status']==1) { ?>
	                                            <a href="#" class="btn btn-success btn-xs">Active</a>
	                                            <?php } else {?>
	                                            <a href="#" class="btn btn-danger btn-xs">Inactive</a>
	                                            <?php } ?></td>
						<td> <?php echo $row['CreationDate'] ?></td>	
						<td> <?php echo $row['UpdationDate'] ?></td> 	
					 </tr>
					<?php
					}
				  ?>
				</tbody>
			</table>
			</div>
			<div class="col-md-6" id="bookListContainer">
				
			</div>
		</div>	
	</div>
	<?php include('includes/footer.php');?>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="ddtf.js"></script>
<script>
// jQuery('#table_format').ddTableFilter();
</script>
<script type="text/javascript">
	// $('mytable').ddTableFilter();
	window.loadList = function(catId){
		$.post('fetch_books.php',{catId: catId}).done(function(data){
			// console.log(data);
			$('#bookListContainer').html(data);
		});
	}
</script>

</body>
</html>
<?php } ?>
