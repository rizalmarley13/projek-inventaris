<?php 
foreach ($ambil_data as $tampildata) {
	$nodetail = $tampildata->nodetail;
	$no_ruangan = $tampildata->no_ruangan;
	$kode_barang = $tampildata->kode_barang;
	$nama_barang = $tampildata->nama_barang;
	$merk = $tampildata->merk;
	$versi = $tampildata->versi;
	$satuan = $tampildata->satuan;
	$status = $tampildata->status;
	$keterangan = $tampildata->keterangan;
}
?>

<div class="container">
	<div class="row">
		<div class="col-lg-11">
		<form method="POST" action="<?php echo base_url();?>index.php/mutasi/simpan_mutasi">
			<P><?php echo $this->session->flashdata('info') ?></P>
			<div class="navbar-form pull-right">
				<div class="input group">
					<input type="text" name="no_mutasi" class="form-control" value="<?php echo $no_mutasi?>" placeholder="No mutasi" readonly>
					<input type="text" name="tgl_mutasi" class="form-control tanggal" value="" placeholder="Tanggal Mutasi" required>
				</div>
			</div>
			<table class="table table-striped">
			<tr>
				<input type="hidden" name="nodetail" class="form-control" value="<?php echo $nodetail; ?>" readonly>
			</tr>
			<tr>
				<td width="20%">No Ruangan Asal</td>
				<td>
					<div class="col-lg-2">
						<input type="text" name="no_ruangan" class="form-control" value="<?php echo $no_ruangan; ?>" readonly>
					</div>
				</td>
			</tr>
			<tr>
				<td>No Ruangan Baru</td>
				<td>
					<div class="col-lg-2">
						<Select name="ruangan_baru" class="form-control" required>
							<option value="">--Pilih--</option>
							<?php foreach ($ruang as $listruang) { ?>
							<option value="<?php echo $listruang->no_ruangan?>"><?php echo $listruang->no_ruangan?></option>
							<?php } ?>
						</Select>
					</div>
				</td>
			</tr>
			<!-- <tr>
				<td></td>
				<td>
					<div class="col-lg-4">	
						<input type="text" name="barang_mutasi" id="barang_mutasi" class="form-control" placeholder="ketik nama barang">	
					</div>
				</td>
			</tr> -->
			<tr>
				<td>Kode Barang</td>
				<td>
					<div class="col-lg-3">
						<input type="text" name="kode_barang" id="kode_barang" class="form-control" value="<?php echo $kode_barang?>" readonly>
					</div>
				</td>
			</tr>
			<tr>
				<td>Nama Barang</td>
				<td>
					<div class="col-lg-4">	
						<input type="text" name="nama_barang" id="nama_barang" class="form-control" value="<?php echo $nama_barang?>" readonly>	
					</div>
				</td>
			</tr>
			<tr>
				<td>Merk</td>
				<td>
					<div class="col-lg-4">
						<input type="text" name="merk" id="merk" class="form-control" value="<?php echo $merk; ?>" readonly>
					</div>
				</td>
			</tr>
			<tr>
				<td>Versi</td>
				<td>
					<div class="col-lg-3">
						<input type="text" name="versi" id="versi" class="form-control" value="<?php echo $versi?>" readonly>
					</div>
				</td>
			</tr>
			<tr>
				<td>Jumlah Mutasi</td>
				<td>
					<div class="col-lg-2">
						<input type="text" name="jumlah_mutasi" id="jumlah" class="form-control" required><span id="pesan1" style="color:red"></span>
					</div>
				</td>
			</tr>
			<tr>
				<td>Satuan</td>
				<td>
					<div class="col-lg-3">
						<input type="text" name="satuan" id="satuan" class="form-control" value="<?php echo $satuan?>" readonly>
					</div>
				</td>
			</tr>
			<tr>
				<td>Status</td>
				<td>
					<div class="col-lg-3">
						<input type="text" name="status" id="status" class="form-control" value="Mutasi" readonly>
					</div>
				</td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td>
					<div class="col-lg-6">
						<textarea class="form-control" rows="5" name="keterangan"><?php echo $keterangan; ?></textarea>
					</div>
				</td>
			</tr>
			</table>
			<button type="submit" class="btn btn-primary btn-small"><span class="fa fa-floppy-o fa-fw"></span> Simpan</button>
			<a href="<?php echo base_url();?>index.php/letak_barang/lihat_detail_brg/<?php echo $no_ruangan?>" class="btn btn-small btn-warning"><span class="fa fa-remove"></span> Batal</a>
		</form>
		<br>
		<br>
		<br>
 	</div>
</div>
</div>