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
            <div class="content-wrapper">
                <section class="content-header">
</section>
                <section class="content">
                    <div class="row">
					  <div class="col-lg-12">

              <!-- SETTING START-->

<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include "configuration/config_chmod.php";
$halaman = "komplain"; // halaman
$dataapa = "Komplain"; // data
$tabeldatabase = "komplain"; // tabel database
$chmod = $chmenu2; // Hak akses Menu
$forward = mysql_real_escape_string($tabeldatabase); // tabel database
$forwardpage = mysql_real_escape_string($halaman); // halaman
$search = $_POST['search'];
$date = $_GET['date'];

?>
<!-- SETTING STOP -->
<?php
$decimal ="0";
$a_decimal =",";
$thousand =".";
?>

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
if($search == null || $search == "" ){
        $sqla="SELECT no, COUNT( * ) AS totaldata FROM $forward";
      }else if($date != null && $search == null){
        $sqla="SELECT no, COUNT( * ) AS totaldata FROM $forward where tglkomplain = '$date'";
      }else{
        $sqla="SELECT no, COUNT( * ) AS totaldata FROM $forward where nota like '%$search%' or tglkomplain like '%$search%' or kasir like '%$search%'";
      }
		$hasila=mysqli_query($conn,$sqla);
		$rowa=mysqli_fetch_assoc($hasila);
		$totaldata=$rowa['totaldata'];

?>


          <div class="box" id="tabel1">

            <div class="box-header">
            <h3 class="box-title">Data <?php echo $dataapa ?>  <span class="no-print label label-default" id="no-print"><?php echo $totaldata; ?></span>
					</h3>

			  <form method="post">
			  <br/>
                <div class="input-group input-group-sm no-print" style="width: 250px;" id="no-print">
                  <input type="text" name="search" class="form-control pull-right" placeholder="Cari">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>

				  </form>


            </div>

                                <!-- /.box-header -->
                                  <!-- /.Paginasi -->
                                 <?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    if($date != null && $search == null){
    $sql    = "SELECT komplain.nota AS nota, komplain.no AS no, tglkomplain, jamkomplain, komplain, detail, detailtindakan, komplain.status AS status, tindakan, tgltindakan, jamtindakan, komplain.kasir, pelanggan.nama as pelanggan FROM komplain INNER JOIN bayar ON bayar.nota = komplain.nota INNER JOIN pelanggan ON bayar.pelanggan = pelanggan.kode where komplain.tglkomplain = '$date' order by komplain.no desc";
    }else{
    $sql    = "SELECT komplain.nota AS nota, komplain.no AS no, tglkomplain, jamkomplain, komplain, detail, detailtindakan, komplain.status AS status, tindakan, tgltindakan, jamtindakan, komplain.kasir, pelanggan.nama as pelanggan FROM komplain INNER JOIN bayar ON bayar.nota = komplain.nota INNER JOIN pelanggan ON bayar.pelanggan = pelanggan.kode order by komplain.no desc";
    }
    $result = mysqli_query($conn, $sql);
    $rpp    = 15;
    $reload = "$halaman"."?pagination=true";
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
                                              <th>Pelanggan</th>
                                              <th>Tanggal Komplain</th>
                                              <th>Komplain</th>
                                              <th>Detail Komplain</th>
                                              <th>Status</th>
                                              <th>Tindakan</th>
                                              <th>Tanggal Tindakan</th>
                                              <th>Detail Tindakan</th>
                                              <th>Cc</th>
												<?php	if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>
                                                <th class="no-print">Opsi</th>
												<?php }else{} ?>
                                            </tr>
                                        </thead>
                                          <?php
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $search = $_POST['search'];

    if ($search != null || $search != "") {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

           		if(isset($_POST['search'])){
				$query1="SELECT komplain.nota AS nota, komplain.no AS no, tglkomplain, jamkomplain, komplain, detail, detailtindakan, komplain.status AS status, tindakan, tgltindakan, jamtindakan, komplain.kasir, pelanggan.nama as pelanggan FROM komplain INNER JOIN bayar ON bayar.nota = komplain.nota INNER JOIN pelanggan ON bayar.pelanggan = pelanggan.kode where komplain.nota like '%$search%' or komplain.tglkomplain like '%$search%' or komplain.kasir like '%$search%' or pelanggan.nama like '%$search%' order by komplain.no limit $rpp";
				$hasil = mysqli_query($conn,$query1);
				$no = 1;
				while ($fill = mysqli_fetch_assoc($hasil)){
					?>
                     <tbody>
                       <tr>
                         <td><?php echo ++$no_urut;?></td>
                         <td><?php  echo mysql_real_escape_string($fill['nota']); ?></td>
                         <td><?php  echo mysql_real_escape_string($fill['pelanggan']); ?></td>
                         <td><?php  echo mysql_real_escape_string($fill['tglkomplain'].' / '.date('H:i', strtotime($fill['jamkomplain']))); ?></td>
                         <td><?php  echo mysql_real_escape_string($fill['komplain']); ?></td>
                         <td><?php  echo mysql_real_escape_string($fill['detail']); ?></td>

                         <?php if($fill['status'] == 'proses'){ ?>
                         <td> <span class="label label-warning"><?php  echo mysql_real_escape_string($fill['status']); ?></span></td>
                       <?php }else if($fill['status'] == 'gagal'){ ?>
                         <td> <span class="label label-primary"><?php  echo mysql_real_escape_string($fill['status']); ?></span></td>
                         <?php }else if($fill['status'] == 'solved'){ ?>
                           <td> <span class="label label-success"><?php  echo mysql_real_escape_string($fill['status']); ?></span></td>
                             <?php } ?>
                             <td><?php  echo mysql_real_escape_string($fill['tindakan']); ?></td>
                             <td><?php  echo mysql_real_escape_string($fill['tgltindakan'].' / '.date('H:i', strtotime($fill['jamtindakan']))); ?></td>
                             <td><?php  echo mysql_real_escape_string($fill['detailtindakan']); ?></td>
                         <td><?php  echo mysql_real_escape_string($fill['kasir']); ?></td>
                         <td>
                         <?php	if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>
                           <?php if($fill['status']=='proses'){?>
                             <button type="button" class="btn btn-success btn-xs no-print btn-flat" style="width:55px" onclick="window.location.href='add_komplain?no=<?php echo $fill['no']; ?>'">Tindak</button>
                             <?php }else if($fill['status']=='solved'){ ?>
                               <button type="button" class="btn btn-info btn-xs no-print btn-flat" style="width:55px" onclick="window.location.href='add_komplain?no=<?php echo $fill['no'].'&go=1'; ?>'">Detail</button>
                           <?php } ?>
                        <?php } else {}?>
                        <?php	if ($chmod >= 4 || $_SESSION['jabatan'] == 'admin') { ?>
                       <button type="button" class="btn btn-danger btn-xs btn-flat" onclick="window.location.href='component/delete/delete_master?no=<?php echo $fill['no'].'&'; ?>forward=<?php echo $forward.'&';?>forwardpage=<?php echo $forwardpage.'&'; ?>chmod=<?php echo $chmod; ?>'">Hapus</button>
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
                          <td><?php  echo mysql_real_escape_string($fill['pelanggan']); ?></td>
                          <td><?php  echo mysql_real_escape_string($fill['tglkomplain'].' / '.date('H:i', strtotime($fill['jamkomplain']))); ?></td>
                          <td><?php  echo mysql_real_escape_string($fill['komplain']); ?></td>
                          <td><?php  echo mysql_real_escape_string($fill['detail']); ?></td>

                          <?php if($fill['status'] == 'proses'){ ?>
                          <td> <span class="label label-warning"><?php  echo mysql_real_escape_string($fill['status']); ?></span></td>
                        <?php }else if($fill['status'] == 'gagal'){ ?>
                          <td> <span class="label label-primary"><?php  echo mysql_real_escape_string($fill['status']); ?></span></td>
                          <?php }else if($fill['status'] == 'solved'){ ?>
                            <td> <span class="label label-success"><?php  echo mysql_real_escape_string($fill['status']); ?></span></td>
                              <?php } ?>
                              <td><?php  echo mysql_real_escape_string($fill['tindakan']); ?></td>
                              <td><?php  echo mysql_real_escape_string($fill['tgltindakan'].' / '.date('H:i', strtotime($fill['jamtindakan']))); ?></td>
                              <td><?php  echo mysql_real_escape_string($fill['detailtindakan']); ?></td>
                          <td><?php  echo mysql_real_escape_string($fill['kasir']); ?></td>
                          <td>
                          <?php	if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>
                            <?php if($fill['status']=='proses'){?>
                              <button type="button" class="btn btn-success btn-xs no-print btn-flat" style="width:55px" onclick="window.location.href='add_komplain?no=<?php echo $fill['no']; ?>'">Tindak</button>
                              <?php }else if($fill['status']=='solved'){ ?>
                                <button type="button" class="btn btn-info btn-xs no-print btn-flat" style="width:55px" onclick="window.location.href='add_komplain?no=<?php echo $fill['no'].'&go=1'; ?>'">Detail</button>
                            <?php } ?>
                         <?php } else {}?>
                         <?php	if ($chmod >= 4 || $_SESSION['jabatan'] == 'admin') { ?>
                        <button type="button" class="btn btn-danger btn-xs btn-flat" onclick="window.location.href='component/delete/delete_master?no=<?php echo $fill['no'].'&'; ?>forward=<?php echo $forward.'&';?>forwardpage=<?php echo $forwardpage.'&'; ?>chmod=<?php echo $chmod; ?>'">Hapus</button>
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
        <script src="dist/js/pages/dashboard.js"></script>
        <script src="dist/js/demo.js"></script>
		<script src="dist/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="dist/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<script src="dist/plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<script src="dist/plugins/fastclick/fastclick.js"></script>

    </body>
</html>
