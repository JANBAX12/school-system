<?php
// connect to database
require 'connectDB_teachers.php';

// select passenger
if (isset($_GET['select'])) {

     $Finger_id = $_GET['finger_id'];

     $sql = "SELECT fingerprint_select FROM teacher WHERE fingerprint_select=1";
     $result = mysqli_stmt_init($conn);
     if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_error_select";
        exit();
     }
     else{
        mysqli_stmt_execute($result);
        $result1 = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($result1)) {

            $sql="UPDATE teacher SET fingerprint_select=0";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
                echo "SQL_error_select";
                exit();
            }
            else{
                mysqli_stmt_execute($result);

                $sql="UPDATE teacher SET fingerprint_select=1 WHERE fingerprint_id=?";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)){
                    echo "SQL_error_select_Fingerprint";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($result, "s", $Finger_id);
                    mysqli_stmt_execute($result);

                    echo "teacher fingerprint selected";
                    exit();
                }
            }
        }
        else{
            $sql="UPDATE teacher SET fingerprint_select=1 WHERE fingerprint_id?";
            $result = mysqli_Stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)){
                echo "SQL_error_select_Fingerprint";
                exit();
            }
            else{
                mysqli_stmt_bind_param($result, "s", $Finger_id);
                mysqli_stmt_execute($result);

                echo "teacher Fingerprint selected";
                exit();
            }
        }
    }
}
if (isset($_POST['Add'])) {

    $teName = $_POST['name'];
    $subject = $_POST['subject'];
    $teacherIDnu = $_POST['teacherIDnumber'];
    $Email = $_POST['email'];
    $phoneNu = $_POST['phone number'];

    //optional
    $Timein = $_POST['timein'];
    $Timeout = $_POST['timeout'];
    $gender = $_POST['gender'];

    //check if there any selected  teacher
    $sql = "SELECT teacherName FROM teacher WHERE fingerprint_select=1";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_error";
        exit();
    }
    else{
        mysqli_stmt_execute($result);
        $result1 = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($result1)) {

            if (empty($row['teacherName'])) {

                if (!empty($teName) && !empty($subject) && !empty($teacherIDnu) && !empty($Email) && !empty($phoneNu)) {
                    // check if there any teacher had already the serial number
                    $sql = "SELECT teacherIDnumber FROM teacher WHERE teacherIDnumber=?";
                    $result = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($result, $sql)) {
                        echo "SQL_error";
                        exit();
                    }
                    else{
                        mysqli_stmt_bind_param($result, "d", $teacherIDnu);
                        mysqli_stmt_execute($result);
                        $result1 = mysqli_stmt_get_result($result);
                        if (!$row = mysqli_fetch_assoc($result1)){
                            $sql="UPDATE teacher SET teacherName = ?, subject=?, teacherIDnumber=?, gender=?, phoneNumber=?, email=?, user_date=CURDATE(), time_in=?, time_out=?, WHERE fingerprint_select=1";
                            $result = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($result, $sql)) {
                                echo "SQL_Error_select_Fingerprint";
                                exit();
                            }
                            else{
                                mysqli_stmt_bind_param($result, "sssssssss", $teName, $subject, $teacherIDnu, $gender, $phoneNu, $Email, $Timein, $Timeout);
                                mysqli_stmt_execute($result);

                                echo "A new teacher has been added!";
                                exit();
                            }
                        }
                        else{
                            echo "the serial number is already taken!";
                            exit();
                        }
                    }
                }
                else{
                    echo "Please fill all the fields!";
                    exit();
                }
            }
            else{
                echo "this fingerprint is already added!";
                exit();
            }
        }
        else{
            echo "there's no selected fingerprint";
            exit();
        }
    }
}
//Add selected fingerprint
if (isset($_POST['Add_fingerID'])) {

    $fingerid = $_POST['finger_id'];

    if ($fingerid == 0) {
        echo "Enter a Fingerprint ID!";
        exit();
    }
    else{
        if ($fingerid > 0 && $fingerid < 1000){
            $sql = "SELECT fingerprint_id FROM teacher WHERE fingerprint_id=?";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
                echo "SQL_error";
                exit();
            }
            else{
                mysqli_stmt_bind_param($result, "d", $fingerid);
                mysqli_stmt_execute($result);
                $result1 = mysqli_stmt_get_result($result);
                if (!$row = mysqli_fetch_assoc($result1)){

                    $sql = "SELECT add_fingerid FROM teacher WHERE add_fingerid=1";
                    $result =mysqli_stmt_init($conn);
                    if (!mysqli_Stmt_prepare($result, $sql)){
                        echo "SQL_error";
                        exit();
                    }
                    else{
                        mysqli_stmt_execute($result);
                        $result1 = mysqli_stmt_get_result($result);
                        if ($row = mysqli_fetch_assoc($result1)){
                            $sql = "INSERT INTO teacher (fingerprint_id, add_fingerid) VALUES (?, 1)";
                            $result = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($result, $sql)){
                                echo "SQL_error";
                                exit();
                            }
                            else{
                                mysqli_stmt_bind_param($result, "i", $fingerid);
                                mysqli_stmt_execute($result);
                                echo "The ID is ready to get a new Fingerprint";
                                exit();
                            }
                        }
                        else{
                            echo "you can't add more than one ID each time";
                        }
                    }
                }
                else{
                    echo "this ID is already exists!";
                    exit();
                }
            }
        }
        else{
            echo "the fingerprint ID must be between 1 & 1000";
            exit();
        }
    }
}
// update an existence teacher
if (isset($_POST['update_teacher'])){

    $teName = $_POST['teacher Name'];
    $subject = $_POST['subject Name'];
    $teacherIDnu = $_POST['Teacher Serial Number'];
    $phoneNumber = $_POST['teacher Phone'];
    $Email = $_POST['teacher email'];

    //optional parameters
    $Timein = $_POST['timein'];
    $Timeout = $_POST['timeout'];
    $gender = $_POST['gender'];

    if ($teacherIDnu == 0){
        $teacherIDnu = -1;
    }
    // check if there any selected teacher
    $sql = "SELECT * FROM teacher WHERE fingerprint_select=1";
    $result = mysqli_stmt_init($conn,);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error";
        exit();
    }
    else{
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)) {

            if (empty($row['teacher name'])) {
                echo "First, you need to add the teacher!";
                exit();
            }
            else{
                if (empty($teName) && empty($subject) && empty($teacherIDnu) && empty($Email) && empty($Timein) && empty($timeout)) {
                    echo "Empty fields";
                    exit();
                }else
                {
                    //check if there any teacher had already the serial Number
                    $sql = "SELECT teacherSerialNumber FROM teachers WHERE TeacherSerialNumber=?";
                    $result = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($result, $sql)) {
                        echo "SQL Error";
                        exit();
                    }
                    else{
                        mysqli_stmt_bind_param($result, "d", $phoneNumber);
                        mysqli_stmt_execute($result);
                        $resultl = mysqli_stmt_get_result($result);
                        if (!$row = mysqli_fetch_assoc($result1)){

                            if (!empty($teName) && !empty($subject) && !empty($teacherIDnu) && !empty($phoneNumber) && !empty($Email) && !empty($Timein) && !empty($timeout)){

                                $sql="UPDATE teacher SET teacherName=?, subjectName=?, TeacherSerialNumber=?, teacherPhone=?, gender=?, email=?, time_in=?, time_out=?, WHERE fingerprint_select=1";
                                $result = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($result, $sql)) {
                                    echo "SQL Error_select_Fingerprint";
                                    exit();
                                }
                                else{
                                    mysqli_stmt_bind_param($result, "sids", $teName, $subject, $teacherIDnu, $phoneNumber, $Gender, $Email, $Timein );
                                    mysqli_stmt_execute($result);

                                    echo "The selected teacher has been updated";
                                    exit();
                                }
                            }
                            else{
                                if (!empty($Timein)) {
                                    $sql="UPDATE teacher SET gender=?, time_in=? WHERE fingerprint_select=1";
                                    $result = mysqli_stmt_init($conn);
                                    if (!mysqli_stmt_prepare($result, $sql)) {
                                        echo "SQL Error select Fingerprint";
                                        exit();
                                    }
                                    else{
                                        mysqli_stmt_bind_param($result, "ss", $gender, $Timein );
                                        mysqli_stmt_execute($result);

                                        echo "The selected teacher has been updated!";
                                        exit();
                                    }
                                }
                                else{
                                    echo "The Teacher Time in is empty!";
                                    exit();
                                }
                                if (!empty($timeout)){
                                    $sql="UPDATE teacher SET gander=?, time_out=? WHERE fingerprint_select=1";
                                    $result = mysqli_stmt_init($conn);
                                    if (!mysqli_stmt_prepare($result, $sql)) {
                                        echo "SQL Error Select Fingerprint";
                                        exit();
                                    }
                                    else{
                                        mysqli_stmt_bind_param($result, "ss", $gender, $Timein, $timeout);
                                        mysqli_stmt_execute($result);

                                        echo "The selected teacher has been updated";
                                        exit();
                                    }
                                }
                                else{
                                    echo "The Teacher Time In is empty!";
                                    exit();
                                }
                            }
                        }
                        else{
                            echo "The serial number is already taken!";
                            exit();
                        }
                    }
                }
            }
        }
        else{
            echo "There's no selected User to update!";
            exit();
        }
    }
    // delete user
    if (isset($_POST['delete'])) {

        $sql = "SELECT fingerprint_select FROM teachers WHERE fingerprint_select=1";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo "SQL_Error_select";
            exit();
        }
        else{
            mysqli_stmt_execute($result);
            $result1 = mysqli_stmt_get_result($result);
            if ($row = mysqli_fetch_assoc($result1)) {
                $sql="UPDATE teachers SET TeachersName='', subjectName='', Teacher SerialNumber='', teacherPhone='', gender='', email='', time_in='', del_fingerid=1 WHERE fingerprint_select=1";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_delete";
                    exit();
                }
                else{
                    mysqli_stmt_execute($result);
                    echo "The User Fingerprint has been deleted";
                    exit();
                }
            }
            else{
                echo "select a User to remove";
                exit();
            }
        }
    }
}
?>

