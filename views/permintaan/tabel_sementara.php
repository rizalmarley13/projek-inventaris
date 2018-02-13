<table class="table table-striped" id="tabel-brgsementara">
				<thead>
					<tr><th>Nomer</th>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>Jumlah</th>
						<th>Satuan</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no=1;
					$nomer = array();
					if (empty($tampil)) {?>
			        <tr>
			            <td colspan="14" align="center">Data Barang Masih Kosong</td>
			        </tr>
			        <?php } else {
			        	 foreach ($tampil as $rowtampil) { ?>
					<tr>
						<td><?php echo $no++?></td>
						<td><?php echo $kode_barang = $rowtampil->kode_barang?></td>
						<td><?php echo $nama_barang = $rowtampil->nama_barang?></td>
						<td><?php echo $jumlah_diminta = $rowtampil->jumlah_diminta?></td>
						<td><?php echo $satuan = $rowtampil->satuan?></td>
						<td><a href="javascript:void(0)" class="btn btn-danger btn-small" onclick="hapus_data('<?php echo $kode_barang = $rowtampil->kode_barang?>')">Hapus</a></td>
					</tr>
					<?php } }?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="2" align="center"><b>Jumlah Total</b></td>
						<td colspan="2">
							<?php foreach ($jmltotal as $rowtotal) {
								echo $total_barang = $rowtotal->total;
							}
							?>
						</td>
					</tr>
				</tfoot>
			</table>