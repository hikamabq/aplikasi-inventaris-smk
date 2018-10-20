<?php
$judul = 'Barang';
require_once '../fungsi.php';
require_once 'view.php';


if(!isset($_SESSION['user'])){
	header('Location:../index.php');
}

$query = "SELECT * FROM barang ";
$read  = run($query);

$query = "SELECT * FROM barang,stok WHERE barang.jumlah = stok.jumlah";
$stok  = run($query);

$query = "SELECT * FROM stok WHERE status='ok' ";
$keluar  = run($query);

if(isset($_GET['cari'])){
	$cari = $_GET['cari'];
	$query = "SELECT * FROM barang WHERE nama_barang LIKE '%$cari%' ";
	$read  = run($query);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>INVENTARIS</title>
	<link rel="stylesheet" href="../style.css">
	<link rel="icon" href="../assets/tut.png">
</head>
<style>
	@media print{
		.cetak{
			display: none;
		}
	}
</style>
<body>

<div class="main-admin">
	<div class="isi" style="width: 100%;">
		<div class="konten">

			<a href="cetak.php" class="tmbl putih cetak" onclick="cetak()">Cetak PDF</a>
				<!-- <h3>DATA BARANG INVENTARIS</h3> -->
			<br><br>
			<h2>LAPORAN INVENTARIS</h2>
			<br><br>
			<div class="dataa">
				<h3 class="kiri">Barang Masuk</h3>
			</div>
			<div class="data-barang">
				<table>
					<thead>
						<tr>
							<td width="30" align="center">No</td>
							<td>Nama Barang</td>
							<td align="center">Jumlah</td>
							<td>Sumber Dana</td>
							<td>Supplier</td>
							<td align="center">Tanggal</td>
						</tr>
					</thead>

					<tbody>
					<?php 
				if(mysqli_num_rows($read) > 0){
					$no = 0;
					while($row = mysqli_fetch_assoc($read)){ 
					$no++;
						?>
						<tr>
							<td align="center"><?= $no; ?></td>
							<td><?= $row['nama_barang']; ?></td>
							<td align="center"><?= $row['jumlah']; ?></td>
							<td><?= $row['sumber_dana']; ?></td>
							<td><?= $row['supplier']; ?></td>
							<td align="center"><?= $row['tanggal']; ?></td>
						</tr>
					<?php }
				}else{
					echo '<tr>
								<td colspan="11">
									<h3 style="padding:15px; text-align:center;">Data kosong!</h3>
								</td>
							</tr>';
				}
					 ?>
					</tbody>

				</table>
			</div>
			<br><br>
			<div class="dataa">
				<h3>Stok Barang</h3>
			</div>
			<div class="data-barang">
				<table>
					<thead>
						<tr>
							<td width="30" align="center">No</td>
							<td>Nama Barang</td>
							<td align="center">Jumlah</td>
							<td align="center">Lokasi</td>
							<td align="center" width="200">Aksi</td>
						</tr>
					</thead>

					<tbody>
					<?php 
				if(mysqli_num_rows($stok) > 0){
					$no = 0;
					while($row = mysqli_fetch_assoc($stok)){ 
					$no++;
						?>
						<tr>
							<td align="center"><?= $no; ?></td>
							<td><?= $row['nama_barang']; ?></td>
							<td align="center"><?= $row['jumlah_masuk']; ?></td>
							<td><?= $row['lokasi_barang']; ?></td>
							<td align="center">
							<?php if($row['jumlah_masuk'] != 0 ){ ?>
								<a href="kel.php?id=<?= $row['jumlah']; ?>" class="tmbl kuning">Ambil Barang</a>
							<?php }else{ ?>
								<!-- <a href="" class="tmbl merah">Habis</a> -->
								<b style="color: red;">Barang Habis</b>
							<?php } ?>
							</td>
						</tr>
					<?php }
				}else{
					echo '<tr>
								<td colspan="11">
									<h3 style="padding:15px; text-align:center;">Data kosong!</h3>
								</td>
							</tr>';
				}
					 ?>
					</tbody>

				</table>
			</div>
			<br><br>
			<div class="dataa">
				<h3>Barang Keluar</h3>
			</div>
			<div class="data-barang">
				<table>
					<thead>
						<tr>
							<td width="30" align="center">No</td>
							<td>Nama Barang</td>
							<td align="center">Jumlah</td>
							<td>Penerima</td>
							<td align="center">Tanggal</td>
						</tr>
					</thead>

					<tbody>
					<?php 
				if(mysqli_num_rows($keluar) > 0 ){
					$no = 0;
					while($row = mysqli_fetch_assoc($keluar)){ 
					$no++;
						?>
						<tr>
							<td align="center"><?= $no; ?></td>
							<td><?= $row['nama_barang']; ?></td>
							<td align="center"><?= $row['jumlah_keluar']; ?></td>
							<td><?= $row['penerima']; ?></td>
							<td align="center"><?= $row['tanggal']; ?></td>
						</tr>
					<?php }
				}else{
					echo '<tr>
								<td colspan="11">
									<h3 style="padding:15px; text-align:center;">Data kosong!</h3>
								</td>
							</tr>';
				}
					 ?>
					</tbody>

				</table>
			</div>

		</div>
	</div>
</div>

</body>
</html>

<script>
	function cetak(){
		window.print();
	}
</script>