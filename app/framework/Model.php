<?php
/**
* 
*/
class Model 
{
	 protected $db;
	 public $error;
	 public $count;
	 function __construct(){
	 	$this->db=DB::getInstance();
	}

	public function select($sql,$params=[]){
		$sth= $this->db->prepare($sql);
		if ($sth->execute($params)) {
			$this->error=false;
			$this->count=$sth->rowCount();
			return $sth->fetchAll();
		}
		$this->error=$sth->errorInfo();
		return false;
	}

	public function insert(Array $details){
		$keys=array_keys($details);
		$column='('.implode(',', $keys).')';
		$values='(:'.implode(',:',$keys).')';
		$sql='INSERT INTO '.$this->table.' '. $column.' VALUES '.$values;
		$sth=$this->db->prepare($sql);
		if($sth->execute($details)){
			$this->error=false;
			$this->count=$sth->rowCount();
			return $this->db->lastInsertId();
		}
		$this->error=$sth->errorInfo();
		return false;
	}

	public function update($sql,$params=[]){
		$sth=$this->db->prepare($sql);
		if($sth->execute($params)){
			$this->error=false;
			$this->count=$sth->rowCount();
			return true;
		}
		$this->error=$sth->errorInfo();
		return false;	
	}

	public function delete($sql, $params=[]){
		$sth=$this->db->prepare($sql);
		if($sth->execute($params)){
			$this->error=false;
			$this->count=$sth->rowCount();
			return true;
		}
		$this->error=$sth->errorInfo();
		return false;
	}

	protected function sql($sql, $params=[]){
		$sth=$this->db->prepare($sql);
		if($sth->execute($params)){
			$this->error=false;
			$this->count=$sth->rowCount();
			return $sth;
		}
		$this->error=$sth->errorInfo();
		return false;		
	}
}
