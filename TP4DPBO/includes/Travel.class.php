<?php 

/******************************************
TUGAS PRAKTIKUM DPBO
******************************************/
class Travel extends DB{
	
	// Mengambil data
	function getTravel(){
		// Query mysql select data ke tb_data
		$query = "SELECT * FROM tb_data"; 

		// Mengeksekusi query
		return $this->execute($query);
	}

	function insertTravel($data){
		$tnama = $data['tnama'];
		$tnomor = $data['tnomor'];
		$tasal = $data['tasal'];
		$ttujuan = $data['ttujuan'];
		$ttanggal = $data['ttanggal'];
		$tstatus = "Belum";

		$query = "INSERT INTO tb_data (nama, nomor, asal, tujuan, tanggal, status) VALUES ('$tnama', '$tnomor', '$ttujuan', '$tasal', '$ttanggal', '$tstatus')";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function deleteTravel($id_data){
		$query = "DELETE FROM tb_data WHERE id=$id_data";

		return $this->execute($query);
	}

	function updateTracelk($id){
		$query = "UPDATE tb_data SET status = 'Sudah' WHERE id = $id";

		return $this->execute($query);
	}
	
}



?>
