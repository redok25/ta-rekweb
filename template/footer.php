<footer class="page-break-top" id="tempat-nih">
	<div class="footer-divider"></div>
	<div class="container">
		<div class="row">
			<div class="clearfix page-break-top"></div>
			<div class="hr5"></div>
			<div class="col-md-12">
				<p class="text-center"><small>Copyright <strong>Sistem Informasi Geografis Kota Yogyakarta</strong> &copy; 2021<a href=""></a>. All Right Reserved</small></p>
			</div>
		</div>
	</div>
</footer>

	<div class="modal fade" id="modal-map" data-backdrop="static">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">
						<i class="fa fa-fw fa-bar-chart"> </i> <span id="namaKecamatan"></span>
					</h4>
				</div>

				<!-- Demografi Kependudukan -->
				<div class="modal-body">
					<div role="tabpanel">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active">
								<a href="#kependudukan" aria-controls="kependudukan" role="tab" data-toggle="tab">Kependudukan</a>
							</li>
							<li role="presentation">
								<a href="#statistikPenduduk" aria-controls="statistikPenduduk" role="tab" data-toggle="tab">Statistik Penduduk</a>
							</li>
							<li role="presentation">
								<a href="#usiaSekolah" aria-controls="tab" role="tab" data-toggle="tab">Usia Sekolah</a>
							</li>
							<li role="presentation">
								<a href="#sekolahDasar" aria-controls="tab" role="tab" data-toggle="tab">SD</a>
							</li>
							<li role="presentation">
								<a href="#sekolahMenengahPertama" aria-controls="tab" role="tab" data-toggle="tab">SMP</a>
							</li>
							<li role="presentation">
								<a href="#sekolahMenengahAtas" aria-controls="tab" role="tab" data-toggle="tab">SMA</a>
							</li>
							<li role="presentation">
								<a href="#sekolahMenengahKejuruan" aria-controls="tab" role="tab" data-toggle="tab">SMK</a>
							</li>
							<li role="presentation">
								<a href="#sekolahKeaksaraan" aria-controls="tab" role="tab" data-toggle="tab">Sekolah Keaksaraan</a>
							</li>
						</ul>

						<!-- Tab panes -->
						<div class="tab-content" style="margin-top: 1em">
							<div role="tabpanel" class="tab-pane active" id="kependudukan">
								<div class="row text-center inner-tab-modal">
									<div class="col-md-3">
										<i class="fa fa-fw fa-users fa-4x"></i>
										<h1 id="populasi"></h1>
										<p>Jumlah Penduduk (2016)</p>
									</div>
									<div class="col-md-3">
										<i class="fa fa-fw fa-globe fa-4x"></i>
										<h1 id="luasWilayah"></h1>
										<p>Luas Wilayah (Km<sup>2</sup>)</p>
									</div>
									<div class="col-md-3">
										<i class="fa fa-fw fa-map fa-4x"></i>
										<h1 id="kawasan"></h1>
										<p>Kawasan</p>
									</div>
									<div class="col-md-3">
										<i class="fa fa-fw fa-home fa-4x"></i>
										<h1 id="jumlahKelurahan"></h1>
										<p>Jumlah Kelurahan</p>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="statistikPenduduk">
								<!-- Line Graph Populasi dan Kepdatan Penduduk -->
								<div class="text-center">
									<div id="statistik"></div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="usiaSekolah">
								<div class="row text-center inner-tab-modal">
									<div class="col-md-4">
										<img src="image/osis_sd.png" height="80px">
										<h1 id="usiaSD"></h1>
										<p>Usia SD (7-12 Tahun)</p>
									</div>
									<div class="col-md-4">
										<img src="image/osis_sma.png" height="80px">
										<h1 id="usiaSMP"></h1>
										<p>Usia SMP (13-15 Tahun)</p>
									</div>
									<div class="col-md-4">
										<img src="image/osis_sma.png" height="80px">
										<h1 id="usiaSMA"></h1>
										<p>Usia SMA (16-18 Tahun)</p>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="sekolahDasar">
								<!-- Jumlah Sekolah -->
								<div class="row text-center inner-tab-modal">
									<div class="col-md-4">
										<i class="fa fa-fw fa-home fa-4x"></i>
										<h1 id="jumlahSD"></h1>
										<p>Sekolah Dasar</p>
									</div>
									<div class="col-md-4">
										<i class="fa fa-fw fa-user fa-4x"></i>
										<h1 id="jumlahPtkSD"></h1>
										<p>PTK Sekolah Dasar</p>
									</div>
									<div class="col-md-4">
										<i class="fa fa-fw fa-users fa-4x"></i>
										<h1 id="jumlahPdSD"></h1>
										<p>Peserta Didik<br/>Sekolah Dasar</p>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="sekolahMenengahPertama">
								<div class="row text-center inner-tab-modal">
									<div class="col-md-4">
										<i class="fa fa-fw fa-home fa-4x"></i>
										<h1 id="jumlahSMP"></h1>
										<p>Sekolah Menengah Pertama</p>
									</div>
									<div class="col-md-4">
										<i class="fa fa-fw fa-user fa-4x"></i>
										<h1 id="jumlahPtkSMP"></h1>
										<p>PTK Sekolah Menengah Pertama</p>
									</div>
									<div class="col-md-4">
										<i class="fa fa-fw fa-users fa-4x"></i>
										<h1 id="jumlahPdSMP"></h1>
										<p>Peserta Didik<br/>Sekolah Menengah Pertama</p>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="sekolahMenengahAtas">
								<div class="row text-center inner-tab-modal">
									<div class="col-md-4">
										<i class="fa fa-fw fa-home fa-4x"></i>
										<h1 id="jumlahSMA"></h1>
										<p>Sekolah Menengah Atas</p>
									</div>
									<div class="col-md-4">
										<i class="fa fa-fw fa-user fa-4x"></i>
										<h1 id="jumlahPtkSMA"></h1>
										<p>PTK Sekolah Menengah Atas</p>
									</div>
									<div class="col-md-4">
										<i class="fa fa-fw fa-users fa-4x"></i>
										<h1 id="jumlahPdSMA"></h1>
										<p>Peserta Didik<br/>Sekolah Menengah Atas</p>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="sekolahMenengahKejuruan">
								<div class="row text-center inner-tab-modal">
									<div class="col-md-4">
										<i class="fa fa-fw fa-home fa-4x"></i>
										<h1 id="jumlahSMK"></h1>
										<p>Sekolah Menengah Kejuruan</p>
									</div>
									<div class="col-md-4">
										<i class="fa fa-fw fa-user fa-4x"></i>
										<h1 id="jumlahPtkSMK"></h1>
										<p>PTK Sekolah Menengah Kejuruan</p>
									</div>
									<div class="col-md-4">
										<i class="fa fa-fw fa-users fa-4x"></i>
										<h1 id="jumlahPdSMK"></h1>
										<p>Peserta Didik<br/>Sekolah Menengah Kejuruan</p>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane" id="sekolahKeaksaraan">
								<div class="row text-center inner-tab-modal">
									<div class="col-md-4">
										<i class="fa fa-fw fa-home fa-4x"></i>
										<h1 id="jumlahKeaksaraan"></h1>
										<p>Sekolah Keaksaraan</p>
									</div>
									<div class="col-md-4">
										<i class="fa fa-fw fa-user fa-4x"></i>
										<h1 id="jumlahPtkKeaksaraan"></h1>
										<p>PTK Sekolah Keaksaraan</p>
									</div>
									<div class="col-md-4">
										<i class="fa fa-fw fa-users fa-4x"></i>
										<h1 id="jumlahPdKeaksaraan"></h1>
										<p>Peserta Didik<br/>Sekolah Keaksaraan</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<p class="text-muted text-center">
						Catatan: Data di atas bukan data sebenarnya (<b>data dummy</b>) dari kawasan tersebut, data di atas digunakan hanya untuk tujuan desain.
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal-login">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Login</h4>
				</div>
				<form method="POST" action="php-native/logic.php">
				<div class="modal-body">
					<input type="hidden" name="now" value="login">
					<div class="form-group">
						<label for="">Username:</label>
						<input type="text" class="form-control" name="username" required>
					</div>
					<div class="form-group">
						<label for="">Password :</label>
						<input type="password" class="form-control" name="password" required>
					</div>
					<p>Belum punya aku? Register <a onclick="register()" style="cursor: pointer;"><b>Di sini</b></a></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Login</button>
				</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal-pw">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Ubah Password</h4>
				</div>
				<form method="POST" action="php-native/logic.php">
				<div class="modal-body">
					<input type="hidden" name="now" value="ubahPW">
					<div class="form-group">
						<label for="">Password Lama :</label>
						<input type="password" class="form-control" name="pl" required>
					</div>
					<div class="form-group">
						<label for="">Password Baru :</label>
						<input type="password" class="form-control" name="pw" required>
					</div>
					<div class="form-group">
						<label for="">Konfirmasi Password Baru :</label>
						<input type="password" class="form-control" name="cpw" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal-register">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Register</h4>
				</div>
				<form method="POST" action="php-native/logic.php">
				<div class="modal-body">
					<input type="hidden" name="now" value="register">
					<div class="form-group">
						<label for="">Username:</label>
						<input type="text" class="form-control" name="username" required>
					</div>
					<div class="form-group">
						<label for="">Password :</label>
						<input type="password" class="form-control" name="password" required>
					</div>
					<div class="form-group">
						<label for="">Confirm Password :</label>
						<input type="password" class="form-control" name="confirm_password" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Register</button>
				</div>
				</form>
			</div>
		</div>
	</div>

    <div class="modal fade" id="modal-info" tabindex="-1" role="dialog" aria-labelledby="notifikasiLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notifikasiLabel">Notifikasi</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                     <h5 class="text-info">Silahkan klik lokasi yang ingin dibuat marker!</h5>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['user'])): ?>
    <div class="modal fade" id="modal-delete" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Hapus Marker</h4>
				</div>
				<div class="modal-body">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Pin</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1; 
								$result = $con->query("SELECT * from pin WHERE user_name = '".$_SESSION['user']."' "); ?>
							<?php if (mysqli_num_rows($result) < 1): ?>
                            <tr>
                                <td colspan="3" align="center">No Data</td>
                            </tr>
                            <?php else: ?>   
								<?php while ($row = mysqli_fetch_assoc($result)): ?>
									<tr>
										<td><?php echo $no++ ?></td>
										<td><?php echo $row['nama'] ?></td>
										<td><a class="btn btn-danger" onclick="return konfirm('Yakin ingin menghapus marker?', 'php-native/logic.php?delete=<?php echo $row['id'] ?>')"><i class="fa fa=trash"></i> Hapus</a></td>
									</tr>
								<?php endwhile ?>
							<?php endif ?>
						</tbody>
					</table>	
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
    <?php endif ?>

   
