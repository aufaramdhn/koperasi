$(".btn-delete").on("click", function (e) {
  e.preventDefault();
  const href = $(this).attr("href");

  Swal.fire({
    title: "Are you sure?",
    text: "Record will be deleted?",
    type: "warning",
    icon: "warning",
    timer: 1500,
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Delete Records",
  }).then((result) => {
    if (result.value) {
      document.location.href = href;
    }
  });
});

$(".btn-logout").on("click", function (e) {
  e.preventDefault();
  const href = $(this).attr("href");

  Swal.fire({
    title: "Are you sure?",
    text: "Want to leave this website?",
    type: "warning",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Logout",
  }).then((result) => {
    if (result.value) {
      document.location.href = href;
    }
  });
});

const notifikasi = $(".info-data").data("infodata");

if (notifikasi == "Disimpan") {
  Swal.fire({
    icon: "success",
    title: "Data berhasil disimpan",
    showConfirmButton: false,
    timer: 1500,
  });
} else if (notifikasi == "Gagal") {
  Swal.fire({
    icon: "error",
    title: "Data gagal disimpan",
    showConfirmButton: false,
    timer: 1500,
  });
} else if (notifikasi == "Kosong") {
  Swal.fire({
    position: "center",
    icon: "warning",
    title: "Username atau password anda kosong",
    showConfirmButton: false,
    timer: 1500,
  });
} else if (notifikasi == "Berhasil") {
  Swal.fire({
    icon: "success",
    title: "Anda berhasil login",
    text: "Selamat datang diwebsite koperasi kami",
    showConfirmButton: false,
    timer: 1500,
  });
}
