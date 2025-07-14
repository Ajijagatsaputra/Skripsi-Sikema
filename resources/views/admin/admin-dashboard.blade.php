@php
    $userRole = Auth::user()->role;
@endphp

<!doctype html>
<html lang="id">
  @include('components.admin.head')

  <body class="d-flex flex-column min-vh-100">
    <div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow d-flex flex-column flex-grow-1">

      {{-- Header, Sidebar, Side Overlay --}}
      @include('components.admin.admin-header')
      @include('components.admin.sidebar')
      @include('components.admin.side-overlay')

      {{-- Main Content --}}
      <main id="main-container" class="flex-grow-1">
        {{-- Hero Section --}}
        <div class="content">
          <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-3 text-center text-md-start">
            <div class="flex-grow-1 mb-2 mb-md-0">
              <h1 class="h3 fw-bold mb-1">Dashboard</h1>
              <h2 class="h6 fw-medium text-muted mb-0">
                Selamat datang kembali, <a class="fw-semibold" href="#">{{ Auth::user()->username }}</a>
              </h2>
            </div>
          </div>
        </div>

        <div class="content">
          {{-- Overview Boxes --}}
          <div class="row items-push">

            {{-- Mahasiswa --}}
            <div class="col-sm-6 col-xxl-3">
              <div class="block block-rounded d-flex flex-column h-100">
                <div class="block-content block-content-full d-flex justify-content-between align-items-center">
                  <dl class="mb-0">
                    <dt class="fs-3 fw-bold">{{ $countMahasiswa }}</dt>
                    <dd class="fs-sm fw-medium text-muted mb-0">Mahasiswa</dd>
                  </dl>
                  <div class="item item-rounded-lg bg-body-light">
                    <i class="fas fa-chalkboard-teacher fs-3 text-primary"></i>
                  </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                  <a href="/listmahasiswa" class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between">
                    <span>Lihat semua mahasiswa</span>
                    <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                  </a>
                </div>
              </div>
            </div>

            {{-- Dosen --}}
            <div class="col-sm-6 col-xxl-3">
              <div class="block block-rounded d-flex flex-column h-100">
                <div class="block-content block-content-full d-flex justify-content-between align-items-start">
                  <div>
                    <dl class="mb-0">
                      <dt class="fs-3 fw-bold">{{ $countDosen }}</dt>
                      <dd class="fs-sm fw-medium text-muted mb-0">Dosen</dd>
                    </dl>
                  </div>
                  <div class="item item-rounded-lg bg-body-light">
                    <i class="far fa-user-circle fs-3 text-primary"></i>
                  </div>
                </div>
                <div class="px-3 pb-3">
                  <form method="GET" action="{{ route('home') }}">
                    <label for="tahun_akademik" class="form-label fs-sm mb-1">Tahun Akademik:</label>
                    <select name="tahun_akademik" id="tahun_akademik" class="form-select form-select-sm" onchange="this.form.submit()">
                      @foreach ($tahunAkademikList as $ta)
                        <option value="{{ $ta['kode'] }}" {{ $selectedTA == $ta['kode'] ? 'selected' : '' }}>
                          {{ $ta['tahun_akademik'] }}{{ $ta['status'] == 1 ? ' (aktif)' : '' }}
                        </option>
                      @endforeach
                    </select>
                  </form>
                </div>
                <div class="bg-body-light rounded-bottom">
                  <a href="/listdosen" class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between">
                    <span>Lihat semua dosen</span>
                    <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                  </a>
                </div>
              </div>
            </div>

            {{-- Alumni --}}
            <div class="col-sm-6 col-xxl-3">
              <div class="block block-rounded d-flex flex-column h-100">
                <div class="block-content block-content-full d-flex justify-content-between align-items-center">
                  <dl class="mb-0">
                    <dt class="fs-3 fw-bold">{{ $countAlumni }}</dt>
                    <dd class="fs-sm fw-medium text-muted mb-0">Alumni</dd>
                  </dl>
                  <div class="item item-rounded-lg bg-body-light">
                    <i class="fas fa-user-graduate fs-3 text-primary"></i>
                  </div>
                </div>
                <div class="bg-body-light rounded-bottom">
                  <a href="/listalumni" class="block-content block-content-full block-content-sm fs-sm fw-medium d-flex align-items-center justify-content-between">
                    <span>Lihat semua alumni</span>
                    <i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                  </a>
                </div>
              </div>
            </div>

          </div>
          {{-- End Overview --}}

          {{-- Statistik Alumni --}}
          <div class="row">
            <div class="col-xl-8 col-xxl-9 d-flex flex-column">
              <div class="block block-rounded flex-grow-1 d-flex flex-column">

                {{-- Header --}}
                <div class="block-header block-header-default">
                  <h3 class="block-title">Statistik Alumni</h3>
                </div>

                {{-- Bar Chart --}}
                <div class="block-content block-content-full">
                  <canvas id="barChartAlumni" style="height: 250px; width: 100%;"></canvas>
                </div>

                {{-- Textual Statistik --}}
                <div class="block-content bg-body-light">
                  <div class="row items-push text-center w-100">
                    @foreach ([
                      ['label' => 'Bekerja', 'data' => $statistikAlumni['Bekerja'], 'icon' => 'fa-briefcase', 'color' => 'success'],
                      ['label' => 'Belum Bekerja', 'data' => $statistikAlumni['Belum Bekerja'], 'icon' => 'fa-user-times', 'color' => 'danger'],
                      ['label' => 'Wirausaha', 'data' => $statistikAlumni['Wirausaha'], 'icon' => 'fa-store', 'color' => 'warning'],
                    ] as $stat)
                      <div class="col-sm-4">
                        <dl class="mb-0">
                          <dt class="fs-4 fw-bold text-{{ $stat['color'] }}">
                            <i class="fa {{ $stat['icon'] }} me-1"></i>
                            {{ $stat['data']['jumlah'] }} Alumni
                          </dt>
                          <dd class="fs-sm fw-medium text-muted mb-0">{{ $stat['label'] }}</dd>
                          <dd class="fs-xs text-muted">{{ $stat['data']['persen'] }} dari total</dd>
                        </dl>
                      </div>
                    @endforeach
                  </div>
                </div>

              </div>
            </div>
          </div>
          {{-- End Statistik Alumni --}}
        </div>
      </main>

      {{-- Sticky Footer --}}
      @include('components.admin.footer')

    </div>

    @include('components.admin.script')
  </body>
</html>
