<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html">
<title>Authentication Web Services</title>
</head>

<body>
<?php
// edit here
$client = new SoapClient("wsdl/auth.wsdl");
//$client = new SoapClient("http://10.24.9.246/web_services_auth/server/auth/auth.php");
$username = "seal_swrc";
$pwd="12345678";

echo '<h3> call function create User </h3>';
echo $client->userCreate($username,$pwd);
?>
</body>
</html>