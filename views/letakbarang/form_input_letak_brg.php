<div class="container">
<div class="row">
<div class="col-md-12">
	<form class="form-vertical" method="POST" action="<?php echo base_url()?>index.php/letak_barang/simpan_letak_brg">
	<P><?php echo $this->session->flashdata('info') ?></P>
	<div class="col-md-2">
		<label class="label-control">No Ruangan</label>
		<select name="no_ruangan" id="no_ruangan" class="form-control" required="harus diisi">
			<option value="">--Pilih--</option>
			<?php foreach ($ruang as $listruang) { ?>
			<option value="<?php echo $listruang->no_ruangan?>"><?php echo $listruang->no_ruangan?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-md-12">
		<br>
		<hr>
	</div>
	<div class="col-md-12">
	<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<thead>
				<th>No</th>
				<th>Kode Barang</th>
				<th>Nama Barang</th>
				<th width="20%">Merk</th>
				<th>Jumlah</th>
				<th>satuan</th>
				<th width="15%">
					<button type="button" class="btn btn-success btn-small" data-toggle="modal" data-target="#modalAddLetakBarang">
							<span class="fa fa-plus fa-fw"></span> Tambah Barang</button>
				</th>
			</thead>
			<tbody>
				<?php 
				$no = 1;
				if(empty($data_sementara)) { ?>
				<tr>
					<td colspan="14" align="center">Data Masih Kosong</td>
				</tr>		
				<?php } else { 
				foreach ($data_sementara as $rowdata) { ?>
				<tr>
					<td><?php echo $no++;?></td>
					<td><?php echo $kode_barang = $rowdata->kode_barang?></td>
					<td><?php echo $nama_barang = $rowdata->nama_barang?></td>
					<td><?php echo $merk = $rowdata->merk?></td>
					<td><?php echo $jumlahbrg = $rowdata->jumlah?></td>
					<td><?php echo $satuan = $rowdata->satuan?></td>
					<td><a href="<?php echo base_url();?>index.php/letak_barang/hapus_byid/<?php echo $rowdata->kode_barang;?>" class="btn btn-danger btn-small">Hapus</a></td>
				<?php }} ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" align="center"><b>Total Barang</b></td>
					<td width="5%"><input type="text" name="total_barang" id="total_barang" class="form-control" value="<?php foreach ($jmltotal as $rowtotal) {
						echo $total = $rowtotal->total;
					}?>" 
					readonly>
				</tr>
			</tfoot>
		</table>
	</div>
	</div>	
	<div class="col-md-12">
		<br>
	
		&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary btn-small"><span class="fa fa-floppy-o fa-fw"></span> Simpan</button>
		<a href="<?php echo base_url();?>index.php/letak_barang" class="btn btn-info btn-small"><span class="fa fa-undo fa-fw"></span> Kembali</a>
	</div>
	
</form>

<!--MODAL LETAK BARANG-->
<div id="modalAddLetakBarang" class="modal fade" role="dialog">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal">×</button>
    		<h3 class="modal-tittle">Tambah Barang</h3>
		</div>
		<div class="modal-body">
	        <form id="frm" name="frm" class="form-horizontal" method="post" action="<?php echo base_url()?>index.php/letak_barang/tambah_tabel_sementara">
	            <div class="control-group">
	                <label class="control-label">Daftar Barang</label>
	                <div class="controls">
	                    <select id="kode_barang_letak" tabindex="5" class="form-control" name="kode_barang" value="" data-placeholder="Pilih Barang">
	                        <option value=""></option>
	                        <?php
	                        if(isset($data_barang)){
	                            foreach($data_barang as $row){
	                                ?>
	                                <option value="<?php echo $row->kode_barang?>"><?php echo $row->nama_barang?></option>
	                            <?php
	                            }
	                        }
	                        ?>
	                    </select>
	                </div>
	            </div>

	            <div id="detail_barang" name="detail_barang"></div>

        	<div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                <button type="submit" class="btn btn-primary" disabled="disabled" name="add">Tambah</button>
        	</div>
    		</form>
		</div>
	</div>
</div>
</div>

<script type="text/javascript">
	function simpan_data()
	{
		var no_ruangan = $("#no_ruangan").val();
		var total_barang = $("#total_barang").val();

		$.ajax({
			url : "<?php site_url('mutasi/simpan_letak_brg')?>",
			type : "post",
			data : {no_ruangan:no_ruangan,total_barang:total_barang},
			succes : function(res){
				if(res!='failed'){
					$("#pesan").html("Data Berhasil Diproses").addClass("alert alert-success");
				}
				else
				{
					alert('gagal menyimpan data');	
				}
			}
		});
	}
</script>