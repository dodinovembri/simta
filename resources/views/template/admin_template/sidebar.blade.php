    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar">
      <div class="sidebar-header">
        <a href="{{ url('/') }}" class="sidebar-brand">
          SIMTA <span>SI</span>
        </a>
        <div class="sidebar-toggler not-active">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
      <div class="sidebar-body">
        <ul class="nav">
          <li class="nav-item nav-category">Main</li>
          <li class="nav-item  {{ (Request::is('admin')) ? 'active' : '' }}">
            <a href="{{ url('/admin') }}" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item nav-category">Data</li>
          <li class="nav-item {{ (Request::is('admin/master/mhs')) ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#mhs-master" role="button" aria-expanded="{{ (Request::is('admin/master/*')) ? 'true' : 'false' }}" aria-controls="mhs-master">
              <i class="link-icon" data-feather="database"></i>
              <span class="link-title">Master</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse {{ (Request::is('admin/master/*')) ? 'show' : '' }}" id="mhs-master">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{ route('admin.master.mhs') }}" class="nav-link {{ (Request::is('admin/master/mhs')) ? 'active' : '' }}">Mahasiswa</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.master.dosen') }}" class="nav-link {{ (Request::is('admin/master/dosen')) ? 'active' : '' }}">Dosen</a>
                </li>                
                <li class="nav-item">
                  <a href="{{ route('admin.master.syarat_ta_1') }}" class="nav-link {{ (Request::is('admin/master/syarat_ta_1')) ? 'active' : '' }}">Syarat Sempro</a>
                </li> 
                <li class="nav-item">
                  <a href="{{ route('admin.master.syarat_ta_2') }}" class="nav-link {{ (Request::is('admin/master/syarat_ta_2')) ? 'active' : '' }}">Syarat Kompre</a>
                </li>                                 
              </ul>
            </div>
          </li> 
          <li class="nav-item nav-category">Mahasiswa</li>
          <li class="nav-item {{ (Request::is('admin/transactions/*')) ? 'active' : '' }}">            
            <div class="collapse show" id="trx-mhs">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{ route('admin.transactions.mhs_aktif') }}" class="nav-link {{ (Request::is('admin/transactions/mhs_aktif')) ? 'active' : '' }}">Mhs Aktif</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.transactions.mhs_memenuhi_syarat') }}" class="nav-link {{ (Request::is('admin/transactions/mhs_memenuhi_syarat')) ? 'active' : '' }}">Mhs Memenuhi Syarat</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.transactions.mhs_tidak_memenuhi_syarat') }}" class="nav-link {{ (Request::is('admin/transactions/mhs_tidak_memenuhi_syarat')) ? 'active' : '' }}">Mhs Tidak Memenuhi Syarat</a>
                </li>
                <li class="nav-item">
                  <?php 
                  $code = 'admin_kkt';
                  $identity = 'admin';
                  $notif = App\Models\Mhs_model::where('status_kkt_file', 1)->count(); ?>
                  <a href="{{ route('admin.transactions.verifikasi_data_mhs') }}" class="nav-link {{ (Request::is('admin/transactions/verifikasi_data_mhs')) ? 'active' : '' }}">Verifikasi Data Mhs <?php if ($notif > 0) { ?> <span class="badge badge-danger">{{ $notif }}</span> <?php }else{echo '';} ?></a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.transactions.verifikasi_sukses') }}" class="nav-link {{ (Request::is('admin/transactions/verifikasi_sukses')) ? 'active' : '' }}">Verifikasi Sukses</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.transactions.verifikasi_gagal') }}" class="nav-link {{ (Request::is('admin/transactions/verifikasi_gagal')) ? 'active' : '' }}">Verifikasi Gagal</a>
                </li>                               
              </ul>
            </div>
          </li>                   
          <li class="nav-item nav-category">Sempro</li>
          <li class="nav-item">
            <div class="collapse show" id="trx-sempro">
              <ul class="nav sub-menu">   
                <li class="nav-item">
                  <?php 
                  $notif = App\Models\Ta_1_model::where('id_status_ta_1', 1)->count();
                  ?>                   
                  <a href="{{ route ('admin.transactions.verifikasi_seminar') }}" class="nav-link {{ (Request::is('admin/transactions/verifikasi_seminar')) ? 'active' : '' }}">Verifikasi Syarat Seminar <?php if ($notif > 0) { ?> <span class="badge badge-danger">{{ $notif }}</span> <?php }else{ echo '';} ?></a>
                </li>                                          
                <li class="nav-item">
                  <?php 
                  $notif = App\Models\Ta_1_model::where('id_status_ta_1', 4)->count();
                  ?>                    
                  <a href="{{ route('admin.transactions.jadwal_sempro') }}" class="nav-link {{ (Request::is('admin/transactions/jadwal_sempro')) ? 'active' : '' }}">Jadwal Sempro <?php if ($notif > 0) { ?> <span class="badge badge-danger">{{ $notif }}</span> <?php }else{ echo '';} ?></a>
                </li>                  
                <li class="nav-item">
                  <?php 
                  $notif = App\Models\Ta_1_model::where('id_status_ta_1', 7)->count();
                  ?>                   
                  <a href="{{ route('admin.transactions.status_sempro') }}" class="nav-link {{ (Request::is('admin/transactions/status_sempro')) ? 'active' : '' }}">Status Sempro <?php if ($notif > 0) { ?> <span class="badge badge-danger">{{ $notif }}</span> <?php }else{ echo '';} ?></a>
                </li>                                               

              </ul>
            </div>
          </li>
          <li class="nav-item nav-category">Kompre</li>          
          <li class="nav-item">
            <div class="collapse show" id="trx-kompre">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <?php 
                  $notif = App\Models\Ta_2::where('id_status_ta_2', 1)->count();
                  ?>                  
                  <a href="{{ route('admin.transactions.verifikasi_kompre') }}" class="nav-link {{ (Request::is('admin/transactions/verifikasi_kompre')) ? 'active' : '' }}">Verifikasi Syarat Kompre <?php if ($notif > 0) { ?> <span class="badge badge-danger">{{ $notif }}</span> <?php }else{ echo '';} ?></a>
                </li>                 
                <li class="nav-item">
                  <?php 
                  $notif = App\Models\Ta_2::where('id_status_ta_2', 4)->count();
                  ?>                  
                  <a href="{{ route('admin.transactions.jadwal_kompre') }}" class="nav-link {{ (Request::is('admin/transactions/jadwal_kompre')) ? 'active' : '' }}">Jadwal Kompre <?php if ($notif > 0) { ?> <span class="badge badge-danger">{{ $notif }}</span> <?php }else{ echo '';} ?></a>
                </li>                  
                <li class="nav-item">
                  <?php 
                  $notif = App\Models\Ta_2::where('id_status_ta_2', 7)->count();
                  ?>                    
                  <a href="{{ route('admin.transactions.status_kompre') }}" class="nav-link {{ (Request::is('admin/transactions/status_kompre')) ? 'active' : '' }}">Status Kompre <?php if ($notif > 0) { ?> <span class="badge badge-danger">{{ $notif }}</span> <?php }else{ echo '';} ?></a>
                </li>                                                                       
              </ul>
            </div>
          </li>        
          <li class="nav-item nav-category">System</li>                    
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#system-configuration" role="button" aria-expanded="{{ (Request::is('admin/system/*')) ? 'true' : 'false' }}" aria-controls="system-configuration">
              <i class="link-icon" data-feather="settings"></i>
              <span class="link-title">System Configuration</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse {{ (Request::is('admin/system/*')) ? 'show' : '' }}" id="system-configuration">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{ route('admin.system.user_account_list') }}" class="nav-link {{ (Request::is('admin/system/user_account_list')) ? 'active' : '' }}">User Account List</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.system.bidang_ilmu') }}" class="nav-link {{ (Request::is('admin/system/bidang_ilmu')) ? 'active' : '' }}">Bidang Ilmu</a>
                </li>                
                <li class="nav-item">
                  <a href="{{ route('admin.system.angkatan') }}" class="nav-link {{ (Request::is('admin/system/angkatan')) ? 'active' : '' }}">Angkatan</a>
                </li>                
                <li class="nav-item">
                  <a href="{{ route('admin.system.jurusan') }}" class="nav-link {{ (Request::is('admin/system/jurusan')) ? 'active' : '' }}">Jurusan</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.system.topik_ta') }}" class="nav-link {{ (Request::is('admin/system/topik_ta')) ? 'active' : '' }}">Topik TA</a>
                </li>                                
              </ul>
            </div>
          </li>           
        </ul>
      </div>
    </nav>
<!--     <nav class="settings-sidebar">
      <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
          <i data-feather="settings"></i>
        </a>      
      </div>
    </nav> -->
    <!-- partial -->