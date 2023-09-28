<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html">
<title>Authentication Web Services</title>
</head>

<body>
<?php
// edit here
if (isset($_GET['username']) && isset($_GET['pwd'])) {
    $username = $_GET['username'];
    $pwd = $_GET['pwd'];

    $client = new SoapClient("http://10.24.9.246/web_services_auth/server/auth/auth.php");
    
    echo '<h3>Call function user&password authenticate</h3>';
    echo $client->usrPwdAuth($username, $pwd);
} else {
    echo '<h3>Call function user&password authenticate</h3>';
    echo "Username and password parameters are missing in the URL.";
}
?>

</body>
</html>