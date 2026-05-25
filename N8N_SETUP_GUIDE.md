# N8N Self-Hosted Setup with Cloudflare Tunnel - RepairMax

This guide walks you through setting up n8n self-hosted with Cloudflare Tunnel integration for your RepairMax chatbot system.

## Table of Contents
1. [Prerequisites](#prerequisites)
2. [Docker Setup](#docker-setup)
3. [Cloudflare Tunnel Configuration](#cloudflare-tunnel-configuration)
4. [n8n Login & Initial Setup](#n8n-login--initial-setup)
5. [Laravel Configuration](#laravel-configuration)
6. [N8N Workflow Setup](#n8n-workflow-setup)
7. [Testing & Troubleshooting](#testing--troubleshooting)

---

## Prerequisites

- Docker & Docker Compose installed
- Cloudflare account
- Cloudflare domain (repairmax.com or similar)
- Laravel application running
- n8n credentials provided

---

## Docker Setup

### Step 1: Start Docker Services

```bash
cd c:\Users\Andrew\Downloads\repairmaxV2-laravel

# Start all services
docker-compose up -d

# Check service status
docker-compose ps

# View logs
docker-compose logs -f n8n
docker-compose logs -f postgres
```

### Step 2: Verify Services Are Running

```bash
# Check n8n health
curl http://localhost:5678/api/v1/health

# Check PostgreSQL connection
docker-compose exec postgres pg_isready -U n8n_user -d n8n_db
```

---

## Cloudflare Tunnel Configuration

### Step 1: Create Cloudflare Tunnel

1. **Go to Cloudflare Dashboard**
   - Login to https://dash.cloudflare.com
   - Select your domain
   - Navigate to **Network > Tunnels**

2. **Create New Tunnel**
   - Click "Create a tunnel"
   - Choose "Cloudflared"
   - Name: `repairmax-n8n`
   - Click "Save tunnel"

3. **Get Tunnel Token**
   - You'll see a command like:
     ```
     cloudflared service install eyJhIjoiXX...
     ```
   - Copy the token after `token=`

### Step 2: Configure Environment Variable

Create `.env` file in your project root:

```bash
# Add these variables
CLOUDFLARE_TUNNEL_TOKEN=eyJhIjoiXX...  # Your tunnel token
```

### Step 3: Create Public Hostname

In Cloudflare Tunnels dashboard:

1. **Add Route**
   - Subdomain: `repairmax`
   - Domain: `n8n.app` (or your domain)
   - Type: `HTTP`
   - URL: `http://n8n-app:5678`
   - Click Save

2. **Verify DNS**
   - Go to DNS settings
   - Should see CNAME record: `repairmax.n8n.app` → tunnel UUID

### Step 4: Restart Docker with Tunnel

```bash
# Update docker-compose.yml with tunnel configuration
docker-compose down
docker-compose up -d

# Check cloudflared logs
docker-compose logs cloudflared
```

---

## N8N Login & Initial Setup

### Step 1: Access N8N

**Local:** http://localhost:5678

**Production:** https://repairmax.n8n.app

### Step 2: Create Admin Account

- Email: `roxas.t.bscs@gmail.com`
- Password: `@Roxastristan1925`
- Click "Setup n8n"

### Step 3: Configure Settings

1. **Go to Settings (Gear Icon)**
2. **Community Nodes**
   - Enable community node packages
3. **Webhook**
   - Set Base URL: `https://repairmax.n8n.app`
   - This allows external webhooks to trigger workflows

---

## Laravel Configuration

### Step 1: Register N8n Routes

Edit `routes/web.php`:

```php
// Include n8n routes
require base_path('routes/n8n.php');
```

Or in `bootstrap/app.php`:

```php
->withRouting(
    web: base_path('routes/web.php'),
    api: base_path('routes/api.php'),
    commands: base_path('routes/console.php'),
    health: '/up',
)
```

### Step 2: Update .env

Add these to your `.env`:

```env
N8N_HOST=https://repairmax.n8n.app
N8N_WEBHOOK_URL=https://repairmax.n8n.app
LARAVEL_API_URL=http://localhost:8000
LARAVEL_WEBHOOK_URL=http://host.docker.internal:8000
```

### Step 3: Register Policy

In `app/Providers/AuthServiceProvider.php`:

```php
protected $policies = [
    \App\Models\ChatbotSession::class => \App\Policies\ChatbotSessionPolicy::class,
];
```

### Step 4: Create Chatbot Message Table

Run migration:

```bash
php artisan make:migration create_chatbot_messages_table

# In migration file:
Schema::create('chatbot_messages', function (Blueprint $table) {
    $table->id();
    $table->foreignId('chatbot_session_id')
        ->constrained('chatbot_sessions')
        ->cascadeOnDelete();
    $table->text('message');
    $table->boolean('is_user')->default(false);
    $table->json('metadata')->nullable();
    $table->timestamps();
    
    $table->index('chatbot_session_id');
});

php artisan migrate
```

### Step 5: Run Laravel Server

```bash
php artisan serve
# Access at http://localhost:8000
```

---

## N8N Workflow Setup

### Workflow 1: Basic Chatbot Handler

1. **Create New Workflow**
   - Click "New"
   - Name: "Chatbot Message Handler"

2. **Add Trigger**
   - Add **Webhook** node
   - Method: POST
   - Path: `/webhook/chatbot-message`
   - Authentication: None (for now)
   - Save and get URL

3. **Add Processing**
   - Add **OpenAI Chat** node (if you have API key)
   - Or **If/Then** node for routing
   - Map message: `$json.message`

4. **Add Response**
   - Add **HTTP Request** node (POST)
   - URL: `http://host.docker.internal:8000/api/webhooks/n8n/chatbot-response`
   - Body:
     ```json
     {
       "session_id": "{{ $json.session_id }}",
       "user_id": "{{ $json.user_id }}",
       "message": "{{ $json.response }}",
       "action": "process_message",
       "metadata": {}
     }
     ```

5. **Save & Activate**

### Workflow 2: Repair Status Check

1. Create new workflow: "Repair Status Inquiry"
2. Webhook path: `/webhook/repair-status-check`
3. Connect to your repair tracking system
4. Send callback to: `/api/webhooks/n8n/repair-status-update`

### Workflow 3: Booking Confirmation

1. Create workflow: "Booking Confirmation"
2. Webhook path: `/webhook/booking-confirmation`
3. Generate confirmation code
4. Send response to: `/api/webhooks/n8n/booking-confirmation`

### Workflow 4: Appointment Scheduler

1. Create workflow: "Appointment Scheduling"
2. Webhook path: `/webhook/appointment-scheduling`
3. Validate available slots
4. Callback: `/api/webhooks/n8n/appointment-notification`

---

## Testing & Troubleshooting

### Test Chatbot Connection

```bash
# Test Laravel webhook endpoint
curl -X POST http://localhost:8000/api/webhooks/n8n/health \
  -H "Content-Type: application/json"

# Test n8n connection from Laravel
php artisan tinker
> $service = app(\App\Services\N8nService::class);
> $service->healthCheck();
```

### Debug N8N Logs

```bash
# View n8n container logs
docker-compose logs -f n8n

# View PostgreSQL logs
docker-compose logs -f postgres

# View Cloudflare tunnel logs
docker-compose logs -f cloudflared
```

### Common Issues

| Issue | Solution |
|-------|----------|
| Cannot access n8n at https://repairmax.n8n.app | Check Cloudflare tunnel is running: `docker-compose logs cloudflared` |
| N8n webhook returns 401 | Verify authentication in webhook settings |
| Messages not saving | Check chatbot_messages table exists: `php artisan migrate` |
| Cloudflared connection fails | Verify CLOUDFLARE_TUNNEL_TOKEN in .env is correct |
| Laravel cannot reach n8n | Use `http://n8n-app:5678` in Docker network or check LARAVEL_WEBHOOK_URL |

### Enable Chat Widget in Your App

Add to any Blade template:

```blade
<livewire:chatbot-widget />
```

Or in your main layout:

```blade
<!-- In your app layout -->
@livewireStyles
<!-- ... your content ... -->
@livewireScripts
@livewire('chatbot-widget')
```

---

## Production Deployment Checklist

- [ ] Cloudflare tunnel running and verified
- [ ] N8n password changed from default
- [ ] PostgreSQL database backed up
- [ ] Laravel .env configured with production URLs
- [ ] SSL certificate valid (Cloudflare provides)
- [ ] All webhooks tested and responding
- [ ] Error logging configured
- [ ] Rate limiting enabled on API routes
- [ ] Database migrations up to date
- [ ] n8n encryption key secured in .env

---

## Useful Commands

```bash
# Restart all services
docker-compose restart

# Rebuild Docker images
docker-compose build --no-cache

# Access n8n database
docker-compose exec postgres psql -U n8n_user -d n8n_db

# Reset n8n (WARNING: Deletes all workflows)
docker-compose exec n8n npm run build
docker-compose exec n8n rm -rf ~/.n8n/database.sqlite

# View Laravel API logs
tail -f storage/logs/laravel.log

# Test n8n webhook
curl -X POST http://localhost:5678/webhook/chatbot-message \
  -H "Content-Type: application/json" \
  -d '{"message":"Hello","user_id":1,"session_id":"test"}'
```

---

## Next Steps

1. ✅ Set up Docker & Cloudflare Tunnel
2. ✅ Configure Laravel integration
3. ✅ Create n8n workflows
4. 🚀 Deploy chatbot to your app
5. 📊 Monitor and optimize

For support or questions, refer to:
- N8N Docs: https://docs.n8n.io
- Laravel Docs: https://laravel.com/docs
- Cloudflare Docs: https://developers.cloudflare.com
