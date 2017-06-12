<?php

   namespace X\App\Controllers;

   use X\Sys\Controller; 
   use X\Sys\Session;


   class Dashboard extends Controller{


   		public function __construct($params){

   			parent::__construct($params);
        $this->addData(array('page'=>'Dashboard'));
   			$this->model=new \X\App\Models\mDashboard();
   			$this->view =new \X\App\Views\vDashboard($this->dataView,$this->dataTable);
   		}


      function home(){

        $data=$this->model->getPath(); 
        $this->addData($data); 

        $this->view->__construct($this->dataView,$this->dataTable);
        $this->view->show();

      }

      function my(){

        $iduser = $this->params['id'];

        $res=$this->model->myStories($iduser); 
        $this->addData($res);

        $this->view->__construct($this->dataView,$this->dataTable);
        $this->view->show();

      }

   }
