<?php

if(!function_exists('myhelper'))
{
    function ubah_tgl($tgl) //untuk dimasukan ke database format database : 2019-04-09
    {
        // ==> 06-04-2019 ==bln/tgl/thn
        $tes = explode("/", $tgl);
        $array = array($tes[2],$tes[0],$tes[1]);
        $cek = implode("-",$array);
        return $cek; //output Y-m-d contoh 2019-04-09
    }
    
    function get_bulan($bulan)
    {
        switch ($bulan) {
            case 01 : return "Januari";
                break;
            case 02 : return "Februari";
                break;
            case 03 : return "Maret";
                break;
            case 04 : return "April";
                break;
            case 05 : return "Mei";
                break;
            case 06 : return "Juni";
                break;
            case 07 : return "Juli";
                break;
            case 8 : return "Agustus";
                break;
            case 9 : return "September";
                break;
            case 10 : return "Oktober";
                break;
            case 11 : return "November";
                break;
            case 12 : return "Desember";
                break;
        }
    }
    
    function tgl_indo($tgl_idn)
    {
        //2019-04-23
        $tanggal = substr($tgl_idn, 8,2);
        $bulan   = get_bulan(substr($tgl_idn, 5,2));
        $thn = substr($tgl_idn, 0,4);
        return $tanggal." ".$bulan." ".$thn;
    }
    
    function jumlah_inbox()
    {
        $CI             = & get_instance();
        $inbox          = $CI->db->query('SELECT sum(status)as jml FROM inbox WHERE status=1')->row_array();
        return $inbox['jml'];
    }
    
    function inbox_detail()
    {
        $CI         = & get_instance();
        $isi_pesan  = $CI->db->query("SELECT inbox.*,DATE_FORMAT(tgl_inbox,'%d %M %Y') AS tanggal FROM inbox WHERE status='1'
                                     ORDER BY id_inbox DESC LIMIT 5");
        return $isi_pesan;
    }
    
    function _chrome_visitor()
    {
        $CI             = & get_instance();
        $jml            = $CI->db->query('SELECT * FROM pengunjung WHERE perangkat_pengunjung="Chrome"')->num_rows();
        return $jml;
    }
    
    function _mozilla_visitor()
    {
        $CI             = & get_instance();
        $jml            = $CI->db->query('SELECT * FROM pengunjung WHERE perangkat_pengunjung="Firefox" OR perangkat_pengunjung="Mozilla"')->num_rows();
        return $jml;
    }
    function _googlebot_visitor()
    {
        $CI             = & get_instance();
        $jml            = $CI->db->query('SELECT * FROM pengunjung WHERE perangkat_pengunjung="Googlebot"')->num_rows();
        return $jml;
    }
    function _opera_visitor()
    {
        $CI             = & get_instance();
        $jml            = $CI->db->query('SELECT * FROM pengunjung WHERE perangkat_pengunjung="Opera"')->num_rows();
        return $jml;
    }
    
    function profil_pt()
    {
        $CI   = & get_instance();
        $CI->load->model('Main_model','main');
        $CI->main->set_table('profil_perusahaan');
        $CI->main->get_table();
        $data = $CI->main->to_show();
        foreach ($data->result_array() as $p)
        {
            $hasil[]= $p;
        }
        return $hasil[0];
    }
}
