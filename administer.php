
<!DOCTYPE html>
<html lang="en">
    <head>
    <title>administration</title>
    <link rel="stylesheet" type="text/css" href="css/admin.css">
    <script>
    $(window).on("load resize ", function() {
        var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
        $('.tbl-header').css({
            'padding-right': scrollWidth
        });
    }).resize();
    </script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<?php include 'header.php'?>
    <body>
        <nav class="header">
            <div class="nav">
                <div class="topnav"id="myTopnav">
                    <a href="teachers_bar.php">teachers dashboard</a>
                    <a href="manage_techers.php">manage teachers</a>
                    <a href="teachersActivity.php">teachers_attendance</a>
                    <a href="javascript:void(0);" class="icon" onclick="navFunction()">
                    <i class="fa fa-bars"></i></a>
                </div>
            </div>
    <main>
        <section>
            <!--teachers table-->
            <h1 class="slideInDown animated">Here are all teachers</h1>
            <div class="tbl-header slideInRight animated">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <th> Name</th>
                            <th>subject</th>
                            <th>Serial Number</th>
                            <th>Gender</th>
                            <th>Finger ID</th>
                            <th>Date</th>
                            <th>Time In</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content slideInRight animated">
                <table cellpadding="0" cellspacing="0"border="0">
                    <tbody>
                        <?php
                        //connect to database connection
                        require'connectDB.php';

                $sql = "SELECT * FROM users WHERE NOT teachersName='' ORDER BY id DESC";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)){
                    echo '<p class="error">SQL Error</p>';
                }
                else{
                    mysqli_stmt_execute($result);
                    $result1 = mysqli_stmt_get_result($result);
                    if (mysqli_num_rows($resultl) > 0){
                        while ($row = mysqli_fetch_assoc($resultl)){
                ?>
                            <TR>
                                <TD><?php echo $row['teacherName'];?></TD>
                                <TD><?php echo $row['subject'];?></TD>
                                <TD><?php echo $row['teacherIDnumber'];?></TD>
                                <TD><?php echo $row['gender'];?></TD>
                                <TD><?php echo $row['teacher_date'];?></TD>
                                <TD><?php echo $row['time_in'];?></TD>
                                <TD><?php echo $row['time_out'];?></TD>
                            </TR>
                            <?php
                        }
                    }
                }
                ?>
                    </tbody>
                </table>
            </div>
            </section>
    </main>
    <footer>
  <p>&copy; 2023 demass.solutions</p>
</footer>
</body>
</html>