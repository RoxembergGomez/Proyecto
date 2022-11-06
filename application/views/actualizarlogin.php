<div class="container">

  <div  class="login_wrapper">
  <div class="animate form login_form  ">
    <section class="login_content">

      <div id="aw" class="container md-3">
        <div id="identified1" class="card-body ">
          <h1 style="margin:5px;">CAMBIO DE CLAVE</h1>
          <br>
        <?php
          echo form_open_multipart('Usuarios/actualizarcontrasena',array('id'=>'form1'));
        ?>
        <input type="hidden" name="idUsuario" value="<?php echo $this->session->userdata('idUsuario');?>">
             <?php if($msg=='1'){?>
              <p id="validar" >  (*) Error de contraseña </p>
          <?php } ?>
          <div class="col-md-12 form-group has-feedback">
            <span class="fa fa-key form-control-feedback left" aria-hidden="true">
            </span>
            <input type="password" class="form-control has-feedback-left" name="contrasena" placeholder="Contraseña actual" autocomplete="off" id="password1">
            <span class=" form-control-feedback right" style="cursor: pointer;"  onclick="mostrar()" >
              <i id="slash" class="fa fa-eye-slash"></i>
              <i id="eye" class="fa fa-eye"></i>
          </span>
          </div>
          <div class="col-md-12 form-group has-feedback">
            <span class="fa fa-key form-control-feedback left" aria-hidden="true">
            </span>
            <input type="password" class="form-control has-feedback-left" name="nuevacontrasena" placeholder="Nueva contraseña" autocomplete="off" id="password2"  value="<?php echo set_value('nuevacontrasena'); ?>" >
            <span class=" form-control-feedback right" style="cursor: pointer;"  onclick="mostrarrep()" >
              <i id="vi" class="fa fa-eye-slash"></i>
              <i id="novi" class="fa fa-eye"></i>
          </span>
          </div>
          <div class="col-md-12 form-group has-feedback">
            <span class="fa fa-key form-control-feedback left" aria-hidden="true">
            </span>
            <input type="password" class="form-control has-feedback-left" name="repitacontrasena" placeholder="Repita contraseña" autocomplete="off"   value="<?php echo set_value('repitacontrasena'); ?>" id="password3">
          <p style="color: red;" ><?php echo form_error('nuevacontrasena');?></p>
          <span class=" form-control-feedback right" style="cursor: pointer;"  onclick="hideshow3()" >
              <i id="vi2" class="fa fa-eye-slash"></i>
              <i id="novi2" class="fa fa-eye"></i>
          </span>
          <?php if($msg=='2'){?>
              <p style="margin:0px;" >  (*) Contraseñas nuevas no coiciden </p>
          <?php } ?>
          </div>
        
          <div class="col-md-12 ">
            <button type="submit" class="col-md-12 form-group btn btn-dark" >
              <i class="fa fa-sign-in"></i> Actualizar
            </button>
          </div>
          <?php
          echo form_close();

          echo form_open_multipart('Usuarios/index2');
        ?>
        <div class="col-md-12 form-group has-feedback float-right">
            <button class="col-md-12 form-group btn btn-dark" type="submit">
              <i class="fa fa-remove (alias)"></i> Cancelar
            </button>
          </div> 
         <?php
          echo form_close();
          ?>        

          <div class="separator">

            <div>
              <h1> Sistema de Auditoría Interna</h1>
            </div>
          </div>
        
        </div>
      </div>
    </section>
  </div>
</div>
<h1 id="proyecto">SAIB-RISK</h1>

<script>
    function mostrar(){
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

    function mostrarrep(){
      var past = document.getElementById("password2");
      var vi = document.getElementById("vi");
      var novi = document.getElementById("novi");
      
      if(past.type === 'password'){
        past.type = "text";
        vi.style.display = "block";
        novi.style.display = "none";
      }
      else{
        past.type = "password";
        vi.style.display = "none";
        novi.style.display = "block";
      }

    }

    function hideshow3(){
      var password = document.getElementById("password3");
      var vi2 = document.getElementById("vi2");
      var novi2 = document.getElementById("novi2");
      
      if(password.type === 'password'){
        password.type = "text";
        vi2.style.display = "block";
        novi2.style.display = "none";
      }
      else{
        password.type = "password";
        vi2.style.display = "none";
        novi2.style.display = "block";
      }

    }
  </script>
       
   



