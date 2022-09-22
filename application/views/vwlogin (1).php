<div class="login_wrapper ">
  <div div class="animate form login_form  ">
    <section class="login_content  ">
      <?php
      echo form_open_multipart(
        'usuarios/validar',
        array(
          'id' => 'formlogin',
          'class' => 'from-control'
        )
      );
      ?>
      <div id="aw" class="container md-3">
        <div id="identified1" class="card-body ">
          <h1>Iniciar Sesión</h1>
          <div class="content-center">
            <img class="img-fluid rounded w-80" src="<?php echo base_url() ?>img/sismrbb.png">
          </div>
          <br>
          <div class="col-md-12 form-group has-feedback">
            <input type="text" class="form-control has-feedback-left" name="login" placeholder="Ingrese su usuarios" required>
            <span class="fa fa-user form-control-feedback left" aria-hidden="true">
            </span>
          </div>
          <div class="col-md-12 form-group has-feedback">
            <span class="fa fa-key form-control-feedback left" aria-hidden="true">
            </span>
            <input type="password" class="form-control has-feedback-left" name="password" placeholder="Ingrese su contraseña" required>
          </div>
          <div>
            <button class="col btn btn-success" type="submit">
              <i class="fa fa-sign-in"></i> Ingresar
            </button>
          </div>
          <div class="clearfix"></div>
          <div class="separator">
            <div class="clearfix"></div>
            <div>
              <h1><i class="fa fa-globe"></i> Sistema de gestión de ventas</h1>
              <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap template.</p>
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