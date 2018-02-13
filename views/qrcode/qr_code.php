<div class="container">
	<table class="table">
		<thead>
			<tr>
				<th>Kode Barang</th>
				<th>Nama Barang</th>
				<th>Merk</th>
				<th>Versi</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($brg as $row): ?>
			<tr>
				<td><?php echo $row->kode_barang ?></td>
	            <td><?php echo $row->nama_barang ?></td>
	            <td><?php echo $row->merk ?></td>
	            <td><?php echo $row->versi ?></td>
	            <td><a href="<?php echo base_url();?>index.php/qr_code_generate/print_qr/<?php echo $row->kode_barang ?>" class="btn btn-success" >Cetak QR-Code</a></td>
			</tr>
			<?php endforeach ?>
		</tbody>
		
	</table>
	
</div>