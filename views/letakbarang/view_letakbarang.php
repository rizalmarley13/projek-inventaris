<div class="container">
<div class="row">
<div class="col-md-6">
	<div class="page-header">
        <a href="<?php echo base_url();?>index.php/letak_barang/input_letak_brg" class="btn btn-success btn-small"><span class="fa fa-plus fa-fw"></span> Tambah Data</a>
    </div>
    <div class="table-responsive">
	<table class="table table-bordered table-striped">
		<thead>
			<th><p align="center">No</p></th>
			<th><p align="center">No Ruangan</p></th>
			<th><p align="center">Total Barang</p></th>
			<th width="20%"></th>
		</thead>
		<tbody>
		<?php 
			$no = 1;
			if(empty($data_letak)) { ?>
			<tr>
				<td colspan="14" align="center">Data Masih Kosong</td>
			</tr>		
			<?php } else { 
			foreach ($data_letak as $tampildata) { ?>
			<tr align="center">
				<td><?php echo $no++?></td>
				<td><?php echo $no_ruangan = $tampildata->no_ruangan?></td>
				<td><?php echo $total_barang = $tampildata->total_barang?></td>
				<td>
					<a href="<?php echo base_url();?>index.php/letak_barang/lihat_detail_brg/<?php echo $tampildata->no_ruangan?>" class="btn btn-info btn-small"><span class="fa fa-external-link"></span> Lihat Detail</a>
				</td>
			</tr>
			<?php }} ?>
		</tbody>
	</table>
	</div>
</div>
</div>
</div>