<?php
include 'conn.php';

session_start();

if (isset($_POST['EmpDeleteBtn'])) {
    $id = $_POST['delete_id'];

    $query = "DELETE FROM employeefile WHERE recid='$id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        $_SESSION['success1'] = "Deleted Successfully";
        $_SESSION['status_code'] = "success";

        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
        echo '<script type="text/javascript">';
        echo 'document.addEventListener("DOMContentLoaded", function() {';
        echo 'Swal.fire({';
        echo 'title: "SUCCESSFULLY DELETED!",';
        echo 'icon: "success"';
        echo '}).then(() => {window.location.href="../admin/crud.php";});';
        echo '});';
        echo '</script>';
    }
    else{
        echo "Error: " . mysqli_error($conn); 
    }
}


?>