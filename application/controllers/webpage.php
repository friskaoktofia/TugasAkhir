<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class webpage extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('array');
		$this->load->model("info");
		$this->load->model("database");
		$this->data["pages"] = array(
			'index' => '',
			'pm' => '',
			'co2' => '',
		);
	}
	public function index()
	{
		$page = array();
		$page[] = "pageweb";
		$this->data["page"] = $page;
		$this->data["pages"]["index"] = "active";
		$this->load->view("template/content", $this->data);
	}
	public function tampilData(){
		$hasil = array();
		$query = $this->info->tampil();
		$ct = $this->info->count();
		$hasil['detail'] = $query[$ct-1]->detailInfo;
		$hasil['waktu'] = $query[$ct-1]->waktuInfo;
		echo json_encode($hasil);
	}
	public function pm(){
		$this->data["pages"]["pm"] = "active";
		$this->load->view("template/header");
		$this->load->view("pageweb", $this->data);
		$this->load->view("pm/footerpm");
	}
	public function co2(){
		$this->data["pages"]["co2"] = "active";
		$this->load->view("template/header");
		$this->load->view("pageweb", $this->data);
		$this->load->view("co2/footerco2");
	}
	public function simpan(){
        $data = array();
        $temp = array();
        for ($i=1; $i <= 20 ; $i++) { 
        	$data["data".$i] = $this->uri->segment($i+2);
        }
		$waktu = date("Y-m-d H:i:s");
        $kirim = array(
        	'detailInfo' => '[{"id" : "'.$data["data1"].'", "lat" : "-6.976073", "lng" : "107.631637", "co" : "'.$data["data3"].'", "co2" : "'.$data["data2"].'", "dust" : "'.$data["data4"].'"},{"id" : "'.$data["data5"].'", "lat" : "-6.976073", "lng" : "107.631862", "co" : "'.$data["data7"].'", "co2" : "'.$data["data6"].'", "dust" : "'.$data["data8"].'"},{"id" : "'.$data["data9"].'", "lat" : "-6.976073", "lng" : "107.632087", "co" : "'.$data["data11"].'", "co2" : "'.$data["data10"].'", "dust" : "'.$data["data12"].'"},{"id" : "'.$data["data13"].'", "lat" : "-6.976073", "lng" : "107.632312", "co" : "'.$data["data15"].'", "co2" : "'.$data["data14"].'", "dust" : "'.$data["data16"].'"},{"id" : "'.$data["data17"].'", "lat" : "-6.976073", "lng" : "107.632537", "co" : "'.$data["data19"].'", "co2" : "'.$data["data18"].'", "dust" : "'.$data["data20"].'"}]',
        	'waktuInfo' => $waktu
        );
        $this->info->simpan($kirim,'info');
    }

	public function dataJson(){
		$hasil = array();
		$query = $this->info->tampil();
		$ct = $this->info->count();
		$hasil['detail'] = $query[$ct-1]->detailInfo;
		$hasil['waktu'] = $query[$ct-1]->waktuInfo;
		echo json_encode($hasil);
	}

}