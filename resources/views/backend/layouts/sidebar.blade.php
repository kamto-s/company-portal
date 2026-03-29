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
                      @can('dashboard.permission')
                          <li>
                              <a href="{{ route('dashboard') }}" class="waves-effect">
                                  <i class='fas fa-home'></i>
                                  <span class="ml-1">Dashboard</span>
                              </a>
                          </li>
                      @endcan

                      @canany(['category.permission'])
                          <li class="menu-title">Posts</li>
                      @endcanany

                      @can('category.permission')
                          <li class="{{ request()->routeIs('categories.*') ? 'mm-active' : '' }}">
                              <a href="{{ route('categories.index') }}"
                                  class=" waves-effect {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                                  <i class="fas fa-file-alt"></i>
                                  <span class="ml-1">Categories</span>
                              </a>
                          </li>
                      @endauth

                      {{-- <li class="{{ request()->routeIs('users.*') ? 'mm-active' : '' }}">
                          <a href="{{ route('users.index') }}"
                              class=" waves-effect {{ request()->routeIs('users.*') ? 'active' : '' }}">
                              <i class="fas fa-folder"></i>
                              <span class="ml-1">Categories</span>
                          </a>
                      </li> --}}

                      @canany(['user.permission', 'role.permission', 'permission.permission',
                          'activity-log.permission'])
                          <li class="menu-title">Settings</li>
                      @endcanany

                      @can('user.permission')
                          <li class="{{ request()->routeIs('users.*') ? 'mm-active' : '' }}">
                              <a href="{{ route('users.index') }}"
                                  class=" waves-effect {{ request()->routeIs('users.*') ? 'active' : '' }}">
                                  <i class="fas fa-users"></i>
                                  <span class="ml-1">Users</span>
                              </a>
                          </li>
                      @endcan

                      @can('role.permission')
                          <li class="{{ request()->routeIs('roles.*') ? 'mm-active' : '' }}">
                              <a href="{{ route('roles.index') }}"
                                  class="waves-effect {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                                  <i class="fas fa-shield-alt"></i>
                                  <span class="ml-1">Roles</span>
                              </a>
                          </li>
                      @endcan

                      @can('permission.permission')
                          <li class="{{ request()->routeIs('permissions.*') ? 'mm-active' : '' }}">
                              <a href="{{ route('permissions.index') }}"
                                  class=" waves-effect {{ request()->routeIs('permissions.*') ? 'active' : '' }}">
                                  <i class="fas fa-unlock-alt"></i>
                                  <span class="ml-1">Permissions</span>
                              </a>
                          </li>
                      @endcan

                      @can('activity-log.permission')
                          <li class="{{ request()->routeIs('activity-logs.*') ? 'mm-active' : '' }}">
                              <a href="{{ route('activity-logs.index') }}" class=" waves-effect">
                                  <i class="fas fa-history"></i>
                                  <span class="ml-1">Activity
                                      Log</span>
                              </a>
                          </li>
                      @endcan

                  </ul>
              </div>
              <!-- Sidebar -->
          </div>
      </div>
