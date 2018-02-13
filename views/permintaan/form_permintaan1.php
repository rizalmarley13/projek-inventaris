<!-- konten form -->
<div class="container">
<div class="row">
	<div class="col-md-12">
	<div id="pesan"></div>
	<form class="form" method="POST" action="<?php echo base_url()?>index.php/permintaan/tambah_permintaan">
	<P><?php echo $this->session->flashdata('info') ?></P>
		<div class="col-md-8"></div>
		<div class="col-md-2">
		<div class="form-group">
			<input type="text" name="no_permintaan" id="no_permintaan" class="form-control" placeholder="No permintaan" value="<?php echo $kodepermintaan ?>" readonly>
		</div>
		</div>
		<div class="col-md-2">
		<div class="form-group">
			<div class="input-group date">
				<input type="text" name="tgl_permintaan" id="tgl_permintaan" class="form-control" data-date-format="dd-mm-yyyy" value="<?php echo isset($date) ? $date : date('d-m-Y')?>" data-date="12-02-2012" placeholder="Tanggal Permintaan" readonly>
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
				<label>Id Karyawan</label>
				<input type="text" name="id_karyawan" id="id_karyawan" class="form-control" value="<?php echo $this->session->userdata('id_karyawan')?>" readonly>
			</div>
		</div>
		</td>
		</tr>
		<tr>
		<td>
		<div class="col-md-3">
			<div class="form-group">
				<label>Nama Karyawan</label>
				<input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control" value="<?php echo $this->session->userdata('nama_karyawan')?>" readonly>
			</div>
		</div>
		</td>
		</tr>
		<tr>
		<td>
		<div class="col-md-3">
			<div class="form-group">
				<label>Bagian</label>
				<input type="text" name="bagian" id="bagian" class="form-control" value="<?php echo $this->session->userdata('bagian')?>" readonly>
			</div>
		</div>
		</td>
		</tr>
		</table>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Kode Barang</th>
					<th>Nama Barang</th>
					<th width="10%">Jumlah</th>
					<th>Satuan</th>
					<th width="25%">
						<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#modalAddPermintaanBarang">
							<span class="fa fa-plus fa-fw"></span> Tambah Barang</button>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; $no=1;?>
				<?php foreach ($this->cart->contents() as $items) : ?>
					<?php echo form_hidden('rowid[]', $items['rowid']); ?>

				<tr class="gradeX">
					<td><?php echo $no; ?></td>
					<td><?php echo $items['id']; ?></td>
					<td><?php echo $items['name']; ?></td>
					<td><?php echo $items['qty']; ?></td>
					<td><?php echo $items['options']; ?></td>
					<td>
						<a href="<?php echo base_url()?>index.php/permintaan/hapus_item/<?php echo $items['rowid']; ?>" class="btn btn-danger btn-small"><span class="fa fa-trash fa-fw delbutton"></span> Hapus</a>
					</td>
				</tr>
				<?php $i++; $no++;?>
				<?php endforeach; ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3" align="center"><b>Total Barang</b></td>
					<td><input type="text" class="form-control" name="total_barang" id="total" value="<?php echo $this->cart->total_items(); ?>" readonly></td>
				</tr>
			</tfoot>
		</table>
		<br>
		&nbsp;&nbsp;<button type="submit" class="btn btn-primary btn-small"><span class="fa fa-floppy-o fa-fw"></span> Simpan</button>
		<a href="<?php echo base_url();?>index.php/permintaan/reset_permintaan" class="btn btn-warning btn-small"><span class="fa fa-times fa-fw"></span> Batal</a>
		</form>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
	</div>
	</div>

	<!--MODAL PERMINTAAN BARANG-->
	<div id="modalAddPermintaanBarang" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
    		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal">x</button>
        		<h3 class="modal-tittle">Tambah Barang</h3>
    		</div>
    		<div class="modal-body">
		        <form id="frm" name="frm" class="form-horizontal" method="post" action="<?php echo base_url()?>index.php/permintaan/tambah_permintaan_to_cart">
		            <div class="control-group">
		                <label class="control-label">Daftar Barang</label>
		                <div class="controls">
		                    <select id="kode_barang" tabindex="5" class="form-control" name="kode_barang" value="" data-placeholder="Pilih Barang" required="harus diisi">
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
	                <button type="submit" class="btn btn-primary" disabled="disabled" id="add" name="add">Tambah</button>
            	</div>
        		</form>
    		</div>
		</div>
	</div>

</div>

<script type="text/javascript">

	function proses_data()
	{	
		var no_permintaan = $("#no_permintaan").val();
		var tgl_permintaan = $("#tgl_permintaan").val();
		var id_karyawan = $("#id_karyawan").val();
		var bagian = $("#bagian").val();
		var total_barang = $("#total").val();
 
		$.ajax ({
			url : "<?php echo site_url('permintaan/tambah_permintaan')?>",
			type : "POST",
			data : {no_permintaan:no_permintaan,tgl_permintaan:tgl_permintaan,id_karyawan:id_karyawan,bagian:bagian,total_barang:total_barang},
			success : function (res){
				if (res!='failed')
				{
					$("#pesan").html("Data Berhasil Diproses").addClass("alert alert-success");
				}
				else
				{
					alert('gagal memproses data');
				}
			}

		});
	}

</script>

 