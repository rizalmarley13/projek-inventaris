<div class="container">
	<section class="col-md-12">
		<div class="table-responsive">

			<p><?php echo $this->session->flashdata('info')?></p>
			<div class="table-responsive">
			<table id="tabel" class="table table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th><p align="center">No. Checking</p></th>
						<th><p align="center">Tanggal Checking</p></th>
						<th><p align="center">Id User</p></th>
						<th><p align="center">No. Ruangan</p></th>
						<th><p align="center">Nama Barang</p></th>
						<th><p align="center">Jumlah</p></th>
						<th><p align="center">Satuan</p></th>
						<th><p align="center">Aksi</p></th>
					</tr>
				</thead>
				<tbody>
				<?php if (empty($qmaintenance)) {?>
				<tr>
					<td colspan="8" align="center">Data maintenance Masih Kosong</td>
				</tr>
				<?php } else { 
						foreach ($qmaintenance as $rowmaintenance) { ?>
					<tr align="center">
						<td><?php echo $no_checking=$rowmaintenance->no_checking; ?></td>
						<td><?php echo $tgl_checking=$rowmaintenance->tgl_checking; ?></td>
						<td><?php echo $id_user=$rowmaintenance->id_user; ?></td>
						<td><?php echo $no_ruangan=$rowmaintenance->no_ruangan; ?></td>
						<td><?php echo $nama_barang=$rowmaintenance->nama_barang; ?></td>
						<td><?php echo $jumlah=$rowmaintenance->jumlah; ?></td>
						<td><?php echo $satuan=$rowmaintenance->satuan; ?></td>
						<td>
							<a href="#" class="btn btn-warning btn-xs"><span class="fa fa-search fa-fw"></span> Detail</a>
	                        <a href="#" class="btn btn-danger btn-xs" onclick="return confirm('Anda yakin menghapus data ini ?')"><span class="fa fa-trash fa-fw"></span> Hapus</a>
						</td>
					</tr>
					<?php } } ?>
				</tbody>
			</table>
			</div>
		</div>
	</section>
</div>