<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* @property user_model $user */

class Qr_code_generate extends CI_Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_barang2');
        $this->load->model('model_notifikasi');
        $this->load->library('ci_qr_code');
        $this->config->load('qr_code');

    }

    /**
     * success_link
     * to display user info and see print link
     * @access public
     * @param user_id
     * @return
     */
    function index()
    {    
        $isi['content'] = 'qrcode/qr_code';
        $isi['judul'] = 'Master Data';
        $isi['subjudul'] = 'Cetak QR-Code';
        $isi['brg'] = $this->model_barang2->get_allbarang();
        $akses = $this->session->userdata('nama_jabatan');
        $isi['jmlnotif'] = $this->model_notifikasi->notif_countif($akses);
        $isi['notifikasi'] = $this->model_notifikasi->get_notif($akses);
        $this->load->view('home/view_home',$isi);

    }

    public function print_qr($id)
    {   
        $id = $this->uri->segment(3);
        $qr_code_config = array();
        $qr_code_config['cacheable'] = $this->config->item('cacheable');
        $qr_code_config['cachedir'] = $this->config->item('cachedir');
        $qr_code_config['imagedir'] = $this->config->item('imagedir');
        $qr_code_config['errorlog'] = $this->config->item('errorlog');
        $qr_code_config['ciqrcodelib'] = $this->config->item('ciqrcodelib');
        $qr_code_config['quality'] = $this->config->item('quality');
        $qr_code_config['size'] = $this->config->item('size');
        $qr_code_config['black'] = $this->config->item('black');
        $qr_code_config['white'] = $this->config->item('white');
        $this->ci_qr_code->initialize($qr_code_config);

        // mengambil data barang
        $detail_brg = $this->model_barang2->qrcode_barang_byid($id);
        $image_name = $id.".png";

        // create user content
        foreach ($detail_brg as $row) {
        $kode_barang=$row->kode_barang;
        $nama_barang=$row->nama_barang;
        $merk=$row->merk;
        $versi=$row->versi;

        }

        $codeContents = "$kode_barang";
        $codeContents .= " $nama_barang";
        $codeContents .= " $merk";
        $codeContents .= " $versi";
       
        $params['data'] = $codeContents;
        $params['level'] = 'H';
        $params['size'] = 4;

        $params['savename'] = FCPATH.$qr_code_config['imagedir'].$image_name;
        $this->ci_qr_code->generate($params);

        $this->data['qr_code_image_url'] = base_url().$qr_code_config['imagedir'].$image_name;

        // save image path in tree table
        $this->model_barang2->ganti_qrbrg($id,$image_name);
        // then redirect to see image link
        $file = $params['savename'];
        if(file_exists($file)){
            header('Content-Description: File Transfer');
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: '.filesize($file));
            ob_clean();
            flush();
            readfile($file);
            unlink($file); // deletes the temporary file

            exit;
        }
    }

}
// END qr_code_generate Controller class
/* End of file qr_code_generate.php */
/* Location: ./application/controllers/qr_code_generate.php */