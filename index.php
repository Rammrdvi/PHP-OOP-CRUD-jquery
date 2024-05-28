<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CRUD Operations OOP Concept By using PHP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3 class="text-center">PHP CRUD Operations using PHP OOP</h3>
            <hr />
            <a href="insert.php" class="btn btn-success mb-3">Insert Record</a>
            <div class="table-responsive">                

            <!-- Validation alert message condition start-->
            <?php if (isset($_GET['message']) && isset($_GET['type'])): ?>
                <div class="alert alert-<?php echo ($_GET['type'] == 'success') ? 'success' : 'danger'; ?>" role="alert" id="responseAlert">
                    <?php echo htmlspecialchars($_GET['message']); ?>
                </div>
                <script>
                    $(document).ready(function() {
                        setTimeout(function() {
                            $("#responseAlert").fadeOut();
                        }, 5000); // Hide after 5 seconds
                    });
                </script>
            <?php endif; ?>
            <!-- Validation alert message condition End-->

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
                require_once 'function.php';
                $fetchdata = new DB_con();
                $sql = $fetchdata->fetchdata();
                $sno = 1;
                while ($row = mysqli_fetch_array($sql)) {
                ?>
                    <tr id="row_<?php echo $row['id']; ?>">
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
                            <button class="btn btn-danger btn-sm delete-record" data-id="<?php echo htmlentities($row['id']); ?>">
                                <span class="glyphicon glyphicon-trash"></span> Delete
                            </button>
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

<script>
$(document).ready(function() {
    $('.delete-record').click(function() {
        var id = $(this).data('id');
        if (confirm('Do you really want to delete')) {
            $.ajax({
                url: 'delete.php',
                type: 'POST',
                data: { id: id },
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status == 'success') {
                        $('#row_' + id).remove();
                        showAlert(res.message, 'success');
                    } else {
                        showAlert(res.message, 'danger');
                    }
                },
                error: function() {
                    showAlert('Something went wrong. Please try again.', 'danger');
                }
            });
        }
    });

    function showAlert(message, type) {
        var alertBox = '<div class="alert alert-' + type + '" role="alert" id="responseAlert">' + message + '</div>';
        $('.container').prepend(alertBox);
        setTimeout(function() {
            $("#responseAlert").fadeOut();
        }, 5000); // Hide after 5 seconds
    }
});
</script>
</body>
</html>
