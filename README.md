# FlyHigh Flight Booking System ✈️

## About
FlyHigh is a flight booking management system developed as part of the **IMS566 - Advanced Web Design Development And Content Management** course assignment. The system allows users to search for flights, make bookings, and download PDF receipts. Administrators have access to a dashboard for managing flights, bookings, and user accounts.

## Tech Stack
- **Backend:** PHP 8.1, CakePHP 4.4
- **Frontend:** Bootstrap 5, Chart.js
- **Database:** MySQL

---
## Features
|       Feature            | Description |
|:------------------------|:--------------|
| 🔍 **Flight Search**    | Real-time search with origin, destination, date, and passenger selection |
| 🗓️**Booking System**    | Multi-step booking workflow with session management |
| 📄 **PDF Receipts**     | Professional ticket generation using DomPDF |
| 🌙**Dark Mode**         | System-wide theme toggle for user preference |
| 📊**Admin Dashboard**   | Analytics, charts, and CRUD operations for all entities |
| 📲**Responsive Design** | Mobile-first approach using Bootstrap 5 |
---


## Setup Instructions

1. Clone this repository
2. Run `composer install`
3. Create MySQL database `flight_booking`
4. Import [database/flight_booking.sql](cci:7://file:///c:/laragon/www/flight_booking/database/flight_booking.sql:0:0-0:0)
5. Configure [config/app_local.php](cci:7://file:///c:/laragon/www/flight_booking/config/app_local.php:0:0-0:0) with your database credentials
6. Run `bin/cake server`
7. Open the given server

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
