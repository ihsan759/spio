$('#modalcatatan').on('show.bs.modal', function (event) {
    // event.relatedtarget menampilkan elemen mana yang digunakan saat diklik.
    var button              = $(event.relatedTarget)

    var catatan        = button.data('catatan');
    var judul          = button.data('judul');

    // membuat objek elemen
    var hasil_modal = document.getElementById("catatan_pemeriksa");
    var judul_modal = document.getElementById("modalcatatanLabel");

    // menampilkan output ke elemen hasil
    hasil_modal.innerHTML = catatan;
    judul_modal.innerHTML = judul;
})