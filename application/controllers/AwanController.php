<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AwanController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
        $fn = fopen("http://localhost/website/friskawoman/data.txt","r");
        
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
        
        //$dataJsonDecode = json_decode($dataJsonEncode);
        // foreach ($dataJsonDecode->data as $key => $value) {
        //     echo $value->ph;
        // }
        // echo "<pre>";
        // print_r($dataJsonDecode->data[3]->turbinity);
        print_r($dataJsonEncode);
        // $latA = ($dataJsonDecode->data[0]->lat);
        // $latB = ($dataJsonDecode->data[1]->lat);
        // $lngA = ((float)$dataJsonDecode->data[0]->long);
        // $lngB = ((float)$dataJsonDecode->data[1]->long);
        // $phA = ($dataJsonDecode->data[0]->ph);
        // $phB = ($dataJsonDecode->data[1]->ph);
        // $jmlhLat = $latA+$latB;
        // $jmlhLng = $lngA+$lngB;
        // $latT = $jmlhLat/2;
        // $lngT = $jmlhLng/2;
        // $laT = pow($latT-$latA, 2);
        // $lonG = pow($lngT-$lngA, 2);
        // $d = sqrt($laT+$lonG);
        // $z = (($phA/$d)+($phB/$d))/((1/$d)+(1/$d));

        // print_r($z);
        
	}

}
