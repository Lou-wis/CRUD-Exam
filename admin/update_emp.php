<?php
include 'conn.php';

session_start();

if(isset($_POST['updateEmp'])){
    $id = $_POST['id'];
    $fullname = $_POST['Ufullname'];
    $address = $_POST['Uaddress'];
    $birthdate = $_POST['Ubirthdate'];
    $age = $_POST['Uage'];
    $gender = $_POST['Ugender'];
    $civilstat = $_POST['UcivilStatus'];
    $contact = $_POST['Ucontact'];
    $salary = $_POST['Usalary'];
    $active = $_POST['Uactive'];

    $query = "UPDATE employeefile SET fullname='$fullname', address='$address', birthdate='$birthdate', age='$age', gender='$gender', civilstat='$civilstat', contactnum='$contact', salary='$salary', isactive='$active' WHERE recid='$id'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
        echo '<script type="text/javascript">';
        echo 'document.addEventListener("DOMContentLoaded", function() {';
        echo 'Swal.fire({';
        echo 'title: "SUCCESSFULLY UPDATED!",';
        echo 'icon: "info"';
        echo '}).then(() => {window.location.href="../admin/crud.php";});';
        echo '});';
        echo '</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}



?>