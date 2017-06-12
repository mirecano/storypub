<?php
	namespace X\Sys;

	class Model{
		// if model pagination 
		// activate $pagination=true
		protected $db;
		protected $stmt;
		//pagination attributes
		public $pagination=false;
		public $limit;
		// current number of page
        public $page; 
        //number of records
        public $total; 
        public $npages;

		public function __construct(){
			$this->db=DB::singleton();
			//construct in pagination mode
			if ($pag){
				$this->pagination=true;
				$this->limit=LIMIT_ROWS;
			}
		}

		/*Usamos el metodo preapre de PDO, para preparar la sentencia sql*/
		public function query($sql){
			$this->stmt=$this->db->prepare($sql);
		}

		/**
		 *  function bind
		 * @param $param string :name
		 * @param $value PHP variable
		 * @param $type  PDO::PARAM_STR.... or null
		 * 
		 * */

		public function bind($param,$value){	
			switch (true) {
				case is_int($value):
					$type= \PDO::PARAM_INT;
				break;

				case is_null($value):
					$type= \PDO::PARAM_NULL;
				break;

				case is_bool($value):
					$type= \PDO::PARAM_BOOL;
				break;

				default:
					$type= \PDO::PARAM_STR;
				break;
			}
			$this->stmt->bindValue($param,$value,$type);
		}
		
		public function execute(){
			$result=$this->stmt->execute();
    		return $result;
		}

		public function resultSet(){
			return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
		}

		public function single(){
			return $this->stmt->fetch(\PDO::FETCH_ASSOC);
		}

		public function rowCount(){
			return $this->stmt->rowCount();
		}

		public function lastInsertId(){
			return $this->db->lastInsertId();
		}

		public function beginTransaction(){
			return $this->db->beginTransaction(); 
		}

		public function endTransaction(){
			return $this->db->commit();
		}

		public function cancelTransaction(){
			return $this->db->rollback(); 
		}

		public function debugDumpParams(){
			return $this->stmt->debugDumpParams(); 
		}

		//pagination functions
		public function getTotal($table){
            //extracting total records
            $sql="SELECT * FROM ".$table;
            $this->query($sql);
            $this->execute();
            $total=$this->rowCount();
            $this->total=$total;
            $this->npages=ceil($total/$this->limit);
            Session::set('total',$this->total);
            setcookie('total',Session::get('total'),0,APP_W);
            return $this->total;
        }

	    public function setPage($page){
	        $this->page=$page;
	    }

    	

	}