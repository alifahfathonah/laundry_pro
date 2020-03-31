<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
error_reporting(0);
include "configuration/config_etc.php";
include "configuration/config_include.php";
etc();session();connect();


$sql1="SELECT print FROM backset";
$hasil1=mysqli_query($conn,$sql1);
$row=mysqli_fetch_assoc($hasil1);
$print=$row['print'];

if($print == null || $print == ""){
  $print = 'one';
}else{
  $print=$row['print'];
}

?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="dist/plugins/print/<?php echo $print; ?>.css">
        <title>Cetak</title>

        <?php
        $decimal ="0";
        $a_decimal =",";
        $thousand =".";
        ?>

        <?php
        $nota = $_GET["nota"];

        $sql1="SELECT * FROM data";
      	$hasil1=mysqli_query($conn,$sql1);
      	$row=mysqli_fetch_assoc($hasil1);
      	$nama=$row['nama'];
        $alamat=$row['alamat'];
        $notelp=$row['notelp'];
        $tagline=$row['tagline'];
        $signature=$row['signature'];
        $avatar=$row['avatar'];

        $sql1="SELECT * FROM bayar where nota='$nota'";
        $hasil1=mysqli_query($conn,$sql1);
        $row=mysqli_fetch_assoc($hasil1);
        $tglmasuk=$row['tglmasuk'];
        $jammasuk=date('H:i', strtotime($row['jammasuk']));
        $total=$row['total'];
        $pelanggan=$row['pelanggan'];
        $kasir=$row['kasir'];
        $catatan=$row['catatan'];

        $sql1="SELECT * FROM pelanggan where kode='$pelanggan'";
        $hasil1=mysqli_query($conn,$sql1);
        $row=mysqli_fetch_assoc($hasil1);
        $namapelanggan=$row['nama'];
        $nohppelanggan=$row['nohp'];
        $alamatpelanggan=$row['alamat'];

        $sql1="SELECT SUM(jumlah) as data FROM transaksimasuk where nota='$nota'";
        $hasil1=mysqli_query($conn,$sql1);
        $row=mysqli_fetch_assoc($hasil1);
        $totalqty=$row['data'];

        ?>
<?php /////////////////////////////////////////////////////////////////
if($print == 'one' || $print == null || $print == ""){
?>

        <table class="table-header">
          <?php if($avatar == "dist/upload/index.jpg"){}else{?>
        <tr><td colspan="6" class="nama" style="width:240px"><img src="<?php echo $avatar; ?>" style="max-width:100%;"></td></tr>
            <?php } ?>
        <tr><td colspan="6" class="nama" style="font-size:16px; font-weight:bold; width:240px"><?php echo $nama;?></td></tr>
        <tr><td colspan="6" style="font-style:italic; width:240px;  "><?php echo $tagline;?></td></tr>
        <tr><td colspan="6" style="width:240px;"><?php echo $alamat;?></td></tr>
        <tr><td colspan="6" style="border-bottom:double 4px #000; padding-bottom:5px;width:240px;"><?php echo $notelp;?></td></tr>

        </table>

        <table class="table-print">
        <tr class="spa">
        <td width="20%" style="width:48px;">&nbsp;</td>
        <td width="15%" style="width:28.8px;">&nbsp;</td>
        <td width="20%"  style="width:43.2px;">&nbsp;</td>
        <td width="18%"  style="width:48px;">&nbsp;</td>
        <td width="18%"  style="width:60px;">&nbsp;</td>
        <td width="8%"  style="width:12px;">&nbsp;</td>
        </tr>
        <tr>
        </tr>

        <tr >
        	 <td style="width:192px;" colspan="6" align="center"><h2>No.Nota - <?php echo $nota;?></h2></td>
        </tr>
        <tr >
        	 <td style="width:192px;" colspan="6" align="left">Tgl Transaksi : <?php echo $tglmasuk;?> / <?php echo $jammasuk; ?></td>
         </tr>
         <tr>
           <td style="width:192px;" colspan="6" align="left">Pelanggan : <b><?php echo $namapelanggan;?></b> / <?php echo $nohppelanggan; ?></td>
         </tr>
         <tr>
           <td style="width:192px;" colspan="6" align="left"><?php echo $alamatpelanggan;?></td>
        </tr>
        <tr>
          <td style="width:192px;" colspan="6" align="left"></td>
       </tr>
           <tr class="siv solid">
          	<td colspan="6" style="width:240px;">
        	<div class="solid-border" ></div>
        </td>
          </tr>

          <?php

          $query1="SELECT * FROM  transaksimasuk where nota ='$nota' order by no";
          $hasil = mysqli_query($conn,$query1);
          while ($fill = mysqli_fetch_assoc($hasil)){
            ?>

            <tr>
              <td colspan="6" style="width:240px;"><?php  echo mysql_real_escape_string($fill['nama']); ?></td>
              </tr>

              <tr>

              <td colspan="2" style="width:76.8px;">Qty : </td>
              <td style="width:43.2px;"><?php  echo mysql_real_escape_string($fill['jumlah'].$fill['satuan']); ?></td>
              <td style="width:58px;" align="right">x <?php  echo number_format(($fill['biaya']), $decimal, $a_decimal, $thousand).',-'; ?></td>
              <td style="width:62px;" colspan="2" align="right"><?php  echo number_format(($fill['hargaakhir']), $decimal, $a_decimal, $thousand).',-'; ?></td>
              </tr>

            <tr class="siv">
              <td colspan="5" style="width:228px;">
            <div class="dotted-border"></div>	</td>
            <td style="width:12px;">(+)	</td>
            </tr>

            <?php
            ;
          }

           ?>

        <tr>
        	<td colspan="2" style="width:76.8px;">Total Qty</td>
          <td style="width:43.2px;"><?php echo round($totalqty, 1); ?></td>
        	<td style="width:48px;"><b>Total</b></td>
        	<td style="width:72px;" colspan="2" align="right"><b><?php echo number_format($total, $decimal, $a_decimal, $thousand).',-';?></b></td>
         </tr>

           <tr class="siv solid">
          	<td colspan="6" style="width:240px;">
        	<div class="solid-border" ></div>
        </td>
          </tr>

        <tr>
        	<td style="width:237px;" colspan="6" align="right"><?php echo $kasir;?></td>
          </tr>

           <tr class="siv solid">
          	<td colspan="6" style="width:240px;">
        	<div class="solid-border" ></div>
        </td>
          </tr>


                  <tr>
                  	<td style="width:240px;" colspan="6"><?php echo $catatan;?></td>
                    </tr>

                    <tr class="siv solid">
                   	<td colspan="6" style="width:240px;">
                 	<div class="solid-border" ></div>
                 </td>
                   </tr>

        <tr>
        	<td style="width:240px;" colspan="6"><pre  style="white-space: pre-line;">
          <?php echo $signature;?>
          <pre></td>
          </tr>
          <tr class="terakhir">
        	<td style="width:240px;" colspan="6"></td>
          </tr>
        </table>

<?php }else if($print == 'two'){ ?>


  <table class="table-header">
    <tr>
  <?php if($avatar == "dist/upload/index.jpg"){}else{?>
  <td colspan="6" style="width:240px"><img src="<?php echo $avatar; ?>" style="max-width:100%;"></td></tr>
  <?php } ?>
  <tr><td colspan="6" class="nama" style="font-size:22px; font-weight:bold; max-width:100%; padding-bottom:10px"><?php echo $nama;?></td></tr>
  <tr><td colspan="6" style="width:100%;"><?php echo $tagline;?></td></tr>
  <tr><td colspan="6" style="width:100%;"><?php echo $alamat;?></td></tr>
  <tr><td colspan="6" style="width:100%;">Telp <?php echo $notelp;?></td></tr>
  <tr><td colspan="6" style="border-bottom:double 4px #000; width:50%; color:white;">.</td></tr>
  <tr><td colspan="6" style="width:100%; font-size:17px; padding-bottom:20px; padding-top:10px"><b>No. Nota - <?php echo $nota;?></b></td></tr>


  </table>

  <table class="table-print">
  <tr class="spa">
  <td width="20%" style="width:196px;">&nbsp;</td>
  <td width="15%" style="width:117.6px;">&nbsp;</td>
  <td width="20%"  style="width:176.4px;">&nbsp;</td>
  <td width="18%"  style="width:196px;">&nbsp;</td>
  <td width="18%"  style="width:245px;">&nbsp;</td>
  <td width="8%"  style="width:49px;">&nbsp;</td>
  </tr>

   <tr>
     <td style="width:196px;">Pelanggan&nbsp;: </td>
     <td colspan="5" style="width:784px;"><?php echo $namapelanggan;?>		/ Tlp.&nbsp;<?php echo $nohppelanggan;?></td>
    </tr>

  <tr>
  	<td style="width:196px;">&nbsp;</td>
  	<td colspan="5" style="width:784px;"><?php echo $alamatpelanggan;?> </td>
    </tr>

  <tr >
  	<td style="width:196px;">Transaksi&nbsp;: </td>
  	 <td style="width:784px; padding-bottom:15px;" colspan="5" align="left"><?php echo $tglmasuk;?> / <?php echo $jammasuk; ?></td>
  </tr>


     <tr class="divid divsolid">
    	<td colspan="6" style="width:100%;"><div class="solid-border" ></div></td>
    </tr>

    <?php

    $query1="SELECT * FROM  transaksimasuk where nota ='$nota' order by no";
    $hasil = mysqli_query($conn,$query1);
    while ($fill = mysqli_fetch_assoc($hasil)){
      ?>

    <tr>
    	<td colspan="2" style="width:313.6px;"><?php echo $fill['nama']; ?></td>
    	<td style="width:176.4px;"><?php echo $fill['jumlah'].' '.$fill['satuan']; ?> </td>
    	<td style="width:196px;" align="right">x <?php echo number_format($fill['biaya'], $decimal, $a_decimal, $thousand).',-';?></td>
    	<td style="width:294px;" colspan="2" align="right"><?php echo number_format($fill['hargaakhir'], $decimal, $a_decimal, $thousand).',-';?></td>
      </tr>

      <tr class="divid">
    	  	<td colspan="5" style="width:931px;">
    		<div class="dotted-border" ></div>	</td>
    		<td style="width:49px;">(+)	</td>
    	  </tr>


          <?php
    				  }

    ?>


  <tr>
  	<td colspan="3" style="width:490px;"><b>Total  : </b></td>
  	<td style="width:196px;">&nbsp;</td>
  	<td style="width:294px;" colspan="2" align="right"><b><?php echo number_format($total, $decimal, $a_decimal, $thousand).',-';?></b></td>
   </tr>

     <tr class="divid divsolid"><td colspan="6" style="width:100%;"><div class="solid-border" ></div></td></tr>

     <tr>
      <td style="width:100%;" colspan="6" align="right"><?php echo $kasir;?></td>
      </tr>

      <tr class="divid divsolid"><td colspan="6" style="width:100%;"><div class="solid-border" ></div></td></tr>
      <td style="width:980px;" colspan="6" align="left"><pre><?php echo $catatan;?></pre></td>
      <tr class="divid divsolid"><td colspan="6" style="width:100%;"><div class="solid-border" ></div></td></tr>


  <tr>
  	<td style="width:313.6px;" colspan="3"></td>
  	<td style="width:666.4px;" colspan="3" align="right"></td>
    </tr>


  <tr><td style="width:980px;" colspan="6"><pre><?php echo $signature;?></pre></td></tr>

    <tr class="terakhir"><td style="width:100%;" colspan="6"></td></tr>

    </table>

<?php } ?>

        <script>

          setTimeout(function(){window.print()}, 2000);
           </script>
