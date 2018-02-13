<div class="table-responsive">
<table class="table table-bordered">
<thead>
	<th><p align="center">No</p></th>
	<th><p align="center">Nama Barang/Jasa</p></th>
	<th><p align="center">Spesifikasi</p></th>
	<th><p align="center">Jumlah</p></th>
	<th><p align="center">Satuan</p></th>
	<th><p align="center">Contoh Barang</p></th>	
</thead>
<tbody>
	<?php 
	$no=1;
	if (isset($detail_pengadaan)) {
		foreach ($detail_pengadaan as $row) { ?>
	<tr>
		<td align="center"><?php echo $no++;?></td>
		<td align="center"><?php echo $row->nama_brg_jasa ;?></td>
		<td align="center"><?php echo $row->spesifikasi ;?></td>
		<td align="center"><?php echo $row->jumlah ;?></td>
		<td align="center"><?php echo $row->satuan ;?></td>
		<td><img src="<?php echo base_url();?>asset/uploads/<?php echo $row->nama_gbr;?>"></td>
	</tr>
	<?php } }?>
</tbody>
</table>
</div>