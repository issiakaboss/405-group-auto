# 405 Group Auto — Project Guide

## Overview

This repository is a Laravel 13 dealership inquiry application tailored to a US-focused vehicle sales workflow. The app has been adapted from a payment-first checkout flow into a lead generation and inquiry flow where users browse inventory, add vehicles to a session cart, and submit complete shopping selections as purchase inquiries or appointment requests.

## Current business model

- Public catalog and vehicle detail pages
- Cart retained as a selection/inquiry list
- No online payment gateway
- US-only access restriction via middleware and request headers
- Custom vehicle request storage for vehicles users cannot find
- Admin page for reviewing incoming requests

## Tech stack

- PHP 8.3
- Laravel 13
- Tailwind CSS
- Vite
- Spatie Permission
- MySQL or SQLite for local tests

## Important domain changes

### Vehicle data contract

The vehicle model now follows a modern dealership-style schema:

- `make`
- `model`
- `trim`
- `year`
- `mileage`
- `vehicle_type`
- `body_style`
- `exterior_color`
- `interior_color`
- `fuel_type`
- `transmission`
- `has_clean_title`
- `money_still_owed`
- `location`
- `status`
- `price`
- `images`

The legacy `category` field is no longer the primary source of truth. Where older views still send or display `category`, the app now resolves from `vehicle_type` safely.

### Enums

Enum-backed states live under:

- `app/Models/Enums/`

Examples:

- `VehicleStatus`
- `VehicleLocation`
- `VehicleType`
- `FuelType`
- `Transmission`
- `BodyStyle`
- `VehicleColor`
- `MoneyOwedStatus`

## Main routes

- `/` — home/catalog
- `/cars/{vehicle}` — vehicle detail
- `/cart` — current inquiry cart
- `/favorites` — saved favorites
- `/about` and `/contact` — unified contact/about page
- `/admin/vehicle-requests` — admin incoming request list

## Important files

- `app/Models/Vehicle.php` — main vehicle domain model
- `app/Http/Controllers/VehicleController.php` — catalog and request submission
- `app/Http/Controllers/CartController.php` — inquiry cart behavior
- `app/Http/Middleware/GeoUsRestriction.php` — US visitor restriction
- `database/migrations/2026_06_01_163040_create_vehicles_table.php` — base vehicle schema
- `database/migrations/2026_08_05_000002_create_vehicle_requests_table.php` — custom request storage
- `resources/views/welcome.blade.php` — public landing page
- `resources/views/vehicles/show.blade.php` — vehicle detail page
- `resources/views/admin/vehicle-requests/index.blade.php` — admin request list

## Common runtime pitfall

Blade views must not assume every enum-backed value is already a typed object. Some rows may still emit a raw string from the DB. Always resolve safely like this:

```php
$statusEnum = $vehicle->status instanceof \App\Models\Enums\VehicleStatus
    ? $vehicle->status
    : \App\Models\Enums\VehicleStatus::tryFrom($vehicle->status);
```

## Local setup and verification

Run the following from the project root:

```bash
composer install
npm install
php artisan migrate:refresh --seed
npm run build
php artisan serve
```

## Verification notes

The database migration and seed refresh are the key proof that the schema is aligned with the new business model. If a page throws an exception, inspect whether the view is still using the legacy `category` assumption or calling `->label()` on a string instead of an enum object.
