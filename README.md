# FlyHigh Flight Booking System ✈️

## About
FlyHigh is a flight booking management system developed as part of the **IMS566 - Advanced Web Design Development And Content Management** course assignment. The system allows users to search for flights, make bookings, and download PDF receipts. Administrators have access to a dashboard for managing flights, bookings, and user accounts.

## Tech Stack
- **Backend:** PHP 8.1, CakePHP 5.2
- **Frontend:** Bootstrap 5, Chart.js
- **Database:** MySQL

---
## Features
|       Feature            | Description |
|:------------------------|:--------------|
| 🔍 **Flight Search**    | Real-time search with origin, destination, date, and passenger selection |
| 🗓️**Booking System**    | Multi-step booking workflow with session management |
| 📄 **PDF Receipts**     | Professional ticket generation  |
| 🌙**Dark Mode**         | System-wide theme toggle for user preference |
| 📊**Admin Dashboard**   | Analytics, charts, and CRUD operations for all entities |
| 📲**Responsive Design** | Mobile-first approach using Bootstrap 5 |
---


## Group Report 📄
The group report for this assignment is located in the `docs/` folder:
- **Location:** `docs/IMS566 FLIGHT_BOOKING_REPORT.pdf`
- **Note:** If you download this repository as a ZIP file, the report will be included inside the `docs` folder as a PDF.

---

## Database Location 🗄️
For the lecturer's reference, the SQL database file is located in the **database** folder:
- **File:** `database/flight_booking.sql`
- **Instructions:** Please import this file into your MySQL database as described in the Setup Instructions.

---

## Setup Instructions

1. **Clone or Download:**
   - Clone this repository OR click **Code > Download ZIP**.
   - If downloading ZIP, extract it to your `c:\laragon\www\` folder.

2. **Install Dependencies:**
   - Open your terminal in the project directory.
   - Run command: `composer install`
   - *Note: This will recreate the `vendor` folder with all required libraries.*

3. **Database Setup:**
   - Open Laragon Database (MySQL).
   - Create a new database named `flight_booking`.
   - Import the file `database/flight_booking.sql` into this new database.

4. **Configuration:**
   - Copy `config/app_local.example.php` to `config/app_local.php` (if it doesn't exist).
   - Configure `config/app_local.php` with your database credentials.

5. **Run the App:**
   - Run `bin/cake server`
   - Access the homepage at the given URL (usually `http://localhost:8765`).

---

## Demo Accounts

| Role  |        email         | Password | 
|:------|:---------------------|:---------|
| Admin | admin@flyhigh.com    | 123      |
| User  | user@flyhigh.com     | 123      |

---

## Contributors

| Name                                  |   Matric No. | 
|:--------------------------------------|:-------------|
| [MEGAT NAUFAL SYABIL BIN ZAMRI]       | [2025121211] | 
| [MUHAMMAD NAJMI BIN ISMADY]           | [2025197825] | 
| [FARIS AFIZUAN BIN ABD KAHARMUZAKIR]  | [2025136615] | 
| [MUHAMMAD AMIR AMSYAR BIN ZAIN AZMAN] | [2025197521] | 

---

## Acknowledgements
- CakePHP Framework
- Bootstrap 5
- Chart.js

---

Made with CAKEPHP for ADVANCED WEB DESIGN DEVELOPMENT AND CONTENT MANAGEMENT (IMS566) Group Assignment
