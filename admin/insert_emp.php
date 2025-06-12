<?php
include 'conn.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $civilstat = $_POST['civilStatus'];
    $contactnum = $_POST['contact'];
    $salary = $_POST['salary'];
    $isactive = isset($_POST['active']) ? 1 : 0;

    $sql = "INSERT INTO `employeefile` (`fullname`, `address`, `birthdate`, `age`, `gender`, `civilstat`, `contactnum`, `salary`, `isactive`) 
            VALUES ('$fullname', '$address', '$birthdate', '$age', '$gender', '$civilstat', '$contactnum', '$salary', '$isactive')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
        echo '<script type="text/javascript">';
        echo 'document.addEventListener("DOMContentLoaded", function() {';
        echo 'Swal.fire({';
        echo 'title: "SUCCESSFULLY INSERTED!",';
        echo 'icon: "success"';
        echo '}).then(() => {window.location.href="../admin/crud.php";});';
        echo '});';
        echo '</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} 

?>
