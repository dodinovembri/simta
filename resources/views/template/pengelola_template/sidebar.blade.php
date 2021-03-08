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
            <li class="nav-item {{ (Request::is('pengelola/dashboard')) ? 'active' : '' }}">
              <a href="{{ route('pengelola.dashboard') }}" class="nav-link">
                <i class="link-icon" data-feather="box"></i>
                <span class="link-title">Dashboard</span>
              </a>
            </li>
            <li class="nav-item nav-category">Pengelola</li>
            <li class="nav-item">
              <div class="collapse show" id="mhs-master">
                <ul class="nav sub-menu">
                  <li class="nav-item">
                    <a href="{{ route('pengelola.transactions.mhs') }}" class="nav-link {{ (Request::is('pengelola/transactions/mhs')) ? 'active' : '' }}">Mahasiswa</a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('pengelola.transactions.dosen') }}" class="nav-link {{ (Request::is('pengelola/transactions/dosen')) ? 'active' : '' }}">Dosen</a>
                  </li>
                  <li class="nav-item ">
                    <a href="{{ route('pengelola.transactions.mhs_memenuhi_syarat') }}" class="nav-link {{ (Request::is('pengelola/transactions/mhs_memenuhi_syarat')) ? 'active' : '' }}">Mhs Memenuhi Syarat</a>
                  </li>
                  <li class="nav-item ">
                    <a href="{{ route('pengelola.transactions.mhs_tidak_memenuhi_syarat') }}" class="nav-link {{ (Request::is('pengelola/transactions/mhs_tidak_memenuhi_syarat')) ? 'active' : '' }}">Mhs Tidak Memenuhi Syarat</a>
                  </li>
                  <li class="nav-item ">
                    <a href="{{ route('pengelola.transactions.verifikasi_sukses') }}" class="nav-link {{ (Request::is('pengelola/transactions/verifikasi_sukses')) ? 'active' : '' }}">Verifikasi Sukses</a>
                  </li>
                  <li class="nav-item ">
                    <a href="{{ route('pengelola.transactions.verifikasi_gagal') }}" class="nav-link {{ (Request::is('pengelola/transactions/verifikasi_gagal')) ? 'active' : '' }}">Verifikasi Gagal</a>
                  </li>
<!--                   <li class="nav-item ">
                    <a href="{{ route('pengelola.transactions.set_pembimbing_skripsi') }}" class="nav-link {{ (Request::is('pengelola/transactions/set_pembimbing_skripsi')) ? 'active' : '' }}">Set Pembimbing Skripsi</a>
                  </li> -->

                  <li class="nav-item ">
                  <?php 
                  $notif = App\Models\Ta_1_model::where('id_status_ta_1', 2)->count();
                  ?>                     
                    <a href="{{ route ('pengelola.transactions.penguji_sempro') }}" class="nav-link {{ (Request::is('pengelola/transactions/penguji_sempro')) ? 'active' : '' }}">Set Penguji Sempro <?php if ($notif > 0) { ?> <span class="badge badge-danger">{{ $notif }}</span> <?php }else{ echo '';} ?></a>
                  </li>
                  <li class="nav-item ">
                    <?php 
                    $notif = App\Models\Penguji_ta_1::where('status_agree_penguji', 0)->count();
                    ?>                  
                    <a href="{{ route('pengelola.transactions.konfirmasi_penguji_sempro') }}" class="nav-link {{ (Request::is('pengelola/transactions/konfirmasi_penguji_sempro')) ? 'active' : '' }}">Konfirmasi Penguji Sempro<?php if ($notif > 0) { ?> <span class="badge badge-danger">{{ $notif }}</span> <?php }else{ echo '';} ?></a>
                  </li>
                  <li class="nav-item ">
                    <?php 
                    $notif = App\Models\Penguji_ta_2::where('status_agree_penguji', 0)->count();
                    ?>                   
                    <a href="{{ route('pengelola.transactions.konfirmasi_penguji_kompre') }}" class="nav-link {{ (Request::is('pengelola/transactions/konfirmasi_penguji_kompre')) ? 'active' : '' }}">Konfirmasi Penguji Kompre<?php if ($notif > 0) { ?> <span class="badge badge-danger">{{ $notif }}</span> <?php }else{ echo '';} ?></a>
                  </li>
                  <li class="nav-item ">
                    <a href="{{ route ('pengelola.transactions.konfirmasi_perpanjang_sempro_dosen') }}" class="nav-link {{ (Request::is('pengelola/transactions/konfirmasi_perpanjang_sempro_dosen')) ? 'active' : '' }}">Konf. Perpanjang Sempro</a>
                  </li>
                  <li class="nav-item ">
                    <a href="{{ route ('pengelola.transactions.konfirmasi_perpanjang_kompre_dosen') }}" class="nav-link {{ (Request::is('pengelola/transactions/konfirmasi_perpanjang_kompre_dosen')) ? 'active' : '' }}">Konf. Perpanjang Kompre</a>
                  </li>                                                                
                  <li class="nav-item ">
                    <a href="{{ route('pengelola.transactions.status_sempro') }}" class="nav-link {{ (Request::is('pengelola/transactions/status_sempro')) ? 'active' : '' }}">Status Sempro</a>
                  </li>  
                  <li class="nav-item ">
                    <a href="{{ route('pengelola.transactions.status_kompre') }}" class="nav-link {{ (Request::is('pengelola/transactions/status_kompre')) ? 'active' : '' }}">Status Kompre</a>
                  </li>  
                  <li class="nav-item ">
                      <a href="{{ route('pengelola.transactions.menyetujui_topik_ta') }}" class="nav-link {{ (Request::is('pengelola/transactions/menyetujui_topik_ta')) ? 'active' : '' }}">Mhs Topik TA</a>
                  </li>                               
                </ul>
              </div>
            </li>                                                               
          </ul>
        </div>
      </nav>
      <!-- partial -->