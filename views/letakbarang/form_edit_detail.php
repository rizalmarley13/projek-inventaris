<div class="container">
<div class="row">
	<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel panel-heading">Edit Data Detail Letak Barang</div>
				<div class="panel panel-body">

				<p><?php echo $this->session->flashdata('info')?></p>
					
					<?php foreach ($data_detail as $rowdetail) { ?>
					<form method="POST" role="form" action="<?php echo base_url();?>index.php/letak_barang/update_detail_letak">
						<table class="table table-striped">
							
							<input type="hidden" name="nodetail" id="nodetail" class="form-control" value="<?php echo $nodetail = $rowdetail->nodetail?>">
							<tr>
								<td width="20%">No Ruangan</td>
								<td>
									<div class="col-lg-2">
										<input type="text" name="no_ruangan" id="no_ruangan" class="form-control" value="<?php echo $no_ruangan = $rowdetail->no_ruangan?>">
									</div>
								</td>
							</tr>
							<tr>
								<td>Kode Barang</td>
								<td>
									<div class="col-lg-3">
										<input type="text" name="kode_barang" id="kode_barang" class="form-control" value="<?php echo $kode_barang = $rowdetail->kode_barang?>">
									</div>
								</td>
							</tr>
							<tr>
								<td>Nama Barang</td>
								<td>
									<div class="col-lg-4">
										<input type="text" name="nama_barang" id="nama_barang" class="form-control" value="<?php echo $nama_barang = $rowdetail->nama_barang?>">
									</div>
								</td>
							</tr>
							<tr>
								<td>Merk</td>
								<td>
									<div class="col-lg-4">
										<input type="text" name="merk" id="merk" class="form-control" value="<?php echo $merk = $rowdetail->merk?>">
									</div>
								</td>
							</tr>
							<tr>
								<td>Versi</td>
								<td>
									<div class="col-lg-4">
										<input type="text" name="versi" id="versi" class="form-control" value="<?php echo $versi = $rowdetail->versi?>">
									</div>
								</td>
							</tr>
							<tr>
								<td>Jumlah Lama</td>
								<td>
									<div class="col-lg-2">
										<input type="text" name="jumlah" id="jumlah" class="form-control" value="<?php echo $jumlah = $rowdetail->jumlah?>" readonly>
									</div>
								</td>
							</tr>
							<tr>
								<td>Jumlah Baru</td>
								<td>
									<div class="col-lg-4">
										<input type="text" name="jumlah_baru" id="jumlah_baru" class="form-control" value="" placeholder="Diisi jika ada perubahan jumlah">
									</div>
								</td>
							</tr>
							<tr>
								<td>Satuan</td>
								<td>
									<div class="col-lg-4">
										<input type="text" name="satuan" id="satuan" class="form-control" value="<?php echo $satuan = $rowdetail->satuan?>">
									</div>
								</td>
							</tr>
							<tr>
								<td>Status</td>
								<td>
									<div class="col-lg-4">
										<input type="text" name="status" id="status" class="form-control" value="<?php echo $status = $rowdetail->status?>">
									</div>
								</td>
							</tr>
							<tr>
								<td>Kondisi</td>
								<td>
									<div class="col-lg-3">
										<input type="text" name="kondisi" id="kondisi" class="form-control" value="<?php echo $kondisi = $rowdetail->kondisi?>">
									</div>
								</td>
							</tr>
							<tr>
								<td>Keterangan</td>
								<td>
									<div class="col-lg-8">
										<textarea class="form-control" name="keterangan" id="keterangan" rows="5"><?php echo $keterangan = $rowdetail->keterangan?></textarea>
									</div>
								</td>
							</tr>
							<?php } ?>
						</table>
						<br>
						<br>
						&nbsp;&nbsp;<button type="submit" class="btn btn-small btn-primary"><span class="fa fa-save"></span> Simpan</button>
						<a href="<?php echo base_url();?>index.php/letak_barang/lihat_detail_brg/<?php echo $no_ruangan = $rowdetail->no_ruangan?>" class="btn btn-small btn-warning"><span class="fa fa-remove"></span> Batal</a>
					</form>
				</div>
			</div>
	</div>
</div>
</div>