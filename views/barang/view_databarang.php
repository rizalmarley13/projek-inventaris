<div class="container">
<section class="col-md-12">
        <div class="table-responsive">
            <div class="page-header">
                <a href="<?php echo base_url();?>index.php/barang2/form/add" class="btn btn-success btn-small"><span class="fa fa-plus fa-fw"></span> Tambah Data</a>
            </div>
            <p><?php echo $this->session->flashdata('info')?></p>
            <div class="table-responsive">
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
                    <tr>
                    <td colspan="14" align="center">Data Barang Masih Kosong</td>
                    </tr>
                        <?php } else {
                        $no = 1;
                        foreach ($data as $rowbarang) { ?>
                    <tr>
                        <td align="center"><?php echo $no++; ?></td>
                        <td align="center"><?php echo $rowbarang->kode_barang; ?></td>
                        <td align="center"><?php echo $rowbarang->nama_barang; ?></td>
                        <td align="center"><?php echo $rowbarang->nama; ?></td>
                        <td align="center"><?php echo $rowbarang->merk; ?></td>
                        <td align="center"><?php echo $rowbarang->versi; ?></td>
                        <td align="center"><?php echo $rowbarang->jumlah; ?></td>
                        <td align="center"><?php echo $rowbarang->satuan; ?></td>
                        <td>
                        <a href="<?php echo base_url();?>index.php/barang2/form/edit/<?php echo $rowbarang->kode_barang;?>" class="btn btn-warning btn-xs"><span class="fa fa-edit fa-fw"></span> Edit</a>
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
        </div>
    </section>
    </div>
    