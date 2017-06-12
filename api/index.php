<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'config.slim.php'; 

    $app = new \Slim\App(['settings'=>$config]);
    
    $container = $app->getContainer();
    
    $container['db']=function($c){
                      
        $db=$c['settings']['db']; /
        $pdo = new PDO('mysql:host='.$db['host'].';dbname='.$db['dbname'],$db['user'],$db['pass']); /
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        return $pdo;
    };
    //routing web Service
//"Crear, Leer, Actualizar y Borrar"
    
    $app->get('/user', function(Request $req, Response $res){ 
        
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();
        $result=$stmt->fetchALL(PDO::FETCH_OBJ);
        
        return $this->response->withJson($result);
        
    });

    //llegim amb ID usuari
    
    $app->get('/user/{id}', function(Request $req, Response $res, $args){ 
        
        $id=(int)$args['id']; 
        
        $stmt = $this->db->prepare("SELECT * FROM users WHERE idusers= :id");
        
        $stmt->bindValue(":id",$id, PDO::PARAM_INT);
        
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_OBJ);
        
        return $this->response->withJson($result); 
    });
    
    $app->post('/user/add', function(Request $req){
        
        $data=$req->getParsedBody();
        
        $email = $data['email'];
        $pass = $data['password'];
        $user = $data['username'];
        
        $stmt = $this->db->prepare("INSERT INTO users"
                . "(idusers, rols, email, password, usersname) VALUES (null, '2', :email, :pass, :user)");
        
        $stmt->bindValue(":email",$email, PDO::PARAM_STR);
        $stmt->bindValue(":password",$pass, PDO::PARAM_STR);
        $stmt->bindValue(":username",$user, PDO::PARAM_STR);
        
        $stmt->execute();
        
        $id = (int)$this->db->lastInsertId(); 
        
        //Mostrem usuari creat
        
        $stmt = $this->db->prepare("SELECT * FROM users WHERE idusers = :id");
        
        $stmt->bindValue(":id",$id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        $result=$stmt->fetchAll(PDO::FETCH_OBJ);
        
        return $this->response->withJson($result);
       
    });
    
    $app->put('/user/upd', function(Request $req){ //UPDATE
        
        $data=$req->getParsedBody();
        
        $id=(int)$data['id']; //obtenemos id
        $email=$data['email'];
        $pass=$data['pass'];
        $user=$data['user'];
        
        
        $stmt = $this->db->prepare("UPDATE users SET email = :email, password = :pass, usersname = :user WHERE users.idusers = :id");
        
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
        $stmt->bindValue(':user', $user, PDO::PARAM_STR);
        
        $stmt->execute();
        
        $stmt = $this->db->prepare("SELECT * FROM users WHERE idusers= :id");
        
        $stmt->bindValue(":id",$id, PDO::PARAM_INT);
        
        $stmt->execute();
        $result=$stmt->fetchAll(PDO::FETCH_OBJ);
               
        return $this->response->withJson($result);
        
    });
    
    
    $app->delete('/user/del', function(Request $req){ 
        
        $data=$req->getParsedBody();
        
        $id=(int)$data['id']; 
        
        $stmt = $this->db->prepare("SELECT * FROM users WHERE idusers= :id");
        
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        $result1 = $stmt->rowCount();
        
        
        $stmt = $this->db->prepare("DELETE FROM users WHERE"
                . " users.idusers = :id");
        
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        $stmt = $this->db->prepare("SELECT * FROM users WHERE idusers= :id");
        
        $stmt->bindValue(":id",$id, PDO::PARAM_INT);
        
        $stmt->execute();
        
        $result2 = $stmt->rowCount();
        
        
       if ($result1 == 1 && $result2 == 0) {
        return $this->response->withJson(array('msg'=>'Usuari '.$id.' Esborrat'));
        } 
        
        else {
        return $this->response->withJson(array('msg'=>'usuari no existeix'));
        }
        
       
        
    });
    
    $app->run();
    
