function load_data() {
    $.post("poligizi/load_data", {}, function (data) {
        console.log(data);
        $("#table2").DataTable().clear().destroy();
        $("#table2 > tbody").html('');
        $.each(data.poligizi, function (idx, val) {
            var html = '<tr>';
            html += '<td >' + val.daftarpasienTrx + '</td>';
            html += '<td>' + val.daftarpoliName + '</td>';
            html += '<td>' + val.accountpasienName + '</td>';
            html += '<td>' + val.daftarpasienKeluhan + '</td>';
            html += '<td><span onclick="active_data(' + val['daftarpasienId'] + ',' + val['daftarpasienStatus'] + ')" class="badge ' + ((val['daftarpasienStatus'] == '1') ? 'bg-success' : 'bg-danger') + ' ">' +
            ((val['daftarpasienStatus'] == '1') 
                ? '<i class="fas fa-check-circle"></i> Selesai' 
                : '<i class="fas fa-spinner"></i> Diproses') +
            '</span></td>';
        
            html += '</tr>';
            $("#table2 > tbody").append(html);
        });
        $('#table2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    }, 'json');
}

function active_data(id, status) {
    if (status == 1) {
      swalWithBootstrapButtons.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda Ingin MENONAKTIFKAN data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Nonaktifkan',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          $.post('poligizi/active', { id: id }, function(data) {
            if (data.status === 'success') {
              Swal.fire({
                title: 'Success!',
                text: data.msg,
                icon: 'success',
                confirmButtonText: 'OK'
              }).then(() => {
               load_data()
              });
            } else {
              Swal.fire({
                title: 'Gagal!',
                text: data.msg,
                icon: 'error',
                confirmButtonText: 'OK'
              });
            }
          }, 'json');
        }
      });
    } else {
      Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda Ingin MENGAKTIFKAN data ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Aktifkan',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          $.post('poligizi/active', { id: id }, function(data) {
            if (data.status === 'success') {
              Swal.fire({
                title: 'Sukses!',
                text: data.msg,
                icon: 'success',
                confirmButtonText: 'OK'
              }).then(() => {
                load_data()
              });
            } else {
              Swal.fire({
                title: 'Gagal!',
                text: data.msg,
                icon: 'error',
                confirmButtonText: 'OK'
              });
            }
          }, 'json');
        }
      });
    }
  }

load_data();