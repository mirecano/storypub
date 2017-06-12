<?php

	namespace X\App\Models;

	use \X\Sys\Model;
	use \X\Sys\Session;

	class mLogin extends Model{

		public function __construct(){
			parent::__construct();

		}

    public function valeuser($username, $password){

                    $this->query("SELECT * FROM users WHERE usersname=:username && password=:password");

                    $this->bind(":username",$username);

                    $this->bind(":password",$password);

                    $this->execute();

                    $res=$this->rowCount();

										$user = $this->single();

                   if($res==1){
										 	//si el 
										 	Session::set('user',$user);
                      return true;

                   }else{
                       return false;
                   }

                }


								public function logout(){

									Session::destroy();
									header("location:.."); 
								}

	}
