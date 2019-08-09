<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TugasAkhir extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('array');
		$this->load->model("info");
		$this->load->model("database");
		$this->data["pages"] = array(
			'index' => '',
			'turbidity' => '',
			'dummy' => '',
			'suhu' => '',
			'ph' => '',
			'tds' => '',
		);
	}

	public function lihatData(){
		$fn = fopen("http://localhost/website/friskawoman/TA2.txt","r");
        
        $response = array();
        $response["data"] = array();
        while(! feof($fn))  {
            $result = fgets($fn);
            $data = explode("," , $result);
            $h['ph'] = $data[0];
            $h['turbidity'] = $data[1];
            $h['tds'] = $data[2];
            $h['suhu'] = $data[3];
            $h['lat'] = $data[4];
            $h['long'] = $data[5];
            array_push($response['data'], $h);
        }

        fclose($fn);
        $dataJsonEncode = json_encode($response);
        print_r($dataJsonEncode);
        
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
		$hasil['detail'] = $query[$ct-1]->dataKualitas;
		$hasil['waktu'] = $query[$ct-1]->waktuData;
		echo json_encode($hasil);
	}
	public function dummy(){
		$this->data["pages"]["dummy"] = "active";
		$this->load->view("template/header");
		$this->load->view("pageweb", $this->data);
		$this->load->view("dummy/footerdumy");
	}
	
	public function suhu(){
		$this->data["pages"]["suhu"]="active";
		$this->load->view("template/header");
		$this->load->view("pageweb", $this->data);
		$this->load->view("suhu/footersuhu");
	}
	public function ph(){
		$this->data["pages"]["ph"]="active";
		$this->load->view("template/header");
		$this->load->view("pageweb", $this->data);
		$this->load->view("ph/footerph");
	}
	public function tds(){
		$this->data["pages"]["tds"]="active";
		$this->load->view("template/header");
		$this->load->view("pageweb",$this->data);
		$this->load->view("tds/footertds");
	}
	
	public function simpan(){
        $data = array();
        $temp = array();
        for ($i=1; $i <= 20 ; $i++) { 
        	$data["data".$i] = $this->uri->segment($i+2);
        }
		$waktu = date("Y-m-d H:i:s");
        $kirim = array(
        	'dataKualitas' => '[{"id" : "'.$data["data1"].'", "lat" : "-6.972837", "lng" : "107.631684", "co" : "'.$data["data3"].'", "co2" : "'.$data["data2"].'", "dust" : "'.$data["data4"].'"},{"id" : "'.$data["data5"].'", "lat" : "-6.972907", "lng" : "107.631673", "co" : "'.$data["data7"].'", "co2" : "'.$data["data6"].'", "dust" : "'.$data["data8"].'"},{"id" : "'.$data["data9"].'", "lat" : "-6.972955", "lng" : "107.631667", "co" : "'.$data["data11"].'", "co2" : "'.$data["data10"].'", "dust" : "'.$data["data12"].'"},{"id" : "'.$data["data13"].'", "lat" : "-6.973019", "lng" : "107.631670", "co" : "'.$data["data15"].'", "co2" : "'.$data["data14"].'", "dust" : "'.$data["data16"].'"},{"id" : "'.$data["data17"].'", "lat" : "-6.973101", "lng" : "107.631673", "co" : "'.$data["data19"].'", "co2" : "'.$data["data18"].'", "dust" : "'.$data["data20"].'"}]',
        	'waktuData' => $waktu
        );
        $this->info->simpan($kirim,'tabelfriska');
    }

	public function dataJson(){
		$hasil = array();
		$query = $this->info->tampil();
		$ct = $this->info->count();
		$hasil['detail'] = $query[$ct-1]->dataKualitas;
		$hasil['waktu'] = $query[$ct-1]->waktuData;
		echo json_encode($hasil);
	}
}
