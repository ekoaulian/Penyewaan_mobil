<?php
include('header.php');
session_start();
 
if( !isset($_SESSION['saya_admin']) )
{
    header('location:./../'.$_SESSION['akses']);
    exit();
}
 
$nama = ( isset($_SESSION['nama_user']) ) ? $_SESSION['nama_user'] : '';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Proses Edit</title>
</head>
<body>
		<?php
					$vnopol = $_POST ['txtnopol'];
					$vfoto = $_POST ['txtfoto'];
					$vmobil = $_POST ['txtmobil'];
					$vharga = $_POST ['txtharga'];
					$vstatus = $_POST ['txtstatus'];


				$conn = mysql_connect("localhost","root","") or die ("koneksi gagal");
				mysql_select_db("tugas_php",$conn);
				$strSQL = "update mobil set namamobil='$vmobil',foto='$vfoto',harga='$vharga',status='$vstatus' where nopol='$vnopol'";
				$qry = mysql_query($strSQL,$conn) or die ("query salah");
			?>

			<!-- Data sudah di update
			<a href="index.php">Halaman Awal</a> -->
			<script type="text/javascript">
			window.location = "index.php";
			</script>
</body>
</html>
<?php
include('../footer.php');
?>