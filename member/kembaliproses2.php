<?php
include('header.php');
session_start();
 
if( !isset($_SESSION['nama_user']) )
{
    header('location:./../'.$_SESSION['akses']);
    exit();
}else{
    $nama = $_SESSION['nama_user'];
}
 
?>

<div class="container">
      <div class="col-sm-9">  
         <h2>Halaman Member</h2>
         <h5><span class="glyphicon glyphicon-time"></span> Dibuat pada, 01 Januari 2019.</h5>
         <h5><span class="label label-success">#Stmik insan pembangunan</span></h5><br>
       </div>
       </div>
<div class="container">

<?php
include 'koneksi.php';
$today= date("Ymd");

$vnopol = $_POST['hiddennopol'];
$vdenda = $_POST['txtdenda'];
// cari id transaksi terakhir yang berawalan tanggal hari ini
$query = "SELECT max(idTransaksi) AS last FROM trankembali WHERE idtransaksi LIKE '$today%'";
$hasil = mysql_query($query);
$data  = mysql_fetch_array($hasil);
$lastNoTransaksi = $data['last'];
$lastNoUrut = substr($lastNoTransaksi, 8, 4); 
$nextNoUrut = $lastNoUrut + 1;
$nextNoTransaksi = $today.sprintf('%04s', $nextNoUrut);
// proses simpan data transaksi dengan nomor transaksi yang baru
$query = "INSERT INTO trankembali (idtransaksi, nopol, denda)VALUES ('$nextNoTransaksi','$vnopol','$vdenda')";
$hasil = mysql_query($query);
if ($hasil)
{
    // jika proses simpan transaksi sukses, maka tampilkan nomor transaksi dan data pembayaran
    $query2 = "SELECT * FROM mobil WHERE nopol = '$vnopol'";
    $hasil2 = mysql_query($query2);
    $data2  = mysql_fetch_array($hasil2);

    $vstatus='ada';
    $query3 = "update mobil set status='$vstatus' WHERE nopol = '$vnopol'";
    $hasil3 = mysql_query($query3);
    
?>
  <div class="col-lg-4">
  <div class="table-responsive">
  <table class="table">
  <h3>Transaksi Sukses</h3>
  <div class="col-lg-4">
  <div class="table-responsive">
  <table class="table">
  <tr> 
  <td>Transaksi:</td> <td><?php echo $nextNoTransaksi; ?> </td>
  </tr>
  <tr>
  <td>NOPOL:</td>   <td><?php echo $vnopol; ?> </td>
  </tr>
  <tr>
  <td>MOBIL:</td>   <td><?php echo $data2['namamobil']; ?> </td>
  </tr>
  <tr>
  <td>Denda:</td>   <td><?php echo $vdenda; ?> </td>
  </tr>
  </table>
  
<?php
}
else echo "Transaksi Gagal";
?> 

<a href="index.php" class="btn btn-outline btn-default">Kembali</a>
  </div>
  </div>
  </div><br>

<?php
include('../footer.php');
?>
     