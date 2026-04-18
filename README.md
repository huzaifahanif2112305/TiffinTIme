<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
# DesiDhaba

DesiDhaba is a Smart Tiffin Service System - a centralized web application designed to connect customers with local tiffin service providers offering home-cooked meals. The platform simplifies daily meal management for students, office workers, and families by offering affordable, hygienic, and customizable tiffin plans.

## Features

- **Seller Panel**: Allows tiffin service providers (home-based chefs) to register, log in, upload daily menus with prices, and manage their offerings.
- **Buyer Interface**: Customers can browse available tiffin providers, compare menus and prices, place orders, and manage subscriptions with ease.
- **Menu Management**: Sellers can add and update daily menus with details such as dishes, pricing, descriptions, and images.
- **Order Management**: Track order status from placement to delivery with real-time updates.
- **Authentication**: Secure user authentication for customers, tiffin providers, and administrators with separate login and registration forms.
- **Rating & Reviews**: Customers can rate and review tiffin providers and dishes.
- **Responsive Design**: Fully responsive UI for an optimal experience across all devices.

## Tech Stack

- **Backend**: Laravel (PHP)
- **Frontend**: HTML, CSS, JavaScript
- **Database**: MySQL
- **File Storage**: Local or cloud storage for service images
- **Authentication**: Laravel built-in authentication system

## Installation

To get started with the project locally:

1. Clone the repository:

   ```bash
   git clone https://github.com/yourusername/DesiDhaba.git
   
2. Navigate the Project Directory
   ```bash
   cd DesiDhaba
3. Install require Dependensies
   ```bash
   composer install
4. Set up .env file
   ```bash
   cp .env.example .env
5. Run Database Migrations
   ```bash
   php artisan migrate
6. now run the application
   ```bash
   php artisan serve

Now you should be able to access the application at http://localhost:8000.

Usage
Seller (Tiffin Provider):

- Register and log in to the seller panel
- Upload daily menus with dishes, prices, and images
- View and manage orders from customers
- Track customer ratings and feedback

Buyer (Customer):

- Browse available tiffin service providers
- View detailed information about menus and dishes
- Place orders and manage subscriptions
- Rate and review tiffin providers and meals

Admin:

- Manage all users (customers and sellers)
- Approve or reject seller registrations
- Monitor all orders and handle complaints