<?php

$this->load->view("template/header");

if(is_array($page)){
	for ($i=0; $i < count($page) ; $i++) { 
		$this->load->view($page[$i]);
	}
}
else{
	$this->load->view($page);
}
$this->load->view("template/footer");