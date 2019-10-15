<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
			error_reporting(E_ALL ^ E_NOTICE);
			// Bikin koneksi ke database dgn format (localhost, username, password, namaDatabase)
			$conn = mysqli_connect("localhost","root","","informatika");

			// Data diambil dari input type hidden
			$NIMLAMA = $_POST["NIMLAMA"];

			$NIM = $_POST["NIM"];
			$Nama = $_POST["Nama"];
			$Kelas = $_POST["Kelas"];
			$Alamat = $_POST["Alamat"];

			// Input berupa tombol submit atau ubah
			$Submit = $_POST["Submit"];

			// Ketika tombol submit di tekan
			if ($Submit) {
				if ($NIM == "") {
					echo "<h3>NIM tidak boleh kosong</h3>";
				} elseif ($Nama == "") {
					echo "<h3>Nama tidak boleh kosong</h3>";
				} elseif ($Kelas == "") {
					echo "<h3>Kelas tidak boleh kosong</h3>";
				} elseif ($Alamat == "") {
					echo "<h3>Alamat tidak boleh kosong</h3>";
				} else {
					$insert = "INSERT INTO mahasiswa (NIM, Nama, Kelas, Alamat) 
								VALUES ('$NIM','$Nama','$Kelas','$Alamat')
							";
					mysqli_query($conn, $insert); // Melakukan insert ke database
					echo "<h3>Data Berhasil Dimasukkan</h3>";
				}
			
			// Ketika tombol ubah di tekan
			}

			// Ketika tombol hapus(di kolom aksi) di tekan
			if ($_GET["hps"]) {
				$NIM = $_GET["hps"]; //NIM di dapat dari $_GET atau Link URL
				$hapus = "DELETE FROM mahasiswa WHERE NIM = '$NIM'";
				mysqli_query($conn, $hapus);
				echo "<h3>Data berhasil di hapus</h3>";
			
			// Ketika tombol ubah(di kolom aksi) di tekan
			}
		?>

<form method="post" action="uhh.php">
			<table>
				<tr>
					<td>NIM</td>
					<td>:</td>
					<td> 
						<input type="text" name="NIM" value="<?php echo $dataMahasiswa[0] ?>">
					</td>
				</tr>
				<tr>
					<td>Nama</td>
					<td>:</td>
					<td>
						<input type="text" name="Nama" value="<?php echo $dataMahasiswa[1] ?>">
					</td>
				</tr>
				<tr>
					<td>Kelas</td>
					<td>:</td>
					<td>
						<input type="radio" name="Kelas" value="A" <?php if ($dataMahasiswa[2]=="A") { echo "checked"; } ?> >A
						<input type="radio" name="Kelas" value="B" <?php if ($dataMahasiswa[2]=="B") { echo "checked"; } ?> >B
						<input type="radio" name="Kelas" value="C" <?php if ($dataMahasiswa[2]=="C") { echo "checked"; } ?> >C
					</td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>:</td>
					<td>
						<input type="text" name="Alamat" value="<?php echo $dataMahasiswa[3] ?>">
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td>
						<?php
							// Cek apakah dataMahasiswa ada atau tidak
							if ($dataMahasiswa) {
								echo "<input type='submit' name='Ubah' value='Ubah'>";
							} else {
								echo "<input type='submit' name='Submit' value='Submit'>";
							}
						?>
					</td>
				</tr>
			</table>
		</form>

		<hr>

		<table border="1">
			<tr>
				<td>NIM</td>
				<td>Nama</td>
				<td>Kelas</td>
				<td>Alamat</td>
				<td>Aksi</td>
			</tr>
			<?php
				$cari = "SELECT * FROM mahasiswa";
				$hasil = mysqli_query($conn, $cari);
				while ($data = mysqli_fetch_row($hasil)){
					// Tambahkan tombol ubah dan hapus dengan link menuju file ini dan dengan mengirim data $_GET dengan value NIM
					echo "
						<tr>
							<td>$data[0]</td>
							<td>$data[1]</td>
							<td>$data[2]</td>
							<td>$data[3]</td>
							<td>
								<a href='uhh.php?hps=$data[0]'>Hapus</a>
							</td>
						</tr>
					";
				}
			?>
		</table>
</body>
</html>