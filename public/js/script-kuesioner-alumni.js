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

// Ambil semua elemen section terkait status kerja
const sectionsMap = {
    detailPekerjaan: document.getElementById("detailPekerjaan"),
    detailWirausaha: document.getElementById("detailWirausaha"),
    detailLanjutStudy: document.getElementById("detailLanjutStudy"),
    sectionCariKerja: document.getElementById("sectionCariKerja"),
    kompetensiA: document.getElementById("kompetensiA"),
    kompetensiB: document.getElementById("kompetensiB"),
    bagian2: document.getElementById("waktuAlumniMendapatkanPekerjaan"),
    wiraswasta: document.getElementById("wiraswasta"),
    lokasiPekerjaan: document.getElementById("lokasikerja"),
    kesesuaianKerja: document.getElementById("kesesuaianPekerjaan"),
    aktivitasSaatini: document.getElementById("aktivitasSaatIni"),
    evaluasi: document.getElementById("evaluasiPendidikan"),
    caramendapatkankerjaan: document.getElementById("caraMendapatkanPekerjaan"),
};

// Fungsi reset semua section ke kondisi awal
function resetAllWorkSections() {
    Object.values(sectionsMap).forEach((section) => {
        if (section) {
            section.style.display = "none";
            section
                .querySelectorAll("input, select, textarea")
                .forEach((el) => {
                    el.removeAttribute("required");
                    if (el.type === "radio" || el.type === "checkbox") {
                        el.checked = false;
                    } else {
                        el.value = "";
                    }
                });
        }
    });
}

// Fungsi set visible + required untuk section tertentu
function showSection(section, requiredFields = []) {
    if (section) {
        section.style.display = "block";
        section.querySelectorAll("input, select, textarea").forEach((el) => {
            if (
                requiredFields.length === 0 ||
                requiredFields.includes(el.name)
            ) {
                el.setAttribute("required", "required");
            }
        });
    }
}

// Event listener untuk perubahan status bekerja
document.querySelectorAll('input[name="bekerja"]').forEach((radio) => {
    radio.addEventListener("change", function () {
        resetAllWorkSections(); // Selalu reset semua section sebelum tampilkan yang baru

        switch (this.value) {
            case "bekerja_full":
                showSection(sectionsMap.bagian2, []); // Semua input di bagian ini required
                showSection(sectionsMap.lokasiPekerjaan);
                showSection(sectionsMap.kesesuaianKerja);
                showSection(sectionsMap.kompetensiA);
                showSection(sectionsMap.kompetensiB);
                showSection(sectionsMap.evaluasi);
                showSection(sectionsMap.caramendapatkankerjaan);
                showSection(sectionsMap.aktivitasSaatini);
                showSection(sectionsMap.sectionCariKerja);
                break;

            case "wirausaha":
                showSection(sectionsMap.bagian2);
                showSection(sectionsMap.wiraswasta, [
                    "posisi_usaha",
                    "tingkat_usaha_level",
                    "alamat_usaha",
                ]);
                showSection(sectionsMap.kesesuaianKerja);
                showSection(sectionsMap.lokasiPekerjaan);
                showSection(sectionsMap.kompetensiA);
                showSection(sectionsMap.kompetensiB);
                showSection(sectionsMap.evaluasi);
                showSection(sectionsMap.caramendapatkankerjaan);
                showSection(sectionsMap.aktivitasSaatini);
                showSection(sectionsMap.sectionCariKerja);
                break;

            case "lanjutstudy":
                showSection(sectionsMap.detailLanjutStudy, ["universitas"]);
                break;

            case "tidak":
                showSection(sectionsMap.aktivitasSaatini);
                showSection(sectionsMap.sectionCariKerja);
                break;

            case "belum_bekerja":
                showSection(sectionsMap.aktivitasSaatini);
                break;
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
