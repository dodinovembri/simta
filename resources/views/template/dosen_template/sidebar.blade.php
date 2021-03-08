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
          <li class="nav-item nav-category">Main</li>
          <li class="nav-item {{ (Request::is('dosen/dashboard')) ? 'active' : '' }}">
            <a href="{{ route('dosen.dashboard') }}" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item nav-category">DATA</li>
          <li class="nav-item">
            <div class="collapse show" id="mhs-master">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{ route('dosen.transactions.mhs_akademik') }}" class="nav-link {{ (Request::is('dosen/transactions/mhs_akademik')) ? 'active' : '' }}">Mhs Bimbingan Akademik</a>
                </li>  
                <li class="nav-item">
                  <a href="{{ route('dosen.transactions.mhs_skripsi') }}" class="nav-link {{ (Request::is('dosen/transactions/mhs_skripsi')) ? 'active' : '' }}">Mhs Bimbingan Skripsi</a>

                <li class="nav-item">
                  <?php 
                  $notif = App\Models\MhsPerpanjangSempro::select('mhs_perpanjang_sempro.*')->join('mhs', 'mhs_perpanjang_sempro.nim', '=', 'mhs.nim')->join('dosen', 'mhs.nip_pa','=','dosen.nip')->where('mhs_perpanjang_sempro.id_status_agree_perpanjang', '=', 1)->count();
                  ?>                  
                  <a href="{{ route('dosen.transactions.konfimasi_perpanjang_ta_1') }}" class="nav-link {{ (Request::is('dosen/transactions/konfimasi_perpanjang_ta_1')) ? 'active' : '' }}">Konf. Perpanjang Sempro <?php if ($notif > 0) { ?> <span class="badge badge-danger">{{ $notif }}</span> <?php }else{ echo '';} ?></a>
                </li> 

                <li class="nav-item">
                  <?php 
                  $notif = App\Models\MhsPerpanjangTa_2::select('mhs_perpanjang_ta_2.*')->join('mhs', 'mhs_perpanjang_ta_2.nim', '=', 'mhs.nim')->join('dosen', 'mhs.nip_pa','=','dosen.nip')->where('mhs_perpanjang_ta_2.id_status_agree_perpanjang', '=', 1)->count();
                  ?>                  
                  <a href="{{ route('dosen.transactions.konfimasi_perpanjang_ta_2') }}" class="nav-link {{ (Request::is('dosen/transactions/konfimasi_perpanjang_ta_2')) ? 'active' : '' }}">Konf. Perpanjang Kompre <?php if ($notif > 0) { ?> <span class="badge badge-danger">{{ $notif }}</span> <?php }else{ echo '';} ?></a>
                </li>      

                <li class="nav-item ">
                  <a href="{{ route ('dosen.transactions.konfirmasi_perpanjang_sempro_dosen') }}" class="nav-link {{ (Request::is('dosen/transactions/konfirmasi_perpanjang_sempro_dosen')) ? 'active' : '' }}">Status Perpanjang Sempro</a>
                </li>
                <li class="nav-item ">
                  <a href="{{ route ('dosen.transactions.konfirmasi_perpanjang_kompre_dosen') }}" class="nav-link {{ (Request::is('dosen/transactions/konfirmasi_perpanjang_kompre_dosen')) ? 'active' : '' }}">Status Perpanjang Kompre</a>
                </li>                            
                
                <li class="nav-item">
                  <a href="{{ route('dosen.transactions.konfimasi_pembimbing_ta') }}" class="nav-link {{ (Request::is('dosen/transactions/konfimasi_pembimbing_ta')) ? 'active' : '' }}">Konfirmasi Pembimbing TA</a>
                </li> 

                <li class="nav-item">
                  <?php 
                  $notif = App\Models\Penguji_ta_1::select('penguji_ta_1.*')->join('dosen', 'penguji_ta_1.nip','=','dosen.nip')->where('penguji_ta_1.status_agree_penguji', '=', 0)->where('penguji_ta_1.nip', Auth::user()->username)->count();
                  ?>                  
                  <a href="{{ route('dosen.transactions.konfirmasi_jadwal_sempro') }}" class="nav-link {{ (Request::is('dosen/transactions/konfirmasi_jadwal_sempro')) ? 'active' : '' }}">Konfirmasi Jadwal Sempro <?php if ($notif > 0) { ?> <span class="badge badge-danger">{{ $notif }}</span> <?php }else{ echo '';} ?></a>
                </li>                  

                <li class="nav-item">
                  <?php 
                  $notif = App\Models\Penguji_ta_2::select('penguji_ta_2.*')->join('dosen', 'penguji_ta_2.nip','=','dosen.nip')->where('penguji_ta_2.status_agree_penguji', '=', 0)->where('penguji_ta_2.nip', Auth::user()->username)->count();
                  ?>                   
                  <a href="{{ route('dosen.transactions.konfimasi_jadwal_kompre') }}" class="nav-link {{ (Request::is('dosen/transactions/konfimasi_jadwal_kompre')) ? 'active' : '' }}">Konfirmasi Jadwal Kompre<?php if ($notif > 0) { ?> <span class="badge badge-danger">{{ $notif }}</span> <?php }else{ echo '';} ?></a>
                </li>                 

                <li class="nav-item">
                  <?php 
                  $nip = Auth::user()->username;
                  $notif = App\Models\Mhs_topik_ta::select('mhs_topik_ta.*')->join('mhs', 'mhs_topik_ta.nim', '=', 'mhs.nim')->join('dosen', 'mhs.nip_pa','=','dosen.nip')->where('mhs_topik_ta.id_status_agree_topik', '=', 1)->where('dosen.nip', '=', $nip)->count();
                    ?>
                  <a href="{{ route('dosen.transactions.topik_ta_mhs') }}" class="nav-link {{ (Request::is('dosen/topik_ta_mhs')) ? 'active' : '' }}">Konfirmasi Topik Mhs <?php if ($notif > 0) { ?> <span class="badge badge-danger">{{ $notif }}</span> <?php }else{echo '';} ?></a>
                </li>

                <li class="nav-item">
                  <?php 
                  $notif = App\Models\Ta_1_model::where('id_status_ta_1', 7)->count();
                  ?>                    
                  <a href="{{ route('dosen.transactions.jadwal_menguji') }}" class="nav-link {{ (Request::is('dosen/transactions/jadwal_menguji')) ? 'active' : '' }}">Jadwal Menguji Sempro <?php if ($notif > 0) { ?> <span class="badge badge-danger">{{ $notif }}</span> <?php }else{echo '';} ?></a>
                </li>  

                <li class="nav-item">
                  <a href="{{ route('dosen.transactions.jadwal_menguji_ta_2') }}" class="nav-link {{ (Request::is('dosen/transactions/jadwal_menguji_ta_2')) ? 'active' : '' }}">Jadwal Menguji Skripsi</a>
                </li>  
              </ul>
            </div>
          </li>                             
        </ul>
      </div>
    </nav>