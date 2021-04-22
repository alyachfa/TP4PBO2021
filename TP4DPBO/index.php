<?php

/******************************************
TUGAS PRAKTIKUM DPBO
******************************************/

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Travel.class.php");

// Membuat objek dari kelas task
$otravel = new Travel($db_host, $db_user, $db_password, $db_name);
$otravel->open();

// Memanggil metho pada di kelas Travel

	$otravel->getTravel();

// Proses mengisi tabel dengan data
$data = null;
$no = 1;

if(isset($_POST['add'])){
	$otravel->insertTravel($_POST);

	header("Location:index.php");
}

while (list($id, $tnama, $tnomor, $ttanggal, $tasal, $ttujuan, $tstatus) = $otravel->getResult()) {
	// Tampilan jika status Keberangkatan nya sudah dikerjakan
	if($tstatus == "Sudah"){
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tnama . "</td>
		<td>" . $tnomor . "</td>
		<td>" . $tasal . "</td>
		<td>" . $ttujuan . "</td>
		<td>" . $ttanggal . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		</td>
		</tr>";
		$no++;
	}

	// Tampilan jika status keberangkatan nya belum dikerjakan
	else{
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tnama . "</td>
		<td>" . $tnomor . "</td>
		<td>" . $tasal . "</td>
		<td>" . $ttujuan . "</td>
		<td>" . $ttanggal . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-success' ><a href='index.php?id_status=" . $id .  "' style='color: white; font-weight: bold;'>Selesai</a></button>
		</td>
		</tr>";
		$no++;
	}
}

if(isset($_GET['id_hapus'])){
	$id_data = $_GET['id_hapus'];

	$otravel->deleteTravel($id_data);

	unset($_GET['id_hapus']);

	header("Location: index.php");
}

if(isset($_GET['id_status'])){
	$id_status = $_GET['id_status'];

	$otask->updateTravel($id_status);

	unset($_GET['id_status']);
	
	header("Location: index.php");
}

// Menutup koneksi database
$otravel->close();

// Membaca template skin.html
$tpl = new Template("templates/skin.html");

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);

// Menampilkan ke layar
$tpl->write();