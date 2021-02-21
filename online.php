
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 
if(isset($_GET['del']))
{
$id=$_GET['del'];
$sql = "select from tblbooks  WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();
$_SESSION['delmsg']="Category deleted scuccessfully ";
header('location:manage-books.php');

}
    ?>


						<?php 
							$db = new PDO("mysql:host=localhost;dbname=library", "root", "");
							$stmt = $db->prepare("select * from tblbooks WHERE CatId = $catid");
							$stmt->execute();
							while($row=$stmt->fetch()){
						 ?>
						 <tr>
							<td> <?php echo $row['id'] ?></td>
							<td> <?php echo $row['BookName'] ?></td>	
							<td> <?php echo $row['ISBNNumber'] ?></td> 
						 </tr>
						 <?php 
						 	}
						  ?>






						  
					<td> <?php echo $row['Status'] ?></td> 
