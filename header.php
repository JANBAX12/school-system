<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link href="css/font-awesome.css" rel="stylesheet">
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="bootstrap.css">
    <script src="js/bootstrap.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<style>
    body{
        background-image: url("image/background.jpg");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>
<header>
<div class="logoA-container">
    <img src="$" alt="school" class="logoA">
</div>
<style>
.logoA {
    height: 10%;
    width: 15%;
    aspect-ratio: 4/3;
    object-fit: contain;
    background-color: transparent;
}
.logoA-container {
    background-color: transparent;
}
</style>
    <div class="header">
        <div class="logo">
            <a>attendance system</a>
        </div>
    </div>

    <div class="topnav" id="myTopnav">
        <a href="login.php">login</a>
        <a href="index.php">students</a>
        <a href="UsersLog.php">students Log</a>
        <a href="ManageUsers.php">Manage students</a>
        <a href="administer.php">teachers</a>
        <a href="javascript:void(0);" class="icon" onclick="navFunction()">
            <i class="fa fa-bars"></i></a>
    </div>
</header>
<script>
function navFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>