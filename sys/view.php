<?php
	namespace X\Sys;

	/*
	Recollim array associatiu per utilitzar els seus valors
	*/

	class View extends \ArrayObject{ 

		protected $output;
		protected $dataTable;

		public function __construct($dataView, $dataTable=null){ // $data=null
			parent::__construct($dataView,\ArrayObject::ARRAY_AS_PROPS); 

			if($dataTable!=null){
				$this->dataTable = $dataTable;
			}
		}

		//Agafem directori fileview per renderitzar-ho

		public function render($fileview){
			ob_start();
			include APP.'tpl'.DS.$fileview;
			return ob_get_clean();
		}

		function show(){
			echo $this->output;
		}
	}