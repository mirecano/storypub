<?php 

	namespace X\Sys;

	class DB extends \PDO{
		static $instance;

		public function __construct(){

			//recuperar la configuració del fitxer config.json
			$config = Registry::getInstance();
			$dbconf = (array)$config->dbconf;
			//Recollir els valors del nostre fitxer json a través de la classe registry	
			$dsn=$dbconf['driver'].':host='.$dbconf['dbhost'].';dbname='.$dbconf['dbname'];	
			$usr=$dbconf['dbuser']; 		
			$pwd=$dbconf['dbpass'];

			try{
				parent::__construct($dsn,$usr,$pwd);
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		static function singleton(){
			if(!(self::$instance instanceof self)){
				self::$instance=new self();
			}
			return self::$instance;
		}
	}