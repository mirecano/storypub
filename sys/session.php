<?php

	namespace X\Sys;

	/*Control de sessions
	*/

	class Session{

		static function init(){
			session_start();
			self::set('id',session_id()); 
		}

		static function set($key,$value){
			$_SESSION[$key]=$value; 
		}

		static function get($key){
			if(self::exists($key)){
				return $_SESSION[$key];
			}else{
				return null;
			}
		}

		static function exists($key){
			if(array_key_exists($key, $_SESSION)){
				return true;
			} else {
				return false;
			}
		}
		//esborrem la key
		static function del($key){
			if(self::exists($key)){
				unset($_SESSION[$key]);
			}
		}
		//esborrem tota sessió
		static function destroy(){
			session_destroy();
		}
	}