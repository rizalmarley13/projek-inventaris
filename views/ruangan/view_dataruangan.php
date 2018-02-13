<div class="container">
	<section class="col-md-12">
		<div class="table-responsive">
			<div class="page-header">
				<a href="<?php echo base_url();?>index.php/ruangan/form/add" class="btn btn-success btn-small"><span class="fa fa-plus fa-fw"></span> Tambah Data</a>
			</div>

			<p><?php echo $this->session->flashdata('info')?></p>
			<div class="table-responsive">
			<table id="tabel" class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th width="1%"><p align="center">No</p></th>
						<th><p align="center">No Ruangan</p></th>
						<th><p align="center">Nama Ruangan</p></th>
						<th><p align="center">Lantai</p></th>
						<th><p align="center">Aksi</p></th>
					</tr>
				</thead>
				<tbody>
				<?php if (empty($qruangan)) {?>
				<tr>
					<td colspan="6" align="center">Data Ruangan Masih Kosong</td>
				</tr>
				<?php } else { 
						$no = 1;
						foreach ($qruangan as $rowruangan) { ?>
					<tr align="center">
						<td><?php echo $no++; ?></td>
						<td><?php echo $no_ruangan=$rowruangan->no_ruangan; ?></td>
						<td><?php echo $nama_ruangan=$rowruangan->nama_ruangan; ?></td>
						<td><?php echo $lantai=$rowruangan->lantai; ?></td>
						<td>
							<a href="<?php echo base_url();?>index.php/ruangan/form/edit/<?php echo $rowruangan->no_ruangan;?>" class="btn btn-warning btn-xs"><span class="fa fa-edit fa-fw"></span> Edit</a>
	                        <a href="<?php echo base_url();?>index.php/ruangan/delete/<?php echo $rowruangan->no_ruangan;?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda yakin menghapus data ini ?')"><span class="fa fa-trash fa-fw"></span> Hapus</a>
						</td>
					</tr>
					<?php } } ?>
				</tbody>
			</table>
			</div>
		</div>
	</section>
</div>