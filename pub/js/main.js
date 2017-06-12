/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    //FORMULARI DE LOGIN
    $('#form-login').on('submit',function(){
      var postData=$(this).serialize();
      var formURL =  "login/log";

      $.ajaxSetup({cache:false});
      $.ajax({
        type:'post',
        url:formURL,
        data:postData,
        
        success:function(resp){
          res=JSON.parse(resp);
          if(typeof res.estado == 'undefined' ){
            window.location.href=res.redir;
          }else{
            $(".msg").html("<h3>"+res.estado+"</h3>");
          }
        }
      });
      return false;
    });

    //FORMULARI DE REGISTRE
    $(".form-reg input[name=email]").on('change',function(){
      var postData=$(this).serialize();
      var formURL = "register/valemail";

      $.ajaxSetup({ cache: false });
      $.ajax({
        type:'post',
        url:formURL,
        data:postData,
        
        success:function(resp){
          res=JSON.parse(resp);
          $("#msg-email").removeClass();
          $("#msg-email").addClass(res.class);
          $("#msg-email").html(res.msg);
        }
      });
    });

    $(".form-reg input[name=username]").on('change',function(){
      var postData=$(this).serialize();
      var formURL = "register/valusername";

      $.ajaxSetup({ cache: false });
      $.ajax({
        type:'post',
        url:formURL,
        data:postData,
        success:function(resp){
          res=JSON.parse(resp);
          $("#msg-username").removeClass();
          $("#msg-username").addClass(res.class);
          $("#msg-username").html(res.msg);
        }
      });
    });

    //REGISTRE USUARI NOU
    $('.form-reg').on('submit',function(){
      var postData=$(this).serialize();
      var formURL = "register/reg"; 

      $.ajaxSetup({ cache: false });
      $.post(formURL, postData, function(resp){
        res=JSON.parse(resp);
      });
      return false;
    });
});
