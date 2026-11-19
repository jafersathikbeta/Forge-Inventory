# Forge Inventory Management System

**Live Production URL:** [https://ams.itcoresolutions.in](https://ams.itcoresolutions.in)

A comprehensive, enterprise-grade Inventory and Order Management System built with Laravel. Developed as a full-scale solution for IT Core Solutions (deployed at `ams.itcoresolutions.in`), this system handles complex manufacturing supply chains, dynamic product compositions, and automated reporting.

## Core Features

- **Strict Role-Based Access Control (RBAC):** Utilizes Spatie Permissions with granular control (e.g., `permission:users.ownership.transfer`, `role:Super Admin`).
- **Advanced Bill of Materials (BOM):** 
  - Products can be linked to raw materials or composite materials.
  - Includes an algorithmic `computeExpandedRequirements` engine that dynamically flattens composite materials into their raw constituent requirements multiplied by the product quantity.
- **Order & Stock Management:** 
  - Real-time stock logging with transactional database safety (`DB::transaction`).
  - Order processing with automated stock deductions.
- **Automated PDF Reporting & Telegram Integration:** 
  - Generates daily PDF reports.
  - A custom `TelegramService` pushes text alerts and attaches generated PDF documents directly to administrators via the Telegram Bot API.
- **Ownership Transfer:** Secure feature allowing Super Admins to transfer system ownership (`users.ownership.transfer`).

## Architecture

- **Framework:** Laravel (PHP 8+)
- **Database:** MySQL (Eloquent ORM, Pivot tables for BOM)
- **Authentication:** Laravel Breeze
- **Authorization:** Spatie Laravel-Permission
- **Integrations:** Telegram Bot API (via Laravel HTTP Client)

## Note

This repository contains the application source code (controllers, models, services, migrations, views) of a client project deployed to production. Laravel scaffolding files (composer.json, artisan, package.json, .env.example) are not included, so it is not intended to be run directly from this repo.
- **Frontend:** Blade Components, Tailwind CSS
