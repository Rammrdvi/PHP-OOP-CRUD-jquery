<?php
require_once 'function.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $deletedata = new DB_con();
        $sql = $deletedata->delete($id);
        if ($sql) {
            // Success response
            echo json_encode(['status' => 'success', 'message' => 'Record deleted successfully']);
        } else {
            // Error response
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete record. Please try again.']);
        }
    } else {
        // Error response
        echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
    }
}
?>
