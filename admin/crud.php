<!DOCTYPE html>
<html lang="en">

<?php
include "head.php";
include "navbar.php";
?>

<body>
    <div class="container mt-3">
        <h1 id="main_title" class="text-center">EMPLOYEE CREDENTIALS</h1>

        <div class="d-flex justify-content-end mb-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddModal">ADD NAMES</button>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered mt-2">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fullname</th>
                        <th>Address</th>
                        <th>Birthdate</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Civil Stat</th>
                        <th>Contact</th>
                        <th>Salary</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include "conn.php";

                    $query = "SELECT * FROM `employeefile`";
                    $query_run = mysqli_query($conn, $query);

                    if ($query_run) {
                        foreach ($query_run as $row) {
                    ?>
                        <tr>
                            <td><?php echo $row['recid']; ?></td>
                            <td><?php echo $row['fullname']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['birthdate']; ?></td>
                            <td><?php echo $row['age']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['civilstat']; ?></td>
                            <td><?php echo $row['contactnum']; ?></td>
                            <td><?php echo $row['salary']; ?></td>
                            <td><?php echo $row['isactive']; ?></td>
                            <td text-align="center">
                                <button class="btn btn-primary updatebtn">Update</button>
                                <button class="btn btn-danger delBtn">Delete</button>
                            </td>    
                        </tr>
                        <?php
                                }
                        } else {
                        echo "No Record Found";
                        }
                        ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ADD Modal -->
    <div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Employee</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="insert_emp.php">
                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input type="text" name="fullname" class="form-control" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control">
                            </div>

                            <div class="form-group mt-3">
                                <label for="birthdate">Birthdate</label>
                                <input type="date" id="birthdate" name="birthdate" class="form-control" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="age">Age</label>
                                <input type="number" id="age" name="age" class="form-control" required>
                            </div>

                            <div class="form-group mt-3">
                                <label for="gender">Gender</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="genderMale" value="male" required>
                                    <label class="form-check-label" for="genderMale">Male</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="female" required>
                                    <label class="form-check-label" for="genderFemale">Female</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="genderOther" value="other" required>
                                    <label class="form-check-label" for="genderOther">Other</label>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label for="civilStatus">Civil Status</label>
                                <select class="form-control" id="civilStatus" name="civilStatus" required>
                                    <option value="" disabled selected>Select your civil status</option>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="widowed">Widowed</option>
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <label for="contact">Contact No.</label>
                                <input type="text" name="contact" id="contact" class="form-control" pattern="[0-9]*" title="Please enter only digits" required>
                                <small class="text-muted">Only digits allowed (0-9).</small>
                            </div>


                            <div class="form-group mt-3">
                                <label for="salary">Salary</label>
                                <input type="number" step="0.01" name="salary" id="salary" class="form-control" required>
                            </div>


                            <div class="form-group mt-3">
                                <label for="active">Active</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="active" name="active" value="1">
                                    <label class="form-check-label" for="active">
                                        Active
                                    </label>
                                </div>
                            </div>

                            <div class="modal-footer mt-3">
                                <button type="submit" class="btn btn-success" name="submit">Add</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <!-- UPDATE Modal -->
    <div class="modal fade" id="UpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Name</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="update_emp.php">
                            <input type="hidden" id="id" name="id" required>

                            <div class="form-group">
                                    <label for="fullname">Full Name</label>
                                    <input type="text" id="Ufullname" name="Ufullname" class="form-control" required>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="address">Address</label>
                                    <input type="text" id="Uaddress" name="Uaddress" class="form-control">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="birthdate">Birthdate</label>
                                    <input type="date" id="Ubirthdate" name="Ubirthdate" class="form-control" required>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="age">Age</label>
                                    <input type="number" id="Uage" name="Uage" class="form-control" required>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="gender">Gender</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="Ugender" id="UgenderMale" value="male" required>
                                        <label class="form-check-label" for="genderMale">Male</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="Ugender" id="UgenderFemale" value="female" required>
                                        <label class="form-check-label" for="genderFemale">Female</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="Ugender" id="UgenderOther" value="other" required>
                                        <label class="form-check-label" for="genderOther">Other</label>
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="civilStatus">Civil Status</label>
                                    <select class="form-control" id="UcivilStatus" name="UcivilStatus" required>
                                        <option value="" disabled selected>Select your civil status</option>
                                        <option value="single">Single</option>
                                        <option value="married">Married</option>
                                        <option value="widowed">Widowed</option>
                                    </select>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="contact">Contact No.</label>
                                    <input type="text" id="Ucontact" name="Ucontact" class="form-control">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="salary">Salary</label>
                                    <input type="text" id="Usalary" name="Usalary" class="form-control">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="active">Active</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="Uactive" name="Uactive" value="1">
                                        <label class="form-check-label" for="active">
                                            Active
                                        </label>
                                    </div>
                                </div>

                                <div class="modal-footer mt-3">
                                    <input type="submit" name="updateEmp" value="Save Changes" class="btn btn-primary">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    <!-- DELETE MODAL START -->
    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="delete_emp.php">
                        <input type="hidden" name="delete_id" id="delete_id">
                        <div class="modal-body">
                            <h4>Are you sure you want to remove this employee?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="EmpDeleteBtn" name="EmpDeleteBtn" class="btn btn-primary">Confirm</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

   

<?php
include 'footer.php';
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('.updatebtn').click(function() {
        var $row = $(this).closest('tr');
        var rowData = $row.find('td').map(function() {
            return $(this).text().trim();
        }).get();

        $('#id').val(rowData[0]);
        $('#Ufullname').val(rowData[1]);
        $('#Uaddress').val(rowData[2]);
        $('#Ubirthdate').val(rowData[3]);
        $('#Uage').val(rowData[4]);
        
        // Handle gender selection
        var gender = rowData[5].toLowerCase();
        $('input[name="Ugender"]').prop('checked', false); 
        $('input[name="Ugender"][value="' + gender + '"]').prop('checked', true); 

        $('#UcivilStatus').val(rowData[6]);
        $('#Ucontact').val(rowData[7]);
        $('#Usalary').val(rowData[8]);
        
        // Handle checkbox (Active status)
        var isActive = parseInt(rowData[9]);
        $('#Uactive').prop('checked', isActive === 1);

        $('#UpdateModal').modal('show');
    });

    $('.delBtn').on('click', function() {
        $('#DeleteModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        console.log(data);

        $('#delete_id').val(data[0]);
    });
});
</script>

</body>
</html>
