<?php 
	foreach ($qbarang as $rowdata) {
		$kode_barang = $rowdata->kode_barang;
		$nama_barang = $rowdata->nama_barang;
		$id_jenis = $rowdata->id_jenis;
		$merk = $rowdata->merk;
		$versi = $rowdata->versi;
		$sumber = $rowdata->sumber;
		$tgl_beli = $rowdata->tgl_beli;
		$tgl_expired = $rowdata->tgl_expired;
		$harga_beli = $rowdata->harga_beli;
		$jumlah = $rowdata->jumlah;
		$satuan = $rowdata->satuan;
		$qr_code = $rowdata->qr_code;
	}
?>
<div class="container">
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel panel-heading"><b>Detail Barang</b></div>
				<div class="panel panel-body">
				<div class="tabel-responsive">
				<div class="page-header">
				<a href="<?php echo base_url()?>index.php/barang2" class="btn btn-sm btn-info"><i class="glyphicon glyphicon-repeat"></i> Kembali</a>
				</div>
				<table id="tabel_detbarang" class="table table-striped">
					<tr>
						<td width="30%">Kode Barang</td>
						<td><?php echo $kode_barang ?></td>
					</tr>
					<tr>
						<td>Nama Barang</td>
						<td><?php echo $nama_barang ?></td>
					</tr>
					<tr>
						<td>Jenis Barang</td>
						<td><?php echo $id_jenis ?></td>
					</tr>
					<tr>
						<td>Merk</td>
						<td><?php echo $merk ?></td>
					</tr>
					<tr>
						<td>Versi</td>
						<td><?php echo $versi ?></td>
					</tr>
					<tr>
						<td>Sumber</td>
						<td><?php echo $sumber ?></td>
					</tr>
					<tr>
						<td>Tanggal Beli</td>
						<td><?php echo $tgl_beli ?></td>
					</tr>
					<tr>
						<td>Tanggal Expired</td>
						<td><?php echo $tgl_expired ?></td>
					</tr>
					<tr>
						<td>Harga Beli</td>
						<td><?php echo $harga_beli ?></td>
					</tr>
					<tr>
						<td>Jumlah</td>
						<td><?php echo $jumlah?></td>
					</tr>
					<tr>
						<td>Satuan</td>
						<td><?php echo $satuan ?></td>
					</tr>
				</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>