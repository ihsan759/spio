$(document).ready(function() {
    $('#modalfile').on('show.bs.modal', function (event) {
        // event.relatedtarget menampilkan elemen mana yang digunakan saat diklik.
        var button              = $(event.relatedTarget)
        var modal          = $(this)
        
        // menampilkan output ke elemen hasil
        modal.find('#no').attr("value",button.data('no'));
        modal.find('#id_pemeriksa').attr("value",button.data('idpemeriksa'));
        modal.find('#id').attr("value",button.data('id'));
    });
});