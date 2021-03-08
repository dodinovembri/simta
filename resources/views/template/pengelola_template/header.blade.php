      <!-- partial:partials/_navbar.html -->
      <nav class="navbar">
        <a href="#" class="sidebar-toggler">
          <i data-feather="menu"></i>
        </a>
        <div class="navbar-content">
          <form class="search-form">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i data-feather="search"></i>
                </div>
              </div>
              <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
            </div>
          </form>
          <ul class="navbar-nav">
            <li class="nav-item dropdown nav-profile">
              <?php                   
              $pengelola = Auth::user()->username;
              $pengelola = App\User::where('username', $pengelola)->first(); ?>              
              <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left: -15pt">
                <b>Pengelola</b>
              </a>
              <div class="dropdown-menu" aria-labelledby="profileDropdown">
                <div class="dropdown-header d-flex flex-column align-items-center">
                  <div class="figure mb-3">
                  </div>
                  <div class="info text-center">
                    <p class="name font-weight-bold mb-0">{{$pengelola->username}}</p>
                    <p class="email text-muted mb-3">{{$pengelola->name}}</p>
                  </div>
                </div>
                <div class="dropdown-body">
                  <ul class="profile-nav p-0 pt-3">
                    <li class="nav-item">
                      <a href="{{ route('pengelola.profile') }}" class="nav-link">
                        <i data-feather="user"></i>
                        <span>Profile</span>
                      </a>
                    </li>  
                    <li class="nav-item">
                      <a href="{{ route('pengelola.edit_pass') }}" class="nav-link">
                        <i data-feather="edit"></i>
                        <span>Change Password</span>
                      </a>
                    </li>                                    
                    <li class="nav-item">
                      <a href="{{ url('auth/logout') }}" class="nav-link">
                        <i data-feather="log-out"></i>
                        <span>Log Out</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </nav>
      <!-- partial -->