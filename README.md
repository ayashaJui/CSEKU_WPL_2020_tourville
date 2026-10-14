<div align="center">

# Tourville

**A tourism management platform for discovering, booking, and managing travel packages.**

Tourists · Agencies · Administrators — all in one place.

[![Watch the Demo](https://img.shields.io/badge/▶_Watch_Demo-FF0000?style=for-the-badge&logo=youtube&logoColor=white)](https://www.youtube.com/watch?v=jrAbrGvxJOE)
[![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-MariaDB-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![Stripe](https://img.shields.io/badge/Stripe-Payments-635BFF?style=for-the-badge&logo=stripe&logoColor=white)](https://stripe.com/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-4-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)

</div>

---

## Overview

**Tourville** is a web-based tourism management system built with **PHP** and **MySQL**.
It connects three types of users through dedicated, role-based portals:

- **Tourists** browse and book tour packages from different agencies and pay online.
- **Agencies** publish packages, set travel dates and pricing, and manage bookings and staff.
- **Administrators** approve accounts and oversee the entire platform.

> **Note:** A live hosted demo is no longer available.
> Watch the full walkthrough on YouTube: **https://www.youtube.com/watch?v=jrAbrGvxJOE**

## Table of Contents

- [Features](#features)
- [Tech Stack](#tech-stack)
- [Architecture](#architecture)
- [Getting Started](#getting-started)
- [Demo accounts](#demo-accounts)
- [Database](#database)
- [Notes](#notes)
- [Authors](#authors)

## Features

<table>
<tr>
<th align="left">Tourist</th>
<th align="left">Agency</th>
<th align="left">Administrator</th>
</tr>
<tr valign="top">
<td>

- Register / log in (admin approval)
- Search and browse packages
- View agency profiles
- Book with travel-style tiers
- Pay online via Stripe
- Booking history & profile
- Reviews and comments

</td>
<td>

- Register / log in (admin approval)
- Owner, Manager, Staff roles
- Analytics dashboard + charts
- Manage packages & pricing
- Manage travel dates
- Manage employees
- Bookings, payments, reviews

</td>
<td>

- Platform-wide dashboard
- Approve agencies & tourists
- Manage admins
- Manage packages
- View payments, reviews, comments

</td>
</tr>
</table>

### Travel styles

Each package defines three pricing tiers — **Budget**, **Comfortable**, and **Luxury** —
and tourists can pay the full amount, half, or just the booking-percentage deposit.

## Tech Stack

| Layer | Technologies |
| :--- | :--- |
| **Front-end** | HTML, CSS, JavaScript, Bootstrap 4, jQuery |
| **Back-end** | PHP (PDO with prepared statements) |
| **Database** | MySQL / MariaDB |
| **Payments** | Stripe (`stripe/stripe-php`) |
| **Libraries** | Google Charts, CKEditor 5, AOS, Font Awesome |

## Architecture

```
tourville/
├── index.php                  Landing page (video hero + top-rated agencies)
├── agencies.php / agency.php  Agency listing & detail
├── packages.php / package.php Package listing & detail
├── search.php                 Search results
├── booking.php                Booking entry point
├── payment.php / charge.php   Stripe payment flow
├── mybookings.php  profile.php  success.php
│
├── admin/                     Administrator dashboard
├── agency/                    Agency dashboard
├── tourist/                   Tourist registration & booking handlers
│
├── includes/                  DB connection, helpers, auth, flash messages
├── layouts/                   Shared header, navbar, footer
├── css/  js/                  Front-end assets
├── database/tourism_db.sql    Schema + seed data
└── composer.json              PHP dependencies
```

## Getting Started

### Quick Start

```bash
# 1. Place this folder in your web server root (e.g. htdocs/tourville), then:
composer install                                    # install PHP dependencies
mysql -u root -p -e "CREATE DATABASE tourism_db;"
mysql -u root -p tourism_db < database/tourism_db.sql
copy config\api_key.example.php config\api_key.php  # then paste your own Stripe test keys

# 2. Open http://localhost/tourville/ and log in with a demo account below.
```

Detailed steps follow.

### Prerequisites

| Requirement | Version |
| :--- | :--- |
| PHP | 7.4 or newer |
| MySQL / MariaDB | 5.7+ / 10.4+ |
| Composer | Latest |
| Web server | XAMPP, WAMP, Laragon, or similar |

### 1. Clone the project

```bash
git clone <your-repo-url> tourville
cd tourville
```

Place it inside your web server root (for example `htdocs/tourville`).

### 2. Create and import the database

```bash
mysql -u root -p -e "CREATE DATABASE tourism_db;"
mysql -u root -p tourism_db < database/tourism_db.sql
```

Or import `database/tourism_db.sql` using phpMyAdmin.

### 3. Install dependencies

```bash
composer install
```

### 4. Configure the database

The app reads DB settings from (in order of precedence): environment variables,
then `config/db.php`, then built-in defaults.

```bash
copy config\db.example.php config\db.php     # Windows
cp config/db.example.php config/db.php       # Linux / macOS
```

Then edit `config/db.php` if your setup differs from the defaults:

```php
$host     = 'localhost';
$port     = 3306;
$db       = 'tourism_db';
$user     = 'root';
$password = '';
```

### 5. Configure Stripe

The `config/` directory is git-ignored, so the key file is **not** in the repo.
Recreate it from the template:

```bash
copy config\api_key.example.php config\api_key.php   # Windows
cp config/api_key.example.php config/api_key.php     # Linux / macOS
```

Then paste your Stripe keys into `config/api_key.php`. Get them from:

```
https://dashboard.stripe.com/test/apikeys
```

```php
define('STRIPE_KEY', 'sk_test_...');          // secret — server-side only
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_...');
```

Also make sure the publishable key in `js/stripe.js` matches.

### 6. Run the app

Start Apache and MySQL, then open:

```
http://localhost/tourville/
```

### Demo accounts

The database dump ships ready-to-use accounts (all already `approved`):

| Role | Email | Password |
| :--- | :--- | :--- |
| Administrator | `admin@gmail.com` | `admin123` |
| Agency (owner) | `george@gmail.com` | `123456` |
| Tourist | `john@gmail.com` | `123456` |

- **Admins cannot self-register.** An admin only exists via this seed, or when an
  existing admin adds one (Admin → Admins → Add Admin).
- **Agency login:** choose role **Owner** on the login page.
- Passwords are bcrypt hashes — change them for any real deployment.
- The seeded tourist's stored Stripe customer belongs to the original (now deleted)
  Stripe account, so to actually make a payment, **register a new tourist** using
  your own Stripe test keys.

## Database

The schema is defined in [`database/tourism_db.sql`](database/tourism_db.sql):

```
admins            agencies          agency_employees
bookings          comments          packages
package_dates     payments          reviews
tourists
```

## Notes

- Built on an older PHP / Bootstrap stack; kept mainly as a learning and reference project.
- Never commit real database credentials or Stripe secret keys.

## Authors

**Ayasha Jui** · **Samia Shorna**

Khulna University — Computer Science & Engineering

<div align="center">

Made as a university web programming lab project.

</div>
