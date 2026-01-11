<?php
/**
 * Admin Theme Element
 * Contains Global Styles and Sidebar Navigation
 */
$controller = $this->request->getParam('controller');
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rajdhani:wght@500;600;700&display=swap');

    :root {
        /* BATMAN GOTHAM THEME */
        --gotham-bg: #050505;          /* Deep Black */
        --gotham-card: #121212;        /* Dark Grey Card */
        --gotham-accent: #f1c40f;      /* Gold Accent */
        --gotham-text: #ecf0f1;        /* Off-White Text */
        --gotham-muted: #95a5a6;       /* Muted Grey Text */
        --gotham-border: #2c3e50;      /* Dark Blue-Grey Border */
        
        --sidebar-collapsed: 70px;
        --sidebar-expanded: 260px;
    }

    body { 
        background-color: var(--gotham-bg); 
        font-family: 'Rajdhani', sans-serif; 
        color: var(--gotham-text);
        margin: 0; 
        overflow-x: hidden; 
    }

    /* COLLAPSIBLE SIDEBAR */
    .sidebar {
        width: var(--sidebar-collapsed);
        background-color: #000000;
        border-right: 1px solid var(--gotham-border);
        color: white;
        height: 100vh;
        position: fixed;
        left: 0; top: 0;
        z-index: 1001; /* Above header */
        transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        white-space: nowrap;
    }
    .sidebar:hover { width: var(--sidebar-expanded); box-shadow: 10px 0 30px rgba(0,0,0,0.8); }

    .nav-header { padding: 25px; font-weight: 700; opacity: 0; transition: 0.2s; font-family: 'Oswald'; font-size: 1.2rem; letter-spacing: 1px; color: var(--gotham-accent); }
    .sidebar:hover .nav-header { opacity: 1; }

    .nav-item {
        display: flex; align-items: center;
        padding: 15px 22px;
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        cursor: pointer;
        transition: 0.2s;
        border-left: 4px solid transparent;
    }
    .nav-item i { font-size: 1.4rem; min-width: 30px; transition: 0.2s; }
    .nav-item span { margin-left: 15px; opacity: 0; transition: 0.2s; }
    .sidebar:hover .nav-item span { opacity: 1; }
    .nav-item:hover, .nav-item.active { 
        background: rgba(241, 196, 15, 0.15); 
        color: var(--gotham-accent); 
        border-left-color: var(--gotham-accent); 
    }

    /* MAIN CONTENT */
    .main-content { 
        margin-left: var(--sidebar-collapsed); 
        padding: 40px; 
        transition: margin-left 0.3s; 
        display: flex; flex-direction: column; min-height: 100vh; 
        position: relative;
        z-index: 1;
    }
    
    /* DASHBOARD CARDS */
    .dashboard-card { 
        background: var(--gotham-card); 
        border: 1px solid var(--gotham-border); 
        border-radius: 8px; 
        padding: 25px; 
        margin-bottom: 20px; 
        box-shadow: 0 4px 10px rgba(0,0,0,0.3); 
    }

    /* FORM STYLES */
    .form-control, .form-select {
        background-color: #1a1a1a;
        border: 1px solid var(--gotham-border);
        color: var(--gotham-text);
    }
    .form-control:focus, .form-select:focus {
        background-color: #222;
        border-color: var(--gotham-accent);
        color: var(--gotham-text);
        box-shadow: 0 0 0 0.25rem rgba(241, 196, 15, 0.25);
    }
    label { color: var(--gotham-muted); margin-bottom: 5px; }
    
    /* TABLE STYLES */
    .table-flyhigh { width: 100%; border-collapse: collapse; color: var(--gotham-muted); }
    .table-flyhigh th { text-align: left; padding: 15px; border-bottom: 2px solid var(--gotham-border); color: var(--gotham-accent); font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; }
    .table-flyhigh th a { color: var(--gotham-accent); text-decoration: none; }
    .table-flyhigh th a:hover { color: #fff; }
    .table-flyhigh td { padding: 15px; border-bottom: 1px solid rgba(255,255,255,0.05); font-size: 0.95rem; vertical-align: middle; }
    .table-flyhigh tr:hover td { color: var(--gotham-text); background: rgba(255,255,255,0.02); }
    
    .status-badge { padding: 6px 12px; border-radius: 50px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }
    .status-paid { background: rgba(46, 204, 113, 0.2); color: #2ecc71; border: 1px solid #2ecc71; }
    .status-unpaid { background: rgba(241, 196, 15, 0.2); color: #f1c40f; border: 1px solid #f1c40f; }

    .role-admin { background: rgba(231, 76, 60, 0.2); color: #e74c3c; border: 1px solid #e74c3c; }
    .role-user { background: rgba(255,255,255,0.1); color: #95a5a6; border: 1px solid #7f8c8d; }

    .btn-create { 
        background: var(--gotham-accent); 
        color: #000; 
        border-radius: 50px; 
        padding: 10px 25px; 
        text-decoration: none; 
        font-weight: 700; 
        display: inline-flex; align-items: center; gap: 8px; 
        transition: 0.2s; 
        border: none;
    }
    .btn-create:hover { background: #fff; color: #000; box-shadow: 0 0 10px var(--gotham-accent); }
    
    h2, h3, h4, h5, h6 { color: var(--gotham-text); font-family: 'Oswald'; letter-spacing: 1px; }
    .text-muted { color: var(--gotham-muted) !important; }
    
    /* Paginator */
    .paginator .pagination { display: flex; list-style: none; padding: 0; gap: 5px; margin-top: 20px; }
    .paginator .pagination li a { 
        padding: 5px 10px; 
        border: 1px solid var(--gotham-border); 
        color: var(--gotham-muted); 
        text-decoration: none; 
        border-radius: 4px; 
    }
    .paginator .pagination li.active a { background: var(--gotham-accent); color: #000; border-color: var(--gotham-accent); }
</style>

<div class="admin-wrapper">
    <nav class="sidebar">
        <div class="nav-header">ADMIN PANEL</div>
        <a href="<?= $this->Url->build(['controller' => 'Dashboards', 'action' => 'index']) ?>" class="nav-item <?= $controller == 'Dashboards' ? 'active' : '' ?>">
            <i class="bi bi-grid-1x2"></i> <span>Overview</span>
        </a>
        <a href="<?= $this->Url->build(['controller' => 'Bookings', 'action' => 'index']) ?>" class="nav-item <?= $controller == 'Bookings' ? 'active' : '' ?>">
            <i class="bi bi-journal-check"></i> <span>Bookings</span>
        </a>
        <a href="<?= $this->Url->build(['controller' => 'Flights', 'action' => 'index']) ?>" class="nav-item <?= $controller == 'Flights' ? 'active' : '' ?>">
            <i class="bi bi-airplane"></i> <span>Flights</span>
        </a>
        <a href="<?= $this->Url->build(['controller' => 'Passengers', 'action' => 'index']) ?>" class="nav-item <?= $controller == 'Passengers' ? 'active' : '' ?>">
            <i class="bi bi-people"></i> <span>Passengers</span>
        </a>
        <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" class="nav-item <?= $controller == 'Users' ? 'active' : '' ?>">
            <i class="bi bi-person-gear"></i> <span>Users</span>
        </a>
    </nav>
