# 🎯 Quick Start - Where to Find Everything

## 📊 Access the Reports with Sales & Profit Analytics

### URL
```
http://127.0.0.1:8000/admin/reports
```

### Menu Path
```
Admin Dashboard → Sidebar → Reports & Analytics
```

---

## 🎨 What You'll See

### Layout (Top to Bottom)

```
┌────────────────────────────────────────────────────────────────┐
│  Reports & Analytics Dashboard                                 │
├────────────────────────────────────────────────────────────────┤
│                                                                  │
│  [Daily] [Weekly] [Monthly] [Yearly] ← Click to switch         │
│                                                                  │
│  ┌──────────────────────────────────────────────────────────┐  │
│  │ 💰 Total Sales: ₱15,500 │ Costs: ₱8,200 │ Profit: ₱7,300 │  │
│  │ Service Charge: ₱5,000  │ Parts Cost: ₱3,200               │  │
│  └──────────────────────────────────────────────────────────┘  │
│                                                                  │
│  ┌─────────────────────────────┬─────────────────────────────┐  │
│  │ Sales vs Costs (Bar Chart)  │  Profit Trend (Line Chart)  │  │
│  │                             │                              │  │
│  │  ████ ████ ████            │  ╱╲  ╱╲  ╱╲                 │  │
│  │  ████ ████ ████            │ ╱  ╲╱  ╲╱  ╲               │  │
│  └─────────────────────────────┴─────────────────────────────┘  │
│                                                                  │
│  + [Existing Charts Below]                                      │
│  - Revenue Trend, Repair Status, Service Types                 │
│                                                                  │
└────────────────────────────────────────────────────────────────┘
```

---

## 📁 File Structure

### Components (Updated/Created)
```
app/Livewire/Admin/
├── Reports.php ⭐ UPDATED - Added profit/sales calculation methods
├── RescheduleManagement.php ✅ NEW
└── ReportsAnalyticsEnhanced.php ✅ NEW (Optional - separate analytics)

app/Livewire/User/
└── RescheduleAppointment.php ✅ NEW
```

### Views (Updated/Created)
```
resources/views/livewire/admin/
├── reports.blade.php ⭐ UPDATED - Added sales/profit section + charts
├── reschedule-management.blade.php ✅ NEW
└── reports-analytics-enhanced.blade.php ✅ NEW (Optional)

resources/views/livewire/user/
└── reschedule-appointment.blade.php ✅ NEW
```

### Models (Created)
```
app/Models/
├── AppointmentReschedule.php ✅ NEW
└── RepairItem.php ✅ NEW
```

### Migrations (Applied)
```
database/migrations/
├── 2026_06_14_082000_add_cost_price_to_inventory_items_table
├── 2026_06_14_082005_create_appointment_reschedules_table
├── 2026_06_14_082006_add_reschedule_reason_to_appointments_table
├── 2026_06_14_082008_create_repair_items_table
└── 2026_06_14_082010_add_service_cost_to_appointments_table
```

---

## 🚀 The Key Integration Point

**Main Change**: `/admin/reports` now displays sales and profit data!

```php
// app/Livewire/Admin/Reports.php

public function render()
{
    // New methods added:
    $salesAndProfitData = $this->getSalesAndProfitData($this->timeframe);
    $profitTrend = $this->getProfitTrend();
    $revenueTrendWithCosts = $this->getRevenueTrendWithCosts();
    
    // These are passed to the view for display
}
```

---

## 📊 The Three Analytics Features

### Feature 1: Appointment Rescheduling ✅
**User Can**:
- Reschedule own appointments (URL-based access)
- Select new date/time
- Provide reason

**Admin Can**:
- Manage all reschedules at `/admin/reschedules`
- Filter by status
- Mark as No-Show
- Reschedule with custom reason

### Feature 2: Profit & Cost Tracking ✅
**Database**:
- `cost_price` and `selling_price` in inventory
- `service_cost` and `parts_cost` in appointments
- `repair_items` table for detailed tracking

**Formula**:
```
Profit = Final Cost - (Service Cost + Parts Cost)
```

### Feature 3: Sales & Profit Analytics ✅
**Location**: Integrated in `/admin/reports`

**Shows**:
- Timeframe selector (Daily/Weekly/Monthly/Yearly)
- 5 metric cards
- 2 new charts (Sales vs Costs, Profit Trend)
- All metrics update reactively

---

## 💡 How to Use

### Step 1: Configure Inventory
```
Admin → Inventory Management
- For each item, set:
  • cost_price (what you paid)
  • selling_price (what you charge)
```

### Step 2: Record Repair Data
```
When completing appointment, record:
- Service cost (labor)
- Parts used (from inventory)
- Final cost (customer charge)
```

### Step 3: View Analytics
```
Admin → Reports & Analytics
- Select timeframe: Daily/Weekly/Monthly/Yearly
- See all metrics and charts
```

---

## 📈 Example Metrics Card

```
┌─────────────────────────────┐
│  💰 Total Sales              │
│                              │
│  ₱15,500                     │
│  (from 12 repairs)           │
│                              │
│  ┌─ Total Costs: ₱8,200      │
│  │  - Service: ₱5,000        │
│  │  - Parts:   ₱3,200        │
│  │                           │
│  └─ Profit: ₱7,300 (47.1%)   │
└─────────────────────────────┘
```

---

## 🔧 Technical Details

### Profit Calculation Query
```php
$query->selectRaw('
    SUM(final_cost) as sales,
    SUM(service_cost + parts_cost) as total_costs,
    SUM(final_cost) - SUM(service_cost + parts_cost) as profit
')
```

### Timeframe Grouping
```
Daily:   Last 7 days (groupBy day)
Weekly:  Last 12 weeks (groupBy week)
Monthly: Last 12 months (groupBy month)
Yearly:  Last 5 years (groupBy year)
```

### Chart Libraries
- Chart.js v4.4.0 (via CDN)
- Responsive design
- Automatic updates on timeframe change

---

## ✅ Verification

All changes verified:
- ✅ PHP syntax check passed
- ✅ Laravel config cache successful
- ✅ Database migrations applied
- ✅ Livewire components created
- ✅ Views updated with new sections
- ✅ Charts rendering with Chart.js
- ✅ Responsive design implemented

---

## 🎯 What's Different from Original

| Feature | Before | After |
|---------|--------|-------|
| Sales Data | Not available | ✅ Displayed in cards + charts |
| Profit Data | Not available | ✅ Calculated & displayed |
| Cost Breakdown | Not available | ✅ Service + Parts separated |
| Analytics | Basic only | ✅ Multi-timeframe with trends |
| Reports Page | Static data | ✅ Dynamic, reactive updates |

---

## 🚨 Important Notes

1. **For Accurate Profit Data**:
   - Set `cost_price` for all inventory items
   - Record `service_cost` when completing repairs
   - Log parts used in `repair_items` table

2. **Timeframe Impact**:
   - All metrics and charts change when you switch timeframe
   - No page reload needed (Livewire handles it)

3. **Historical Data**:
   - Only shows completed appointments with final_cost > 0
   - Requires service_cost and parts_cost to be recorded

---

## 📞 Support

**If Charts Don't Show**:
1. Clear browser cache (Ctrl+Shift+Delete)
2. Check browser console (F12)
3. Verify Chart.js CDN is accessible

**If Profit is Zero**:
1. Verify inventory has cost_price
2. Check appointments have service_cost
3. Ensure repair_items has parts logged

**If Data is Missing**:
1. Verify appointments have status='completed'
2. Check final_cost is > 0
3. Clear config: `php artisan config:cache`

---

## 🎉 You're All Set!

Navigate to **Admin → Reports & Analytics** and start viewing your sales and profit data!

**Features Ready to Use**:
- ✅ Appointment Rescheduling
- ✅ Profit & Cost Tracking
- ✅ Sales & Profit Analytics (on Reports page)
