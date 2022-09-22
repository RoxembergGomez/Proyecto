<div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="<?php echo base_url(); ?>gentelella/Production/index.html" class="site_title"><span>SAIB-RISK</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="<?php echo base_url(); ?>gentelella/Production/images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Bienvenido,</span>
              <h2><?php echo $this->session->userdata('usuario');?></h2>
            </div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>MÓDULOS</h3>
              <ul class="nav side-menu">
              <?php if ($this->session->userdata('tipo')=='jefe') {?>
                <li><a><i class="fa fa-users"></i>Gestión de Usuarios<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li>
                      <?php echo form_open_multipart('controller_usuarios/index');?>
                        <button type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;" >Usuarios</button>
                      <?php echo form_close();?>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-male"></i>Gestión de Empleados<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li>
                      <?php echo form_open_multipart('controller_empleados/index');?>
                        <button type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;" >Empleados</button>
                      <?php echo form_close();?>
                    </li>
                    <li>
                      <?php echo form_open_multipart('controller_cargos/index');?>
                        <button type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;" >Cargos</button>
                      <?php echo form_close();?>
                    </li>
                     <li>
                      <?php echo form_open_multipart('controller_unidadnegocio/index');?>
                        <button type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;" >Unidades de Negocio</button>
                      <?php echo form_close();?>
                    </li>
                  </ul>
                </li>
              <?php }
              if ($this->session->userdata('tipo')=='jefe' || $this->session->userdata('tipo')=='ejecutor') {?>
                <li><a><i class="fa fa-line-chart"></i>Análisis de Riesgos<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li>
                      <?php echo form_open_multipart('controller_procesos/index');?>
                        <button type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;" >Procesos</button>
                      <?php echo form_close();?>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-list"></i>Planificación<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li>
                      <?php echo form_open_multipart('controller_actividades/index');?>
                        <button type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;" >Actividades</button>
                      <?php echo form_close();?>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-list"></i>Ejecución<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li>
                      <?php echo form_open_multipart('controller_memorandumplanificacion/index');?>
                        <button type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;" >MPA</button>
                      <?php echo form_close();?>
                    </li>
                    <li>
                      <?php echo form_open_multipart('controller_programas/index');?>
                        <button type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;" >Programas de Trabajo</button>
                      <?php echo form_close();?>
                    </li>
                    <li>
                      <?php echo form_open_multipart('controller_requerimientoinformacion/index');?>
                        <button type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;" >Requerimiento</button>
                      <?php echo form_close();?>
                    </li>
                  </ul>
                </li>
              <?php }?>
                <li><a><i class="fa fa-file-text"></i>Hallazgos<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li>
                      <?php echo form_open_multipart('controller_hallazgos/index');?>
                        <button  type="submit" class="btn btn-dark btn-sm text-left w-100" style="background-color: transparent; border: none;">Hallazgos</button>
                      <?php echo form_close();?>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-list-ol"></i>ADMIN<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="<?php echo base_url(); ?>gentelella/production/tables.html">Tables</a></li>
                    <li><a href="<?php echo base_url(); ?>gentelella/production/tables_dynamic.html">Table Dynamic</a></li>
                  </ul>
                </li>
            </div>
        </div>
          <!-- /sidebar menu -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">