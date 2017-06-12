<?php
	namespace X\Sys;

	use X\Sys\Registry;
	/**
	*
	*   Controller: the base controller
	*     in MVC systems
	*
	*   Allows pass data between views and controller
	*   and between models and controllers
	*
	**/
	class Controller{
		protected $model;
		protected $view;
		protected $params;
		//mechanism for passing data to views
		protected $dataView=array();
		protected $dataTable=array();
		//object configuration data
		protected $conf;
		//app version and title data
		protected $app; 

		function __construct($params=null,$dataView=null){
			$this->params=$params;
			//accés tipus SINGELTON
			$this->conf=Registry::getInstance();
			$this->app=(array)$this->conf->app;
			$this->addData($this->app);	
		}


		function ajax($output){
			//netejem el bufer 
			ob_clean(); 
			if(is_array($output)){
				echo json_encode($output);
			}
		}

		/**
		 *   Merge two arrays
		 * 
		 *   Merge arrays in dataView array
		 * 	to use then lika variables in the template
		 *   @param array $array
		 * 
		 * 
		 * */

		protected function addData($array){
			if (is_array($array)){
				if ($this->is_single($array)&& is_array($this->dataView)){
					$this->dataView=array_merge($this->dataView,$array);
				}else{
					$this->dataTable=$array;
				}
			}
			else{
				$this->dataView=$array;
			}
		}

		/**
		 *  convert rows form multiple row array to  linnear
		 *  array data
		 * @param $mdata  array
		 * @return $result array
		 * 
		 * 
		 * */

		protected function multipleData($mdata){
			//
			for($i=0;$i<count($mdata);$i++){
				foreach ($mdata[$i] as $key => $value) {
					$result[$key.$i]=$value;
				}
			}
			return $result;
		}

		/**
		 *  Checks if array is single or multidimensional
		 *  @param $data array
		 * 	@return boolean
		 * 
		 * */

		protected function is_single($data){
			foreach ($data as  $value) {
				if (is_array($value)){
					return false;
				}else{
					return true;
				}
			}
		}

		function ajax($output){
			ob_clean();
			if(is_array($output)){
				echo json_encode($output);
			}
		}		
		
		function error(){
            $this->msg='Error. Action not defined';
        }
	}