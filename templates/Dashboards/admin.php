<?php
/**
 * @var \App\View\AppView $this
 * @var array $stats
 */
$this->assign('title', 'Admin Dashboard');
?>

<div class="container-fluid py-5" style="background-color: #f8f9fa; min-height: 85vh;">
    <div class="container">
        <!-- Dashboard Header -->
        <div class="row mb-4 align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold mb-0" style="color: #333;">Dashboard</h2>
                <p class="text-muted mb-0">Overview of system performance</p>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <button class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm">
                    <i class="bi bi-plus-lg me-2"></i>New Flight
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4">
            <!-- Flights -->
            <div class="col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm h-100 rounded-3">
                    <div class="card-body p-4 d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="bi bi-airplane-fill fs-4"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted fw-medium mb-1 small text-uppercase">Total Flights</p>
                            <h3 class="fw-bold mb-0 text-dark"><?= $this->Number->format($stats['flights']) ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bookings -->
            <div class="col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm h-100 rounded-3">
                    <div class="card-body p-4 d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="bi bi-ticket-perforated-fill fs-4"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted fw-medium mb-1 small text-uppercase">Bookings</p>
                            <h3 class="fw-bold mb-0 text-dark"><?= $this->Number->format($stats['bookings']) ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Passengers -->
            <div class="col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm h-100 rounded-3">
                    <div class="card-body p-4 d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="bi bi-people-fill fs-4"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted fw-medium mb-1 small text-uppercase">Passengers</p>
                            <h3 class="fw-bold mb-0 text-dark"><?= $this->Number->format($stats['passengers']) ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Revenue (Mockup) -->
            <div class="col-md-4 col-lg-3">
                <div class="card border-0 shadow-sm h-100 rounded-3">
                    <div class="card-body p-4 d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="bi bi-currency-dollar fs-4"></i>
                            </div>
                        </div>
                        <div>
                            <p class="text-muted fw-medium mb-1 small text-uppercase">Revenue</p>
                            <h3 class="fw-bold mb-0 text-dark">MYR 12.5K</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: Quick Links / Recent Activity -->
        <div class="row mt-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="fw-bold mb-0 text-dark">Recent Flights</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="bg-light text-muted small text-uppercase">
                                <tr>
                                    <th class="ps-4">Flight No</th>
                                    <th>Route</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-4 fw-bold">MH370</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span>KUL</span>
                                            <i class="bi bi-arrow-right mx-2 text-muted small"></i>
                                            <span>PEK</span>
                                        </div>
                                    </td>
                                    <td>Oct 24, 2025</td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill">On Time</span></td>
                                    <td class="text-end pe-4"><button class="btn btn-sm btn-link text-muted"><i class="bi bi-three-dots-vertical"></i></button></td>
                                </tr>
                                <tr>
                                    <td class="ps-4 fw-bold">AK512</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span>KUL</span>
                                            <i class="bi bi-arrow-right mx-2 text-muted small"></i>
                                            <span>SIN</span>
                                        </div>
                                    </td>
                                    <td>Oct 24, 2025</td>
                                    <td><span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill">Delayed</span></td>
                                    <td class="text-end pe-4"><button class="btn btn-sm btn-link text-muted"><i class="bi bi-three-dots-vertical"></i></button></td>
                                </tr>
                                <tr>
                                    <td class="ps-4 fw-bold">OD101</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span>PEN</span>
                                            <i class="bi bi-arrow-right mx-2 text-muted small"></i>
                                            <span>LGK</span>
                                        </div>
                                    </td>
                                    <td>Oct 25, 2025</td>
                                    <td><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">Scheduled</span></td>
                                    <td class="text-end pe-4"><button class="btn btn-sm btn-link text-muted"><i class="bi bi-three-dots-vertical"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="fw-bold mb-0 text-dark">Quick Actions</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action py-3 d-flex align-items-center border-bottom-0">
                            <div class="bg-light rounded p-2 me-3"><i class="bi bi-person-plus text-primary"></i></div>
                            <div>
                                <h6 class="mb-0 fw-bold">Add New User</h6>
                                <small class="text-muted">Register system administrators</small>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action py-3 d-flex align-items-center border-bottom-0">
                            <div class="bg-light rounded p-2 me-3"><i class="bi bi-gear text-secondary"></i></div>
                            <div>
                                <h6 class="mb-0 fw-bold">System Settings</h6>
                                <small class="text-muted">Configure application parameters</small>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action py-3 d-flex align-items-center border-bottom-0">
                            <div class="bg-light rounded p-2 me-3"><i class="bi bi-file-earmark-text text-success"></i></div>
                            <div>
                                <h6 class="mb-0 fw-bold">Generate Reports</h6>
                                <small class="text-muted">Download monthly statistics</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
