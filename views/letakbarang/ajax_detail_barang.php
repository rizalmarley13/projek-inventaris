<?php
if(isset($detail_barang)){
    foreach($detail_barang as $row){
        ?>
        <div class="control-group">
            <label class="control-label">Kode Barang</label>
            <div class="controls">
                <input name="kode_barang" id="kode_barang" type="text" class="form-control" value="<?php echo $row->kode_barang; ?>" readonly>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Nama Barang</label>
            <div>
                <input name="nama_barang" id="nama_barang" type="text"  class="form-control" value="<?php echo $row->nama_barang; ?>" readonly>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Merk</label>
            <div>
                <input name="merk" id="merk" type="text" class="form-control" value="<?php echo $row->merk; ?>" readonly>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Versi</label>
            <div>
                <input name="versi" id="versi" type="text"  class="form-control" value="<?php echo $row->versi; ?>" readonly>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Jumlah Barang</label>
            <div>
                <input name="jumlah" id="jumlah" type="text"  class="form-control" value="" required="harus di isi"><span id="pesan1" style="color:red"></span>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Satuan</label>
            <div class="controls">
                <input name="satuan" id="satuan" type="text" class="form-control" value="<?php echo $row->satuan; ?>" readonly>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Status</label>
            <div>
                <input name="status" id="status" type="text"  class="form-control" value="">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Kondisi</label>
            <div>
                <select name="kondisi" id=kondisi class="form-control">
                    <option value="">--Pilih--</option>
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                </select>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Keterangan</label>
            <div>
                <textarea class="form-control" id="keterangan" rows="5" name="keterangan"></textarea>
            </div>
        </div>
    <?php
    }
}
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#kode_barang").change(function(){
            var kd_barang = $("#kode_barang").val();
            $.ajax({
                type: "POST",
                url : "<?php echo base_url('mutasi/get_detail_barang'); ?>",
                data: "kode_barang="+kode_barang,
                cache:false,
                success: function(data){
                    $('#detail_barang').html(data);
                    document.frm.add.disabled=false;
                }
            });
        });
    });

    //Validasi inputan angka
    $("#jumlah").keypress(function(data){
            if (data.which!=8 && data.which!=0 && (data.which < 48 || data.which > 75)) {
                $("#pesan1").html("Isikan Angka").show().fadeOut(3000);
                return false;
                }
            });

</script>
