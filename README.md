# 🛍️ Modern E-Commerce Platform (Laravel)

A fully functional, open‑source e‑commerce web application built with **Laravel 12**, **Blade**, **Tailwind CSS (CDN)**, and **MySQL**.  
Designed as a real‑world learning project, it simulates a complete online shop – from product browsing to payment – with a special focus on Myanmar payment gateways.

> **Status:** MVP – Ready for demonstration, learning, and further customization.

---

## ✨ Features

### 🧑‍💼 User Features

- **User Registration & Login** – Manual authentication (no starter kit).
- **Product Catalog** – Browse products, filter by category, search by name/category.
- **Product Detail** – View details, images, and stock info.
- **Shopping Cart** – Session‑based cart with quantity control and expiration.
- **Checkout** – Place an order (stock is reserved immediately).
- **Payment Simulation** – Choose between **KBZ Pay**, **Wave Pay**, **AYA Pay**, or **Bank Transfer** (visual cards, no real money).
- **Order History** – See all orders (pending, paid, cancelled).
- **Cancel Order** – Cancel pending orders (stock is restored).

### 🛡️ Admin Features

- **Role‑based Authorization** – Separate `admin` role with custom middleware.
- **Admin Dashboard** – Monitor all orders (customer, total, status, payment method).
- **Product CRUD** – Create, read, update, delete products.
- **Image Upload** – Upload product images (stored locally).
- **Category Management** – Pre‑seeded categories (Electronics, Books, Clothing).

### 🧠 Smart Inventory Logic

- Stock is deducted **immediately** when an order is placed (prevents overselling).
- **Auto‑cancellation** of unpaid orders after a configurable time (scheduler).
- **Cart expiration** – Items older than 24 h are removed automatically.
- **“Sold Out”** badge and disabled cart button when stock hits zero.
- Per‑user cart isolation (guest cart merges on login).

### 🎨 UI / UX

- Clean, **black‑and‑white minimalist design**.
- Fully responsive (mobile hamburger menu).
- **Tailwind CSS via CDN** (no build step required).
- Smooth hover animations on product cards.
- Home page carousel of popular products (Alpine.js).

---

## 🚀 Tech Stack

- **Backend:** Laravel 12, PHP 8.2+
- **Frontend:** Blade, Tailwind CSS (CDN), Alpine.js
- **Database:** MySQL
- **Session Storage:** File (or database)
- **Authentication:** Manual (custom AuthController)
- **Scheduling:** Laravel Scheduler (for order auto‑cancel)

---

## 📦 Installation (Local Development)

### Prerequisites

- PHP ≥ 8.2
- Composer
- MySQL
- Node.js & npm (only for optional Vite build; not required if using Tailwind CDN)

### Step‑by‑Step

1. **Clone the repository**
    ```bash
    git clone https://github.com/your-username/your-repo.git
    cd your-repo
    ```
