<?php
class database extends ci_model{
	public $table;
	protected $where = array();
	protected $like = array();
	protected $order;
	protected $limit;
	protected $uri;
	protected $rand = false;
	protected $field;
	protected $or_where = array();
	protected $groupBy = array();
	public $values = array();
	public function __construct(){
		parent::__construct();
	}
	public function set_groupBy($val){
		$this->groupBy=$val;
	}
	public function set_field($field){
		$this->field = $field;
	}
	public function add_batch_value($val){
		$this->values[] = $val;
	}
	public function activateJoin($table,$joinEvt){
		$this->db->join($table, $joinEvt);
	}
	public function set_table($table){
		$this->table = $table;
	}
	public function set_order($order,$rand = false){
		$this->order = $order;
		$this->rand = $rand;
	}
	public function set_where($where){
		$this->where= $where;

	}
	public function set_or_where($where){
		$this->or_where= $where;

	}
	public function set_like($like){
		$this->like = $like;
	}
	public function set_limit($limit){
		$this->limit = $limit;
	}
	public function set_uri($uri){
		$this->uri= $uri;
	}

	public function unset_where(){
		$this->where= null;
	}
	public function unset_field(){
		$this->field= null;
	}
	public function unset_groupby(){
		$this->groupBy= null;
	}
	public function unset_like(){
		$this->like = null;
	}
	public function unset_limit(){
		$this->limit = $limit;
	}
	public function unset_table(){
		$this->uri= null;
	}
	public function set_values($val){
		$this->values=$val;
	}
	public function setWhereAndOr($arrAnd,$arrOr,$operationAnd = "=",$operationOr = "like"){
		$qAnd=array();
		$i=0;
		foreach ($arrAnd as $key => $value) {
			$arKey = explode(" ", $key);
			if(count($arKey)>1){
				$operationAnd = $arKey[1];
				$key = $arKey[0];
			}
			
			$qAnd[$i] = $key ." ".$operationAnd." '".$value."'";
			$i++;
		}
		$qOr;
		$i=0;
		foreach ($arrOr as $key => $value) {
			$arKey = explode(" ", $key);
			
			if(count($arKey)>1){
				$operationOr = $arKey[1];
				$key = $arKey[0];
			}
			$qOr[$i] = $key ." ".$operationOr." '".$value."'";
			$i++;
		}
		$qAnd = implode(" and ", $qAnd);
		$qOr =  implode(" or ", $qOr);
		$this->set_where("(".$qAnd.") and (".$qOr.")");
	}
	public function simpan($data, $table){
		$this->db->insert($table,$data);
	}

	public function get_60_data(){
        $this->db->select('dataKualitas');
        $this->db->from('tabelfriska');
        $this->db->limit(60);
        $this->db->order_by('id', 'DESC');

        return $this->db->get();
    }

    public function get_data(){
        $this->db->select('dataKualitas');
        $this->db->from('tabelfriska');
        $this->db->limit(1);
        $this->db->order_by('id', 'DESC');

        return $this->db->get();
    }

	public function simpan_banyak(){
		$this->db->insert_batch($this->table,$this->values);
		return true;
	}
	public function update(){
		$this->db->where($this->where);
		$even = $this->db->update($this->table,$this->values);
		if($even) return true;
		else return false;
	}
	public function tampil(){
		if($this->where) $this->db->where($this->where);
		if($this->like) $this->db->or_like($this->like);
		if($this->or_where) $this->db->or_where($this->or_where);
		if($this->field) $this->db->select($this->field);
		if($this->groupBy) $this->db->group_by($this->groupBy);
		if($this->order){
			if(!$this->rand)
				$this->db->order_by($this->order);	
			else
				$this->db->order_by($this->order,"RANDOM");
		} 
		$data = $this->db->get($this->table,$this->limit,$this->uri);
		return $data->result();
	}
	public function tampil_json(){
		if($this->where) $this->db->where($this->where);
		if($this->like) $this->db->or_like($this->like);
		if($this->or_where) $this->db->or_where($this->or_where);
		if($this->order) $this->db->order_by($this->order);
		$data = $this->db->get($this->table,$this->limit,$this->uri);
		return json_encode($data->result_array());
	}
	public function hapus(){
		$even = $this->db->delete($this->table,$this->where);
		if($even) return true;
		else return false;
	}
	public function count(){
		if($this->where) $this->db->where($this->where);
		if($this->like) $this->db->or_like($this->like);
		$jml= $this->db->count_all_results($this->table);
		return $jml;	
	}
	public function getdistinct($field){
		$query=$this->db->query("SELECT distinct (".$field.") from ".$this->table);
		return $query->result();
	}
	public function kosong(){
		$this->db->truncate($this->table); 
	}
	public function getIncrement($field){
		$query=$this->db->query("SELECT ".$field." from ".$this->table." order by ".$field." asc");
		$res = $query->result_array();
		$num = 0;
		foreach($res as $key){
			$num = $key[$field];
		}
		$num+=1;
		return $num;
	}

}
?>