<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
      <div class="nano">
          <div class="nano-content">
              <ul>
                  <div class="logo"><a href="index.html">
                          <!-- <img src="assets/images/logo.png" alt="" /> --><span>Focus</span></a></div>
                  <li class="label">Main</li>
                  <li><a class="sidebar-sub-toggle"><i class="ti-home"></i> Dashboard <span
                              class="badge badge-primary">2</span> <span
                              class="sidebar-collapse-icon ti-angle-down"></span></a>
                      <ul>
                          <li><a href="index.html">Dashboard 1</a></li>
                          <li><a href="index1.html">Dashboard 2</a></li>
                      </ul>
                  </li>

                  <li class="label">Apps</li>
                  <li><a class="sidebar-sub-toggle"><i class="ti-bar-chart-alt"></i> Users <span
                              class="sidebar-collapse-icon ti-angle-down"></span></a>
                      <ul>
                          <li><a href="{{ route('admin.users.index') }}">User List</a></li>
                          <li><a href="{{ route('admin.users.create') }}">Add User</a></li>
                      </ul>
                  </li>
                  <li><a class="sidebar-sub-toggle"><i class="ti-layout"></i> Roles <span
                              class="sidebar-collapse-icon ti-angle-down"></span></a>
                      <ul>
                          <li><a href="{{ route('admin.roles.index') }}">Role List</a></li>
                          <li><a href="{{ route('admin.roles.index') }}">Add Role</a></li>
                      </ul>
                  </li>

                  <li><a href="{{ route('admin.mock.api') }}"><i class="ti-close"></i>Create Mock Api</a></li>
                  <li><a href="{{ route('admin.mock.api.list') }}"><i class="ti-close"></i>Api List</a></li>


                  <li><a href="{{ route('admin.custom.mock.api') }}"><i class="ti-close"></i>Create Custom Mock Api</a></li>
                  <li><a href="{{ route('admin.custom.mock.api.list') }}"><i class="ti-close"></i>Custom Api List</a></li>

                  <li><a class="sidebar-sub-toggle"><i class="ti-target"></i> Pages <span
                              class="sidebar-collapse-icon ti-angle-down"></span></a>
                      <ul>
                          <li><a href="page-login.html">Login</a></li>
                          <li><a href="page-register.html">Register</a></li>
                          <li><a href="page-reset-password.html">Forgot password</a></li>
                      </ul>
                  </li>
                  <li><a href="../documentation/index.html"><i class="ti-file"></i> Documentation</a></li>
                  <li><a><i class="ti-close"></i> Logout</a></li>
              </ul>
          </div>
      </div>
</div>