{{-- Hapus/komentari bawaan OneUI dan chart plugin --}}
<script src="assets/js/oneui.app.min.js"></script>
{{-- <script src="assets/js/plugins/chart.js/chart.min.js"></script> --}}
<script src="assets/js/pages/be_pages_dashboard.min.js"></script>

<canvas id="barChartAlumni" style="height: 300px; width: 100%;"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('barChartAlumni').getContext('2d');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Bekerja', 'Belum Bekerja', 'Wirausaha'],
        datasets: [{
          label: 'Jumlah Alumni',
          data: [
            {{ $statistikAlumni['Bekerja']['jumlah'] }},
            {{ $statistikAlumni['Belum Bekerja']['jumlah'] }},
            {{ $statistikAlumni['Wirausaha']['jumlah'] }}
          ],
          backgroundColor: [
            'rgba(25, 135, 84, 0.8)',     // Hijau
            'rgba(220, 53, 69, 0.8)',     // Merah
            'rgba(255, 193, 7, 0.8)'      // Kuning
          ],
          borderRadius: 6,
          barThickness: 40
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false },
          tooltip: {
            callbacks: {
              label: (ctx) => `${ctx.parsed.y} Alumni`
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: { stepSize: 1, precision: 0 },
            title: {
              display: true,
              text: 'Jumlah Alumni'
            }
          },
          x: {
            title: {
              display: true,
              text: 'Kategori'
            }
          }
        }
      }
    });
  });
</script>
