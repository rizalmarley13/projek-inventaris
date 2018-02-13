<div class="container">
<section class="col-md-12">
        <div class="table-responsive">
            <div class="page-header">
            <button type="button" data-toggle="modal" data-target="#modalTambahBarang" class="btn btn-success btn-small"><span class="fa fa-plus fa-fw"></span> Tambah Data</button>
            </div>
            <p><?php echo $this->session->flashdata('info')?></p>

            <table id="tabel" class="table table-bordered table-striped table-hover">
                <thead>
                    <tr>
                        <th><p align="center">No</p></th>
                        <th><p align="center">Kode Barang</p></th>
                        <th><p align="center">Nama Barang</p></th>
                        <th><p align="center">Jenis</p></th>
                        <th><p align="center">Merk</p></th>
                        <th><p align="center">Versi</p></th>
                        <th><p align="center">Jumlah</p></th>
                        <th><p align="center">Satuan</p></th>
                        <th><p align="center">Aksi</p></th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($data)) {?>
                    <tr align="center">
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
                        <a href="<?php echo base_url();?>index.php/barang2/editbarang/<?php echo $rowbarang->kode_barang;?>" class="btn btn-warning btn-xs"><span class="fa fa-edit fa-fw"></span> Edit</a>
                        <br>
                        <a href="<?php echo base_url();?>index.php/barang2/detail/<?php echo $rowbarang->kode_barang;?>" class="btn btn-info btn-xs"><span class="fa fa-search fa-fw"></span> Detail</a>
                        <br>
                        <a href="<?php echo base_url();?>index.php/barang2/delete/<?php echo $rowbarang->kode_barang;?>" class="btn btn-danger btn-xs" onclick="return confirm('Anda yakin menghapus data ini ?')"><span class="fa fa-trash fa-fw"></span> Hapus</a>
                        <br>
                        <a href="<?php echo base_url();?>index.php/qr_code_generate/print_qr/<?php echo $rowbarang->kode_barang;?>" class="btn btn-success btn-xs"><span class="fa fa-print fa-fw"></span> Print QR Code</a>
                        </td>
                    </tr>
                        <?php } }?>
                </tbody>
            </table>
        </div>
    </section>
    </div>
    <!--MODAL PENGADAAN BARANG-->
    <div id="modalTambahBarang" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3 class="modal-tittle">Form Data Barang</h3>
            </div>
            <div class="modal-body">
                <form id="form_pengadaan" name="form_pengadaan" class="form-horizontal" method="post" action="#">
                    <div class="control-group">
                        <label class="control-label">Nama Barang / jasa</label>
                        <div class="controls">
                            <input type="text" name="nama_brg_jasa" value="" placeholder="Nama barang / Jasa" class="form-control" required="harus diisi">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Spesifikasi</label>
                        <div class="controls">
                            <input type="text" name="spesifikasi" value="" placeholder="spesifikasi" class="form-control" required="harus diisi">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Jumlah</label>
                        <div class="controls">
                            <input type="text" name="jumlah" value="" placeholder="Jumlah" class="form-control" required="harus diisi">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Keterangan</label>
                        <div class="controls">
                            <textarea name="keterangan" class="form-control" rows="5" id="ketangan" placeholder="Keterangan"></textarea>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button type="submit" class="btn btn-primary" name="add">Tambah</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script type="text/javascript">
        $("#tabel_barang").DataTable();
    </script>
    