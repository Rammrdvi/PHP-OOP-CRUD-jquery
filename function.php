<?php
session_start();

class DB_con {
    private $db;

    // Constructor to establish database connection
    function __construct() {
        $this->db = new mysqli('localhost', 'root', '', 'oopscrud');
        if ($this->db->connect_errno) {
            die("Failed to connect to MySQL: " . $this->db->connect_error);
        }
    }

    // Function to insert data into the database
    public function insert($fname, $lname, $emailid, $contactno, $address) {
        $query = "INSERT INTO tblusers (FirstName, LastName, EmailId, ContactNumber, Address) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssss", $fname, $lname, $emailid, $contactno, $address);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Function to fetch all data from the database
    public function fetchdata() {
        $result = $this->db->query("SELECT * FROM tblusers");
        return $result;
    }

    // Function to fetch a single record from the database
    public function fetchonerecord($userid)
{
    $sql = "SELECT * FROM tblusers WHERE id=?";
    $stmt = $this->db->prepare($sql);
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        return $result;
    } else {
        return false; // Return false if no record found or query failed
    }
}


    // Function to update data in the database
    public function update($fname, $lname, $emailid, $contactno, $address, $userid) {
        $query = "UPDATE tblusers SET FirstName=?, LastName=?, EmailId=?, ContactNumber=?, Address=? WHERE id=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssssi", $fname, $lname, $emailid, $contactno, $address, $userid);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Function to delete a record from the database
    public function delete($rid) {
        $result = $this->db->query("DELETE FROM tblusers WHERE id='$rid'");
        return $result;
    }
}

?>
