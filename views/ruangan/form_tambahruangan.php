<?php 
if ($aksi == 'aksi_add'){
	$no_ruangan = "";
	$nama_ruangan = "";
	$lantai= "";

}

else
{

	foreach ($qruangan as $rowdata){
		$no_ruangan=$rowdata->no_ruangan;
		$nama_ruangan=$rowdata->nama_ruangan;
		$lantai=$rowdata->lantai;

	}
}	
?>

<div class="container">
<div class="row">
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel panel-heading">Input Data Ruangan</div>
		<div class="panel panel-body">
			<form method="POST" onsubmit="return validasi(this)" action="<?php echo base_url(); ?>index.php/ruangan/form/<?php echo $aksi;?>">
				<table class="table table-striped">
					<tr>
						<td width="30%">No Ruangan</td>
						<td>
							<div class="col-lg-4">
							<Input type="text" name="no_ruangan" id="no_ruangan" class="form-control" value="<?php echo $no_ruangan ?>">
							</div>
						</td>
					</tr>
					<tr>
						<td>Nama Ruangan</td>
						<td>
							<div class="col-lg-6">
								<Input type="text" name="nama_ruangan" class="form-control" value="<?php echo $nama_ruangan ?>">
							</div>
						</td>
					</tr>
					<tr>
						<td>Lantai</td>
						<td>
							<div class="col-lg-4">
								<select class="form-control" name="lantai">
								<option value=""<?php if($aksi=="aksi_edit"){if($lantai==""){echo 'Selected';}}?>>--Pilih--</option>
								<option value="Lantai 1"<?php if($aksi=="aksi_edit"){if($lantai=="Lantai 1"){echo 'Selected';}}?>>Lantai 1</option>
							  	<option value="Lantai 2"<?php if($aksi=="aksi_edit"){if($lantai=="Lantai 2"){echo 'Selected';}}?>>Lantai 2</option>
							  	<option value="Lantai 3"<?php if($aksi=="aksi_edit"){if($lantai=="Lantai 3"){echo 'Selected';}}?>>Lantai 3</option>
							  	<option value="Lantai 4"<?php if($aksi=="aksi_edit"){if($lantai=="Lantai 4"){echo 'Selected';}}?>>Lantai 4</option>
								</select>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<button type="submit" class="btn btn-primary btn-small">Simpan</button>
							<a href="<?php echo base_url();?>index.php/ruangan" class="btn btn-info btn-small"><i class="glyphicon glyphicon-repeat"></i> Kembali</a>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
</div>
</div>
<script type="text/javascript">
	function validasi(form) {
	if(form.no_ruangan.value == ""){
		alert("Maaf nomer ruangan tidak boleh kosong, Periksa kembali kelengkapan data.!");
			form.no_ruangan.focus();
			return(false);
		}
		return(true);
	}
</script>