# UniAid - Donation Management System

A web-based **Donation and Volunteer Management System** developed for our capstone project. It aims to ease the processes of donation tracking (both in-kind and monetary), request fulfillment, volunteer activity, and resource distribution across various Red Cross chapters in the Philippines.
---

## 📌 Features

### 🔐 User Registration & Verification
- Users register as **Donors** or **Volunteers**.
- **Live photo capture** using **Face API** for identity verification.
- Donors also take a **live photo with their donations** for authenticity.

### 💸 Cash Donation Module
- Donate directly to **fund requests** or make **quick donations**.
- Choose **cause**, **chapter**, and **payment method** (Gcash, PayPal, Credit Card, Bank Transfer).
- Upload **proof of payment** and enter **transaction reference** (mock payment gateway, no real deductions).
- Track donations by status: `pending`, `received`, `ongoing`, `distributed`.

### 📦 In-Kind Donation Module
- Donate based on **specific requests** or **quick causes**.
- Track items by **category**, **cause**, and **expiration status** (`good`, `near_expired`, `expired`, `no_expiration`).
- Admins can create donation requests with **location**, **urgency**, **proof images/video**, and **validity date**.

### 👨‍⚕️ Volunteer Management
- Volunteers register with availability and preferred services.
- Can be assigned to tasks.
- If a volunteer declines a task, it’s automatically posted as a **public event**.
- Volunteers can view and opt in to these events.
- Logged in `volunteer_activity` table and tied to `event` if applicable.

### 📍 Geomapping
- Locations (user, chapter, request) are stored with **latitude/longitude**.
- Map UI (Leaflet) can visualize:
  - Request locations
  - Pin point based on the cause of request
  - Chapter offices
  - Volunteer or pickup addresses

### 📊 Admin Dashboard
- Manage:
  - Requests (in-kind & cash) with **validity date**
  - Donor and volunteer accounts (with active/inactive status)
  - Donation tracking and verification
  - Inventory in **Pooled Resources** and **Pooled Funds**
  - Distribution records
  - Chapters and news updates


### 📱 SMS Notifications
- Donors receive SMS alerts for:
  - Thank you message upon registration
  - Account is activated after verification
  - Successful donation submission
  - Admin approval or status update (e.g., received, distributed)
  - Reminders for pickup/drop-off schedule

### 📧 Email Notifications
- Donors receive email confirmations and updates:
  - Welcome email upon registration
  - Account is activated after verification
  - Proof and tracking number confirmation
  - Summary of donation (items/cash, chapter, cause)
- Admins are notified of:
  - New donation submissions
  - Volunteer sign-ups and confirmations

---

## 🗂️ Technologies Used
- Blade
- PHP (Laravel) 
- MySQL (Database)
- JavaScript (jQuery, AJAX)
- HTML5/CSS3 (Bootstrap 5)
- Face API (for live photo verification)
- Leaflet.js (for geomapping)
- API SMS
- Other Javascript Libraries

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
