<!-- Dashboard Statistik -->
<div class="container">
  <div class="row justify-content-center mt-4 mb-4">
    {{-- <!-- Statistik Kelulusan Mahasiswa -->
    <div class="col-lg-6 col-md-8 mb-4">
      <div class="block block-rounded mx-auto">
        <div class="block-header block-header-default">
          <h3 class="block-title">Statistik Kelulusan Mahasiswa</h3>
          <div class="block-options">
            <button type="button" class="btn-block-option" onclick="updateChart()">
              <i class="si si-refresh"></i>
            </button>
          </div>
        </div>

        <div class="block-content text-center">
          <canvas id="graduationChart" style="max-height: 360px; max-width: 100%;"></canvas>
        </div>

        <div class="block-content">
          <div id="graduation-info" class="row text-center justify-content-center">
            <!-- Keterangan dinamis via JS -->
          </div>
        </div>
      </div>
    </div>

    <!-- Statistik Status Alumni -->
    <div class="col-lg-6 col-md-8 mb-4">
      <div class="block block-rounded mx-auto">
        <div class="block-header block-header-default">
          <h3 class="block-title">Statistik Status Alumni</h3>
          <div class="block-options">
            <button type="button" class="btn-block-option" onclick="updateAlumniChart()">
              <i class="si si-refresh"></i>
            </button>
          </div>
        </div>

        <div class="block-content text-center">
          <canvas id="alumniChart" style="max-height: 360px; max-width: 100%;"></canvas>
        </div>

        <div class="block-content">
          <div id="alumni-info" class="row text-center justify-content-center">
            <!-- Keterangan dinamis via JS -->
          </div>
        </div>
      </div>
    </div> --}}
  </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Script Chart -->
<script>
  // Data Kelulusan Mahasiswa
  const graduationData = {
    labels: ['Tepat Waktu', 'Terlambat'],
    values: [68, 32],
    colors: ['#28a745', '#ffc107'],
    icons: ['fa-calendar-check', 'fa-user-clock']
  };

  const ctx1 = document.getElementById('graduationChart').getContext('2d');
  const graduationChart = new Chart(ctx1, {
    type: 'pie',
    data: {
      labels: graduationData.labels,
      datasets: [{
        data: graduationData.values,
        backgroundColor: graduationData.colors,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            color: '#555',
            font: { size: 14 }
          }
        },
        tooltip: {
          callbacks: {
            label: function(context) {
              return `${context.label}: ${context.parsed}%`;
            }
          }
        }
      }
    }
  });

  function renderInfo(containerId, data) {
    const container = document.getElementById(containerId);
    container.innerHTML = '';
    data.labels.forEach((label, i) => {
      const col = document.createElement('div');
      col.className = 'col-6 col-sm-6 col-lg-4 py-3';
      col.innerHTML = `
        <i class="fa ${data.icons[i] || 'fa-chart-pie'} fa-2x" style="color: ${data.colors[i]}"></i>
        <div class="fw-bold mt-2">${label}</div>
        <div class="text-muted">${data.values[i]}%</div>
      `;
      container.appendChild(col);
    });
  }

  // Initial render
  renderInfo('graduation-info', graduationData);

  function updateChart() {
    graduationData.labels = ['Lulus Cepat', 'Tepat Waktu', 'Terlambat'];
    graduationData.values = [25, 45, 30];
    graduationData.colors = ['#17a2b8', '#28a745', '#ffc107'];
    graduationData.icons = ['fa-bolt', 'fa-calendar-check', 'fa-user-clock'];

    graduationChart.data.labels = graduationData.labels;
    graduationChart.data.datasets[0].data = graduationData.values;
    graduationChart.data.datasets[0].backgroundColor = graduationData.colors;
    graduationChart.update();

    renderInfo('graduation-info', graduationData);
  }

  // Data Status Alumni
  const alumniData = {
    labels: ['Sudah Bekerja', 'Lanjut Studi', 'Belum Bekerja', 'Wirausaha'],
    values: [40, 25, 20, 15],
    colors: ['#007bff', '#6610f2', '#dc3545', '#fd7e14'],
    icons: ['fa-briefcase', 'fa-graduation-cap', 'fa-user-clock', 'fa-store']
  };

  const ctx2 = document.getElementById('alumniChart').getContext('2d');
  const alumniChart = new Chart(ctx2, {
    type: 'pie',
    data: {
      labels: alumniData.labels,
      datasets: [{
        data: alumniData.values,
        backgroundColor: alumniData.colors,
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            color: '#555',
            font: { size: 14 }
          }
        },
        tooltip: {
          callbacks: {
            label: function(context) {
              return `${context.label}: ${context.parsed}%`;
            }
          }
        }
      }
    }
  });

  renderInfo('alumni-info', alumniData);

  function updateAlumniChart() {
    alumniData.labels = ['Sudah Bekerja', 'Lanjut Studi', 'Belum Bekerja', 'Wirausaha'];
    alumniData.values = [45, 20, 25, 10];
    alumniChart.data.labels = alumniData.labels;
    alumniChart.data.datasets[0].data = alumniData.values;
    alumniChart.update();

    renderInfo('alumni-info', alumniData);
  }
</script>