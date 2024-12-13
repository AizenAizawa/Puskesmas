function reset_form() {
  $("#Keluhan").val('');
  $("#Poli").val('');
  $("#Name").val('');
  load_poli()
}

function load_data() {
  $.post("antrian/load_data", {}, function (data) {
    console.log(data);
    $("#table2").DataTable().clear().destroy();
    $("#table2 > tbody").html('');
    $.each(data.antrian, function (idx, val) {
      var html = '<tr>';
      html += '<td >' + val.daftarpasienTrx + '</td>';
      html += '<td>' + val.daftarpoliName + '</td>';
      html += '<td>' + val.daftarpasienKeluhan + '</td>';
      html += '<td>' + val.accountpasienNik + '</td>';
      html += '<td>' + val.daftarpasiennameId + '</td>';
      html += '<td>';
      html += '<a href="#" class="btn btn-warning btn-sm" onclick="edit_data(' + val.daftarpasienId + ')"><i class="fas fa-edit"></i></a> ';
      html += '<a href="#" class="btn btn-danger btn-sm" onclick="hapus_data(' + val.daftarpasienId + ')"><i class="fas fa-trash"></i></a>';
      html += '</td>';      
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

var NikChoices = null;

function load_poli() {
  $.post("antrian/load_poli", function (res) {
    $('#Poli').empty();
    $('#Poli').append('<option value="" disabled selected>Pilihan Poli</option>');
    $.each(res.dataPoli, function (i, v) {
      $('#Poli').append('<option value="' + v.daftarpoliId + '">' + v.daftarpoliName + '</option>');
    });
    $('#NIK').empty();
    $('#NIK').append('<option value="" disabled selected>Pilihan Nik</option>');
    $.each(res.dataNIK, function (i, v) {
      $('#NIK').append('<option value="' + v.accountpasienId + '" data-name="' + v.accountpasienName + '">' + v.accountpasienNik + '</option>');
    });

    if (NikChoices) {
      NikChoices.destroy();
    }
    NikChoices = new Choices('#NIK', {
      searchEnabled: true,
      itemSelectText: '',
      placeholder: true,
      placeholderValue: 'Pilih atau cari nama',
    });

    $('#NIK').on('change', function () {
      updateNameField();
    });
  }, 'json');
}

function updateNameField() {
  const selectedOption = $("#NIK option:selected");
  const name = selectedOption.data("name");
  $("#Name").val(name);
}

function simpan_data() {
  let keluhan = $("#Keluhan").val();
  let poli = $("#Poli").val();
  let Nik = $("#NIK").val();
  let name = $("#Name").val();
  $.post("antrian/create", { keluhan, poli, Nik, name }, function (data, status) {
    console.log(data.status);
    if (data.status === "Error") {
      Swal.fire({
        title: 'Error!',
        text: data.msg,
        icon: 'error',
        confirmButtonText: 'OK'
      });
    } else {
      reset_form();
    }
  }, 'json');
}

function updateName() {
  const selectedOption = $("#NIK option:selected");
  const name = selectedOption.data("name");
  $("#Name").val(name);
}
function edit_data(id) {
  $.post('antrian/edit_table', { id: id }, function (data) {
    console.log('Respon dari server:', data);
    if (data.status === 'ok') {
      $("#Name").val(data.data.daftarpasiennameId);
      $("#Poli").val(data.data.daftarpasienpoliId);
      $("#Keluhan").val(data.data.daftarpasienKeluhan);
      $("#formModal").data('id', id);
      $("#formModal").modal('show');
      $(".btn-submit").hide();
      $(".btn-editen").show();
    } else {
      Swal.fire({
        title: 'Error!',
        text: data.msg,
        icon: 'error',
        confirmButtonText: 'OK'
      })
    }
  }, 'json');
}

function update_data() {
  var id = $("#formModal").data('id');

  let accountpasienHarus = {
    id: id,
    daftarpasienNik: $("#NIK").val()
  }

  let accountpasienData = {
    daftarpasiennameId: $("#Name").val(),
    daftarpasienpoliId: $("#Poli").val(),
    daftarpasienKeluhan: $("#Keluhan").val()
  };

  var gabung = Object.assign({}, accountpasienHarus, accountpasienData)
  if (Object.values(accountpasienHarus).some(val => val === "")) {
    Swal.fire({
      title: 'Error!',
      text: 'Please fill out all fields',
      icon: 'error',
      confirmButtonText: 'OK'
    });
  } else {
    $.post('antrian/update_table', gabung, function (data) {
      if (data.status === 'success') {
        Swal.fire({
          title: 'Success!',
          text: data.msg,
          icon: 'success',
          confirmButtonText: 'OK'
        }).then(() => {
          $("#formModal").modal("hide");
          reset_form();
        });
      } else {
        Swal.fire({
          title: 'Error!',
          text: data.msg,
          icon: 'error',
          confirmButtonText: 'OK'
        });
      }
    }, 'json');
  }
}

function hapus_data(id) {
  Swal.fire({
    title: 'Apakah kamu ingin menghapus data?',
    showDenyButton: true,
    showCancelButton: true,
    denyButtonText: 'No',
    confirmButtonText: 'Yes',
    customClass: {
      actions: 'my-actions',
      cancelButton: 'order-1 right-gap',
      confirmButton: 'order-2',
      denyButton: 'order-3',
    },
  }).then((result) => {
    if (result.isConfirmed) {
      $.post('antrian/delete_table', { id: id }, function (data) {
        if (data.status === 'success') {
          Swal.fire({
            title: 'Succes!',
            text: data.msg,
            icon: 'success',
            confirmButtonText: 'OK'
          }).then(() => {
            location.reload();
          });
        } else {
          Swal.fire({
            title: 'Error!',
            text: data.msg,
            icon: 'error',
            confirmButtonText: 'OK'
          })
        }
      }, 'json');
    } else if (result.isDenied) {
      Swal.fire('Perubahan tidak tersimpan', '', 'info')
    }
  })
}

$(document).ready(function () {
  $(".closed").click(function () {
    $("#formModal").modal('hide')
    reset_form()
  });

  $(".btn-add").click(function () {
    $(".btn-submit").show();
    $(".btn-editen").hide();
  })

  $(".btn-submit").show();
  $(".btn-editen").hide();

  load_poli();
  load_data();

});