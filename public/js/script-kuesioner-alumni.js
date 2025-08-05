// Progress tracking dengan animasi yang lebih smooth
function updateProgress() {
    const form = document.getElementById("alumniForm");
    const requiredInputs = form.querySelectorAll(
        "input[required], select[required], textarea[required]"
    );
    const visibleRequiredInputs = Array.from(requiredInputs).filter((input) => {
        const section = input.closest(".section-card");
        return !section || section.style.display !== "none";
    });

    let filledInputs = 0;

    visibleRequiredInputs.forEach((input) => {
        if (input.type === "radio") {
            const radioGroup = form.querySelector(
                `input[name="${input.name}"]:checked`
            );
            if (radioGroup && visibleRequiredInputs.includes(input)) {
                filledInputs++;
            }
        } else if (input.value.trim() !== "") {
            filledInputs++;
        }
    });

    const progress =
        visibleRequiredInputs.length > 0
            ? (filledInputs / visibleRequiredInputs.length) * 100
            : 0;

    // Animasi progress bar
    const progressBar = document.getElementById("progressBar");
    const progressText = document.getElementById("progressText");

    progressBar.style.width = progress + "%";
    progressText.textContent = Math.round(progress) + "%";

    // Ubah warna progress berdasarkan persentase
    if (progress < 33) {
        progressBar.style.background =
            "linear-gradient(90deg, #ef4444, #f97316)";
    } else if (progress < 66) {
        progressBar.style.background =
            "linear-gradient(90deg, #f59e0b, #eab308)";
    } else {
        progressBar.style.background =
            "linear-gradient(90deg, #06b6d4, #10b981)";
    }
}

// Show/hide sections berdasarkan status pekerjaan
document.querySelectorAll('input[name="bekerja"]').forEach((radio) => {
    radio.addEventListener("change", function () {
        const detailPekerjaan = document.getElementById("detailPekerjaan");
        const detailWirausaha = document.getElementById("detailWirausaha");
        const detailLanjutStudy = document.getElementById("detailLanjutStudy");
        const sectionCariKerja = document.getElementById("sectionCariKerja");
        const kompetensiA = document.getElementById("kompetensiA");
        const kompetensiB = document.getElementById("kompetensiB");
        const bagian2 = document.getElementById(
            "waktuAlumniMendapatkanPekerjaan"
        );
        const wiraswasta = document.getElementById("wiraswasta");
        const lokasiPekerjaan = document.getElementById("lokasikerja");
        const kesesuaianKerja = document.getElementById("kesesuaianPekerjaan");
        const aktivitasSaatini = document.getElementById("aktivitasSaatIni");
        const evaluasi = document.getElementById("evaluasiPendidikan");
        const caramendapatkankerjaan = document.getElementById(
            "caraMendapatkanPekerjaan"
        );

        // Sembunyikan semua detail section + cari kerja + kompetensi
        [
            detailPekerjaan,
            detailWirausaha,
            detailLanjutStudy,
            sectionCariKerja,
            kompetensiA,
            kompetensiB,
            bagian2,
            wiraswasta,
            lokasiPekerjaan,
            kesesuaianKerja,
            aktivitasSaatini,
        ].forEach((section) => {
            if (section) section.style.display = "none";
        });

        // Hapus required dan kosongkan nilai
        [
            detailPekerjaan,
            detailWirausaha,
            detailLanjutStudy,
            sectionCariKerja,
        ].forEach((section) => {
            if (section) {
                section.querySelectorAll("input, select").forEach((el) => {
                    el.removeAttribute("required");
                    el.value = "";
                });
            }
        });

        if (this.value === "bekerja_full") {
            bagian2.style.display = "block";
            lokasiPekerjaan.style.display = "block";
            kesesuaianKerja.style.display = "block";
            bagian2.querySelectorAll("input, select").forEach((el) => {
                el.setAttribute("required", "required");
            });
            kompetensiA.style.display = "block";
            kompetensiB.style.display = "block";
            evaluasi.style.display = "block";
            caramendapatkankerjaan.style.display = "block";
            aktivitasSaatini.style.display = "block";
            sectionCariKerja.style.display = "block";
        } else if (this.value === "wirausaha") {
            // detailWirausaha.style.display = "block";
            bagian2.style.display = "block";
            wiraswasta.style.display = "block";
            kesesuaianKerja.style.display = "block";
            lokasiPekerjaan.style.display = "block";
            // detailWirausaha.querySelectorAll("input, select").forEach((el) => {
            //     if (["nama_usaha", "posisi_usaha"].includes(el.name)) {
            //         el.setAttribute("required", "required");
            //     }
            // });
            bagian2.querySelectorAll("input, select").forEach((el) => {
                el.setAttribute("required", "required");
            });

            wiraswasta.querySelectorAll("select, textarea").forEach((el) => {
                if (
                    [
                        "posisi_usaha",
                        "tingkat_usaha_level",
                        "alamat_usaha",
                    ].includes(el.name)
                ) {
                    el.setAttribute("required", "required");
                }
            });
            kompetensiA.style.display = "block";
            kompetensiB.style.display = "block";
            evaluasi.style.display = "block";
            caramendapatkankerjaan.style.display = "block";
            aktivitasSaatini.style.display = "block";
            sectionCariKerja.style.display = "block";
        } else if (this.value === "lanjutstudy") {
            detailLanjutStudy.style.display = "block";
            detailLanjutStudy
                .querySelectorAll("input, select")
                .forEach((el) => {
                    if (el.name === "universitas") {
                        el.setAttribute("required", "required");
                    }
                });
        } else if (this.value === "tidak") {
            aktivitasSaatini.style.display = "block";
            sectionCariKerja.style.display = "block";
            sectionCariKerja.querySelectorAll("input, select").forEach((el) => {
                el.setAttribute("required", "required");
            });
            aktivitasSaatini.querySelectorAll("input, select").forEach((el) => {
                el.setAttribute("required", "required");
            });
            // Kompetensi tetap disembunyikan (tidak diapa-apakan di sini)
        } else if (this.value === "belum_bekerja") {
            aktivitasSaatini.style.display = "block";
            aktivitasSaatini.querySelectorAll("input, select").forEach((el) => {
                el.setAttribute("required", "required");
            });
        }
        updateProgress();
    });
});

// Logika lanjutan bulan sebelum/sesudah lulus
document
    .getElementById("waktuCariKerja")
    .addEventListener("change", function () {
        const sebelumGroup = document.getElementById("sebelumLulusGroup");
        const setelahGroup = document.getElementById("setelahLulusGroup");

        // Reset tampilan
        sebelumGroup.style.display = "none";
        setelahGroup.style.display = "none";

        // Reset nilai dan required
        sebelumGroup.querySelector("input").value = "";
        setelahGroup.querySelector("input").value = "";
        sebelumGroup.querySelector("input").removeAttribute("required");
        setelahGroup.querySelector("input").removeAttribute("required");

        if (this.value === "sebelum_lulus") {
            sebelumGroup.style.display = "block";
            sebelumGroup
                .querySelector("input")
                .setAttribute("required", "required");
        } else if (this.value === "setelah_lulus") {
            setelahGroup.style.display = "block";
            setelahGroup
                .querySelector("input")
                .setAttribute("required", "required");
        }

        updateProgress(); // Optional jika pakai progress
    });

// Update progress saat input berubah
document.addEventListener("input", updateProgress);
document.addEventListener("change", updateProgress);

// Floating back to top button
window.addEventListener("scroll", function () {
    const backToTop = document.getElementById("backToTop");
    if (window.pageYOffset > 300) {
        backToTop.style.display = "block";
    } else {
        backToTop.style.display = "none";
    }
});

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: "smooth",
    });
}

// Form submission dengan loading state
document.getElementById("alumniForm").addEventListener("submit", function (e) {
    const submitBtn = document.querySelector(".btn-submit");
    const originalText = submitBtn.innerHTML;

    submitBtn.innerHTML =
        '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...';
    submitBtn.disabled = true;

    // Jika ada error, kembalikan button ke state semula
    setTimeout(() => {
        if (submitBtn.disabled) {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    }, 10000);
});

// Animasi fade in untuk section cards
const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
};

const observer = new IntersectionObserver(function (entries) {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = "1";
            entry.target.style.transform = "translateY(0)";
        }
    });
}, observerOptions);

// Observe semua section cards
document.querySelectorAll(".section-card").forEach((card) => {
    card.style.opacity = "0";
    card.style.transform = "translateY(30px)";
    card.style.transition = "opacity 0.6s ease, transform 0.6s ease";
    observer.observe(card);
});

// Initialize progress
updateProgress();

// Konfirmasi sebelum meninggalkan halaman jika form sudah diisi
let formChanged = false;
document.addEventListener("input", () => (formChanged = true));
document.addEventListener("change", () => (formChanged = true));

window.addEventListener("beforeunload", function (e) {
    if (formChanged) {
        e.preventDefault();
        e.returnValue = "";
    }
});

// Remove konfirmasi saat form di-submit
document.getElementById("alumniForm").addEventListener("submit", function () {
    formChanged = false;
});

// Auto-save ke localStorage setiap 30 detik (opsional)
setInterval(function () {
    if (formChanged) {
        const formData = new FormData(document.getElementById("alumniForm"));
        const data = {};
        for (let [key, value] of formData.entries()) {
            data[key] = value;
        }
        // Note: localStorage tidak tersedia di Claude artifacts
        // localStorage.setItem('tracer_study_draft', JSON.stringify(data));
    }
}, 30000);

// Section: Input Tambahan 'Lainnya'
// ================================= //
const sumberBiayaSelect = document.getElementById("sumberBiayaSelect");
const sumberBiayaLainnya = document.getElementById("sumberBiayaLainnya");

if (sumberBiayaSelect && sumberBiayaLainnya) {
    sumberBiayaSelect.addEventListener("change", function () {
        if (this.value === "lainnya") {
            sumberBiayaLainnya.style.display = "block";
            sumberBiayaLainnya
                .querySelector("input")
                .setAttribute("required", "required");
        } else {
            sumberBiayaLainnya.style.display = "none";
            const input = sumberBiayaLainnya.querySelector("input");
            input.removeAttribute("required");
            input.value = "";
        }
    });
}

// logic untuk mengambil data kota berdasarkan provinsi'
// ================================= //
document.getElementById("provinsi").addEventListener("change", function () {
    const provinceCode = this.value;
    const kotaSelect = document.getElementById("kota");
    kotaSelect.innerHTML =
        '<option value="" disabled selected>Memuat data...</option>';

    fetch(`/api/kota/${provinceCode}`)
        .then((response) => response.json())
        .then((data) => {
            kotaSelect.innerHTML =
                '<option value="" disabled selected>-- Pilih Kabupaten/Kota --</option>';
            for (const [code, name] of Object.entries(data)) {
                const option = document.createElement("option");
                option.value = code;
                option.textContent = name;
                kotaSelect.appendChild(option);
            }
        })
        .catch((error) => {
            kotaSelect.innerHTML =
                '<option value="">Gagal memuat data</option>';
            console.error("Gagal fetch kota:", error);
        });
});
