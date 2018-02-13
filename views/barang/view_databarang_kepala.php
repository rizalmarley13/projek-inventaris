<div class="container">
<section class="col-md-12">
        <div class="table-responsive">
            <p><?php echo $this->session->flashdata('info')?></p>

            <table id="tabel_barang" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jenis</th>
                        <th>Merk</th>
                        <th>Versi</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($data)) {?>
                    <tr>
                    <td colspan="14" align="center">Data Barang Masih Kosong</td>
                    </tr>
                        <?php } else {
                        $no = 1;
                        foreach ($data as $rowbarang) { ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $rowbarang->kode_barang; ?></td>
                        <td><?php echo $rowbarang->nama_barang; ?></td>
                        <td><?php echo $rowbarang->nama; ?></td>
                        <td><?php echo $rowbarang->merk; ?></td>
                        <td><?php echo $rowbarang->versi; ?></td>
                        <td><?php echo $rowbarang->jumlah; ?></td>
                        <td><?php echo $rowbarang->satuan; ?></td>
                        <td>
                        <a href="<?php echo base_url();?>index.php/barang_kepala/detail/<?php echo $rowbarang->kode_barang;?>" class="btn btn-info btn-xs"><span class="fa fa-search fa-fw"></span> Detail</a>
                        <br>
                    </tr>
                        <?php } }?>
                </tbody>
            </table>
        </div>
    </section>
    </div>
    <script type="text/javascript">
        function validasi_brg(){
            alert("test");
        }
    </script>