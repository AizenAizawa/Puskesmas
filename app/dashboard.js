$(document).ready(function() {
    $.post("dashboard/pasien", function(data) {
        $('#total-pasien').text(data.total_pasien);
        $('#poli-umum').text(data.poli_umum);
        $('#poli-gigi').text(data.poli_gigi);
        $('#poli-gizi').text(data.poli_gizi);
    }, 'json');
});
