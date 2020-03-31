	<header class="main-header">
        <title>WebApp Proware</title>
				<?php
				include "configuration/config_connect.php";
				date_default_timezone_set("Asia/Jakarta");
				$harisekarang=date('d');
				$bulansekarang=date('m');
				$tahunsekarang=date('Y');
				$hariini=date('Y-m-d');

				$sqlx2="SELECT COUNT(kode) AS data FROM pelanggan WHERE tgldaftar = '$hariini'";
				$hasilx2=mysqli_query($conn,$sqlx2);
				$row=mysqli_fetch_assoc($hasilx2);
				$notifmember=$row['data'];

				$sqlx2="SELECT COUNT(nota) AS data FROM bayar WHERE tgldeadline = '$hariini' and status = 'proses'";
				$hasilx2=mysqli_query($conn,$sqlx2);
				$row=mysqli_fetch_assoc($hasilx2);
				$notifdeadline=$row['data'];

				$sqlx2="SELECT COUNT(kode) AS data FROM komplain WHERE tglkomplain = '$hariini'";
				$hasilx2=mysqli_query($conn,$sqlx2);
				$row=mysqli_fetch_assoc($hasilx2);
				$notifkomplain=$row['data'];

				$sqlx2="SELECT COUNT(nota) AS data FROM bayar WHERE tglmasuk = '$hariini'";
				$hasilx2=mysqli_query($conn,$sqlx2);
				$row=mysqli_fetch_assoc($hasilx2);
				$notiftrx=$row['data'];

				$totalnotif = ($notifmember+$notiftrx+$notifkomplain+$notifdeadline);
				 ?>
                <!-- Logo -->
                <a href="<?php  echo $_SESSION['baseurl'];?>" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b></b></span>
                    <!-- logo for regular state and mobile devices -->
                 <span class="logo-lg"><b>Proware</b></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation</span> </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
													<li class="dropdown notifications-menu">
														<?php if($totalnotif == '0'){}else{?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-danger"><?php echo $totalnotif;?></span>
            </a>
						<?php } ?>
            <ul class="dropdown-menu">

              <li class="header">Anda memiliki <?php echo $totalnotif;?> Notifikasi</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">

									<?php if($notifmember == '0'){}else{?>
                  <li>
                    <a href="pelanggan?date=<?php echo $hariini; ?>">
                      <i class="fa fa-users text-aqua"></i> <?php echo $notifmember;?> pelanggan baru hari ini
                    </a>
                  </li>
									<?php } ?>
									<?php if($notifdeadline == '0'){}else{?>
                  <li>
                    <a href="order_data?deadline=<?php echo $hariini; ?>">
                      <i class="fa fa-warning text-yellow"></i> <?php echo $notifdeadline;?> laundry deadline hari ini
                    </a>
                  </li>
									<?php } ?>
									<?php if($notifkomplain == '0'){}else{?>
                  <li>
                    <a href="komplain?date=<?php echo $hariini; ?>">
                      <i class="fa fa-users text-red"></i> <?php echo $notifkomplain;?> komplain masuk hari ini
                    </a>
                  </li>
									<?php } ?>
									<?php if($notiftrx == '0'){}else{?>
                  <li>
                    <a href="order_data?date=<?php echo $hariini; ?>">
                      <i class="fa fa-shopping-cart text-green"></i> <?php echo $notiftrx;?> transaksi masuk hari ini
                    </a>
                  </li>
									<?php } ?>

                </ul>
              </li>
            </ul>
          </li>
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php  echo $_SESSION['avatar']; ?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs"> <?php  echo $_SESSION['nama']; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <!-- User image -->
                                    <li class="user-header">
                                        <img src="<?php  echo $_SESSION['avatar']; ?>" class="img-circle" alt="User Image">
                                        <p>
                  <?php  echo $_SESSION['nama']; ?> - <?php  echo $_SESSION['jabatan']; ?></p>
                                    </li>
                                    </li>


                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                              <a href="add_admin?no=<?php  echo $_SESSION['nouser']; ?>" class="btn btn-default btn-flat">Profil</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="logout?logout=1" class="btn btn-default btn-flat">Keluar</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!-- Control Sidebar Toggle Button -->
                            <li>
</li>
                        </ul>
                    </div>
                </nav>
            </header>
