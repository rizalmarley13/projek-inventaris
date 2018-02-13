<?php
if(isset($detail_barang)){
    foreach($detail_barang as $row){
        ?>

        <div class="control-group">
            <label class="control-label">Kode Barang</label>
            <div class="controls">
                <input name="kode_barang" type="text" class="form-control" value="<?php echo $row->kode_barang; ?>" readonly>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Nama Barang</label>
            <div>
                <input name="nama_barang" type="text"  class="form-control" value="<?php echo $row->nama_barang; ?>" readonly>
            </div>
        </div>

            <div class="controls">
                <input name="harga_beli" type="hidden" class="form-control" value="<?php echo $row->harga_beli; ?>" >
            </div>

        <div class="control-group">
            <label class="control-label">Ready Stok</label>
            <div class="controls">
                <input name="stok" type="text" class="form-control" value="<?php echo $row->jumlah; ?>" readonly>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">satuan</label>
            <div class="controls">
                <input name="options" type="text" class="form-control" value="<?php echo $row->satuan; ?>" readonly>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label">Jumlah Permintaan</label>
            <div class="controls">
                <input id="qty" name="qty" type="text" class="form-control" placeholder="Input Jumlah Permintaan...">
            </div>
        </div>
    <?php
    }
}
?>
