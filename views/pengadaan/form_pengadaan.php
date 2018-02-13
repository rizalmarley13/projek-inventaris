<!-- konten form -->
<div class="container">
<div class="row">
	<div class="col-md-11">
	<P><?php echo $this->session->flashdata('info') ;?></P>
	<p><?php echo $error ;?></p>
		<form role="form" method="POST" action="<?php echo base_url()?>index.php/pengadaan/kirim_pengadaan">
		<div class="col-md-8"></div>
		<div class="col-md-2">
		<div class="form-group">
			<input type="text" name="no_pengadaan" class="form-control" placeholder="No Pengadaan" value="<?php echo $no_pengadaan?>" readonly>
		</div>
		</div>
		<div class="col-md-2">
		<div class="form-group">
			<div class="input-group date">
				<input type="text" name="tgl_pengadaan" class="form-control" value="<?php echo date('Y-m-d');?>" placeholder="Tanggal Pengadaan" readonly>
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
				<input type="hidden" name="id_karyawan" class="form-control" value="<?php echo $this->session->userdata('id_karyawan')?>" readonly>
			</div>
		</div>
		</td>
		</tr>
		<tr>
		<td>
		<div class="col-md-3">
			<div class="form-group">
				<input type="hidden" name="nama_karyawan" class="form-control" value="<?php echo $this->session->userdata('nama_karyawan')?>" readonly>
			</div>
		</div>
		</td>
		</tr>
		<tr>
		<td>
			<div class="col-md-3">
				<div class="form-group">
					<input type="hidden" name="bagian" class="form-control" value="<?php echo $this->session->userdata('bagian')?>" readonly>
				</div>
			</div>
		</td>
		</tr>
		<tr>
			<td>
				<div class="col-md-3">
					<div class="form-group">
						<input type="hidden" name="jabatan" class="form-control" value="<?php echo $this->session->userdata('nama_jabatan')?>" readonly>
						<?php $nama_jabatan = $this->session->userdata('nama_jabatan')?>
					</div>
				</div>
				<hr>
			</td>
		</tr>
		<tr>
			<td>
				<div class="form-group">
					<label><h3>Input Pengadaan Barang / Jasa</h3></label>
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
				<th><p align="center">Keterangan</p></th>
				<th width="15%">
					<button type="button" class="btn btn-success btn-small" data-toggle="modal" data-target="#modal_pengadaan">
							<span class="fa fa-plus fa-fw"></span> Tambah Barang / Jasa</button>
				</th>
			</thead>
			<tbody>
			<?php 
				if (empty($data_smtr_pengadaan)) { ?>
				<tr>
					<td colspan="14" align="center">Data Masih Kosong</td>
				</tr>
			<?php } else { 
			$no = 1;
			foreach ($data_smtr_pengadaan as $rowdata) { ?>
			<tr align="center">
				<td><?php echo $no++;?></td>
				<td><?php echo $rowdata->nama_brg_jasa;?></td>
				<td><?php echo $rowdata->spesifikasi;?></td>
				<td><?php echo $rowdata->jumlah;?></td>
				<td><?php echo $rowdata->satuan;?></td>
				<td><img src="<?php echo base_url();?>asset/uploads/<?php echo $rowdata->nama_gbr;?>"></td>
				<td><?php echo $rowdata->keterangan;?></td>
				<td>
					<a href="<?php echo base_url();?>index.php/pengadaan/hapus_brg_pengadaan/<?php echo $rowdata->no;?>" class="btn btn-danger btn-sm">Hapus</a>
				</td>
			</tr>
				<?php } } ?>		
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3" align="center"><b>Total Barang / Jasa</b></td>
					<td width="5%"><input type="text" name="total_barang" id="total_barang" class="form-control" value="<?php foreach ($total_brg as $rowtotal) {
						echo $total_barang = $rowtotal->total_barang;
					};?>" 
					readonly>
				</tr>
			</tfoot>
		</table>
		</div>
		<div class="table-responsive">
		<table>
		<tr>
			<input type="hidden" name="komen_pk2" class="form-control" rows="5" id="text_jasa" placeholder="Komentar">
			<input type="hidden" name="komen_pjm" class="form-control" rows="5" id="text_jasa" placeholder="Komentar">
		</tr>
		<tr>
			<td>
				<div class="col-md-3">
				<input type="hidden" name="kirim_ke" value="<?php if($nama_jabatan == "Petugas Akademik"){
					echo "Kepala Administrasi Akademik & Kemahasiswaan";}
					else{
						echo "kepala Sarpras";
					}
					?>" class="form-control">
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
		</div>
		</form>
		<br>
		<br>
		</div>
	</div>
</div>
</div>

<!--MODAL PENGADAAN BARANG-->
<div id="modal_pengadaan" class="modal fade" role="dialog">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal">×</button>
    		<h3 class="modal-tittle">Tambah Barang / Jasa</h3>
		</div>
		<div class="modal-body">
	        <form id="form_pengadaan" name="form_pengadaan" class="form-horizontal" method="post" action="<?php echo base_url();?>index.php/pengadaan/tambah_tabel_smtr_pengadaan" enctype="multipart/form-data">
	            <div class="control-group">
	                <label class="control-label">Nama Barang / jasa</label>
	                <div class="controls">
	                	<input type="text" name="nama_brg_jasa" id="nama_brg_jasa" value="" placeholder="Nama barang / Jasa" class="form-control" required="harus diisi">
	                	<span id="pesan" text-color="red"></span>
	                </div>
	            </div>
	            <div class="control-group">
	                <label class="control-label">Spesifikasi</label>
	                <div class="controls">
	                	<textarea name="spesifikasi" class="form-control" rows="5" id="spesifikasi" placeholder="spesifikasi" required="harus diisi"></textarea>
	                </div>
	            </div>
	            <div class="control-group">
	                <label class="control-label">Jumlah</label>
	                <div class="controls">
	                	<input type="text" name="jumlah" id="jumlah" value="" placeholder="Jumlah" class="form-control" required="harus diisi">
	                	<span id="pesan1" text-color="red"></span>
	                </div>
	            </div>
	            <div class="control-group">
	                <label class="control-label">Satuan</label>
	                <div class="controls">
	                	<select type="text" name="satuan" value="" placeholder="satuan" class="form-control" required="harus diisi" >
	                		<option value="-">--Pilih--</option>
	                		<option value="Unit">Unit</option>
	                		<option value="Rim">Rim</option>
	                		<option value="Pieces">Pieces</option>
	                		<option value="Kg">Kg</option>
	                	</select>
	                </div>
	            </div>
	             <div class="control-group">
	            	<label class="control-label">Contoh Gambar Barang</label>
	            	<input type="file" name="filegambar" class="form-control">
	            	Maximal 2 MB..
	            </div>
	            <div class="control-group">
	                <label class="control-label">Keterangan</label>
	                <div class="controls">
	                	<textarea name="keterangan" class="form-control" rows="5" id="ketangan" placeholder="Keterangan"></textarea>
	                </div>
	            </div>
        	<div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                <button type="submit" class="btn btn-primary" name="add">Tambah</button>
        	</div>
    		</form>
		</div>
	</div>
</div>
</div>

