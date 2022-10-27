$('#modalinfo').on('show.bs.modal', function (event) {
    // event.relatedtarget menampilkan elemen mana yang digunakan saat diklik.
    var button              = $(event.relatedTarget)

    var catatan        = button.data('catatan');
    var judul          = button.data('judul');
    var pembuat        = button.data('pembuat');

    // membuat objek elemen
    var hasil_modal = document.getElementById("catatan");
    var judul_modal = document.getElementById("modalinfoLabel");
    var pembuat_modal = document.getElementById("pembuat")

    // menampilkan output ke elemen hasil
    hasil_modal.innerHTML = catatan;
    judul_modal.innerHTML = judul;
    pembuat_modal.innerHTML = pembuat;
})