<script type="text/javascript">
	$("#tambah").click(function){
		$("#jumlah").focus();
	}
</script>
<div class="container">
<div class="row">
	<div class="col-lg-11">
		<div class="panel panel-default">
			<div class="panel panel-heading">Input Permintaan</div>
			<div class="panel panel-body">
				<form method="POST" action="<?php echo base_url();?>index.php/permintaan/tambah_permintaan">
				<table class="table table-striped">
				<tr></tr>
					<tr>
						<td width="20%">No. Permintaan</td>
						<td>
							<div class="col-lg-2">
							<input type="text" name="no_permintaan" class="form-control" value="" readonly>
							</div>
						</td>
					</tr>
					<tr>
						<td>Tanggal Permintaan</td>
						<td>
							<div class="col-lg-4">
							<div class="input-group date">
					         	<input type="date" class="form-control" name="tgl_permintaan" >
					         	<span class="input-group-addon">
					         	<span class="glyphicon glyphicon-calendar"></span>
					         	</span>
					         </div>
					         </div>
						</td>
					</tr>
					<tr>
						<td>Id Karyawan</td>
						<td>
							<div class="col-lg-5">
								<input type="text" name="id_karyawan" class="form-control" value="">
							</div>
						</td>
					</tr>
					<tr>
						<td>Bagian</td>
						<td>
							<div class="col-lg-4">
								<input type="text" name="bagian" class="form-control" value="">
							</div>
						</td>
					</tr>
					<tr>
						<td>Jumlah Barang</td>
						<td>
							<div class="col-lg-2">
								<input type="text" name="jumlah_barang" class="form-control" value="">
							</div>
						</td>
					</tr>
					<tr>
						<td>Jumlah Disetujui</td>
						<td>
							<div class="col-lg-2">
								<input type="text" name="jumlah_disetujui" class="form-control" value="">
							</div>
						</td>
					</tr>
					<tr>
						<td>
						<button type="submit" class="btn btn-primary btn-small"> Simpan</button>
						</td>
					</tr>
				</table>
				</form>
				
				
				<button type="button" class="btn btn-success btn-small" data-toggle="modal" data-target="#myModal">Lihat Daftar Barang</button>

				<!--- Modal Daftar Barang-->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Data Barang</h4>
				      </div>
				      <div class="modal-body">
				        <table class="table table-striped">
				        	<thead>
				        		<tr>
				        			<th>Kode Barang</th>
				        			<th>Nama Barang</th>
				        			<th>Stock</th>
				        			<th>Satuan</th>
				        		</tr>
				        	</thead>
				        	<tbody>
				                <?php if (empty($data)) {?>
				                    <tr>
				                    <td colspan="14" align="center">Data Barang Masih Kosong</td>
				                    </tr>
				                        <?php } else {
	
				                        foreach ($data as $rowbarang) { ?>
				                    <tr>
				                        <td><?php echo $rowbarang->kode_barang; ?></td>
				                        <td><?php echo $rowbarang->nama_barang; ?></td>
				                        <td><?php echo $rowbarang->jumlah; ?></td>
				                        <td><?php echo $rowbarang->satuan; ?></td>
				                        <td>
				                        <a href="<?php echo base_url();?>index.php/permintaan/add_barang/tambah/<?php echo $rowbarang->kode_barang?>" class="btn btn-info btn-xs" id="tambah"><span class="fa fa-edit fa-fw"></span> Pilih</a>
				                        </td>
				                    </tr>
				                        <?php } }?>
					        </tbody>
				        </table>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				      </div>
				    </div>
				  </div>
				</div>
				<!--Batas Modal-->
				<?php
				if($aksi == "tambah"){
					$kode_barang = "";
					$nama_barang = "";
				}
				else
				{
					foreach ($qbarang as $rowmodal) {
						$kode_barang = $rowmodal->kode_barang;
						$nama_barang = $rowmodal->nama_barang;
					}
				}
				?>
				<form method="POST" action="<?php echo base_url();?>index.php/permintaan/add_barang/<?php echo $aksi;?>">
				<div class="col-lg-2">
					<div class="input group">
						<label>Kode Barang</label>
						<input type="text" name="kode_barang" class="form-control" id="kode_barang" value="<?php echo $kode_barang?>">
					</div>
				</div>
				<div class="col-lg-3">
					<div class="input group">
						<label>Nama Barang</label>
						<input type="text" name="nama_barang" class="form-control" value="<?php echo $nama_barang?>">
					</div>
				</div>
				<div class="col-lg-2">
					<div class="input group">
						<label>Jumlah</label>
						<input type="text" name="jumlah" id="jumlah" class="form-control" value="">
					</div>
				</div>
				<div class="col-lg-3">
					<div class="input group">
						<label>Satuan</label>
						<select name="satuan" class="form-control">
							<option value=""></option>
							<option value="">Pieces</option>
							<option value="">Rim</option>
							<option value="">Unit</option>
						</select>
					</div>
				</div>
				<br>
				<button type="submit" class="btn btn-info btn-small">Tambah</button>
				<button type="reset" class="btn btn-warning btn-small">Reset</button>
				</form>
			<table class="table table-striped bootstrap-datatable datatable">
					<thead>
						<tr>
							<th width="1%">No</th>
							<th>Kode Barang</th>
							<th>Nama Barang</th>
							<th>Jumlah</th>
							<th>Satuan</th>
							<th></th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
</div>