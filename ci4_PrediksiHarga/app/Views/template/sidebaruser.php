
                  <nav class="pcoded-navbar">
                      <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                      <div class="pcoded-inner-navbar main-menu">
                          <div class="">
                              <div class="main-menu-header">
                                  <img class="img-80 img-radius" src="<?= base_url('assets/images/newlogo.png');?>" alt="User-Profile-Image">
                                  <div class="user-details">
                                      <span id="more-details">PT. XYZ </span>
                                  </div>
                              </div>
                          </div>

                          <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Dashboard</div>
                          <ul class="pcoded-item pcoded-left-item">
                              <li class="active">
                                  <a href="<?= base_url('user/dashboard'); ?>" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="ti-home"></i></span>
                                      <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                          </ul>
                          
                          <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Data</div>
                          <ul class="pcoded-item pcoded-left-item">
                             
                             <li class="">
                                  <a href="<?= base_url('user/datasetuser'); ?>" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="fa-solid fa-database"></i></span>
                                      <span class="pcoded-mtext" data-i18n="nav.dash.main">Data Set</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                          </ul>

                          <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Data Set Processing</div>
                          <ul class="pcoded-item pcoded-left-item">
                              <li>

                              <li>
                                  <a href="<?= base_url('user/splitdatasetuser'); ?>" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="fa-solid fa-percent"></i></span>
                                      <span class="pcoded-mtext" data-i18n="nav.form-components.main">Performance</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
        
                          <div class="pcoded-navigation-label" data-i18n="nav.category.forms">Prediction</div>
                          <ul class="pcoded-item pcoded-left-item">

                              <li>
                                  <a href="<?= base_url('user/PrediksiPriceUser'); ?>" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="fa-solid fa-chart-bar"></i></span>
                                      <span class="pcoded-mtext" data-i18n="nav.form-components.main">Random Forest</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>

                              <li class="">
                                  <a href="<?= base_url('/prediksipriceuser/listUploadedFiles'); ?>" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="fa-solid fa-file"></i></span>
                                      <span class="pcoded-mtext" data-i18n="nav.dash.main">List Report .txt/excel</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                            </ul>
                          <div class="pcoded-navigation-label" data-i18n="nav.category.navigation">Logout</div>
                          <ul class="pcoded-item pcoded-left-item">
                              <li class="active">
                                  <a href="<?= base_url('/logout'); ?>" class="waves-effect waves-dark">
                                      <span class="pcoded-micon"><i class="ti-user"></i></span>
                                      <span class="pcoded-mtext" data-i18n="nav.dash.main">Logout</span>
                                      <span class="pcoded-mcaret"></span>
                                  </a>
                              </li>
                          </ul>
                          </div>

                      </div>
                  </nav>

                 

