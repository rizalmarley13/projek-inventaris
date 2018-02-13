<div class="container">
<div class="row">
<div class="col-lg-12">
	<div class="table-responsive">
	<div class="page_header">
	<form method="post" action="<?php echo base_url()?>index.php/pengadaan/tampil_berdasarkan">
		<div class="col-md-2 col-sm-2 col-xs-2"><b>Tampil Berdasarkan</b>
		<select class="form-control" name="showby">
			<option value="">--Plih--</option>
			<option value="Disetujui">Disetujui</option>
			<option value="Pending">Pending</option>
			<option value="Tidak Disetujui">Tidak Disetujui</option>
		</select>
		</div>
		<br>
		<button type="submit" class="btn btn-primary btn-small"><i class="fa fa-refresh" aria-hidden="true"></i> Refresh</button>
		<a href="<?php echo base_url()?>index.php/pengadaan/tampil_datapengadaan" class="btn btn-info btn-small"><span class="fa fa-undo fa-fw"></span> Kembali</a>
	</form>
	<br>
	<table class="table table-bordered table-striped" id="tabel">
		<thead>
			<th><p align="center">No</p></th>
			<th><p align="center">No Pengadaan</p></th>
			<th><p align="center">Tanggal</p></th>
			<th><p align="center">Nama Karyawan</p></th>
			<th><p align="center">Bagian</p></th>
			<th><p align="center">jabatan</p></th>
			<th><p align="center">Total Barang</p></th>
			<th><p align="center">Komentar PK II Keuangan</p></th>
			<th><p align="center">Komentar Kepala PJM</p></th>
			<th><p align="center">Status</p></th>
		</thead>
		<tbody>
			<?php if (empty($dpengadaan)) { ?>
			<tr>
				<td colspan="14" align="center">Data Pengadaan Masih Kosong</td>
			</tr>
			<?php } else {
				$no = 1;
				foreach ($dpengadaan as $rowdata) { ?>
			<tr align="center">
				<td><?php echo $no++;?></td>
				<td><?php echo $rowdata->no_pengadaan;?></td>
				<td><?php echo $rowdata->tgl_pengadaan;?></td>
				<td><?php echo $rowdata->nama_karyawan;?></td>
				<td><?php echo $rowdata->bagian;?></td>
				<td><?php echo $rowdata->jabatan;?></td>
				<td><?php echo $rowdata->total_barang;?>&nbsp;&nbsp;<button class="btn btn-info btn-xs data-detail" data-id="<?php echo $rowdata->no_pengadaan;?>">Detail</button></td>
				<td><?php echo $rowdata->komen_pk2;?></td>
				<td><?php echo $rowdata->komen_pjm;?></td>
				<?php $status = $rowdata->status;?>
				<?php if ($status=="Disetujui") {
					echo "<td><button type=\"button\" class=\"btn btn-success btn-small\">$status</button></td>";
				}
				else if ($status=="Pending") {
					echo "<td><button type=\"button\" class=\"btn btn-warning btn-small\">$status</button></td>";
				}
				else
				{
				echo "<td><button type=\"button\" class=\"btn btn-danger btn-small\">$status</button></td>";
				} ?>
			</tr>
			<?php }}?>
		</tbody>
	</table>
	</div>
	<!-- Modal -->
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Data Barang Pengadaan</h4>
                </div>
                <div class="modal-body">

                	<div class="fetched-data"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


</div>
</div>