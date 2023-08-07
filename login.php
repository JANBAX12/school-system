<!DOCTYPE html>
<html lang="eng">
    <meta charset="utf-8">
    <head>
        <link rel="stylesheet" type="text/css" href="login.css">
        <script src="login.js"></script>
    <!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</head>
<?php include 'header.php'; ?>
<form action="login.php" method="post>
    <label for="username">username</label>
    <input type="text" name="username" id="username" /><br>
    <label for="password">password:</label>
    <input type="password" name="password" id="password" /><br>
    <input type="submit" value="Login" />
</form>
<?php
session_start();
require_once('db.php');//connect to database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password_'];

    $query = "SELECT * FROM users WHERE username = '$username' AND password_ = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
    //valid credentials, create a session and redirect to home page
    $_SESSION['username'] = $username;
    header(('location:index.php'));
    } else {
    //invalid credentials, redirect to login page
    $error = "Invalid username or password";
    }
}
?>