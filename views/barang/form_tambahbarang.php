<!-- konten form -->
<?php  
if ($aksi =='aksi_add') {
		$kode_barang = "";
		$nama_barang = "";
		$id_jenis = "";
		$merk = "";
		$versi = "";
		$sumber = "";
		$tgl_beli = "";
		$tgl_expired = "";
		$harga_beli = "";
		$jumlah = "";
		$satuan = "";
	} else {
		foreach ($qdata as $rowedit) {
			$kode_barang = $rowedit->kode_barang;
			$nama_barang = $rowedit->nama_barang;
			$id_jenis = $rowedit->id_jenis;
			$merk = $rowedit->merk;
			$versi = $rowedit->versi;
			$sumber = $rowedit->sumber;
			$tgl_beli = $rowedit->tgl_beli;
			$tgl_expired = $rowedit->tgl_expired;
			$harga_beli = $rowedit->harga_beli;
			$jumlah = $rowedit->jumlah;
			$satuan = $rowedit->satuan;
		}
	}
?>

<div class="container">
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel panel-heading">Input Data Barang</div>
			<div class="panel panel-body">
						<form method="POST" id="fromInput" action="<?php echo base_url(); ?>index.php/barang2/form/<?php echo $aksi?>" role="form" class="from-horizontal" >
							<table class="table table-striped">
								<tr>
									<td>
									<?php if ($aksi == 'aksi_add') { ?>
										<div class="col-md-3">
										<div class="form form-group">
										<label for="kode_barang">Kode Barang</label>
										<input type ="text" id="kode_barang" name="kode_barang" class ="form-control" value="<?php echo $get_kodebarang;?>" readonly>
										<p><?php echo form_error('kode_barang');?></p>
										</div>
										</div>
									<?php } else if ($aksi == 'aksi_edit') { ?>
										<div class="col-md-3">
										<div class="form form-group">
										<label for="kode_barang">Kode Barang</label>
										<input type ="text" id="kode_barang" name="kode_barang" class ="form-control" value="<?php echo $kode_barang?>" readonly>
										<p><?php echo form_error('kode_barang');?></p>
										</div>
										</div>
									<?php } ?>
										
									</td>
								</tr>
								<tr>
									<td>
										<div class="col-md-4">
										<div class="form form-group">
										<label for="nama_barang">Nama Barang</label>
										<input type ="text" id="nama_barang" name="nama_barang" class ="form-control" value="<?php echo $nama_barang?>" >
										<p><?php echo form_error('nama_barang');?></p>
										</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="col-md-3">
										<div class="form form-group">
										<label for="id_jenis">Jenis Barang</label>
										<select class="form-control" name="id_jenis" id="id_jenis" required>
											<option value="">--Pilih--</option>
										  	<option value="1"<?php if($aksi=="aksi_edit"){if($id_jenis=="1"){echo 'Selected';}}?>>Alat Tulis Kantor</option>
										  	<option value="2"<?php if($aksi=="aksi_edit"){if($id_jenis=="2"){echo 'Selected';}}?>>Komputer</option>
										  	<option value="3"<?php if($aksi=="aksi_edit"){if($id_jenis=="3"){echo 'Selected';}}?>>Perlengkapan Komputer</option>
										  	<option value="4"<?php if($aksi=="aksi_edit"){if($id_jenis=="4"){echo 'Selected';}}?>>Perlengkapan Perkuliahan</option>
										  	<option value="5"<?php if($aksi=="aksi_edit"){if($id_jenis=="5"){echo 'Selected';}}?>>Perlengkapan Kantor</option>
										  	<option value="6"<?php if($aksi=="aksi_edit"){if($id_jenis=="6"){echo 'Selected';}}?>>Perlengkapan Promosi</option>
										</select>
										</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="col-md-4">
										<div class="form form-group">
										<label for="merk">Merk</label>
										<input type="text" name="merk" id="merk" class="form-control" value="<?php echo $merk ?>">
										</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="col-md-4">
										<div class="form form-group">
										<label for="versi">Versi</label>
										<input type ="text" id="versi" name="versi"  class ="form-control" value="<?php echo $versi ?>">
										</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="col-md-2">
										<div class="form form-group">
										<label for="sumber">Sumber</label>
											<select class="form-control textbox" name="sumber" id="sumber">
											<option value="" <?php if($aksi=="aksi_edit"){if($sumber==""){echo 'Selected';}}?>></option>
										  	<option value="Beli"<?php if($aksi=="aksi_edit"){if($sumber=="Beli"){echo 'Selected';}}?>>Beli</option>
										  	<option value="Hibah"<?php if($aksi=="aksi_edit"){if($sumber=="Hibah"){echo 'Selected';}}?>>Hibah</option>
											</select>
										</div>
										</div>	
									</td>
								</tr>
								<tr>
									<td>
								        <div class="col-md-3">
								         	<label for="tgl_beli">Tanggal Beli</label>
	            							<div class="input-group date " data-date="" data-date-format="yyyy-mm-dd">
	                							<input class="form-control tanggal" type="date" name="tgl_beli" value="<?php echo $tgl_beli?>">
	                							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            								</div>
        								</div>
									</td>
								</tr>				
								<tr>
									<td>
										<div class="col-md-3">
										<div class="form form-group">
										<label for="tgl_expired">Tanggal Kadaluarsa</label>
											<div class="input-group date " data-date="" data-date-format="yyyy-mm-dd">
	                							<input class="form-control tanggal" type="date" name="tgl_expired" value="<?php echo $tgl_expired?>">
	                							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            								</div>
									    </div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="col-md-3">
										<label for="harga_beli">Harga Beli</label>
											<input type ="text" id="harga_beli" name="harga_beli" class ="form-control textbox" value="<?php echo $harga_beli ?>"><span id="pesan2" style="color:red"></span>
											<p><?php echo form_error('harga_beli'); ?></p>
										</div>		
									</td>
								</tr>
								<tr>
									<td>
										<div class="col-md-2">
										<div class="form form-group">
										<label for="jumlah">Jumlah</label>
											<input type ="text" id="jumlah" name="jumlah" class ="form-control textbox" value="<?php echo $jumlah ?>"><span id="pesan1" style="color:red"></span>
											<p><?php echo form_error('jumlah'); ?></p>
										</div>
										</div>
									</td>
								</tr>
								<tr>
									<td>
									<div class="col-md-2">
									<div class="form form-group">
									<label for="satuan">Satuan</label>
										<select class="form-control" id="satuan" name="satuan" required>
										<option value=""<?php if($aksi=="aksi_edit"){if($satuan==""){echo 'Selected';}}?>></option>
									  	<option value="Unit"<?php if($aksi=="aksi_edit"){if($satuan=="Unit"){echo 'Selected';}}?>>Unit</option>
									  	<option value="Rim"<?php if($aksi=="aksi_edit"){if($satuan=="Rim"){echo 'Selected';}}?>>Rim</option>
									  	<option value="Pieces"<?php if($aksi=="aksi_edit"){if($satuan=="Pieces"){echo 'Selected';}}?>>Pieces</option>
									  	<option value="Kg"<?php if($aksi=="aksi_edit"){if($satuan=="Kg"){echo 'Selected';}}?>>Kg</option>
										</select>
										</div>
										</div>
									</td>
								</tr>
							</table>
							<button type ="submit" class="btn btn-primary btn-small" id="simpan_brg">Simpan</button>
							<a href="<?php echo base_url()?>index.php/barang2" class="btn btn-small btn-info"><i class="glyphicon glyphicon-repeat"></i> Kembali</a>
						</form>
						<br>
						<br>
					</div>
			</div>
	</div>
</div>
</div>