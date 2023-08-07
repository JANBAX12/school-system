<?php
//connect to database
require 'connectDB.php';

if (isset($_POST['FingerID'])) {

    $fingerID = $_POST['FingerID'];

    // Check if the fingerprint already exists
    $sql = "SELECT * FROM users WHERE fingerprint_id =?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)){
        echo "SQL_error_select_card ";
        exit();
    }
    else{
        mysqli_stmt_bind_param($result, "s", $fingerID);
        mysqli_stmt_execute($result);
        $result1 = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($result1)){
            //*****************************************************
            //An existed fingerprint has been detected for Login or Logout
            if (!empty($row['teacherName'])){
                $teName = $row['teacherName'];
                $subject = $row['subject'];
                $teacherIDnu = $row['teacherIDnumber'];
                $gender = $row['gender'];
                $sql = "SELECT * FROM teacher_logs WHERE fingerprint_id =? AND checkindate=CURDATE() AND timeout=''";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)){
                    echo "SQL_error_select_logs ";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($result, "s", $fingerID);
                    mysqli_stmt_execute($result);
                    $result1 = mysqli_stmt_get_result($result);
                    //*****************************************************
                    //login
                    if (!mysqli_fetch_assoc($result1)){

                        $sql = "INSERT INTO teacher_logs (fingerprint_id, teacherName, subject, teacherIDnumber, checkindate) VALUES (?,?,?,?, CURDATE())";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)){
                            echo "SQL_error_insert_login1 ";
                            exit();
                        }
                        else{
                            $timeout = "";
                            mysqli_stmt_bind_param($result, "ssss", $fingerID, $teName, $subject, $teacherIDnu);
                            mysqli_stmt_execute($result);

                            echo "login".$teName;
                            exit();
                        }
                    }
                    //*************
                    //logout
                    else{
                        $sql="UPDATE teacher_logs SET timeout=CURDATE() WHERE fingerprint_id =? AND checkindate=CURDATE()";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)){
                            echo "SQL_error_insert_logout1";
                            exit();
                        }
                        else{
                            mysqli_stmt_bind_param($result, "s", $fingerID);
                            mysqli_stmt_execute($result);

                            echo "logout".$teName;
                            exit();
                        }
                    }
                }
            }
            //**********************
            //An available Fingerprint has been detected
            else{
                $sql = "SELECT * FROM users WHERE fingerprint_select =1";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)){
                    echo "SQL_Error_select";
                    exit();
                }
                else{
                    mysqli_stmt_execute($result);
                    $result1 = mysqli_stmt_get_result($result);

                    if ($row = mysqli_fetch_assoc($result1)){
                        $sql = "UPDATE users SET fingerprint_select=0";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)){
                            echo "SQL_Error_update";
                            exit();
                        }
                        else{
                            mysqli_stmt_execute($result);

                            $sql="UPDATE users SET fingerprint_select=1 WHERE fingerprint_id =? AND teacherName =''";
                            $result = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($result, $sql)){
                                echo "SQL_Error_update_select";
                                exit();
                            }
                            else{
                                mysqli_stmt_bind_param($result, "s", $fingerID);
                                mysqli_stmt_execute($result);

                                echo "select";
                                exit();
                            }
                        }
                    }
                }
            }
        }
        //****************************
        //The fingerprint is not registered
        else{
            // Insert the new fingerprint into the database
            $sql = "INSERT INTO users (fingerprint_id, fingerprint_select) VALUES (?, 1)";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)){
                echo "SQL_error_insert_fingerprint ";
                exit();
            }
            else{
                mysqli_stmt_bind_param($result, "s", $fingerID);
                mysqli_stmt_execute($result);

                echo "inserted";
                exit();
            }
        }
    }
}

if (isset($_POST['del_fingerID'])) {

    $fingerID = $_POST['del_fingerID'];

    $sql = "SELECT * FROM users WHERE fingerprint_select =1 AND teacherName =''";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)){
        echo "SQL_Error_select_del";
        exit();
    }
    else{
        mysqli_stmt_execute($result);
        $result1 = mysqli_stmt_get_result($result);

        if ($row = mysqli_fetch_assoc($result1)){
            $sql="UPDATE users SET del_fingerid =0 WHERE del_fingerid =?";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)){
                echo "SQL_Error_update_del";
                exit();
            }
            else{
                mysqli_stmt_bind_param($result, "s", $fingerID);
                mysqli_stmt_execute($result);

                echo "delete";
                exit();
            }
        }
    }
}

mysqli_close($conn);