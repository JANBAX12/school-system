<!DOCTYPE html>
<html>

<head>
    <title>teachers Logs</title>
    <link rel="stylesheet" type="text/css" href="header.css">
    <link rel="stylesheet" type="text/css" href="css/teachers.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link href="css/font-awesome.css" rel="stylesheet">
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.js"></script>
    <script>
    $(window).on("load resize ", function() {
        var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
        $('.tbl-header').css({
            'padding-right': scrollWidth
        });
    }).resize();
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha1256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous">
    </script>
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/teachers_log.js"></script>
    <script>
    $(document).ready(function() {
        $.ajax({
            url: "teachers_log_up.php",
            type: 'POST',
            data: {
                'select_date': 1,
            }
        });
        setInterval(function() {
            $.ajax({
                url: "teachers_log_up.php",
                type: 'POST',
                data: {
                    'select_date': 0,
                }
            }).done(function(data) {
                $('#teachersLog').html(data);
            });
        }, 5000);
    });
    </script>
</head>

<body>
    <?php include 'header.php';?>
    <main>
        <section>
            <!--teacher table-->
            <h1 class="slideInDown animated">Here are the Users daily logs</h1>
        </section>
    </main>
</body>
</html>