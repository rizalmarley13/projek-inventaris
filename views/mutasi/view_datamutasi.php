<div class="container">
	<section class="col-md-12">
		<div class="table-responsive">
			<div class="page-header">

			<p><?php echo $this->session->flashdata('info')?></p>
			<div class="table-responsive">
			<table id="tabel" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th width="1%"><p align="center">No Mutasi</p></th>
						<th><p align="center">Tanggal Mutasi</p></th>
						<th><p align="center">Ruangan Lama</p></th>
						<th><p align="center">Ruangan Baru</p></th>
						<th><p align="center">Kode Barang</p></th>
						<th><p align="center">Nama Barang</p></th>
						<th><p align="center">Merk</p></th>
						<th><p align="center">Versi</p></th>
						<th><p align="center">Jumlah</p></th>
						<th><p align="center">Satuan</p></th>
						<th><p align="center">Aksi</p></th>
					</tr>
				</thead>
				<tbody>
				<?php if (empty($qmutasi)) {?>
				<tr>
					<td colspan="6" align="center">Data Mutasi Masih Kosong</td>
				</tr>
				<?php } else { 
						foreach ($qmutasi as $rowmutasi) { ?>
					<tr align="center">
						<td><?php echo $no_mutasi=$rowmutasi->no_mutasi; ?></td>
						<td><?php echo $tgl_mutasi=$rowmutasi->tgl_mutasi; ?></td>
						<td><?php echo $no_ruangan=$rowmutasi->no_ruangan; ?></td>
						<td><?php echo $ruangan_baru=$rowmutasi->ruangan_baru; ?></td>
						<td><?php echo $kode_barang=$rowmutasi->kode_barang;?></td>
						<td><?php echo $nama_barang=$rowmutasi->nama_barang;?></td>
						<td><?php echo $merk=$rowmutasi->merk; ?></td>
						<td><?php echo $versi=$rowmutasi->versi; ?></td>
						<td><?php echo $jumlah=$rowmutasi->jumlah_mutasi; ?></td>
						<td><?php echo $satuan=$rowmutasi->satuan; ?></td>
						<td>
	                        <a href="<?php echo base_url();?>index.php/mutasi/hapus_mutasi/<?php echo $no_mutasi;?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda yakin menghapus data ini ?')"><span class="fa fa-trash fa-fw"></span> Hapus</a>
						</td>
					</tr>
					<?php } } ?>
				</tbody>
			</table>
			</div>
		</div>
	</section>
</div>