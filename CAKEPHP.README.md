# FlyHigh Flight Booking System ✈️

A flight booking website built for our Web Development course assignment. Made with CakePHP 4 & Bootstrap 5.

## Features
- 🔍 Flight search with real-time validation
- 🌙 Dark mode toggle
- 📄 PDF receipt generation
- 📊 Admin dashboard with charts
- 🔒 Secure login & registration

## Tech Stack
- **Backend:** PHP 8.1, CakePHP 4.4
- **Frontend:** Bootstrap 5, Chart.js
- **Database:** MySQL

---

## Setup Instructions

### 1. Clone the Repository
```bash
git clone https://github.com/[your-username]/flight_booking.git
cd flight_booking
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Setup Database
1. Create a MySQL database called `flight_booking`
2. Import the SQL file:
   ```bash
   mysql -u root -p flight_booking < database/flight_booking.sql
   ```
   Or use phpMyAdmin to import `database/flight_booking.sql`

### 4. Configure Database Connection
1. Copy `config/app_local.example.php` to `config/app_local.php`
2. Edit `config/app_local.php` with your MySQL credentials:
   ```php
   'username' => 'root',
   'password' => '',
   'database' => 'flight_booking',
   ```

### 5. Run the Application
```bash
bin/cake server
```
Open your browser and go to: `http://localhost:8765`

---

## Demo Accounts

| Role  | Username | Password |
|:------|:---------|:---------|
| Admin | admin    | 123      |
| User  | user     | 123      |

---

## Team Members
| Name | Role | Contribution |
|:-----|:-----|:-------------|
| [Your Name] | Lead Developer | System Architecture, Core Logic |
| [Member 2] | Frontend | CSS Styling, Dark Mode |
| [Member 3] | Database | Database Design, Testing |

---

## Screenshots

*Add screenshots of your application here*

---

Made with ☕ for [Course Name] Assignment
