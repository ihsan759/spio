$(document).ready(function() {
    $('#modaledit').on('show.bs.modal', function (event) {
        // event.relatedtarget menampilkan elemen mana yang digunakan saat diklik.
        var button              = $(event.relatedTarget)
        var modal          = $(this)
        
        // menampilkan output ke elemen hasil
        modal.find('#id_update_draft').attr("value",button.data('id'));
    });
});