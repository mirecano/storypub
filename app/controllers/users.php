<?php

namespace X\App\Controllers;

   use X\Sys\Controller;


   class Users extends Controller{
      protected $model;
      protected $view;
      protected $params;

   		public function __construct($params){
            parent::__construct($params);
            $this->addData(array(
               'page'=>'Users'));
            $this->model=new \X\App\Models\mUsers();
            $this->view =new \X\App\Views\vUsers($this->dataView);

         }

         function profile(){

           $iduser = $this->params['id'];

           $res=$this->model->myStories($iduser); 
           $this->addData($res);

         	 $this->view->__construct($this->dataView,$this->dataTable);
         	 $this->view->show();

         }

         function edit(){

           $iduser=filter_input(INPUT_POST,'userid',FILTER_SANITIZE_STRING);
           $username=filter_input(INPUT_POST,'nameuser',FILTER_SANITIZE_STRING);
           $email=filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);

           $res=$this->model->editUser($iduser, $username, $email);

           }
           else{
             $res = false;
           }

           if($res){
               $this->ajax(array('msg'=>'Correct','class'=>'alert alert-success', 'redir'=>'/stp/dashboard'));

           }else{
              $this->ajax(array('msg'=>'Error', 'class'=>'alert alert-danger'));
           }
         }
   }
