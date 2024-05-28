<?php
require_once 'function.php';

$updatedata = new DB_con();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $userid = intval($_GET['id']);
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $emailid = $_POST['emailid'];
    $contactno = $_POST['contactno'];
    $address = $_POST['address'];
    
    $sql = $updatedata->update($fname, $lname, $emailid, $contactno, $address, $userid);
    
    if ($sql) {
        echo json_encode(["status" => "success", "message" => "Record updated successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Something went wrong. Please try again"]);
    }
    exit();
}
?>

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
            <h3>Update Record | PHP CRUD Operations using PHP OOP</h3>
            <hr />
        </div>
    </div>

    <form id="updaterecord" name="updaterecord" method="post">
        <?php
        $userid = intval($_GET['id']);
        $onerecord = new DB_con();
        $sql = $onerecord->fetchonerecord($userid);
        while($row = mysqli_fetch_array($sql)) {
        ?>
        <div class="row">
            <div class="col-md-4"><b>First Name</b>
                <input type="text" id="firstname" name="firstname" value="<?php echo htmlentities($row['FirstName']);?>" class="form-control">
            </div>
            <div class="col-md-4"><b>Last Name</b>
                <input type="text" id="lastname" name="lastname" value="<?php echo htmlentities($row['LastName']);?>" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"><b>Email id</b>
                <input type="email" id="emailid" name="emailid" value="<?php echo htmlentities($row['EmailId']);?>" class="form-control">
            </div>
            <div class="col-md-4"><b>Contactno</b>
                <input type="text" id="contactno" name="contactno" value="<?php echo htmlentities($row['ContactNumber']);?>" class="form-control" maxlength="10">
            </div>
        </div>
        <div class="row">
            <div class="col-md-8"><b>Address</b>
                <textarea id="address" class="form-control" name="address"><?php echo htmlentities($row['Address']);?></textarea>
            </div>
        </div>
        <?php } ?>
        <div class="row" style="margin-top:1%">
            <div class="col-md-8">
                <input type="button" id="update" name="update" value="Update" class="btn btn-primary">
            </div>
        </div>
    </form>           

    <br>
    <div class="alert alert-danger" role="alert" id="alert">
        This is a danger alert—check it out!
    </div>
</div>

<script>
$(document).ready(function() {
    $("#alert").hide();

    $("#update").click(function() {
        // Fetch values from input fields
        var firstname = $("#firstname").val();
        var lastname = $("#lastname").val();
        var emailid = $("#emailid").val();
        var contactno = $("#contactno").val();
        var address = $("#address").val();

        // Validate input fields
        if (firstname == "" || firstname.length < 4) {
            showAlert("Please enter a valid first name (at least 4 characters).");
            return false;
        }
        if (lastname == "" || lastname.length < 1) {
            showAlert("Please enter a valid last name (at least 1 characters).");
            return false;
        }
        if (emailid == "" || !validateEmail(emailid)) {
            showAlert("Please enter a valid email address.");
            return false;
        }
        if (contactno == "" || contactno.length != 10 || !$.isNumeric(contactno)) {
            showAlert("Please enter a valid contact number (10 digits).");
            return false;
        }
        if (address == "" || address.length < 5) {
            showAlert("Please enter a valid address (at least 5 characters).");
            return false;
        }

        // AJAX request
        $.ajax({
            url: '', // Assuming the form and the PHP script are in the same file
            type: 'POST',
            data: {
                firstname: firstname,
                lastname: lastname,
                emailid: emailid,
                contactno: contactno,
                address: address,
                update: true
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    showAlert(response.message, 'success');
                    setTimeout(function() {
                        window.location.href = 'index.php';
                    }, 3000); // Redirect after 3 seconds
                } else {
                    showAlert(response.message, 'danger');
                }
            },
            error: function() {
                showAlert('Something went wrong. Please try again.', 'danger');
            }
        });
    });

    function showAlert(message, type) {
        $("#alert").html(message).removeClass().addClass('alert alert-' + type).show();
        setTimeout(function() {
            $("#alert").fadeOut();
        }, 5000); // Hide after 5 seconds
    }

    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@(([^<>()[\]\.,;:\s@"]+\.)+[^<>()[\]\.,;:\s@"]{2,})$/i;
        return re.test(String(email).toLowerCase());
    }
});
</script>

</body>
</html>
