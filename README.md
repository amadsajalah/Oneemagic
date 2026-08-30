<div align="center">

# 🎩✨ OneeMagic
**Interactive Magician Booking Platform & Portfolio**

*Where Illusions Become Reality. Book world-class magicians, explore mind-bending portfolios, and experience the Magic Lab.*

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Midtrans](https://img.shields.io/badge/Midtrans-00A5CF?style=for-the-badge&logo=midtrans&logoColor=white)](https://midtrans.com)
[![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)

</div>

---

## 🪄 The Magic (Features)

Welcome to the digital stage of **OneeMagic**. This platform is not just a booking system; it's a digital experience designed to wow audiences before the real show even begins.

*   **🔮 The Magic Lab**: An interactive 3D CSS illusion gallery where users can hover over cards to reveal secrets and tricks.
*   **📅 Seamless Booking System**: Book a magician for your event with a few clicks. Choose your date, location, and let the magic happen.
*   **💳 Automated Payments**: Integrated with **Midtrans Payment Gateway** for secure, instant, and automated payment confirmations (GoPay, QRIS, Virtual Accounts).
*   **📜 Magic Journal & Portfolio**: A beautifully crafted gallery showcasing past performances, levitations, mind readings, and more.
*   **🎭 Two Realms (Roles)**: 
    *   **Spectators (Users)**: Can explore, book, pay, and message the admin.
    *   **The Illusionist (Admin)**: Full control over the stage. Manage bookings, upload portfolios, write journals, and approve payments.

---

## 🔮 Technologies Behind The Illusion

This project is forged using modern web development spells:

- **Backend**: Laravel 11.x (PHP 8.2)
- **Frontend**: Blade Templates, Tailwind CSS (Custom Dark/Glassmorphism theme), Alpine.js
- **Database**: MySQL
- **Payment Gateway**: Midtrans (Snap API & Webhooks)
- **Architecture**: MVC (Model-View-Controller)

---

## 📜 Grimoire (Installation Guide)

Want to run this magic show on your local machine? Follow these incantations:

### 1. Clone the Spellbook
```bash
git clone https://github.com/amadsajalah/Oneemagic.git
cd Oneemagic
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup the Environment
Copy the `.env.example` file to `.env` and configure your database and Midtrans credentials.
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Migrate the Database
Run the migrations and seeders to summon the initial data (Admin account & Magic Lab categories).
```bash
php artisan migrate --seed
```

### 5. Compile Assets & Start the Show
```bash
npm run build
php artisan serve
```
Visit `http://127.0.0.1:8000` to witness the magic! 🎩

---

## 📐 System Architecture (The Blueprints)

The hidden mechanics behind the platform can be found in our comprehensive documentation diagrams (ERD, DFD, Use Case, CDM/PDM). 

👉 **[View Diagram Documentation](diagram_documentation.md)**

---

<div align="center">
  <i>"Those who don't believe in magic will never find it."</i><br>
  <b>Developed by amadsajalah</b>
</div>
