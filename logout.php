<?php
session_start();
// error_reporting(0);

// include "configuration/config_etc.php" ;
include "configuration/config_include.php" ;
connect(); timing();
$_GET['logout'] = '';
$logout = $_GET['logout'];

error_reporting(0);
if($logout<>null){

  $jam = date("H:i");
  $tanggal = date("Y-m-d");

  $user = $_SESSION['username'];
  $sql1 = "UPDATE loglogin SET tgllogout='$tanggal',jamlogout='$jam',status='offline' WHERE username = '$user' AND status='online'";
  $hasil = mysqli_query($conn, $sql1);


session_unset();
session_destroy();
?>
<meta http-equiv="refresh" content="0;  url='login" />
<?php
}else{

  session_start();

  $jam = date("H:i");
  $tanggal = date("Y-m-d");

  $user = $_SESSION['username'];
  $sql1 = "UPDATE loglogin SET tgllogout='$tanggal',jamlogout='$jam',status='offline' WHERE username = '$user' AND status='online'";
  $hasil = mysqli_query($conn, $sql1);


session_unset();
session_destroy();
// header("Location : login");
}

if($logout==null){

  // session_start();

  $jam = date("H:i");
  $tanggal = date("Y-m-d");

  $user = $_SESSION['username'];
  $sql1 = "UPDATE loglogin SET tgllogout='$tanggal',jamlogout='$jam',status='offline' WHERE username = '$user' AND status='online'";
  $hasil = mysqli_query($conn, $sql1);

session_unset();
session_destroy();
?>
<meta http-equiv="refresh" content="0;  url='login'" />
<?php
}
?>
