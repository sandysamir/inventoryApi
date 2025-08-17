# inventoryApi
=======
# Laravel Stock Management System

## Project Overview

This project is a **Stock Management System** built with **Laravel 9**, designed to manage inventory items across multiple warehouses. It supports:

- Stock transfers between warehouses.
- Prevention of over-transfer (cannot transfer more than available stock).
- Low stock detection with events and notifications.
- Unit and feature tests for stock logic, transfers, and events.

---

## Features Implemented

1. **Models and Migrations**
   - `Warehouse`: Stores warehouse details (name, location).
   - `InventoryItem`: Stores item metadata (name, SKU, price).
   - `Stock`: Links `InventoryItem` to `Warehouse` with quantity and reorder threshold.
   - `StockTransfer`: Logs all stock transfer activities.

2. **Stock Transfer Logic**
   - Transfers stock from one warehouse to another.
   - Validates available stock before transfer.
   - Updates quantities in both warehouses.
   - Fires `LowStockDetected` event if stock falls below `reorder_threshold`.

3. **Events and Listeners**
   - `LowStockDetected` event is dispatched when stock is low.
   - `SendLowStockNotification` listener is queued for notification purposes.

4. **Testing**
   - **Unit Test**: Tests stock over-transfer logic.
   - **Feature Test**: Tests successful stock transfer and API response.
   - **Event Test**: Ensures `LowStockDetected` is fired and listener is queued.

---

## Installation & Setup

Follow these steps to get the project running locally:
php artisan migrate

# 7. Optional: Seed the database
php artisan db:seed

# 8. Start the development server
php artisan serve

# 9. Run all tests (unit, feature, event)
php artisan test

