// ! 1. Feather Icon
feather.replace();
// ! 2. Navbar Scroll Effect
window.addEventListener("scroll", function () {
  const navbar = document.getElementById("navbar");
  if (window.scrollY > 50) {
    navbar.classList.add("bg-gray-500", "bg-opacity-50", "shadow-lg");
  } else {
    navbar.classList.remove("bg-gray-500", "bg-opacity-50", "shadow-lg");
  }
});

// ! 3. Button Back to Top
function scrollToTop() {
  window.scrollTo({ top: 0, behavior: "smooth" });
}
window.addEventListener("scroll", function () {
  const btn = document.getElementById("backToTop");
  btn.style.display = window.scrollY > 200 ? "block" : "none";
});

// ! 4. Form Preview dan Modal
const modalForm = document.getElementById("pendaftaran-modal");
const ringkasan = document.getElementById("ringkasanData");
const form = document.getElementById("pendaftaranForm");
const preview = document.getElementById("previewData");
const finalForm = document.getElementById("submitFinal");

// Buka modal ketika link diklik
document
  .querySelector('a[href="daftar_akun.php"]')
  ?.addEventListener("click", (e) => {
    e.preventDefault();
    modalForm.classList.remove("hidden");
  });

// Proses form pendaftaran
form.addEventListener("submit", (e) => {
  e.preventDefault();
  const data = Object.fromEntries(new FormData(form).entries());

  preview.innerHTML = `
    <p><strong>Nama:</strong> ${data.nama}</p>
    <p><strong>No HP:</strong> ${data.nope}</p>
    <p><strong>Tanggal Lahir:</strong> ${data.tglLahir}</p>
  `;

  // Set nilai ke hidden input
  for (const key in data) {
    if (finalForm.elements[key]) {
      finalForm.elements[key].value = data[key];
    }
  }

  modalForm.classList.add("hidden");
  ringkasan.classList.remove("hidden");
});

// Validasi Password & No HP
form.addEventListener("submit", function (e) {
  const passwordInput = document.querySelector('input[name="password"]');
  const nopeInput = document.querySelector('input[name="nope"]');
  const password = passwordInput.value;
  const nope = nopeInput.value;

  const passwordValid = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/.test(password);
  const nopeValid = /^\d+$/.test(nope);

  let errors = [];

  if (!passwordValid) {
    errors.push(
      "Password minimal 8 karakter dan harus mengandung huruf & angka."
    );
  }

  if (!nopeValid) {
    errors.push("Nomor HP hanya boleh mengandung angka.");
  }

  if (errors.length > 0) {
    e.preventDefault();
    alert(errors.join("\n"));
  }
});

// Tombol kembali ke form dari preview
function kembaliKeForm() {
  ringkasan.classList.add("hidden");
  modalForm.classList.remove("hidden");
}

// Salin nomor rekening
function copyRekening() {
  const nomor = document.getElementById("noRek").textContent;
  navigator.clipboard.writeText(nomor).then(() => {
    alert("Nomor rekening disalin: " + nomor);
  });
}
