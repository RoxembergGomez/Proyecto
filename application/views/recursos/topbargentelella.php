              <a data-toggle="tooltip" data-placement="top" title="Ajustes">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Soporte Técnico">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Reportar Incidencia">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Cerrar Sesión" href="login.html">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>          
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav" data-placement="top">
        <div class="nav_menu" data-placement="top">
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i><p><?php echo $this->session->userdata('tipo');?></p> </a>
          </div>

          <nav class="nav navbar-nav">
            <ul class=" navbar-right">
              <li class="nav-item dropdown open" style="padding-left: 15px;">
                <a href="<?php echo base_url(); ?>gentelella/javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                  <img src="<?php echo base_url(); ?>gentelella/Production/images/img.jpg" alt=""><?php echo $this->session->userdata('login');?>
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="<?php echo base_url(); ?>gentelella/javascript:;"> Inicio</a>
                  <a class="dropdown-item" href="<?php echo base_url(); ?>gentelella/javascript:;">
                    <span>Soporte Técnico</span>
                  </a>
                  <a class="dropdown-item" href="<?php echo base_url(); ?>gentelella/javascript:;">Reportar Incidencia</a>
                  <?php echo form_open_multipart('usuarios/logout');//CONTROL PARA CERRAR SESIÓN ?> 
                        <button type="submit" class="dropdown-item"  ><i class="fa fa-sign-out pull-right"></i>Cerrar Sesión</button>
                    <?php echo form_close();?>
                </div>
              </li>

              <li role="presentation" class="nav-item dropdown open">
                <a href="<?php echo base_url(); ?>gentelella/javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-envelope-o"></i>
                  <span class="badge bg-green">6</span>
                </a>
                <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                  <li class="nav-item">
                    <a class="dropdown-item">
                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="dropdown-item">
                      <span class="image"><img src="<?php echo base_url(); ?>gentelella/Production/images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="dropdown-item">
                      <span class="image"><img src="<?php echo base_url(); ?>gentelella/Production/images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="dropdown-item">
                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <div class="text-center">
                      <a class="dropdown-item">
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                      </a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
      </div>
<div class="right_col" role="main">
 <div class="">

