    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar">
      <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
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
          <li class="nav-item">
            <a href="{{ url('mhs') }}" class="nav-link {{ (Request::is('mhs')) ? 'active' : '' }}">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item nav-category">Mahasiswa</li>
          <li class="nav-item">
            <div class="collapse show" id="mhs-master">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{ route('mhs.profile') }}" class="nav-link {{ (Request::is('mhs/profile')) ? 'active' : '' }}">Profile</a>
                </li> 
                <li class="nav-item">
                  <?php 
                  $code = 'm_kkt';
                  $identity = Auth::user()->username;
                  $notif = App\Models\Notifications_model::where('identity', $identity)->where('code', $code)->where('is_read', 0)->count(); ?>
                  <a href="{{ route('mhs.view_upload_kkt_file') }}" class="nav-link {{ (Request::is('mhs/view_upload_kkt_file')) ? 'active' : '' }}">Upload KKT File <?php if ($notif > 0) { ?> <span class="badge badge-danger">{{ $notif }}</span> <?php }else{echo '';} ?></a>                   
                </li> 
              </ul>
            </div>
          </li> 

          <li class="nav-item nav-category">Sempro</li>
          <li class="nav-item">
            <div class="collapse show" id="trx-sempro">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{ route('mhs.transactions.form_pengajuan_topik') }}" class="nav-link {{ (Request::is('mhs/transactions/form_pengajuan_topik')) ? 'active' : '' }}">Form Pengajuan Topik</a>
                </li>  
                <li class="nav-item">
                  <a href="{{ route('mhs.transactions.form_perubahan_topik') }}" class="nav-link  {{ (Request::is('mhs/transactions/form_perubahan_topik')) ? 'active' : '' }}">Form Perubahan Topik</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('mhs.transactions.form_perpanjang_sempro') }}" class="nav-link  {{ (Request::is('mhs/transactions/form_perpanjang_sempro')) ? 'active' : '' }}">Form Perpanjang Sempro</a>
                </li>                
                <li class="nav-item">
                  <a href="{{ route('mhs.transactions.pendaftaran_sempro') }}" class="nav-link  {{ (Request::is('mhs/transactions/pendaftaran_sempro')) ? 'active' : '' }}">Pendaftaran Sempro</a>
                </li>                                           
                <li class="nav-item">
                  <?php 
                  $notif = App\Models\Ta_1_model::where('id_status_ta_1', 7)->where('nim', Auth::user()->username)->count();
                  ?>                   
                  <a href="{{ route('mhs.transactions.jadwal_sempro') }}" class="nav-link {{ (Request::is('mhs/transactions/jadwal_sempro')) ? 'active' : '' }}">Jadwal Sempro <?php if ($notif > 0) { ?> <span class="badge badge-danger">{{ $notif }}</span> <?php }else{ echo '';} ?></a>
                </li> 
                <li class="nav-item">  
                  <a href="{{ route('mhs.transactions.form_pengajuan_sk_sempro') }}" class="nav-link {{ (Request::is('mhs/transactions/form_pengajuan_sk_sempro')) ? 'active' : '' }}">Form Pengajuan SK Sempro</a>
                </li> 
              </ul>
            </div>
          </li>
          <li class="nav-item nav-category">Kompre</li>          
          <li class="nav-item">
            <div class="collapse show" id="trx-kompre">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{ route('mhs.transactions.form_perpanjang_kompre') }}" class="nav-link {{ (Request::is('mhs/transactions/form_perpanjang_kompre')) ? 'active' : '' }}">Form Perpanjang Kompre</a>
                </li>                 
                <li class="nav-item">
                  <a href="{{ route('mhs.transactions.pendaftaran_kompre') }}" class="nav-link  {{ (Request::is('mhs/transactions/pendaftaran_kompre')) ? 'active' : '' }}">Pendaftaran Kompre</a>
                </li>                              
                <li class="nav-item">
                  <?php 
                  $notif = App\Models\Ta_2::where('id_status_ta_2', 7)->where('nim', Auth::user()->username)->count();
                  ?>                   
                  <a href="{{ route('mhs.transactions.jadwal_kompre') }}" class="nav-link {{ (Request::is('mhs/transactions/jadwal_kompre')) ? 'active' : '' }}">Jadwal Kompre <?php if ($notif > 0) { ?> <span class="badge badge-danger">{{ $notif }}</span> <?php }else{ echo '';} ?></a>
                </li> 
                <li class="nav-item">  
                  <a href="{{ route('mhs.transactions.form_pengajuan_sk_kompre') }}" class="nav-link {{ (Request::is('mhs/transactions/form_pengajuan_sk_kompre')) ? 'active' : '' }}">Form Pengajuan SK Kompre</a>
                </li>                                                                                        
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </nav>
