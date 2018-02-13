<div class="container">
<div class="row">
<div class="col-md-12">

<table class="table table-striped">
	<div class="col-md-5 col-md-offset-5">
		<img src="<?php echo base_url();?>asset/admin/img/noavatar.jpg" class="img-circle">
		<br>
		<br>
	</div>
	<tr>
		<td>
			<div class="col-md-4 col-md-offset-5">
					ID Karyawan : <b><?php echo $this->session->userdata('id_karyawan')?></b>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div class="col-md-4 col-md-offset-5">
				Nama : <b><?php echo $this->session->userdata('nama_karyawan');?></b>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div class="col-md-6 col-md-offset-5">
				Jabatan : <b><?php echo $this->session->userdata('nama_jabatan');?></b>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div class="col-md-4 col-md-offset-5">
				Bagian : <b><?php echo $this->session->userdata('bagian');?></b>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div class="col-md-4 col-md-offset-5">
				Level : <b><?php echo $this->session->userdata('level');?></b>
			</div>
		</td>
	</tr>
</table>	
<br>
<br>
<br>
<br>
</div>
</div>
</div>
