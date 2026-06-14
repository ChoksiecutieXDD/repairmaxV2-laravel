# ✅ Sales & Profit Analytics Integrated into Reports Page

## Summary of Integration (June 14, 2026)

The enhanced sales and profit analytics features have been **integrated directly into the existing Reports page** at `/admin/reports`. Users no longer need a separate analytics page - everything is now in one consolidated dashboard.

---

## What's New on Reports Page

### 1. **Timeframe Selector**
Located at the top of the page, allows switching between:
- **Daily** - Last 7 days trend
- **Weekly** - Last 12 weeks trend
- **Monthly** - Last 12 months trend
- **Yearly** - Last 5 years trend

### 2. **Sales & Profit Metric Cards** (5 Cards)
Displays key financial metrics based on selected timeframe:

| Card | Metric | Calculation |
|------|--------|-------------|
| **Total Sales** | Total revenue from completed repairs | SUM(final_cost) |
| **Total Costs** | Service + Parts costs combined | SUM(service_cost + parts_cost) |
| **Total Profit** | Sales minus total costs | SUM(final_cost) - SUM(costs) |
| **Service Charge** | Labor/service costs only | SUM(service_cost) |
| **Parts Cost** | Inventory parts used | SUM(parts_cost) |

Each card also shows:
- Profit margin percentage (for profit card)
- Number of completed repairs (for sales card)
- Cost breakdown (for costs cards)

### 3. **New Charts**
Two additional charts have been added:

#### **Sales vs Costs Chart** (Bar Chart)
- Shows sales and costs side-by-side
- Green bars = Sales (revenue)
- Red bars = Costs (expenses)
- Easy to see profit at a glance (gap between bars)

#### **Profit Trend Chart** (Line Chart)
- Shows profit over time
- Purple line = Profit trend
- Helps identify profitable periods
- Timeframe changes with selector

### 4. **Existing Charts Still Available**
The original charts remain:
- Revenue Trend (7 days)
- Repair Status Distribution
- Service Type Trends

---

## How Profit is Calculated

The system uses this formula:

```
Profit = Final Cost - (Service Cost + Parts Cost)

Example:
LCD Screen Repair
- Final Cost (what customer pays): ₱1,500
- Service Cost (labor): ₱200
- Parts Cost (LCD purchase cost): ₱400
- Total Costs: ₱600

Profit = ₱1,500 - ₱600 = ₱900
Profit Margin = (₱900 / ₱1,500) × 100 = 60%
```

---

## Database Changes Required

### appointment_reschedules Table
Tracks all appointment reschedule events for audit trail.

### repair_items Table  
Records individual parts used in each repair for accurate cost tracking.

### Updated appointment Table
New columns added:
- `service_cost` - Labor cost for the repair
- `parts_cost` - Cost of parts used
- `total_cost` - service_cost + parts_cost
- `profit` - Calculated profit
- `reschedule_count` - Number of times rescheduled
- `is_rescheduled` - Boolean flag
- `cancellation_reason` - Reason if cancelled

### Updated inventory_items Table
New columns added:
- `cost_price` - What you paid for the item
- `selling_price` - What you charge customers

---

## Setting Up for Accurate Reporting

### Step 1: Configure Inventory Costs
1. Go to Admin → Inventory Management
2. For each item, set:
   - **Cost Price**: Your purchase/acquisition cost
   - **Selling Price**: Your retail price
3. Save

Example:
```
Item: iPhone Screen Protector
- Cost Price: ₱50 (what you paid)
- Selling Price: ₱150 (what you charge)
```

### Step 2: Record Repair Costs
When creating/completing an appointment:
1. Set **Service Cost**: How much you charge for labor
2. Select **Parts Used**: Which inventory items were used
3. Set **Final Cost**: Total amount charged to customer

### Step 3: View Analytics
1. Go to Admin → Reports & Analytics
2. Select timeframe (Daily/Weekly/Monthly/Yearly)
3. View metrics and charts
4. Export if needed

---

## Example Report Output

**Daily Report (Sample)**
```
Date: June 14, 2026

Sales & Profit Metrics:
├─ Total Sales: ₱15,500 (from 12 repairs)
├─ Total Costs: ₱8,200
│  ├─ Service Charge: ₱5,000 (labor)
│  └─ Parts Cost: ₱3,200 (inventory)
├─ Total Profit: ₱7,300
└─ Profit Margin: 47.1%

Charts Show:
├─ Sales vs Costs: Bar chart showing ₱15,500 sales vs ₱8,200 costs
├─ Profit Trend: Line graph showing profits across previous days
├─ Status Distribution: Pie chart of pending/in-progress/completed repairs
└─ Service Types: Breakdown of phones/laptops/tablets repaired
```

---

## File Changes Made

### Updated Component
- `app/Livewire/Admin/Reports.php`
  - Added `$timeframe` property for switching between Daily/Weekly/Monthly/Yearly
  - Added `getSalesAndProfitData()` method - calculates sales, costs, profit
  - Added `getProfitTrend()` method - generates profit trend chart data
  - Added `getRevenueTrendWithCosts()` method - generates sales vs costs chart data
  - Updated `render()` method to pass new data to view

### Updated View
- `resources/views/livewire/admin/reports.blade.php`
  - Added timeframe selector buttons (Daily/Weekly/Monthly/Yearly)
  - Added 5 metric cards showing Sales, Costs, Profit, Service Charge, Parts Cost
  - Added Sales vs Costs bar chart
  - Added Profit Trend line chart
  - Updated JavaScript to render new charts with Chart.js

---

## Access the Feature

### URL
```
http://127.0.0.1:8000/admin/reports
```

### Menu Navigation
- Admin Dashboard → Reports & Analytics

### Features at a Glance
- ✅ Real-time sales tracking
- ✅ Profit calculations with margin %
- ✅ Cost breakdown (service vs parts)
- ✅ Multi-timeframe trends (daily/weekly/monthly/yearly)
- ✅ Visual charts (bar, line, doughnut)
- ✅ Export capability (existing feature)
- ✅ Responsive design (mobile-friendly)

---

## Important Notes

1. **Profit Requires Cost Data**
   - For accurate profit calculations, inventory items MUST have cost_price set
   - Appointments MUST have service_cost recorded
   - Parts used MUST be logged in repair_items table

2. **Historical Data**
   - Charts only show data from appointments with:
     - status = 'completed'
     - final_cost > 0
     - service_cost and parts_cost properly recorded

3. **Timeframe Switching**
   - All charts and metrics update automatically when changing timeframe
   - Page uses Livewire for reactive updates (no page reload)

4. **Performance**
   - For large datasets (thousands of appointments), consider adding date range filters
   - Current implementation groups by period (day/week/month/year) for efficiency

---

## Future Enhancements

- [ ] Date range picker for custom periods
- [ ] Department/technician specific reports
- [ ] Comparison with previous periods
- [ ] Export to PDF/Excel with charts
- [ ] Commission tracking by technician
- [ ] Customer segmentation analysis
- [ ] Seasonal trend predictions
- [ ] Inventory cost optimization

---

## Troubleshooting

### Charts not displaying?
1. Clear browser cache (Ctrl+Shift+Delete)
2. Check browser console for JavaScript errors (F12)
3. Verify Chart.js CDN is accessible: `https://cdn.jsdelivr.net/npm/chart.js@4.4.0`

### Profit showing zero?
1. Verify inventory items have cost_price set
2. Check appointments have service_cost recorded
3. Ensure repair_items records parts used
4. Appointments must have status = 'completed'

### Data looks incorrect?
1. Verify timeframe is correct (check which button is selected)
2. Confirm appointment data is saved (check database directly)
3. Clear config cache: `php artisan config:cache`
4. Clear app cache: `php artisan cache:clear`

---

## Summary

✅ Sales & Profit analytics fully integrated into Reports page
✅ Timeframe switching (Daily/Weekly/Monthly/Yearly)
✅ Real-time metric calculations
✅ Professional charts visualization
✅ Responsive design
✅ Ready for production use

**Start using it today**: Navigate to Admin → Reports & Analytics!
