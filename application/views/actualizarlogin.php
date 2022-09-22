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
            <input type="password" class="form-control has-feedback-left" name="contrasena" placeholder="Contraseña actual" autocomplete="off">
            
          </div>
          <div class="col-md-12 form-group has-feedback">
            <span class="fa fa-key form-control-feedback left" aria-hidden="true">
            </span>
            <input type="password" class="form-control has-feedback-left" name="nuevacontrasena" placeholder="Nueva contraseña" autocomplete="off"  value="<?php echo set_value('nuevacontrasena'); ?>">
          </div>
          <div class="col-md-12 form-group has-feedback">
            <span class="fa fa-key form-control-feedback left" aria-hidden="true">
            </span>
            <input type="password" class="form-control has-feedback-left" name="repitacontrasena" placeholder="Repita contraseña" autocomplete="off"   value="<?php echo set_value('repitacontrasena'); ?>">
          <p style="color: red;" ><?php echo form_error('nuevacontrasena');?></p>
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


       
   



