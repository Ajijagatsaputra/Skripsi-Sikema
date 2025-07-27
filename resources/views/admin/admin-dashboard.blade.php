@php
    $userRole = Auth::user()->role;
@endphp

<!doctype html>
<html lang="id">
  @include('components.admin.head')

  <body class="d-flex flex-column min-vh-100 bg-light text-dark">

    {{-- Page Container --}}
    <div id="page-container" class="d-flex flex-column flex-grow-1 sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">

      {{-- Sidebar + Header --}}
      @include('components.admin.admin-header')
      @include('components.admin.sidebar')
      @include('components.admin.side-overlay')

      {{-- Main Content --}}
      <main id="main-container" class="flex-grow-1">
        <div class="content py-4">

          {{-- Header Section --}}
          <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
            <div>
              <h1 class="h3 fw-bold mb-1">Dashboard</h1>
              <p class="text-muted mb-0">
                Selamat datang kembali, <span class="fw-semibold text-primary">{{ Auth::user()->username }}</span>
              </p>
            </div>
          </div>

          {{-- Info Boxes --}}
          <div class="row g-4 mb-4">

            {{-- Mahasiswa --}}
            <div class="col-md-6 col-xl-3">
              <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div>
                    <h4 class="fw-bold mb-1">{{ $countMahasiswa }}</h4>
                    <p class="text-muted mb-0">Mahasiswa</p>
                  </div>
                  <i class="fas fa-chalkboard-teacher fa-2x text-primary"></i>
                </div>
                <div class="card-footer bg-light py-2">
                  <a href="/listmahasiswa" class="text-decoration-none text-primary fw-medium d-flex align-items-center justify-content-between">
                    <span>Lihat semua mahasiswa</span>
                    <i class="fa fa-arrow-alt-circle-right ms-2"></i>
                  </a>
                </div>
              </div>
            </div>

            {{-- Dosen --}}
            <div class="col-md-6 col-xl-3">
              <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div>
                    <h4 class="fw-bold mb-1">{{ $countDosen }}</h4>
                    <p class="text-muted mb-0">Dosen</p>
                  </div>
                  <i class="far fa-user-circle fa-2x text-primary"></i>
                </div>
                <div class="px-3 pb-3">
                  <form method="GET" action="{{ route('home') }}">
                    <label for="tahun_akademik" class="form-label fs-sm mb-1">Tahun Akademik</label>
                    <select name="tahun_akademik" id="tahun_akademik" class="form-select form-select-sm" onchange="this.form.submit()">
                      @foreach ($tahunAkademikList as $ta)
                        <option value="{{ $ta['kode'] }}" {{ $selectedTA == $ta['kode'] ? 'selected' : '' }}>
                          {{ $ta['tahun_akademik'] }}{{ $ta['status'] == 1 ? ' (aktif)' : '' }}
                        </option>
                      @endforeach
                    </select>
                  </form>
                </div>
                <div class="card-footer bg-light py-2">
                  <a href="/listdosen" class="text-decoration-none text-primary fw-medium d-flex align-items-center justify-content-between">
                    <span>Lihat semua dosen</span>
                    <i class="fa fa-arrow-alt-circle-right ms-2"></i>
                  </a>
                </div>
              </div>
            </div>

            {{-- Alumni --}}
            <div class="col-md-6 col-xl-3">
              <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                  <div>
                    <h4 class="fw-bold mb-1">{{ $countAlumni }}</h4>
                    <p class="text-muted mb-0">Alumni</p>
                  </div>
                  <i class="fas fa-user-graduate fa-2x text-primary"></i>
                </div>
                <div class="card-footer bg-light py-2">
                  <a href="/listalumni" class="text-decoration-none text-primary fw-medium d-flex align-items-center justify-content-between">
                    <span>Lihat semua alumni</span>
                    <i class="fa fa-arrow-alt-circle-right ms-2"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>

          {{-- Statistik Alumni --}}
          <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Statistik Alumni</h5>
            </div>
            <div class="card-body">
              <canvas id="barChartAlumni" style="height: 250px;"></canvas>
            </div>
            <div class="card-footer bg-light">
              <div class="row text-center">
                @foreach ([
                  ['label' => 'Bekerja', 'data' => $statistikAlumni['Bekerja'], 'icon' => 'fa-briefcase', 'color' => 'success'],
                  ['label' => 'Belum Bekerja', 'data' => $statistikAlumni['Belum Bekerja'], 'icon' => 'fa-user-times', 'color' => 'danger'],
                  ['label' => 'Wirausaha', 'data' => $statistikAlumni['Wirausaha'], 'icon' => 'fa-store', 'color' => 'warning'],
                ] as $stat)
                  <div class="col-md-4 mb-2">
                    <div class="fw-bold text-{{ $stat['color'] }}">
                      <i class="fa {{ $stat['icon'] }} me-1"></i>
                      {{ $stat['data']['jumlah'] }} Alumni
                    </div>
                    <div class="text-muted small">{{ $stat['label'] }} - {{ $stat['data']['persen'] }} dari total</div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </main>

      {{-- Sticky Footer --}}
      @include('components.admin.footer')
    </div>

    {{-- Script --}}
    @include('components.admin.script')

    {{-- Extra Style to Ensure Footer Sticky --}}
    <style>
      html, body {
        height: 100%;
      }
      #page-container {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
      }
      #main-container {
        flex-grow: 1;
      }
    </style>

  </body>
</html>
