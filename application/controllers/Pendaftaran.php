<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Adm_model');
    }

    function index() {
        $this->load->view('form', NULL);
    }
    public function newForm($value='')
    {
        $this->compileView('newui/formulir');
    }

    private function compileView($form, $data = '')
    {
        $this->load->view('newui/header');
        $this->load->view($form,$data);
        $this->load->view('newui/footer');
    }

    public function insert()
    {
        $nama = "file_".time();
        //upload file
        $config['file_name'] = $nama;
        $config['upload_path'] = 'assets/upload/';
        $config['allowed_types'] = ['jpg','png','jpeg'];
        // $config['max_filename'] = '255';
        // $config['encrypt_name'] = TRUE;

        $config['max_size'] = '3024'; //1 MB
        

        if (isset($_FILES['file']['name'])) {
            if (0 < $_FILES['file']['error']) {
                // echo 'Error during file upload' . $_FILES['file']['error'];
                $nama = 'sample.png';
            } else {
                if (file_exists('assets/' . $_FILES['file']['name'])) {
                    // echo 'File already exists : assets/' . $_FILES['file']['name'];
                    $nama = 'sample.png';
                } else {
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('file')) {
                        // echo $this->upload->display_errors();
                        $nama = 'sample.png';
                    } else {
                            $a = $this->upload->data();
                            $nama = $a['file_name'];
                    }
                }
            }
        } else {
            // echo 'Please choose a file';
            $nama = 'sample.png';
        }
        $data = array(
            'nl_siswa' => $this->input->post('name'),
            'np_siswa' => $this->input->post('surname'),
            'jk_siswa' => $this->input->post('kelamin'),
            'ttl' => $this->input->post('ttl'),
            'agama_siswa' => $this->input->post('agama'),
            'asal_sekolah' => $this->input->post('sekolah'),
            'ijazah' => $this->input->post('ijazah'),
            'nisn' => $this->input->post('nisn'),
            'nik' => $this->input->post('nik'),
            'tahun' => date('Y'),
            'skhun' => $this->input->post('skhun'),
            'warga_siswa' => $this->input->post('kewarganegaraan'),
            'sdr_knd' => $this->input->post('kandung'),
            'sdr_tir' => $this->input->post('tiri'),
            'sdr_ang' => $this->input->post('angkat'),
            'bahasa' => $this->input->post('bahasa'),
            'berat' => $this->input->post('berat'),
            'tinggi' => $this->input->post('tinggi'),
            'gol_dar' => $this->input->post('goldar'),
            'penyakit' => $this->input->post('penyakit'),
            'alamat' => $this->input->post('alamat'),
            'kode_pos' => $this->input->post('kodepos'),
            'hp_siswa' => $this->input->post('handphone'),
            'tinggal' => $this->input->post('tinggal'),
            'photo' => $nama
            );
        $insert = $this->db->insert('calon_siswa', $data );
        // $ids = $this->db->select('id_siswa')->from('calon_siswa')->where($data)->get()->row()->id_siswa;
        $id = $this->db->insert_id();
        $ayah = array(
            'id_siswa' => $id,
            'nl_ayah' => $this->input->post('namaayah'),
            'ttl_ayah' => $this->input->post('ttlayah'),
            'agama_ayah' => $this->input->post('agamaayah'),
            'warga_ayah' => $this->input->post('kewarganegaraanayah'),
            'pend_ayah' => $this->input->post('pendidikanayah'),
            'kerja_ayah' => $this->input->post('pekerjaanayah'),
            'gaji_ayah' => $this->input->post('penghasilanayah'),
            'rumah_ayah' => $this->input->post('alamatrumah'),
            'kantor_ayah' => $this->input->post('alamatkantorayah'),
            'organisasi_ayah' => $this->input->post('organisasiayah')
            );
        $this->db->insert('ayah_siswa', $ayah);

        $ibu = array(
            'id_siswa' => $id,
            'nl_ibu' => $this->input->post('namaibu'),
            'ttl_ibu' => $this->input->post('ttlibu'),
            'agama_ibu' => $this->input->post('agamaibu'),
            'warga_ibu' => $this->input->post('kewarganegaraanibu'),
            'pend_ibu' => $this->input->post('pendidikanibu'),
            'kerja_ibu' => $this->input->post('pekerjaanibu'),
            'gaji_ibu' => $this->input->post('penghasilanibu'),
            'kantor_ibu' => $this->input->post('alamatkantoribu'),
            'organisasi_ibu' => $this->input->post('organisasiibu')
            );
        $this->db->insert('ibu_siswa', $ibu);

        $wali = array(
            'id_siswa' => $id,
            'nl_wali' => $this->input->post('namawali'),
            'ttl_wali' => $this->input->post('ttlwali'),
            'agama_wali' => $this->input->post('agamawali'),
            'warga_wali' => $this->input->post('kewarganegaraanwali'),
            'pend_wali' => $this->input->post('pendidikanwali'),
            'kerja_wali' => $this->input->post('pekerjaanwali'),
            'gaji_wali' => $this->input->post('penghasilanwali'),
            'kantor_wali' => $this->input->post('alamatkantorwali'),
            'organisasi_wali' => $this->input->post('organisasiwali')
            );
            $this->db->insert('wali_siswa', $wali);

        $mampu = array(
            'id_siswa' => $id, 
            'sholat' => $this->input->post('sholat'), 
            'hafalan' => $this->input->post('surat'), 
            'bacaan' => $this->input->post('quran'), 
            'hobi' => $this->input->post('hobi'), 
            'prestasi' => $this->input->post('prestasi'), 
            'sifat' => $this->input->post('sifat'), 
            'penyakit_keras' => $this->input->post('penyakitkeras')
            );

            $this->db->insert('kemampuan_siswa', $mampu);

        $surat = array(
            'id_siswa' => $id,
            'nama_ortu' => $this->input->post('namapernyataan'), 
            'alamat' => $this->input->post('alamatpernyataan'), 
            'handphone' => $this->input->post('teleponpernyataan'), 
            'ortu_dari' => $this->input->post('ortupernyataan') 
            );
        $this->db->insert('surat', $surat);

        header('Location: '.site_url('cetak'));

    }
    public $nama;

    public function cetak()
    {
        $this->nama = 'Ini Nama';
        $nama= $this->nama;
        $this->getPdf($nama);
        // if (!empty($this->uri->segment(2))) {
        //     $id = $this->uri->segment(2);
        //     $data['siswa'] = $this->Adm_model->siswa($id);
        //     $data['ayah'] = $this->Adm_model->ayah($id);
        //     $data['ibu'] = $this->Adm_model->ibu($id);
        //     $data['wali'] = $this->Adm_model->wali($id);
        //     $data['surat'] = $this->Adm_model->surat($id);
        //     $data['kemampuan'] = $this->Adm_model->kemampuan($id);
        //     $this->compileView('newui/pdf', $data);
        // }else {
        //     $data['all'] = $this->Adm_model->all();
        //     $this->compileView('newui/cetak', $data);
        // }
    }

    function getPdf($data = '')
    {
        $this->load->library('Pdf');
        // Instanciation of inherited class
        $pdf = new PDF('P','mm','A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times','B',12);
        // Set font
        // $pdf->SetFont('Arial','B',16);
        // Move to 8 cm to the right
        $pdf->Cell(80);
        // Centered text in a framed 20*10 mm cell and line break
        //margin left right, margin top bottom, text, border, line break
        $pdf->Cell(20,0,'Bissmillahirrahmanirrahim',0,1,'C');
        $pdf->ln(5);
        $pdf->Cell(80);
        // Centered text in a framed 20*10 mm cell and line break
        $pdf->Cell(20,0,'FORMULIR PENDAFTARAN SANTRI BARU',0,1,'C');
        $pdf->ln(5);
        $pdf->Cell(80);
        // Centered text in a framed 20*10 mm cell and line break
        $pdf->Cell(20,0,'TAHUN PELAJARAN 2018/2019',0,1,'C');
        $pdf->ln(15);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(10);
        $pdf->Cell(20,0,'TAHUN PELAJARAN 2018/2019',0,1,'C');


        $pdf->Output();
    }

    public function generate()
    {
        $this->db->select('*');
        $this->db->from('calon_siswa');
        $data['siswa'] = $this->db->get()->result();
        $this->load->view('generate', $data);
    }

    public function cek_valid()
    {
        $kode = $this->input->post('kode');
        $id = $this->uri->segment(3);
        $this->db->select('*');
        $this->db->from('kode');
        $this->db->where('code', $kode);
        $cek = $this->db->get()->result_array();
        $siswa ='';
        if (isset($cek[0]['id_siswa'])) {
            $siswa = $cek[0]['id_siswa'];
        }
        if (!empty($cek) && !empty($siswa)) {
                header('Location: '.site_url('cetak/'.$siswa));
        }elseif (!empty($cek) && empty($siswa)) {
                $this->db->where('code', $kode);
                $this->db->update('kode', ['id_siswa' => $id]);
                header('Location: '.site_url('cetak/'.$id));
        }else{
            echo 'Kode salah. silahkan kembali ke halaman cetak.';
        }

    }

    public function end_valid()
    {
        $id = $this->input->post('id_siswa');
        $id_siswa = array('id_siswa' => $id );
        $kode = $this->input->post('kode');
        $tgl = $this->input->post('tgl');
        $this->db->select('*');
        $this->db->from('calon_siswa');
        $this->db->where('id_siswa', $id);
        $this->db->where('tgl_lahir', $tgl);
        $cek = $this->db->get()->result();
        if (count($cek) == 1) {
            $this->db->where('code', $kode);
            $this->db->update('kode', $id_siswa);
            echo json_encode(true);
        }
        else{
            echo json_encode(false);
        }
    }


}