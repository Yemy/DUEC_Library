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

    <style>
        #BookA:hover{
            background-color: #48d1cc;
        }
    </style>
</head>
<body>

<?php
$catId=intval($_POST['catId']);
$sql = "SELECT * FROM tblcategory WHERE id=$catId";
$query = $dbh -> prepare($sql);
$query->execute();

$results=$query->fetchAll(PDO::FETCH_OBJ);
              ?>                           
<br>
    <div class="content-wrapper" style="margin-top:100px;margin-right: 0px;">
         <div class="container" class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <!-- Advanced Tables -->
                    <div   style="background-color:#48d1cc; " class="panel panel-default">
                            <?php 
                                if($query->rowCount() > 0){
                                    foreach($results as $result1){ 
                             ?>
                         <div class="panel-heading">
                            <h4> Books Under:<?php echo htmlentities($result1->CategoryName);
                                }} ?></h4>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr class="bookHead">
                                            <th>#</th>
                                            <th>Book Name</th>
                                            <th>Category</th>
                                            <th>Author</th>
                                            <th>ISBN</th>
                                            <th>Price</th>
                                            <th>#Available Books </th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$sql = "SELECT * FROM tblbooks WHERE CatId=$catId";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>                                      
                                        <tr class="odd gradeX">
                                            <td class="center"><?php echo htmlentities($cnt);?></td>
                                            <td  class="center"><?php echo htmlentities($result->BookName);?></td>
                                            <td class="center"> <?php echo htmlentities($result1->CategoryName);?></td>
                                           <td class="center"><?php 
                                                $sql2 = "SELECT * FROM tblauthors WHERE id=$result->AuthorId";
                                                $query2 = $dbh -> prepare($sql2);
                                                $query2->execute();
                                                $results2=$query2->fetchAll(PDO::FETCH_OBJ);
                                                if($query2->rowCount() > 0){
                                                foreach($results2 as $result2){
                                                echo htmlentities($result2->AuthorName);}}?></td>
                             
                                            <td class="center"><?php echo htmlentities($result->ISBNNumber);?></td>
                                            <td class="center"><?php echo htmlentities($result->BookPrice);?></td>
                                            <td class="center"><?php echo htmlentities($result->nofbooks);?></td>              
                                        </tr>
 <?php $cnt=$cnt+1;}} ?>                                      
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
 
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>
