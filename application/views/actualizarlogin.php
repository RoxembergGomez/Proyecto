<div class="container">

  <div  class="login_wrapper">
  <div class="animate form login_form  ">
    <section class="login_content">
      <?php
          echo form_open_multipart('Usuarios/actualizarcontrasena',array('id'=>'form1'));
        ?>
      <div id="aw" class="container md-3">
        <div id="identified1" class="card-body ">
          <h1 style="margin:5px;">ACTUALIZAR CONTRASEÑA</h1>
          <br>
         
        <input type="hidden" name="idUsuario" value="<?php echo $this->session->userdata('idUsuario');?>">
             <?php if($msg=='1'){?>
              <p id="validar" >  (*) Error de contraseña </p>
          <?php } ?>
          <div class="col-md-12 form-group has-feedback">
            <span class="fa fa-key form-control-feedback left" aria-hidden="true">
            </span>
            <input type="password" class="form-control has-feedback-left" name="contrasena" placeholder="Contraseña actual" autocomplete="off" id="password1">
            <span class=" form-control-feedback right" style="cursor: pointer;"  onclick="hideshow1()" >
              <i id="slash" class="fa fa-eye-slash"></i>
              <i id="eye" class="fa fa-eye"></i>
          </span>
          </div>
          <div class="col-md-12 form-group has-feedback">
            <span class="fa fa-key form-control-feedback left" aria-hidden="true">
            </span>
            <input type="password" class="form-control has-feedback-left" name="nuevacontrasena" placeholder="Nueva contraseña" autocomplete="off"  value="<?php echo set_value('nuevacontrasena'); ?>" id="password2">
            <span class=" form-control-feedback right" style="cursor: pointer;"  onclick="hideshow2()" >
              <i id="slash" class="fa fa-eye-slash"></i>
              <i id="eye" class="fa fa-eye"></i>
          </span>
          </div>
          <div class="col-md-12 form-group has-feedback">
            <span class="fa fa-key form-control-feedback left" aria-hidden="true">
            </span>
            <input type="password" class="form-control has-feedback-left" name="repitacontrasena" placeholder="Repita contraseña" autocomplete="off"   value="<?php echo set_value('repitacontrasena'); ?>" id="password3">
          <p style="color: red;" ><?php echo form_error('nuevacontrasena');?></p>
          <span class=" form-control-feedback right" style="cursor: pointer;"  onclick="hideshow3()" >
              <i id="slash" class="fa fa-eye-slash"></i>
              <i id="eye" class="fa fa-eye"></i>
          </span>
          <?php if($msg=='2'){?>
              <p style="margin:0px;" >  (*) Contraseñas nuevas no coiciden </p>
          <?php } ?>
          </div>

          <div class="col-md-12 form-group has-feedback">
            <button class="col-md-12 form-group btn btn-dark" type="submit">
              <i class="fa fa-sign-in"></i> Actualizar
            </button>
          </div>
          
          <div class="clearfix"></div>
          <div class="separator">
            <div class="clearfix"></div>
            <div>
              <h1> Sistema de Auditoría Interna</h1>
            </div>
          </div>
          <?php
          echo form_close();
          ?>         
        </div>
      </div>
    </section>
  </div>
</div>

<script>
    /*function hideshow1(){
      var password = document.getElementById("password1");
      var slash = document.getElementById("slash");
      var eye = document.getElementById("eye");
      
      if(password.type === 'password'){
        password.type = "text";
        slash.style.display = "block";
        eye.style.display = "none";
      }
      else{
        password.type = "password";
        slash.style.display = "none";
        eye.style.display = "block";
      }

    }
    function hideshow2(){
      var password = document.getElementById("password2");
      var slash = document.getElementById("slash");
      var eye = document.getElementById("eye");
      
      if(password.type === 'password'){
        password.type = "text";
        slash.style.display = "block";
        eye.style.display = "none";
      }
      else{
        password.type = "password";
        slash.style.display = "none";
        eye.style.display = "block";
      }

    }

    function hideshow3(){
      var password = document.getElementById("password3");
      var slash = document.getElementById("slash");
      var eye = document.getElementById("eye");
      
      if(password.type === 'password'){
        password.type = "text";
        slash.style.display = "block";
        eye.style.display = "none";
      }
      else{
        password.type = "password";
        slash.style.display = "none";
        eye.style.display = "block";
      }

    }*/
  </script>
       
   



