<?php
// File: application/views/audiometri/header.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - ' : '' ?>Audiometri</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/logo/logo-kop.png') ?>">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .navbar-custom {
            background: linear-gradient(45deg, #2c3e50, #3498db);
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-custom .navbar-brand {
            color: white !important;
            font-weight: bold;
            font-size: 1.5rem;
        }
        
        .navbar-custom .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .navbar-custom .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }
        
        .navbar-custom .nav-link.active {
            color: white !important;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }
        
        .content-wrapper {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            min-height: calc(100vh - 140px);
            overflow: hidden;
        }
        
        .footer-custom {
            background: linear-gradient(45deg, #2c3e50, #3498db);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .alert {
            border-radius: 10px;
            margin-bottom: 20px;
        }
        
        .btn-floating {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }
        
        .btn-floating:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url('audiometri') ?>">
                Sistem Manajemen Audiometri
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= ($this->router->method == 'index') ? 'active' : '' ?>" 
                           href="<?= base_url('audiometri') ?>">
                            <i class="fas fa-home me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($this->router->method == 'create') ? 'active' : '' ?>" 
                           href="<?= base_url('audiometri/create') ?>">
                            <i class="fas fa-plus me-1"></i> Tes Baru
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($this->router->method == 'list_tests') ? 'active' : '' ?>" 
                           href="<?= base_url('audiometri/list_tests') ?>">
                            <i class="fas fa-list me-1"></i> Daftar Tes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($this->router->method == 'doctor_view') ? 'active' : '' ?>" 
                           href="<?= base_url('audiometri/doctor_view') ?>">
                            <i class="fa-solid fa-user-doctor"></i> Panel Dokter
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-chart-bar me-1"></i> Laporan
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= base_url('audiometri/export_excel') ?>">
                                <i class="fas fa-file-excel me-1"></i> Export Excel
                            </a></li>
                            <li><a class="dropdown-item" href="#" onclick="showReportModal()">
                                <i class="fas fa-chart-pie me-1"></i> Laporan Statistik
                            </a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
