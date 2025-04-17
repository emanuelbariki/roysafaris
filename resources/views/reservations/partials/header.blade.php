<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation System</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .reservation-card {
            border-left: 4px solid #0d6efd;
            margin-bottom: 20px;
        }
        .section-header {
            background-color: #f8f9fa;
            padding: 10px 15px;
            border-bottom: 1px solid #dee2e6;
            font-weight: 600;
        }
        .room-type-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 5px;
            margin-bottom: 15px;
        }
        .room-type-cell {
            border: 1px solid #dee2e6;
            padding: 5px;
            text-align: center;
            background-color: #f8f9fa;
        }
        .header-row {
            background-color: #0d6efd;
            color: white;
        }
        .payment-row:hover {
            background-color: #f8f9fa;
        }
        .nav-tabs .nav-link.active {
            font-weight: bold;
            border-bottom: 3px solid #0d6efd;
        }
        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        .status-confirmed {
            background-color: #d1e7dd;
            color: #0f5132;
        }
    </style>
</head>
<body>
    <div class="container-fluid mt-3">
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
            <div class="container-fluid">
                <span class="navbar-brand fw-bold text-primary">Reservations </span>
                <div class="d-flex">

                    <a href="{{route('reservations.index')}}" class="btn btn-sm btn-outline-warning me-2">
                        <i class="fas fa-chevron-left me-1"></i>Back
    </a>
                    <button class="btn btn-sm btn-outline-primary me-2">
                        <i class="fas fa-search me-1"></i>Find
                    </button>
                    <button class="btn btn-sm btn-outline-success me-2">
                        <i class="fas fa-plus me-1"></i>New Record
                    </button>
                    <button class="btn btn-sm btn-outline-danger me-2">
                        <i class="fas fa-trash me-1"></i>Delete
                    </button>
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-filter me-1"></i>Filter
                    </button>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="card reservation-card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-hotel me-2"></i>ACCOMMODATION RESERVATION</h5>
            </div>
            
            <div class="card-body">
                <!-- Guest Details Section -->
