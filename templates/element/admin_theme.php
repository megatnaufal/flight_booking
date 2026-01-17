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
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@500;700&family=Rajdhani:wght@500;600;700&display=swap');

    :root {
        /* REFINED PURPLE THEME - PROPER POLISH */
        --admin-bg: #F3F4F6;           /* Softer Light Grey */
        --admin-card: #FFFFFF;         /* White Card */
        --admin-sidebar: #4C1D95;      /* Deep Purple Sidebar */
        --admin-accent: #7C3AED;       /* Purple Accent */
        --admin-accent-hover: #6D28D9; /* Darker Purple */
        --admin-text: #1F2937;         /* Dark Grey Text */
        --admin-muted: #6B7280;        /* Muted Text */
        --admin-border: #E5E7EB;       /* Light Border */
        --admin-gradient: linear-gradient(135deg, #7C3AED 0%, #8B5CF6 100%); /* FlyHigh Gradient */
        
        --sidebar-collapsed: 72px;
        --sidebar-expanded: 260px;
    }

    body { 
        background-color: var(--admin-bg); 
        font-family: 'Inter', sans-serif; 
        color: var(--admin-text);
        margin: 0; 
        overflow-x: hidden; 
        -webkit-font-smoothing: antialiased;
    }

    /* COLLAPSIBLE SIDEBAR */
    .sidebar {
        width: var(--sidebar-collapsed);
        background-color: var(--admin-sidebar);
        border-right: none;
        color: white;
        height: 100vh;
        position: fixed;
        left: 0; top: 0;
        z-index: 1001;
        transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        white-space: nowrap;
        box-shadow: 4px 0 24px rgba(76, 29, 149, 0.15);
    }
    .sidebar:hover { width: var(--sidebar-expanded); box-shadow: 8px 0 30px rgba(0,0,0,0.2); }

    .nav-header { 
        padding: 25px; 
        font-weight: 800; 
        opacity: 0; 
        transition: 0.2s; 
        font-size: 1.1rem; 
        letter-spacing: -0.02em; 
        color: #fff; 
        border-bottom: 1px solid rgba(255,255,255,0.1); 
        white-space: nowrap;
    }
    .sidebar:hover .nav-header { opacity: 1; }

    .nav-item {
        display: flex; align-items: center;
        padding: 16px 24px;
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s ease;
        border-left: 3px solid transparent;
        font-weight: 500;
        font-size: 0.95rem;
    }
    .nav-item i { font-size: 1.25rem; min-width: 24px; transition: 0.2s; display: flex; align-items: center; justify-content: center; }
    .nav-item span { margin-left: 12px; opacity: 0; transition: 0.2s; }
    .sidebar:hover .nav-item span { opacity: 1; }
    
    .nav-item:hover { 
        background: rgba(255, 255, 255, 0.1); 
        color: #fff; 
        padding-left: 28px; /* Subtle slide effect */
    }
    
    .nav-item.active { 
        background: rgba(255, 255, 255, 0.2); 
        color: #fff; 
        border-left-color: #fff; 
        font-weight: 600;
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
        background: var(--admin-card); 
        border: 1px solid var(--admin-border); 
        border-radius: 16px; 
        padding: 24px; 
        margin-bottom: 24px; 
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03); 
    }
    
    /* FORM STYLES */
    .form-control, .form-select {
        background-color: #fff;
        border: 1px solid #D1D5DB;
        color: var(--admin-text);
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 0.9rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .form-control:focus, .form-select:focus {
        background-color: #fff;
        border-color: var(--admin-accent);
        outline: 0;
        box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.2);
    }
    label { color: var(--admin-text); font-weight: 600; margin-bottom: 6px; font-size: 0.85rem; }
    
    /* TABLE STYLES */
    .table-responsive { border-radius: 12px; border: 1px solid var(--admin-border); overflow: hidden; }
    .table-flyhigh { width: 100%; border-collapse: collapse; background: white; white-space: nowrap; }
    .table-flyhigh th { 
        text-align: left; 
        padding: 16px 20px; 
        background: #F9FAFB; 
        border-bottom: 1px solid #E5E7EB; 
        color: #6B7280; 
        font-size: 0.75rem; 
        font-weight: 700; 
        text-transform: uppercase; 
        letter-spacing: 0.05em; 
    }
    .table-flyhigh th a { color: #6B7280; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; }
    .table-flyhigh th a:hover { color: var(--admin-accent); }
    .table-flyhigh th a.asc:after { content: " \2191"; /* Up Arrow */ } 
    .table-flyhigh th a.desc:after { content: " \2193"; /* Down Arrow */ }
    .table-flyhigh td { padding: 16px 20px; border-bottom: 1px solid #F3F4F6; font-size: 0.9rem; vertical-align: middle; color: #1F2937; }
    .table-flyhigh tr:last-child td { border-bottom: none; }
    .table-flyhigh tr:hover td { background: #F9FAFB; }
    
    /* BADGES */
    .status-badge { padding: 4px 10px; border-radius: 6px; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; display: inline-flex; align-items: center; letter-spacing: 0.025em; }
    .status-paid { background: #DCFCE7; color: #166534; border: 1px solid #BBF7D0; }
    .status-unpaid { background: #FEF3C7; color: #92400E; border: 1px solid #FDE68A; }

    .role-admin { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
    .role-user { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }

    /* BUTTONS */
    .btn-create { 
        background: var(--admin-gradient); 
        color: #fff; 
        border-radius: 8px; 
        padding: 10px 20px; 
        text-decoration: none; 
        font-weight: 600; 
        font-size: 0.9rem;
        display: inline-flex; align-items: center; gap: 8px; 
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        box-shadow: 0 4px 6px rgba(124, 58, 237, 0.25);
    }
    .btn-create:hover { 
        background: linear-gradient(135deg, #6D28D9 0%, #7C3AED 100%); 
        color: #fff; 
        transform: translateY(-2px); 
        box-shadow: 0 8px 15px rgba(124, 58, 237, 0.3); 
    }
    
    /* TYPOGRAPHY */
    h2, h3, h4, h5, h6 { color: #111827; font-weight: 700; letter-spacing: -0.025em; margin-bottom: 0.5rem; }
    h2 { font-size: 1.5rem; }
    .text-muted { color: var(--admin-muted) !important; }
    
    /* PAGINATOR */
    .paginator .pagination { display: flex; list-style: none; padding: 0; gap: 4px; margin-top: 24px; justify-content: flex-end; }
    .paginator .pagination li a { 
        padding: 8px 12px; 
        border: 1px solid #E5E7EB; 
        color: #6B7280; 
        text-decoration: none; 
        border-radius: 6px; 
        font-weight: 500;
        font-size: 0.85rem;
        background: #fff;
        transition: all 0.2s;
        display: inline-block;
        min-width: 32px;
        text-align: center;
    }
    .paginator .pagination li a:hover { border-color: #D1D5DB; color: #374151; background: #F9FAFB; }
    .paginator .pagination li.active a { background: var(--admin-accent); color: #fff; border-color: var(--admin-accent); }
    .paginator .pagination li.disabled a { opacity: 0.5; cursor: not-allowed; }
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
        <a href="<?= $this->Url->build(['controller' => 'Airports', 'action' => 'index']) ?>" class="nav-item <?= $controller == 'Airports' ? 'active' : '' ?>">
            <i class="bi bi-geo-alt"></i> <span>Airports</span>
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
