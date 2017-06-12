<?php


namespace X\App\Controllers;
use X\Sys\Controller;
/**
 * Description of login
 *
 * @author linux
 */
class Login extends Controller{

    public function __construct($params){
   			parent::__construct($params);
            $this->addData(array(
               'page'=>'Login'));
   			$this->model=new \X\App\Models\mLogin();
   			$this->view =new \X\App\Views\vLogin($this->dataView,$this->dataTable);
   		}

      function home(){
        $this->view->__construct($this->dataView,$this->dataTable);
      	$this->view->show();
      }

    public function log(){

        $username=filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING);

        $password=filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);

        $res=$this->model->valeuser($username, $password); 

        if($res){
            $this->ajax(array('msg'=>'Correct','class'=>'alert alert-success', 'redir'=>'/stp/dashboard'));
        }

        else{
           $this->ajax(array('msg'=>'Usuario no existe', 'class'=>'alert alert-danger'));
        }

    }

    public function logout(){
      
        $res=$this->model->logout(); 
    }

}
