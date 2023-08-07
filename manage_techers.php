<!DOCTYPE html>
<html>

<head>
    <title>manage teachers</title>
    <link rel="stylesheet" type="text/css" href="css/manage_teachers.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.cs">
    <link rel="stylesheet" type="text/css" href="css/manageusers.css">

    <script>
        $(window).on("load resize ", function() {
        var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
        $('.tbl-header').css({
            'padding-right': scrollWidth
        });
    }).resize();
    </script>
</head>

<body>

    <?php include 'header.php';?>
    <main>
        <h1 class="slideInDown animated">add a new teacher or update information</h1>
        <div class="form-style-5 slideInDown animated">
            <div class="alert">
                <label id="alert"></label>
            </div>
            <form>
                <fieldset>
                    <legend><span class="number">1</span> teachers fingerprint ID</legend>
                    <label>Enter fingerprint ID between 1 & 1000:</label>
                    <input type="number" id="fingerprint_id" name="fingerprint_id" placeholder="Enter fingerprint ID">
                    <label id="fingerprint_id_error"></label>
                    <button type="button" name="fingerid_add" class="fingerid_add">Add fingerprint ID</button>
                </fieldset>
                <fieldset>
                    <legend><span class="number">2</span> teacher info</legend>
                    <input type="text" id="teachers_name" name="teachers_name" placeholder="teachers name">
                    <label id="teachers_name_error"></label>
                    <input type="text" id="teachers_subject" name="teachers_subject" placeholder="teachers subject">
                    <label id="teachers_subject_error"></label>
                    <input type="text" id="teachers_phone" name="teachers_phone" placeholder="teachers phone">
                    <input type="text" id="teachers_email" name="teachers_email" placeholder="teachers email">
                    <label id="teachers_email_error"></label>
                    <input type="number" id="teachers_serial_number" name="teachers_serial_number" placeholder="serial number">
                    <label id="teachers_serial_number_error"></label>
                </fieldset>
                <fieldset>
                    <legend><span class="number">3</span>Additional Info</legend>
                    <label>
                        Time In:
                        <input type="time" id="teachers_time_in" name="teachers_time_in" placeholder="time in">
                        Time Out:
                        <input type="time" id="teachers_time_out" name="teachers_time_out" placeholder="time out">
                        <label id="teachers_time_in_error"></label>
                        <label id="teachers_time_out_error"></label>
                        <input type="radio" name="gender" class="gender" value="Female">Female
                        <input type="radio" name="gender" class="gender" value="Male" checked="checked">Male
                        <label id="teachers_gender_error"></label>
                    </label>
                </fieldset>
                    <button type="button" class="teacher_add" class="teacher_add">Add teacher</button>
                    <button type="button" class="teacher_update" class="teacher_update">Update teacher</button>
                    <button type="button" class="teacher_delete" class="teacher_delete">Delete teacher</button>
            </form>
        </div>
        <div class="section">
            <!--teacher table-->
            <div class="tbl-header slideInRight animated">
                <table>
                    <thead>
                        <tr>
                            <th>Fingerprint ID</th>
                            <th>Name</th>
                            <th>Subject</th>
                            <th>Phone</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Serial Number</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content">
                <table>
                    <tbody>
                        <tr>
                        <td>1</td>
                        <td><NAME></td>
                        <td><SUBJECT></td>
                        <td><PHONE></td>
                        <td><GENDER></td>
                        <td><EMAIL></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>