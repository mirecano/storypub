<?php
	namespace X\Sys;

	/**
	 * 
	 * 
	 * Registry: stores app information
	 * 
	 * @author Mire
	 * 
	 * 
	 * */

	 class Registry{
	 	private $data=array();
	 	static $instance;

	 	function __construct(){
	 		$this->data=array();
	 		$this->loadConf();
	 	}
	 	// singleton instance
	 	public static function getInstance(){
	 		// there is no instance?
	 		if(!(self::$instance instanceof self)){
	 			self::$instance=new self(); 
	 			return self::$instance;
	 		}else{
	 			return self::$instance;
	 		}
	 	}

	 	function __set($key,$value){
	 		if(!array_key_exists($key, $this->data)){ 
	 			$this->data[$key]=$value; 
	 		}
	 	}

	 	function __get($key){
	 		if(array_key_exists($key, $this->data)){
	 			return $this->data[$key];
	 		} else {
	 			return null;
	 		}
	 	}

	 	function __unset($key=null){ 
	 		if($key!=null){
	 			if(array_key_exists($key, $this->data)){
		 			unset($this->data[$key]);
	 			}
	 		}else{
	 			unset($this->data);
	 		}
	 	}

	 	/**
		*	carreguem arxiu json amb dades de configuració 
	 	**/

	 	function loadConf(){
	 		$file=APP.'config.json';
	 		$jsonStr=file_get_contents($file);
	 		
	 		$arrayJson=json_decode($jsonStr);
	 		foreach ($arrayJson as $key => $value) {
	 			$this->data[$key]=$value;
	 		}
	 	}

	}
