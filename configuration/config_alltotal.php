<?php
include 'config_connect.php';
date_default_timezone_set("Asia/Jakarta");
$harisekarang=date('d');
$bulansekarang=date('m');
$tahunsekarang=date('Y');
$hariini=date('Y-m-d');


// Total Data1

$sqlx2="SELECT COUNT(userna_me) as data FROM user";
$hasilx2=mysqli_query($conn,$sqlx2);
$row=mysqli_fetch_assoc($hasilx2);
$datax1=$row['data'];

// Total Data2

$sqlx2="SELECT COUNT(kode) as data FROM pelanggan";
$hasilx2=mysqli_query($conn,$sqlx2);
$row=mysqli_fetch_assoc($hasilx2);
$datax2=$row['data'];

// Total Data3

$sqlx2="SELECT COUNT(kode) as data FROM jenis";
$hasilx2=mysqli_query($conn,$sqlx2);
$row=mysqli_fetch_assoc($hasilx2);
$datax3=$row['data'];

// Total Data4

$sqlx2="SELECT COUNT(kode) as data FROM satuan";
$hasilx2=mysqli_query($conn,$sqlx2);
$row=mysqli_fetch_assoc($hasilx2);
$datax4=$row['data'];


// Total Data1 ------------------------------------------------------------------

$sqlx2="SELECT SUM(jumlah) AS data FROM transaksimasuk WHERE nota IN (SELECT nota FROM bayar WHERE tglmasuk = '$hariini') AND satuan LIKE 'k%g%'";
$hasilx2=mysqli_query($conn,$sqlx2);
$row=mysqli_fetch_assoc($hasilx2);
$dataxx1=round($row['data'],1);

if($dataxx1==null){
  $dataxx1 = '0';
}

// Total Data2

$sqlx2="SELECT SUM(jumlah) AS data FROM transaksimasuk WHERE nota IN (SELECT nota FROM bayar WHERE tglmasuk = '$hariini') AND satuan LIKE 'm%'";
$hasilx2=mysqli_query($conn,$sqlx2);
$row=mysqli_fetch_assoc($hasilx2);
$dataxx2=$row['data'];

if($dataxx2==null){
  $dataxx2 = '0';
}
// Total Data3

$sqlx2="SELECT COUNT(nota) as data FROM bayar WHERE nota IN (SELECT nota FROM transaksimasuk) AND tglmasuk = '$hariini' AND status != 'batal'";
$hasilx2=mysqli_query($conn,$sqlx2);
$row=mysqli_fetch_assoc($hasilx2);
$dataxx3=$row['data'];

// Total Data4

$sqlx2="SELECT COUNT(nota) as data FROM bayar WHERE nota IN (SELECT nota FROM transaksimasuk) AND status != 'batal'";
$hasilx2=mysqli_query($conn,$sqlx2);
$row=mysqli_fetch_assoc($hasilx2);
$dataxx4=$row['data'];



// Total Data1-------------------------------------------------------------------

  // Total Data1 ------------------------------------------------------------------

  $sqlx2="SELECT COUNT(nota) as data FROM bayar WHERE nota NOT IN (SELECT nota FROM transaksimasuk)";
	$hasilx2=mysqli_query($conn,$sqlx2);
	$row=mysqli_fetch_assoc($hasilx2);
	$data1=$row['data'];

  // Total Data2

  $sqlx2="SELECT COUNT(nota) as data FROM bayar WHERE nota IN (SELECT nota FROM transaksimasuk)";
  $hasilx2=mysqli_query($conn,$sqlx2);
  $row=mysqli_fetch_assoc($hasilx2);
  $data2=$row['data'];

  // Total Data3

  $sqlx2="SELECT COUNT(nota) as data FROM bayar WHERE nota IN (SELECT nota FROM transaksimasuk) AND tglmasuk LIKE '$tahunsekarang-$bulansekarang-%'";
  $hasilx2=mysqli_query($conn,$sqlx2);
  $row=mysqli_fetch_assoc($hasilx2);
  $data3=$row['data'];

  // Total Data4

  $sqlx2="SELECT COUNT(nota) as data FROM bayar WHERE nota IN (SELECT nota FROM transaksimasuk) AND tglmasuk = '$hariini'";
  $hasilx2=mysqli_query($conn,$sqlx2);
  $row=mysqli_fetch_assoc($hasilx2);
  $data4=$row['data'];



  // Total Data1-------------------------------------------------------------------

  $sqlx2="SELECT SUM(total) AS data FROM bayar WHERE nota IN (SELECT nota FROM transaksimasuk) and status='lunas'";
	$hasilx2=mysqli_query($conn,$sqlx2);
	$row=mysqli_fetch_assoc($hasilx2);
	$data12=$row['data'];

  // Total Data2

  $sqlx2="SELECT SUM(total) AS data FROM bayar WHERE nota IN (SELECT nota FROM transaksimasuk) AND tglmasuk LIKE '$tahunsekarang-%' and status='lunas'";
  $hasilx2=mysqli_query($conn,$sqlx2);
  $row=mysqli_fetch_assoc($hasilx2);
  $data22=$row['data'];

  // Total Data3

  $sqlx2="SELECT SUM(total) AS data FROM bayar WHERE nota IN (SELECT nota FROM transaksimasuk) AND tglmasuk LIKE '$tahunsekarang-$bulansekarang-%' and status='lunas'";
  $hasilx2=mysqli_query($conn,$sqlx2);
  $row=mysqli_fetch_assoc($hasilx2);
  $data32=$row['data'];

  // Total Data4

  $sqlx2="SELECT SUM(total) AS data FROM bayar WHERE nota IN (SELECT nota FROM transaksimasuk) AND tgllunas = '$hariini' and status='lunas'";
  $hasilx2=mysqli_query($conn,$sqlx2);
  $row=mysqli_fetch_assoc($hasilx2);
  $data42=$row['data'];

  // Total Belum L-------------------------------------------------------------------

  $sqlx2="SELECT SUM(total) AS data FROM bayar WHERE nota IN (SELECT nota FROM transaksimasuk) and status!='lunas'";
	$hasilx2=mysqli_query($conn,$sqlx2);
	$row=mysqli_fetch_assoc($hasilx2);
	$datax12=$row['data'];

  // Total Data2

  $sqlx2="SELECT SUM(total) AS data FROM bayar WHERE nota IN (SELECT nota FROM transaksimasuk) AND tglmasuk LIKE '$tahunsekarang-%' and status!='lunas'";
  $hasilx2=mysqli_query($conn,$sqlx2);
  $row=mysqli_fetch_assoc($hasilx2);
  $datax22=$row['data'];

  // Total Data3

  $sqlx2="SELECT SUM(total) AS data FROM bayar WHERE nota IN (SELECT nota FROM transaksimasuk) AND tglmasuk LIKE '$tahunsekarang-$bulansekarang-%' and status!='lunas'";
  $hasilx2=mysqli_query($conn,$sqlx2);
  $row=mysqli_fetch_assoc($hasilx2);
  $datax32=$row['data'];

  // Total Data4

  $sqlx2="SELECT SUM(total) AS data FROM bayar WHERE nota IN (SELECT nota FROM transaksimasuk) AND tglmasuk = '$hariini' and status!='lunas'";
  $hasilx2=mysqli_query($conn,$sqlx2);
  $row=mysqli_fetch_assoc($hasilx2);
  $datax42=$row['data'];

  // Total Data1-------------------------------------------------------------------

  // Total Data1-------------------------------------------------------------------

  $sqlx2="SELECT SUM(biaya) AS data FROM operasional";
	$hasilx2=mysqli_query($conn,$sqlx2);
	$row=mysqli_fetch_assoc($hasilx2);
	$data14=$row['data'];

  // Total Data2

  $sqlx2="SELECT SUM(biaya) AS data FROM operasional WHERE tanggal LIKE '$tahunsekarang-%'";
  $hasilx2=mysqli_query($conn,$sqlx2);
  $row=mysqli_fetch_assoc($hasilx2);
  $data24=$row['data'];

  // Total Data3

  $sqlx2="SELECT SUM(biaya) AS data FROM operasional WHERE tanggal LIKE '$tahunsekarang-$bulansekarang-%'";
  $hasilx2=mysqli_query($conn,$sqlx2);
  $row=mysqli_fetch_assoc($hasilx2);
  $data34=$row['data'];

  // Total Data4

  $sqlx2="SELECT SUM(biaya) AS data FROM operasional WHERE tanggal = '$hariini'";
  $hasilx2=mysqli_query($conn,$sqlx2);
  $row=mysqli_fetch_assoc($hasilx2);
  $data44=$row['data'];


?>
