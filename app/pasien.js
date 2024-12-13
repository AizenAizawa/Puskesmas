function reset_form() {
  $("#nama").val('');
  $("#nik").val('');
  $("#jenisKelamin").val('');
  $("#golongandarah").val('');
  $("#usia").val('');
  $("#alamat").val('');
  $("#tanggalLahir").val('');
}

function load_data() {
  $.post("pasien/load_data", {}, function (data) {
    console.log(data);
    $("#table2").DataTable().clear().destroy();
    $("#table2 > tbody").html('');
    $.each(data.pasien, function (idx, val) {
      var html = '<tr>';
      html += '<td >' + val.accountpasienName + '</td>';
      html += '<td>' + val.accountpasienNik + '</td>';
      html += '<td>' + val.genderName + '</td>';
      html += '<td>' + val.accountpasienUsia + '</td>';
      html += '<td>' + val.accountpasienAlamat + '</td>';
      html += '<td><a href="#" class="btn btn-warning btn-sm btn-edit" onclick="edit_data(' + val.accountpasienId + ')"><i class="fas fa-edit"></i></a></td>';
      html += '<td><a href="#" class="btn btn-danger btn-sm" onclick="hapus_data(' + val.accountpasienId + ')"><i class="fas fa-trash"></i></a></td>';
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

function load_gender() {
  $.post("pasien/load_gender", function (res) {
    $('#jenisKelamin').empty()
    $('#jenisKelamin').append('<option value="" disabled selected>Pilihan Gender</option>')
    $.each(res.dataGender, function (i, v) {
      $('#jenisKelamin').append('<option value="' + v.genderId + '" >' + v.genderName + '</option>')
    });
    $('#golongandarah').empty()
    $('#golongandarah').append('<option value="" disabled selected>Pilihan Golongan Darah</option>')
    $.each(res.dataGolongan, function (i, v) {
      $('#golongandarah').append('<option value="' + v.golongandarahId + '" >' + v.golongandarahName + '</option>')
    });
  }, 'json')
}

function simpan_data() {
  const form = $('#formPasien');
  const inputs = form.find('input, select, textarea');
  let isValid = true;
  inputs.each(function () {
    $(this).css('border', '');
  });
  inputs.each(function () {
    if (!$(this).val().trim()) {
      $(this).css('border', '1px solid red');
      isValid = false;
    }
  });
  if (!isValid) {
    alert('Harap isi semua bidang yang wajib.');
    return;
  }
  let nik = $("#nik").val();
  if (nik.length !== 16) {
    $("#nik").css('border', '1px solid red');
    alert('NIK harus terdiri dari 16 karakter.');
    return;
  }
  let nama = $("#nama").val();
  let jenisKelamin = $("#jenisKelamin").val();
  let golongandarah = $("#golongandarah").val();
  let usia = $("#usia").val();
  let alamat = $("#alamat").val();
  let tanggalLahir = $("#tanggalLahir").val();
  $.post("pasien/create", 
    {
      nama: nama,
      nik: nik,
      jenisKelamin: jenisKelamin,
      golongandarah: golongandarah,
      usia: usia,
      alamat: alamat,
      tanggalLahir: tanggalLahir
    },
    function (data, status) {
      if (data && data.status) {
        if (data.status === "error") {
          Swal.fire({
            title: 'Error!',
            text: data.msg,
            icon: 'error',
            confirmButtonText: 'OK'
          });
        } else {
          reset_form();
        }
      } else {
        Swal.fire({
          title: 'Error!',
          text: 'Respons server tidak valid.',
          icon: 'error',
          confirmButtonText: 'OK'
        });
      }
    }, 'json')
    .fail(function (jqXHR, textStatus, errorThrown) {
      Swal.fire({
        title: 'Error!',
        text: `AJAX error: ${textStatus} - ${errorThrown}`,
        icon: 'error',
        confirmButtonText: 'OK'
      });
    });
}

function edit_data(id) {
  $.post('pasien/edit_table', { id: id }, function (data) {
    console.log('Respon dari server:', data);
    if (data.status === 'ok') {
      $("#nama").val(data.data.accountpasienName);
      $("#nik").val(data.data.accountpasienNik);
      $("#jenisKelamin").val(data.data.accountpasienGender);
      $("#golongandarah").val(data.data.accountpasienGolongan);
      $("#usia").val(data.data.accountpasienUsia);
      $("#alamat").val(data.data.accountpasienAlamat);
      $("#tanggalLahir").val(data.data.accountpasienLahir);
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
    accountpasienName: $("#nama").val()
  }

  let accountpasienData = {
    accountpasienNik: $("#nik").val(),
    accountpasienGender: $("#jenisKelamin").val(),
    accountpasienGolongan: $("#golongandarah").val(),
    accountpasienUsia: $("#usia").val(),
    accountpasienAlamat: $("#alamat").val(),
    accountpasienLahir: $("#tanggalLahir").val(),
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
    $.post('pasien/update_table', gabung, function (data) {
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
      $.post('pasien/delete_table', { id: id }, function (data) {
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
  $(".angka").keydown(function (e) {

    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190, 107, 189]) !== -1 ||
      (e.keyCode == 65 && e.ctrlKey === true) ||
      (e.keyCode == 67 && e.ctrlKey === true) ||
      (e.keyCode == 88 && e.ctrlKey === true) ||
      (e.keyCode >= 35 && e.keyCode <= 39)) {
      return;
    }
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
      e.preventDefault();
    }
  });
  $(".closed").click(function () {
    $("#formModal").modal('hide')
    load_data()
  });

  $(".btn-add").click(function () {
    $(".btn-submit").show();
    $(".btn-editen").hide();
  })

  $(".btn-submit").show();
  $(".btn-editen").hide();

  load_data();
  load_gender();

});