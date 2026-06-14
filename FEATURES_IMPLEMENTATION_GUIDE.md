# Rescheduling & Analytics Features - Implementation Guide

## Quick Start

The following features have been implemented:

### 1. Appointment Rescheduling (User & Admin)
### 2. Profit & Cost Tracking System  
### 3. Sales & Profit Analytics with Trend Graphs

---

## Database Migrations Applied

✅ `2026_06_14_082000_add_cost_price_to_inventory_items_table`
- Added `cost_price` and `selling_price` to inventory_items

✅ `2026_06_14_082005_create_appointment_reschedules_table`
- New table to track all reschedule events
- Stores: appointment_id, rescheduled_by, original_date, new_date, reason, reschedule_type, notes

✅ `2026_06_14_082006_add_reschedule_reason_to_appointments_table`
- Added `cancellation_reason`, `reschedule_count`, `is_rescheduled` to appointments

✅ `2026_06_14_082008_create_repair_items_table`
- New table to track parts used in repairs
- Stores: appointment_id, inventory_item_id, quantity, cost_price, selling_price, totals

✅ `2026_06_14_082010_add_service_cost_to_appointments_table`
- Added `service_cost`, `parts_cost`, `total_cost`, `profit` to appointments

---

## Models Created/Updated

### New Models
1. **AppointmentReschedule** - Tracks reschedule history
2. **RepairItem** - Tracks parts used per repair

### Updated Models
1. **Appointment** 
   - Added relationships: `reschedules()`, `repairItems()`
   - Added method: `calculateProfit()`
   - New fillable fields: service_cost, parts_cost, etc.

2. **InventoryItem**
   - Added: `cost_price`, `selling_price` fillables

---

## Livewire Components

### User Components

**RescheduleAppointment** (User)
- Located: `app/Livewire/User/RescheduleAppointment.php`
- View: `resources/views/livewire/user/reschedule-appointment.blade.php`
- Features:
  - Users can reschedule their own appointments
  - Pick new date and time
  - Provide reason for reschedule
  - Track reschedule history
  - Limit: 3 reschedules per appointment

### Admin Components

**RescheduleManagement** (Admin)
- Located: `app/Livewire/Admin/RescheduleManagement.php`
- View: `resources/views/livewire/admin/reschedule-management.blade.php`
- Features:
  - Manage all reschedule requests
  - Filter by: All, Reschedulable, Rescheduled, No-Show
  - Search by customer name or booking number
  - Mark appointments as No-Show
  - Reschedule for different reasons:
    - user_no_show
    - technician_unavailable
    - admin_initiated
  - Bulk management actions

**ReportsAnalyticsEnhanced** (Admin)
- Located: `app/Livewire/Admin/ReportsAnalyticsEnhanced.php`
- View: `resources/views/livewire/admin/reports-analytics-enhanced.blade.php`
- Features:
  - **Timeframe Options**: Daily, Weekly, Monthly, Yearly
  - **Sales Metrics**: Total sales, service charges, parts costs
  - **Profit Tracking**: Calculate profit = final_cost - (service_cost + parts_cost)
  - **Charts**:
    - Sales Trend Line Chart
    - Profit Trend Line Chart
    - Repair Status Distribution (Doughnut)
    - Service Type Trends (Bar Chart)
  - **Inventory Metrics**: Total value, costs, potential profit, low stock alerts

---

## How to Use

### For Users - Reschedule Appointment

1. Go to their appointments list
2. Find appointment to reschedule
3. Click "Reschedule" button
4. Select new date and time (must be after today)
5. Optionally provide reason
6. Confirm reschedule

### For Admin - Manage Reschedules

1. Go to Admin Dashboard → Reschedule Management
2. View all pending reschedules
3. Use filters to find specific appointments
4. Click "Reschedule" to open reschedule dialog
5. Select reason type:
   - User No-Show
   - Technician Unavailable
   - Admin Initiated
6. Choose new date/time
7. Add notes if needed
8. Confirm

### For Admin - View Sales & Profit Analytics

1. Go to Admin Dashboard → Reports & Analytics (Enhanced)
2. Select timeframe: Daily, Weekly, Monthly, or Yearly
3. View key metrics:
   - Total Sales (revenue)
   - Total Costs (service + parts)
   - Total Profit (margin %)
4. Analyze charts:
   - Sales vs Profit trends
   - Repair status distribution
   - Service type breakdown
5. Monitor inventory metrics

---

## Important Setup Notes

### For Profit Calculations to Work:

1. **Set Cost Prices for Inventory**
   - Go to Inventory Management
   - Edit each item to set `cost_price`
   - This is the purchase cost
   - `selling_price` is the selling price

2. **When Creating Repairs**
   - Admin must record:
     - Service cost (labor/diagnostics)
     - Parts used (from RepairItem table)
     - Final cost (charged to customer)
   - System will auto-calculate profit

3. **Service Cost Entry**
   - During appointment completion
   - Admin enters labor cost
   - System calculates: profit = final_cost - (service_cost + parts_cost)

---

## Routes to Add (if not auto-registered)

```php
// User routes
Route::get('/reschedule/{appointment}', RescheduleAppointment::class)->name('reschedule');

// Admin routes
Route::get('/admin/reschedules', RescheduleManagement::class)->name('admin.reschedules');
Route::get('/admin/analytics', ReportsAnalyticsEnhanced::class)->name('admin.analytics');
```

---

## Example Profit Calculation

```
Example: LCD Screen Repair

Purchase Cost (cost_price): ₱400
Selling Price (selling_price): ₱800
Service Cost (labor): ₱200
Final Cost Charged: ₱1,500

Parts Profit: ₱800 - ₱400 = ₱400
Service Profit: ₱200
Total Cost: ₱600
Total Profit: ₱1,500 - ₱600 = ₱900
Profit Margin: 60%
```

---

## Testing the Features

```bash
# Test reschedule
php artisan make:test RescheduleAppointmentTest

# Run migrations if not yet applied
php artisan migrate

# Seed test data (optional)
php artisan db:seed
```

---

## Future Enhancements

1. Email notifications for rescheduled appointments
2. SMS notifications to customers
3. Automated no-show reminders
4. Technician availability calendar
5. Export reports to PDF/Excel
6. Advanced filtering for analytics
7. Prediction models for sales trends
8. Customer satisfaction metrics
9. Commission tracking for technicians
10. Seasonal trend analysis
