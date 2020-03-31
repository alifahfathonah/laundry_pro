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

<?php
$decimal ="0";
$a_decimal =",";
$thousand =".";
?>
            <div class="content-wrapper">
                <section class="content-header">
</section>
                <section class="content">



              <!-- SETTING START-->

<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include "configuration/config_chmod.php";
$halaman = "toplist"; // halaman
$dataapa = "Top List"; // data
$tabeldatabase = "bayar"; // tabel database
$chmod = $chmenu9; // Hak akses Menu
$forward = mysql_real_escape_string($tabeldatabase); // tabel database
$forwardpage = mysql_real_escape_string($halaman); // halaman
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];

?>

<!-- SETTING STOP -->

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


          <div class="box" id="tabel1">

            <div class="box-header">
            <h3 class="box-title"><?php echo $dataapa ?>  <span class="no-print label label-default" id="no-print"><?php echo $totaldata; ?></span>
					</h3>


            </div>

                                <!-- /.box-header -->
                                  <!-- /.Paginasi -->

                             <div class="box-body table-responsive">
           					  <div class="col-lg-12">
					  <div class="col-lg-4">

                   <div class="box box-success">
                     <div class="box-header with-border">
                       <h3 class="box-title">5 Layanan Teratas</h3>

                       <div class="box-tools pull-right">
                         <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                         </button>
                         <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                       </div>
                     </div>

                     <div class="box-body">
                       <ul class="products-list product-list-in-box">
                         <?php
                         $query1="SELECT kode, nama, COUNT(kode) AS total FROM transaksimasuk GROUP BY kode LIMIT 5";
                 				$hasil = mysqli_query($conn,$query1);
                 				while ($fill = mysqli_fetch_assoc($hasil)){
                 					?>
                          <li class="item">
                            <div class="product-img">
                              <img src="dist/img/r1.png" alt="Product Image">
                            </div>
                            <div class="product-info">
                              <a class="product-title"><?php  echo mysql_real_escape_string($fill['nama']); ?>
                            <span class="label label-danger pull-right">Top <?php echo ++$no_urut;?></span></a>
                                  <span class="product-description">
                                    Telah diorder sebanyak <?php  echo mysql_real_escape_string($fill['total']); ?> kali transaksi
                                  </span>
                            </div>
                          </li>
              <?php
                 				}
                          ?>

                       </ul>
                     </div>
            </div>


                                </div>


                                <div class="col-lg-4">

                                       <div class="box box-success">
                                         <div class="box-header with-border">
                                           <h3 class="box-title">5 Pelanggan Teratas</h3>

                                           <div class="box-tools pull-right">
                                             <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                             </button>
                                             <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                           </div>
                                         </div>

                                         <div class="box-body">
                                           <ul class="products-list product-list-in-box">
                                             <?php
                                             $query1="SELECT pelanggan.nama as nama, COUNT(nota) AS total FROM bayar INNER JOIN pelanggan ON bayar.pelanggan = pelanggan.kode GROUP BY pelanggan LIMIT 5";
                                            $hasil = mysqli_query($conn,$query1);
                                            $no_urut = 0;
                                            while ($fill = mysqli_fetch_assoc($hasil)){
                                              ?>
                                              <li class="item">
                                                <div class="product-img">
                                                  <img src="dist/img/r2.png" alt="Product Image">
                                                </div>
                                                <div class="product-info">
                                                  <a class="product-title"><?php  echo mysql_real_escape_string($fill['nama']); ?>
                                                    <span class="label label-info pull-right">Top <?php echo ++$no_urut;?></span></a>
                                                      <span class="product-description">
                                                        Telah melakukan order sebanyak <?php  echo mysql_real_escape_string($fill['total']); ?> kali transaksi
                                                      </span>
                                                </div>
                                              </li>
                                  <?php
                                            }
                                              ?>

                                           </ul>
                                         </div>
                                </div>


                                                    </div>



                                                    <div class="col-lg-4">

                                                           <div class="box box-success">
                                                             <div class="box-header with-border">
                                                               <h3 class="box-title">5 Admin Teratas</h3>

                                                               <div class="box-tools pull-right">
                                                                 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                                 </button>
                                                                 <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                               </div>
                                                             </div>

                                                             <div class="box-body">
                                                               <ul class="products-list product-list-in-box">
                                                                 <?php
                                                                 $query1="SELECT user.nama, user.avatar as avatar, COUNT(nota) AS total FROM bayar INNER JOIN USER ON bayar.kasir = user.userna_me GROUP BY kasir LIMIT 5";
                                                                $hasil = mysqli_query($conn,$query1);
                                                                $no_urut = 0;
                                                                while ($fill = mysqli_fetch_assoc($hasil)){
                                                                  ?>
                                                                  <li class="item">
                                                                    <div class="product-img">
                                                                      <img src="<?php  echo mysql_real_escape_string($fill['avatar']); ?>" alt="Product Image">
                                                                    </div>
                                                                    <div class="product-info">
                                                                      <a class="product-title"><?php  echo mysql_real_escape_string($fill['nama']); ?>
                                                                        <span class="label label-success pull-right">Top <?php echo ++$no_urut;?></span></a>
                                                                          <span class="product-description">
                                                                            Telah melakukan trx sebanyak <?php  echo mysql_real_escape_string($fill['total']); ?> kali transaksi
                                                                          </span>
                                                                    </div>
                                                                  </li>
                                                      <?php
                                                                }
                                                                  ?>

                                                               </ul>
                                                             </div>
                                                    </div>


                                                                        </div>
                                                                      </div>
</div>
 <div class="box-body table-responsive">


                                                                          <div class="col-lg-12">

                                                           <div class="col-lg-4">

                                                            <div class="box box-danger">
                                                              <div class="box-header with-border">
                                                                <h3 class="box-title">5 Layanan Terbawah</h3>

                                                                <div class="box-tools pull-right">
                                                                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                                  </button>
                                                                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                                </div>
                                                              </div>

                                                              <div class="box-body">
                                                                <ul class="products-list product-list-in-box">
                                                                  <?php
                                                                  $query1="SELECT kode, nama, COUNT(kode) AS total FROM transaksimasuk GROUP BY kode desc LIMIT 5";
                                                                 $hasil = mysqli_query($conn,$query1);
                                                                 $no_urut = 0;
                                                                 while ($fill = mysqli_fetch_assoc($hasil)){
                                                                   ?>
                                                                   <li class="item">
                                                                     <div class="product-img">
                                                                       <img src="dist/img/r1.png" alt="Product Image">
                                                                     </div>
                                                                     <div class="product-info">
                                                                       <a class="product-title"><?php  echo mysql_real_escape_string($fill['nama']); ?>
                                                                     <span class="label label-danger pull-right"><?php echo ++$no_urut;?></span></a>
                                                                           <span class="product-description">
                                                                             Telah diorder sebanyak <?php  echo mysql_real_escape_string($fill['total']); ?> kali transaksi
                                                                           </span>
                                                                     </div>
                                                                   </li>
                                                           <?php
                                                                 }
                                                                   ?>

                                                                </ul>
                                                              </div>
                                                           </div>


                                                                         </div>


                                                                         <div class="col-lg-4">

                                                                                <div class="box box-danger">
                                                                                  <div class="box-header with-border">
                                                                                    <h3 class="box-title">5 Pelanggan Terbawah</h3>

                                                                                    <div class="box-tools pull-right">
                                                                                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                                                      </button>
                                                                                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                                                    </div>
                                                                                  </div>

                                                                                  <div class="box-body">
                                                                                    <ul class="products-list product-list-in-box">
                                                                                      <?php
                                                                                      $query1="SELECT pelanggan.nama as nama, COUNT(nota) AS total FROM bayar INNER JOIN pelanggan ON bayar.pelanggan = pelanggan.kode GROUP BY pelanggan desc LIMIT 5";
                                                                                     $hasil = mysqli_query($conn,$query1);
                                                                                     $no_urut = 0;
                                                                                     while ($fill = mysqli_fetch_assoc($hasil)){
                                                                                       ?>
                                                                                       <li class="item">
                                                                                         <div class="product-img">
                                                                                           <img src="dist/img/r2.png" alt="Product Image">
                                                                                         </div>
                                                                                         <div class="product-info">
                                                                                           <a class="product-title"><?php  echo mysql_real_escape_string($fill['nama']); ?>
                                                                                             <span class="label label-info pull-right"><?php echo ++$no_urut;?></span></a>
                                                                                               <span class="product-description">
                                                                                                 Telah melakukan order sebanyak <?php  echo mysql_real_escape_string($fill['total']); ?> kali transaksi
                                                                                               </span>
                                                                                         </div>
                                                                                       </li>
                                                                           <?php
                                                                                     }
                                                                                       ?>

                                                                                    </ul>
                                                                                  </div>
                                                                         </div>


                                                                                             </div>



                                                                                             <div class="col-lg-4">

                                                                                                    <div class="box box-danger">
                                                                                                      <div class="box-header with-border">
                                                                                                        <h3 class="box-title">5 Admin Terbawah</h3>

                                                                                                        <div class="box-tools pull-right">
                                                                                                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                                                                                          </button>
                                                                                                          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                                                                        </div>
                                                                                                      </div>

                                                                                                      <div class="box-body">
                                                                                                        <ul class="products-list product-list-in-box">
                                                                                                          <?php
                                                                                                          $query1="SELECT user.nama, user.avatar as avatar, COUNT(nota) AS total FROM bayar INNER JOIN USER ON bayar.kasir = user.userna_me GROUP BY kasir desc LIMIT 5";
                                                                                                         $hasil = mysqli_query($conn,$query1);
                                                                                                         $no_urut = 0;
                                                                                                         while ($fill = mysqli_fetch_assoc($hasil)){
                                                                                                           ?>
                                                                                                           <li class="item">
                                                                                                             <div class="product-img">
                                                                                                               <img src="<?php  echo mysql_real_escape_string($fill['avatar']); ?>" alt="Product Image">
                                                                                                             </div>
                                                                                                             <div class="product-info">
                                                                                                               <a class="product-title"><?php  echo mysql_real_escape_string($fill['nama']); ?>
                                                                                                                 <span class="label label-success pull-right"><?php echo ++$no_urut;?></span></a>
                                                                                                                   <span class="product-description">
                                                                                                                     Telah melakukan trx sebanyak <?php  echo mysql_real_escape_string($fill['total']); ?> kali transaksi
                                                                                                                   </span>
                                                                                                             </div>
                                                                                                           </li>
                                                                                               <?php
                                                                                                         }
                                                                                                           ?>

                                                                                                        </ul>
                                                                                                      </div>
                                                                                             </div>


                                                                                                                 </div>
                                                                                                               </div>


                                 <!-- /.box-body -->

   <div class="box-body table-responsive">
                                 <div class="col-lg-12">

                                  <div class="box box-info">
                                    <div class="box-header with-border">
                                      <h3 class="box-title">Komplain Terbaru</h3>

                                      <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                      </div>
                                    </div>

                                    <div class="box-body">
                                      <ul class="products-list product-list-in-box">
                                        <?php
                                        $query1="SELECT kode, nota, tglkomplain, komplain, tindakan FROM komplain GROUP BY no desc LIMIT 5";
                                       $hasil = mysqli_query($conn,$query1);
                                       $no_urut = 0;
                                       while ($fill = mysqli_fetch_assoc($hasil)){
                                         ?>
                                         <li class="item">
                                           <div class="product-img">
                                             <img src="dist/img/r4.png" alt="Product Image">
                                           </div>
                                           <div class="product-info">
                                             <a class="product-title"><?php  echo mysql_real_escape_string($fill['nota']); ?> / <?php  echo mysql_real_escape_string($fill['tglkomplain']); ?>
                                           <span class="label label-danger pull-right"><?php echo ++$no_urut;?></span></a>
                                                 <span class="product-description">
                                                   Komplain nota <?php echo mysql_real_escape_string($fill['nota']); ?> mengenai <?php  echo mysql_real_escape_string($fill['komplain']); ?> dengan tindakan <?php echo mysql_real_escape_string($fill['tindakan']); ?>
                                                 </span>
                                           </div>
                                         </li>
                                 <?php
                                       }
                                         ?>

                                      </ul>
                                    </div>
                                 </div>


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
