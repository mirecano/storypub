<?php
	namespace X\Sys;


	/**
	*	Core: Front controller
	*
	*	@author: Mire
	*	@package: sys
	*
	*
	**/

	use X\Sys\Request;
	use X\Sys\Session;

	class Core{
		static private $controller;
		static private $action;
		static private $params;

		public static function init(){

			//Iniciem la sessió
			Session::init();

			//Cridem a la funció exploding, de la classe Request
			//$arrayquery, preparat per extreure controlador

			Request::exploding();

			//extreure 1a variable
			self::$controller=Request::getVariable(); 
			//extreure 2a variable
			self::$action=Request::getVariable(); 

			self::$params=Request::getParams(); 
			//Fem routing
			self::router();
		}
		/**
		 * 
		 *  Obtaining file controller
		 * 
		 * 
		 *  @return string $fileroute
		 * 
		 * */

		static function getFileContAct(){
			self::$controller=(self::$controller!="")?self::$controller:'home';
			self::$action=(self::$action!="")?self::$action:'home';
			//trobar controladors
			$filename=strtolower(self::$controller).'.php';
			$fileroute=APP.'controllers'.DS.$filename;
			return $fileroute;

		}


		/**
		* router: Looks for controller and action
		*
		*
		*
		*/
		static function router(){
			
			self::$controller=(self::$controller!="")?self::$controller:'home';
			self::$action=(self::$action!="")?self::$action:'home';
				
			$filename=strtolower(self::$controller).'.php';
			$fileroute = APP.'controllers'.DS.$filename;
		
			if(is_readable($fileroute)){
				$contr_class='\X\App\Controllers\\'.ucfirst(self::$controller);
				self::$controller=new $contr_class(self::$params);
				// cal cridar ara l'accio
				if (is_callable(array(self::$controller,self::$action))){
					call_user_func(array(self::$controller,self::$action));
				}
				else {
					echo self::$action.' :Acció innexistent';
				}
			} else {
				echo self::$controller.' :controlador innexistent';
			}
		}
	}