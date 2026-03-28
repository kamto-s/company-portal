      <div class="vertical-menu">

          <div data-simplebar class="h-100">

              <div class="navbar-brand-box">
                  <a href="{{ route('dashboard') }}" class="logo">
                      <img src="{{ asset('backend') }}/assets/images/logo-light.png" />
                  </a>
              </div>

              <!--- Sidemenu -->
              <div id="sidebar-menu">
                  <!-- Left Menu Start -->
                  <ul class="metismenu list-unstyled" id="side-menu">
                      <li class="menu-title">Menu</li>

                      <li>
                          <a href="{{ route('dashboard') }}" class="waves-effect">
                              <i class='fas fa-home'></i>
                              <span class="ml-1">Dashboard</span>
                          </a>
                      </li>

                      <li class="menu-title">Settings</li>

                      <li>
                          <a href="{{ route('users.index') }}" class=" waves-effect">
                              <i class="fas fa-users"></i>
                              <span class="ml-1">Users</span>
                          </a>
                      </li>

                      <li>
                          <a href="{{ route('roles.index') }}" class=" waves-effect">
                              <i class="fas fa-shield-alt"></i>
                              <span class="ml-1">Roles</span>
                          </a>
                      </li>

                      <li>
                          <a href="#" class=" waves-effect">
                              <i class="fas fa-unlock-alt"></i>
                              <span class="ml-1">Permissions</span>
                          </a>
                      </li>

                  </ul>
              </div>
              <!-- Sidebar -->
          </div>
      </div>
