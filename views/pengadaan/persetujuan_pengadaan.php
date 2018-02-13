<!-- konten form -->
<div class="container">
<div class="row">
	<div class="col-md-11">
	<P><?php echo $this->session->flashdata('info') ?></P>
	<?php 
		foreach ($dnotif as $row) { ?>

		<form role="form" method="POST" action="<?php echo base_url()?>index.php/pengadaan/persetujuan/<?php echo $row->id_notif ;?>">
		<div class="col-md-8"></div>
		<div class="col-md-2">
		<div class="form-group">
			<input type="text" name="no_pengadaan" class="form-control" placeholder="No Pengadaan" value="<?php echo $row->id_notif ;?>" readonly>
		</div>
		</div>
		<div class="col-md-2">
		<div class="form-group">
			<div class="input-group date">
				<input type="text" name="tgl_pengadaan" class="form-control" value="<?php echo $row->tgl_pengadaan ;?>" placeholder="Tanggal Pengadaan" readonly>
				<span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
		</div>
		</div>
		
		<br>
		<br>
		<table>
		<tr>
		<td width="20%">
		<div class="col-md-3">
			<div class="form-group">
				<input type="hidden" name="id_karyawan" class="form-control" value="<?php echo $row->id_karyawan ;?>" readonly>
			</div>
		</div>
		</td>
		</tr>
		<tr>
		<td>
		<div class="col-md-3">
			<div class="form-group">
				<input type="hidden" name="nama_karyawan" class="form-control" value="<?php echo $row->nama_karyawan ;?>" readonly>
			</div>
		</div>
		</td>
		</tr>
		<tr>
		<td>
			<div class="col-md-3">
				<div class="form-group">
					<input type="hidden" name="bagian" class="form-control" value="<?php echo $row->bagian ;?>" readonly>
				</div>
			</div>
		</td>
		</tr>
		<tr>
			<td>
				<div class="col-md-3">
					<div class="form-group">
						<input type="hidden" name="jabatan" class="form-control" value="<?php echo $row->jabatan ;?>" readonly>
					</div>
				</div>
				<?php } ?>
				<hr>
			</td>
		</tr>
		<tr>
			<td>
				<div class="form-group">
					<label><h3>Data Pengadaan Barang / Jasa</h3></label>
				</div>
			</td>
		</tr>
		</table>
		<!-- batas session pengguna-->
		<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<thead>
				<th width="1%"><p align="center">No</p></th>
				<th width="20%"><p align="center">Nama Barang / Jasa</p></th>
				<th><p align="center">Spesifikasi</p></th>
				<th><p align="center">Jumlah</p></th>
				<th><p align="center">Satuan</p></th>
				<th><p align="center">Contoh Barang</p></th>
				<th width="15%"><p align="center">Keterangan</p></th>
			</thead>
			<tbody>
			<?php 
				if (empty($dpengadaan)) { ?>
				<tr>
					<td colspan="14" align="center">Data Masih Kosong</td>
				</tr>
			<?php } else { 
			$no = 1;
			foreach ($dpengadaan as $rowdpengadaan) { ?>
			<tr align="center">
				<td><?php echo $no++;?></td>
				<td><?php echo $rowdpengadaan->nama_brg_jasa;?></td>
				<td><?php echo $rowdpengadaan->spesifikasi;?></td>
				<td><?php echo $rowdpengadaan->jumlah;?></td>
				<td><?php echo $rowdpengadaan->satuan;?></td>
				<td><img src="<?php echo base_url();?>asset/uploads/<?php echo $rowdpengadaan->nama_gbr;?>"></td>
				<td><?php echo $rowdpengadaan->keterangan;?></td>
			</tr>
				<?php } } ?>	
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3" align="center"><b>Total Barang / Jasa</b></td>
					<td width="5%"><input type="text" name="total_barang" id="total_barang" class="form-control" value="<?php foreach ($total_brg as $rowtotal) {
						echo $total_detail = $rowtotal->total_detail;
					};?>" 
					readonly>
				</tr>
			</tfoot>
		</table>
		</div>
		
		<hr size="12px">
		<table>
		<tr>
			<td width="10%">
				<div class="col-md-8">
				<div class="form-group">
					<label>Komentar PK II Bidang Keuangan</label>
					<textarea name="komen_pk2" class="form-control" rows="5" id="text_jasa" placeholder="Komentar PK II Bidang Keuangan"></textarea>
				</div>
				</div>
			</td>
		</tr>
		<tr>
		<tr>
			<td width="10%">
				<div class="col-md-8">
				<div class="form-group">
					<label>Komentar Kepala PJM</label>
					<textarea name="komen_pjm" class="form-control" rows="5" id="text_jasa" placeholder="Komentar Kepala PJM"></textarea>
				</div>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="col-md-8">
				<div class="form-group">
					<input type="radio" name="status" value="Disetujui" required="harus diisi"> Disetujui &nbsp;&nbsp;
					<input type="radio" name="status" value="Pending" required="harus diisi"> Pending &nbsp;&nbsp;
					<input type="radio" name="status" value="Tidak Disetujui" required="harus diisi"> Tidak Disetujui
				</div>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<div class="col-md-3">
				<input type="hidden" name="kirim_ke" value="" class="form-control">
				</div>
			</td>
		</tr>
		<tr>
			<td>
			<div>
			&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary btn-small"><span class="fa fa-send fa-fw"></span> Kirim</button>
			</div>
			</td>
		</tr>
		</table>
		</form>
		<br>
		<br>
		</div>
	</div>
</div>
</div>
