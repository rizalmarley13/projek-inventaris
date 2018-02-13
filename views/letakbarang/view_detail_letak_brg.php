<div class="container">
<div class="row">
<div class="col-md-12">
	<div class="page-header">
        <a href="<?php echo base_url()?>index.php/letak_barang" class="btn btn-info btn-small"><span class="fa fa-undo fa-fw"></span> Kembali</a>
    </div>
    <div class="table-responsive">
	<table class="table table-bordered table-striped">
		<thead>
			<th><p align="center">No</p></th>
			<th><p align="center">Kode Barang</p></th>
			<th><p align="center">Nama Barang</p></th>
			<th><p align="center">Merk</p></th>
			<th><p align="center">Versi</p></th>
			<th><p align="center">Jumlah</p></th>
			<th><p align="center">Satuan</p></th>
			<th><p align="center">Status</p></th>
			<th><p align="center">Kondisi</p></th>
			<th><p align="center">Keterangan</p></th>
			<th><p align="center">Aksi</p></th>
		</thead>
		<tbody>
		<?php 
			$no = 1;
			if(empty($data_detail)) { ?>
			<tr>
				<td colspan="14" align="center">Data Masih Kosong</td>
			</tr>		
			<?php } else { 
			foreach ($data_detail as $tampildetail) { ?>
			<tr align="center">
				<td><?php echo $no++?></td>
				<td><?php echo $kode_barang = $tampildetail->kode_barang?></td>
				<td><?php echo $nama_barang = $tampildetail->nama_barang?></td>
				<td><?php echo $merk = $tampildetail->merk?></td>
				<td><?php echo $versi = $tampildetail->versi?></td>
				<td><?php echo $jumlah = $tampildetail->jumlah?></td>
				<td><?php echo $satuan = $tampildetail->satuan?></td>
				<td><?php echo $status = $tampildetail->status?></td>
				<td><?php echo $kondisi = $tampildetail->kondisi?></td>
				<td><?php echo $keterangan = $tampildetail->keterangan?></td>
				<td>
					<a href="<?php echo base_url()?>index.php/mutasi/ambil_detail_letak/<?php echo $nodetail = $tampildetail->nodetail?>" class="btn btn-warning btn-xs"><span class="fa fa-reply"></span> Mutasi</a>
					<a href="<?php echo base_url()?>index.php/letak_barang/edit_detail_letak/<?php echo $nodetail = $tampildetail->nodetail?>" class="btn btn-info btn-xs"><span class="fa fa-pencil-square-o"></span> Edit</a>
					<a href="<?php echo base_url()?>index.php/letak_barang/update_setelahhapus/<?php echo $nodetail = $tampildetail->nodetail?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda yakin menghapus data ini ?')"><span class="fa fa-trash-o"></span> Hapus</a>
				</td>
			</tr>
			<?php }} ?>
		</tbody>
		<tfoot>
				<tr>
					<td colspan="5" align="center"><b>Jumlah Barang</b></td>
					<td width="5%"><input type="text" name="jumlah_barang" id="jumlah_barang" class="form-control" value="<?php foreach ($jmlbarang as $rowjumlah) {
						echo $jumlah_barang = $rowjumlah->jumlah_barang;
					}?>" 
					readonly></td>
				</tr>
			</tfoot>
	</table>
	</div>
</div>
</div>
</div>