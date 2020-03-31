<!DOCTYPE html>
<html>
<?php
include "configuration/config_etc.php";
include "configuration/config_include.php";
include "configuration/config_alltotal.php";
etc();encryption();session();connect();head();body();timing();
pagination();
?>

<?php
if (!login_check()) {
?>
<meta http-equiv="refresh" content="0; url=logout" />
<?php
exit(0);
}
?>
<div class="wrapper">
<?php
theader();
menu();
?>

<!-- SETTING START-->

<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include "configuration/config_chmod.php";
$halaman = "report_customer"; // halaman
$dataapa = "Laporan Laundry Pelanggan"; // data
$tabeldatabase = "bayar"; // tabel database
$chmod = $chmenu9; // Hak akses Menu
$forward = mysql_real_escape_string($tabeldatabase); // tabel database
$forwardpage = mysql_real_escape_string($halaman); // halaman
$bulan = $_GET['bulan'];
$pelanggan = $_GET['pelanggan'];

?>

<!-- SETTING STOP -->

<?php
$decimal ="0";
$a_decimal =",";
$thousand =".";
?>
            <div class="content-wrapper">
                <section class="content-header">
</section>
                <section class="content">

                                      <?php

                                      // Total Pendapatan dr Customer-------------------------------------------------------------------

                                      $sqlx2="SELECT SUM(total) AS data FROM bayar WHERE nota IN (SELECT nota FROM transaksimasuk) and pelanggan='$pelanggan'";
                                    	$hasilx2=mysqli_query($conn,$sqlx2);
                                    	$row=mysqli_fetch_assoc($hasilx2);
                                    	$datau12=$row['data'];

                                      // Total Data2

                                      $sqlx2="SELECT SUM(total) AS data FROM bayar WHERE nota IN (SELECT nota FROM transaksimasuk) AND tglmasuk LIKE '$tahunsekarang-%' and pelanggan='$pelanggan'";
                                      $hasilx2=mysqli_query($conn,$sqlx2);
                                      $row=mysqli_fetch_assoc($hasilx2);
                                      $datau22=$row['data'];

                                      // Total Data3

                                      $sqlx2="SELECT SUM(total) AS data FROM bayar WHERE nota IN (SELECT nota FROM transaksimasuk) AND tglmasuk LIKE '$tahunsekarang-$bulansekarang-%' and pelanggan='$pelanggan'";
                                      $hasilx2=mysqli_query($conn,$sqlx2);
                                      $row=mysqli_fetch_assoc($hasilx2);
                                      $datau32=$row['data'];

                                      // Total Data4

                                      $sqlx2="SELECT SUM(total) AS data FROM bayar WHERE nota IN (SELECT nota FROM transaksimasuk) AND tglmasuk = '$hariini' and pelanggan='$pelanggan'";
                                      $hasilx2=mysqli_query($conn,$sqlx2);
                                      $row=mysqli_fetch_assoc($hasilx2);
                                      $datau42=$row['data'];

                                      // Total TRX dr Customer-------------------------------------------------------------------

                                      $sqlx2="SELECT COUNT(nota) AS data FROM bayar WHERE nota IN (SELECT nota FROM transaksimasuk) and pelanggan='$pelanggan'";
                                      $hasilx2=mysqli_query($conn,$sqlx2);
                                      $row=mysqli_fetch_assoc($hasilx2);
                                      $datai12=$row['data'];

                                      // Total Data2

                                      $sqlx2="SELECT COUNT(nota) AS data FROM bayar WHERE nota IN (SELECT nota FROM transaksimasuk) AND tglmasuk LIKE '$tahunsekarang-%' and pelanggan='$pelanggan'";
                                      $hasilx2=mysqli_query($conn,$sqlx2);
                                      $row=mysqli_fetch_assoc($hasilx2);
                                      $datai22=$row['data'];

                                      // Total Data3

                                      $sqlx2="SELECT COUNT(nota) AS data FROM bayar WHERE nota IN (SELECT nota FROM transaksimasuk) AND tglmasuk LIKE '$tahunsekarang-$bulansekarang-%' and pelanggan='$pelanggan'";
                                      $hasilx2=mysqli_query($conn,$sqlx2);
                                      $row=mysqli_fetch_assoc($hasilx2);
                                      $datai32=$row['data'];

                                      // Total Data4

                                      $sqlx2="SELECT COUNT(nota) AS data FROM bayar WHERE nota IN (SELECT nota FROM transaksimasuk) AND tglmasuk = '$hariini' and pelanggan='$pelanggan'";
                                      $hasilx2=mysqli_query($conn,$sqlx2);
                                      $row=mysqli_fetch_assoc($hasilx2);
                                      $datai42=$row['data'];



                                       ?>


                  <div class="row">
                    <div class="col-lg-3 col-xs-6">
                                       <!-- small box -->
                                       <div class="small-box bg-aqua">
                                           <div class="inner">
                                               <h3><sup style="font-size: 20px">Rp </sup><?php echo number_format($datau12, $decimal, $a_decimal, $thousand).',-'; ?></h3>
                                               <p>Total Semua</p>
                                           </div>
                                           <div class="icon">
                                             <i class="ion ion-stats-bars"></i>
                                           </div>

                                       </div>
                                   </div>
                                   <!-- ./col -->
                                   <div class="col-lg-3 col-xs-6">
                                       <!-- small box -->
                                       <div class="small-box bg-yellow">
                                           <div class="inner">
                                               <h3><sup style="font-size: 20px">Rp </sup><?php echo number_format($datau22, $decimal, $a_decimal, $thousand).',-'; ?></h3>
                                               <p>Total Tahun Ini</p>
                                           </div>
                                           <div class="icon">
                                              <i class="ion ion-stats-bars"></i>
                                           </div>

                                       </div>
                                   </div>
                                   <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                                       <!-- small box -->
                                       <div class="small-box bg-green">
                                           <div class="inner">
                                               <h3><sup style="font-size: 20px">Rp </sup><?php echo number_format($datau32, $decimal, $a_decimal, $thousand).',-'; ?></h3>
                                               <p>Total Bulan Ini</p>
                                           </div>
                                           <div class="icon">
                                               <i class="ion ion-stats-bars"></i>
                                           </div>

                                       </div>
                                   </div>
                                   <!-- ./col -->
                                   <div class="col-lg-3 col-xs-6">
                                       <!-- small box -->
                                       <div class="small-box bg-red">
                                           <div class="inner">
                                               <h3><sup style="font-size: 20px">Rp </sup><?php echo number_format($datau42, $decimal, $a_decimal, $thousand).',-'; ?></h3>
                                               <p>Total Hari Ini</p>
                                           </div>
                                           <div class="icon">
                                               <i class="ion ion-stats-bars"></i>
                                           </div>

                                       </div>
                                   </div>
                  </div>


                  <div class="row">
                    <div class="col-lg-3 col-xs-6">
                                       <!-- small box -->
                                       <div class="small-box bg-info">
                                           <div class="inner">
                                               <h3><?php echo $datai12; ?><sup style="font-size: 20px">Trx</sup></h3>
                                               <p>Total Semua Trx</p>
                                           </div>
                                           <div class="icon">
                                             <i class="ion ion-flash"></i>
                                           </div>

                                       </div>
                                   </div>
                                   <!-- ./col -->
                                   <div class="col-lg-3 col-xs-6">
                                       <!-- small box -->
                                       <div class="small-box bg-warning">
                                           <div class="inner">
                                               <h3><?php echo $datai22; ?><sup style="font-size: 20px">Trx</sup></h3>
                                               <p>Total Trx Tahun Ini</p>
                                           </div>
                                           <div class="icon">
                                              <i class="ion ion-flash"></i>
                                           </div>

                                       </div>
                                   </div>
                                   <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                                       <!-- small box -->
                                       <div class="small-box bg-success">
                                           <div class="inner">
                                               <h3><?php echo $datai32; ?><sup style="font-size: 20px">Trx</sup></h3>
                                               <p>Total Trx Bulan Ini</p>
                                           </div>
                                           <div class="icon">
                                               <i class="ion ion-flash"></i>
                                           </div>

                                       </div>
                                   </div>
                                   <!-- ./col -->
                                   <div class="col-lg-3 col-xs-6">
                                       <!-- small box -->
                                       <div class="small-box bg-danger">
                                           <div class="inner">
                                               <h3><?php echo $datai42; ?><sup style="font-size: 20px">Trx</sup></h3>
                                               <p>Total Trx Hari Ini</p>
                                           </div>
                                           <div class="icon">
                                               <i class="ion ion-flash"></i>
                                           </div>

                                       </div>
                                   </div>
                  </div>
                    <div class="row">
					  <div class="col-lg-12">



<textarea id="printing-css" style="display:none;">.no-print{display:none}</textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script type="text/javascript">
function printDiv(elementId) {
 var a = document.getElementById('printing-css').value;
 var b = document.getElementById(elementId).innerHTML;
 window.frames["print_frame"].document.title = document.title;
 window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
 window.frames["print_frame"].window.focus();
 window.frames["print_frame"].window.print();
}
</script>

<!-- BREADCRUMB -->


<!-- BOX HAPUS BERHASIL -->

         <script>
 window.setTimeout(function() {
    $("#myAlert").fadeTo(500, 0).slideUp(1000, function(){
        $(this).remove();
    });
}, 5000);
</script>


       <!-- BOX INFORMASI -->
    <?php
if ($chmod == '1' || $chmod == '2' || $chmod == '3' || $chmod == '4' || $chmod == '5' || $_SESSION['jabatan'] == 'admin') {
} else {
?>
   <div class="callout callout-danger">
    <h4>Info</h4>
    <b>Hanya user tertentu yang dapat mengakses halaman <?php echo $dataapa;?> ini .</b>
    </div>
    <?php
}
?>

<?php
if ($chmod >= 1 || $_SESSION['jabatan'] == 'admin') {
?>

<?php
if($pelanggan == null || $pelanggan == "" ){
        $sqla="SELECT no, COUNT( * ) AS totaldata FROM $forward where nota IN (SELECT nota FROM transaksimasuk) and pelanggan = '$pelanggan'";
      }else{
        $sqla="SELECT no, COUNT( * ) AS totaldata FROM $forward where nota IN (SELECT nota FROM transaksimasuk) and pelanggan = '$pelanggan' ";
      }
		$hasila=mysqli_query($conn,$sqla);
		$rowa=mysqli_fetch_assoc($hasila);
		$totaldata=$rowa['totaldata'];

?>


          <div class="box" id="tabel1">

            <div class="box-header">
            <h3 class="box-title">Data <?php echo $dataapa ?>  <span class="no-print label label-default" id="no-print"><?php echo $totaldata; ?></span>
					</h3>

			  <form method="get">
			  <br/>
                    <div class="col-lg-12 col-md-12 col-sm-12 no-print" id="no-print">


  <div class="col-lg-3 col-md-3 col-sm-3">
    <select class="form-control select2" style="width: 100%;" name="pelanggan" onchange="this.form.submit()" required>
      <option value=""></option>
<?php
$sql=mysqli_query($conn,"select * from pelanggan where kode != '1'");
while ($row=mysqli_fetch_assoc($sql)){
if ($pelanggan==$row['kode'])
echo "<option value='".$row['kode']."' selected='selected'>".$row['nama'].' '.$row['kode']."</option>";
else
echo "<option value='".$row['kode']."'>".$row['nama'].' '.$row['kode']."</option>";
}
?>
    </select>

</div>

  <div class="col-lg-6 col-md-6 col-sm-6">
  <?php
$sqlb="SELECT SUM(total) AS total FROM $forward WHERE nota IN (SELECT nota FROM transaksimasuk) AND pelanggan = '$pelanggan' ";
$hasila=mysqli_query($conn,$sqlb);
$rowa=mysqli_fetch_assoc($hasila);
$totalrevenue=$rowa['total'];

$sqlb="SELECT nama FROM pelanggan WHERE kode = '$pelanggan' ";
$hasila=mysqli_query($conn,$sqlb);
$rowa=mysqli_fetch_assoc($hasila);
$namapelanggan=$rowa['nama'];

   ?>

<?php if($pelanggan != null || $pelanggan != ""){ ?>

                      <div class="well well-sm">
                    <?php echo 'Total Pembayaran Laundry <b>'.$namapelanggan.'</b> sejumlah <b>Rp '.number_format($totalrevenue, $decimal, $a_decimal, $thousand).',-</b>'; ?>
                </div>
                  <?php }else{} ?>
</div>
                </div>

				  </form>


            </div>

                                <!-- /.box-header -->
                                  <!-- /.Paginasi -->
                                  <?php
     error_reporting(E_ALL ^ E_DEPRECATED);
     $sql    = "select * from $forward where nota IN (SELECT nota FROM transaksimasuk) and pelanggan = '$pelanggan' order by no desc";
     $result = mysqli_query($conn, $sql);
     $rpp    = 15;
     $reload = "$halaman"."?pelanggan=$pelanggan&pagination=true";
     $page   = intval(isset($_GET["page"]) ? $_GET["page"] : 0);

     if ($page <= 0)
         $page = 1;
     $tcount  = mysqli_num_rows($result);
     $tpages  = ($tcount) ? ceil($tcount / $rpp) : 1;
     $count   = 0;
     $i       = ($page - 1) * $rpp;
     $no_urut = ($page - 1) * $rpp;
 ?>
                             <div class="box-body table-responsive">
                                     <table class="table table-hover ">
                                         <thead>
                                             <tr>
                                               <th>No</th>
                                               <th>No Nota</th>
                                               <th>Tanggal</th>
                                               <th>Pelanggan</th>
                                               <th>Total Pembayaran</th>
                                               <th>Deadline</th>
                                               <th>Status</th>
                                               <th>Cc</th>
                         <?php	if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>
                                                 <th class="no-print">Opsi</th>
                         <?php }else{} ?>
                                             </tr>
                                         </thead>
                                           <?php
     error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
     $bulan = $_POST['bulan'];
     $pelanggan = $_POST['tahun'];

     if ($pelanggan != null || $pelanggan != "") {

         if ($_SERVER["REQUEST_METHOD"] == "POST") {

               if(isset($_POST['tahun'])){
         $query1="SELECT * FROM  $forward where nota IN (SELECT nota FROM transaksimasuk) and pelanggan = '$pelanggan'  order by no limit $rpp";
         $hasil = mysqli_query($conn,$query1);
         $no = 1;
         while ($fill = mysqli_fetch_assoc($hasil)){
           ?>
                      <tbody>
 <tr>
   <td><?php echo ++$no_urut;?></td>

       <td><?php  echo mysql_real_escape_string($fill['nota']); ?></td>
       <td><?php  echo mysql_real_escape_string($fill['tglmasuk'].' / '.date('H:i', strtotime($fill['jammasuk']))); ?></td>
       <?php
     $pelanggan = $fill['pelanggan'];
     $sqle="SELECT nama FROM pelanggan WHERE kode ='$pelanggan'";
     $hasile=mysqli_query($conn,$sqle);
     $rowa=mysqli_fetch_assoc($hasile);
     $namapelanggan=$rowa['nama'];
        ?>
       <td><?php  echo mysql_real_escape_string($namapelanggan); ?></td>
       <td><?php  echo mysql_real_escape_string(number_format($fill['total'], $decimal, $a_decimal, $thousand).',-'); ?></td>
       <td><?php  echo mysql_real_escape_string($fill['tgldeadline'].' / '.date('H:i', strtotime($fill['jamdeadline']))); ?></td>
       <?php if($fill['status'] == 'proses'){ ?>
       <td> <span class="label label-warning"><?php  echo mysql_real_escape_string($fill['status']); ?></span></td>
     <?php }else if($fill['status'] == 'selesai'){ ?>
       <td> <span class="label label-primary"><?php  echo mysql_real_escape_string($fill['status']); ?></span></td>
       <?php }else if($fill['status'] == 'lunas'){ ?>
         <td> <span class="label label-success"><?php  echo mysql_real_escape_string($fill['status']); ?></span></td>
         <?php }else if($fill['status'] == 'batal'){ ?>
           <td> <span class="label label-danger"><?php  echo mysql_real_escape_string($fill['status']); ?></span></td>
           <?php } ?>
       <td><?php  echo mysql_real_escape_string($fill['kasir']); ?></td>
   <td>
   <?php	if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>
     <button type="button" class="btn btn-info btn-xs no-print btn-flat" onclick="window.location.href='order_detail?id=1&trx=1&nota=<?php  echo $fill['nota']; ?>'">Detail</button>
  <?php } else {}?>

     </td></tr><?php
           ;
         }

         ?>
                   </tbody></table>
  <div align="right"><?php if($tcount>=$rpp){ echo paginate_one($reload, $page, $tpages);}else{} ?></div>
      <?php
       }

     }

   } else {
     while(($count<$rpp) && ($i<$tcount)) {
       mysqli_data_seek($result,$i);
       $fill = mysqli_fetch_array($result);
       ?>
                       <tbody>
                         <tr>
                           <td><?php echo ++$no_urut;?></td>
                           <td><?php  echo mysql_real_escape_string($fill['nota']); ?></td>
                           <td><?php  echo mysql_real_escape_string($fill['tglmasuk'].' / '.date('H:i', strtotime($fill['jammasuk']))); ?></td>
                           <?php
                         $pelanggan = $fill['pelanggan'];
                         $sqle="SELECT nama FROM pelanggan WHERE kode ='$pelanggan'";
                         $hasile=mysqli_query($conn,$sqle);
                         $rowa=mysqli_fetch_assoc($hasile);
                         $namapelanggan=$rowa['nama'];
                            ?>
                           <td><?php  echo mysql_real_escape_string($namapelanggan); ?></td>
                           <td><?php  echo mysql_real_escape_string(number_format($fill['total'], $decimal, $a_decimal, $thousand).',-'); ?></td>
                           <td><?php  echo mysql_real_escape_string($fill['tgldeadline'].' / '.date('H:i', strtotime($fill['jamdeadline']))); ?></td>
                           <?php if($fill['status'] == 'proses'){ ?>
                           <td> <span class="label label-warning"><?php  echo mysql_real_escape_string($fill['status']); ?></span></td>
                         <?php }else if($fill['status'] == 'selesai'){ ?>
                           <td> <span class="label label-primary"><?php  echo mysql_real_escape_string($fill['status']); ?></span></td>
                           <?php }else if($fill['status'] == 'lunas'){ ?>
                             <td> <span class="label label-success"><?php  echo mysql_real_escape_string($fill['status']); ?></span></td>
                             <?php }else if($fill['status'] == 'batal'){ ?>
                               <td> <span class="label label-danger"><?php  echo mysql_real_escape_string($fill['status']); ?></span></td>
                               <?php } ?>
                           <td><?php  echo mysql_real_escape_string($fill['kasir']); ?></td>
                        <td>
                        <?php	if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>
                         <button type="button" class="btn btn-info btn-xs no-print btn-flat" onclick="window.location.href='order_detail?id=1&trx=1&nota=<?php  echo $fill['nota']; ?>'">Detail</button>
                        <?php } else {}?>

                         </td></tr>
       <?php
       $i++;
       $count++;
     }

     ?>
                   </tbody></table>
           <div align="right"><?php if($tcount>=$rpp){ echo paginate_one($reload, $page, $tpages);}else{} ?></div>
   <?php } ?>

                                </div>
                                 <!-- /.box-body -->

                             </div>

               <?php } else {} ?>

              <div align="right"  style="padding-right:15px"  class="no-print" id="no-print" >
             <div align="left" class="no-print" id="no-print"> <a onclick="javascript:printDiv('tabel1');" class="btn btn-default btn-flat" name="cetak" value="cetak"><span class="glyphicon glyphicon-print"></span></a><?php echo " "; ?>
               <a onclick="window.location.href='configuration/config_export?forward=customer&search=&pelanggan=<?php echo $pelanggan; ?>'" class="btn btn-default btn-flat" name="cetak" value="export excel"><span class="glyphicon glyphicon-save-file"></span></a></div> <br/>
             </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">
                    </div>
                    <!-- /.row (main row) -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
           <?php footer();?>
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->
<script src="dist/plugins/jQuery/jquery-2.2.3.min.js"></script>
      <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
      <script>
$.widget.bridge('uibutton', $.ui.button);
</script>
      <script src="dist/bootstrap/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
      <script src="dist/plugins/morris/morris.min.js"></script>
      <script src="dist/plugins/sparkline/jquery.sparkline.min.js"></script>
      <script src="dist/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
      <script src="dist/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
      <script src="dist/plugins/knob/jquery.knob.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
      <script src="dist/plugins/daterangepicker/daterangepicker.js"></script>
      <script src="dist/plugins/datepicker/bootstrap-datepicker.js"></script>
      <script src="dist/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
      <script src="dist/plugins/slimScroll/jquery.slimscroll.min.js"></script>
      <script src="dist/plugins/fastclick/fastclick.js"></script>
      <script src="dist/js/app.min.js"></script>
      <script src="dist/js/demo.js"></script>
  <script src="dist/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="dist/plugins/datatables/dataTables.bootstrap.min.js"></script>
  <script src="dist/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="dist/plugins/fastclick/fastclick.js"></script>
  <script src="dist/plugins/select2/select2.full.min.js"></script>
  <script src="dist/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="dist/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="dist/plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <script src="dist/plugins/timepicker/bootstrap-timepicker.min.js"></script>
  <script src="dist/plugins/iCheck/icheck.min.js"></script>
<script>
$(function () {
  //Initialize Select2 Elements
  $(".select2").select2();

  //Datemask dd/mm/yyyy
  $("#datemask").inputmask("yyyy-mm-dd", {"placeholder": "yyyy/mm/dd"});
  //Datemask2 mm/dd/yyyy
  $("#datemask2").inputmask("yyyy-mm-dd", {"placeholder": "yyyy/mm/dd"});
  //Money Euro
  $("[data-mask]").inputmask();

  //Date range picker
  $('#reservation').daterangepicker();
  //Date range picker with time picker
  $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'YYYY/MM/DD h:mm A'});
  //Date range as a button
  $('#daterange-btn').daterangepicker(
      {
        ranges: {
          'Hari Ini': [moment(), moment()],
          'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Akhir 7 Hari': [moment().subtract(6, 'days'), moment()],
          'Akhir 30 Hari': [moment().subtract(29, 'days'), moment()],
          'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
          'Akhir Bulan': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      }
  );

  //Date picker
  $('#datepicker').datepicker({
    autoclose: true
  });

 $('.datepicker').datepicker({
  dateFormat: 'yyyy-mm-dd'
});

 //Date picker 2
 $('#datepicker2').datepicker('update', new Date());

  $('#datepicker2').datepicker({
    autoclose: true
  });

 $('.datepicker2').datepicker({
  dateFormat: 'yyyy-mm-dd'
});


  //iCheck for checkbox and radio inputs
  $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass: 'iradio_minimal-blue'
  });
  //Red color scheme for iCheck
  $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
    checkboxClass: 'icheckbox_minimal-red',
    radioClass: 'iradio_minimal-red'
  });
  //Flat red color scheme for iCheck
  $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
  });

  //Colorpicker
  $(".my-colorpicker1").colorpicker();
  //color picker with addon
  $(".my-colorpicker2").colorpicker();

  //Timepicker
  $(".timepicker").timepicker({
    showInputs: false
  });
});
</script>
</body>
</html>
