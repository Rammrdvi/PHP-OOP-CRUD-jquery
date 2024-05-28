<?php
require_once'function.php';

if(isset($_GET['del']))
    {
// Get delete row by id
$rid=$_GET['del'];
$deletedata=new DB_con();
$sql=$deletedata->delete($rid);
if($sql)
{
// Message for successfully deleted
echo "<script>alert('Record deleted successfully');</script>";
echo "<script>window.location.href='index.php'</script>";
}
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CRUD Operations OOP Concept By using PHP </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        
    </style>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://getbootstrap.com/dist/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center">PHP CRUD Operations using PHP OOP</h3>
            <hr />
            <a href="insert.php" class="btn btn-success mb-3">Insert Record</a>
            <div class="table-responsive">                
                <table id="mytable" class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th>Posting Date</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $fetchdata = new DB_con();
                    $sql = $fetchdata->fetchdata();
                    $sno = 1;
                    while ($row = mysqli_fetch_array($sql)) {
                    ?>
                        <tr>
                            <td><?php echo htmlentities($sno); ?></td>
                            <td><?php echo htmlentities($row['FirstName']); ?></td>
                            <td><?php echo htmlentities($row['LastName']); ?></td>
                            <td><?php echo htmlentities($row['EmailId']); ?></td>
                            <td><?php echo htmlentities($row['ContactNumber']); ?></td>
                            <td><?php echo htmlentities($row['Address']); ?></td>
                            <td><?php echo htmlentities($row['PostingDate']); ?></td>
                            <td>
                                <a href="update.php?id=<?php echo htmlentities($row['id']); ?>" class="btn btn-primary btn-sm">
                                    <span class="glyphicon glyphicon-pencil"></span> Edit
                                </a>
                            </td>
                            <td>
                                <a href="index.php?del=<?php echo htmlentities($row['id']); ?>" class="btn btn-danger btn-sm" onClick="return confirm('Do you really want to delete');">
                                    <span class="glyphicon glyphicon-trash"></span> Delete
                                </a>
                            </td>
                        </tr>
                    <?php
                        $sno++;
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


</body>
</html>