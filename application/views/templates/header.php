<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?= $title ?>
  </title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
  <style>
        /* Masukkan CSS tema gelap di sini */
        .choices__inner {
            background-color: #343a40 !important;
            border: 1px solid #495057 !important;
            border-radius: 0.25rem !important;
            padding: 0.375rem 0.75rem !important;
            color: #ffffff !important;
            font-size: 1rem !important;
        }
        .choices__inner:focus-within {
            border-color: #80bdff !important;
            box-shadow: 0 0 0 0.2rem rgba(128, 189, 255, 0.25) !important;
        }
        .choices__list--dropdown {
            background-color: #343a40 !important;
            border: 1px solid #495057 !important;
            border-radius: 0.25rem !important;
            box-shadow: 0 0.15rem 0.5rem rgba(0, 0, 0, 0.5) !important;
            color: #ffffff !important;
        }
        .choices__item--selectable {
            padding: 0.5rem !important;
            color: #ffffff !important;
            background-color: #343a40 !important;
        }
        .choices__item--selectable:hover {
            background-color: #495057 !important;
        }
        .choices__placeholder {
            color: #6c757d !important;
        }
        .choices__item--choice {
            background-color: #495057 !important;
            border: 1px solid #343a40 !important;
            color: #ffffff !important;
        }
    </style>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/css/') ?>all.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('assets/css/') ?>buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/css/') ?>dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/css/') ?>responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/css/') ?>adminlte.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/css/') ?>OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('assets/css/') ?>daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('assets/css/') ?>summernote-bs4.min.css">
  <!-- Login Form -->
  <link rel="stylesheet" href="<?= base_url('assets/css/') ?>table-form.css">
  <!-- Template -->
  <link rel="stylesheet" href="<?= base_url('assets/css/') ?>template.css">

</head>