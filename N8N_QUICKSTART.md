# N8N + RepairMax Chatbot - Quick Start

## 🚀 TL;DR - Get Running in 5 Minutes

### 1. Start Docker Services
```bash
cd c:\Users\Andrew\Downloads\repairmaxV2-laravel
docker-compose up -d
```

### 2. Login to N8N
- **URL:** http://localhost:5678
- **Email:** roxas.t.bscs@gmail.com  
- **Password:** @Roxastristan1925

### 3. Run Laravel Migrations
```bash
php artisan migrate
```

### 4. Add Chatbot to Your Page
```blade
<livewire:chatbot-widget />
```

---

## 📱 API Endpoints Available

### Chatbot Endpoints (require authentication)

```
POST   /api/chatbot/message                    - Send message
GET    /api/chatbot/sessions                   - List conversations
GET    /api/chatbot/sessions/{id}/messages    - Get messages
POST   /api/chatbot/sessions                   - Create session
DELETE /api/chatbot/sessions/{id}              - Delete session
```

### N8N Webhook Endpoints

```
POST /api/webhooks/n8n/chatbot-response            - Bot responds
POST /api/webhooks/n8n/repair-status-update       - Repair update
POST /api/webhooks/n8n/booking-confirmation       - Booking confirmed
POST /api/webhooks/n8n/appointment-notification   - Appointment alert
POST /api/webhooks/n8n/product-recommendation     - Product suggestions
POST /api/webhooks/n8n/support-ticket             - Support ticket created
POST /api/webhooks/n8n/health                     - Health check
```

---

## 🔧 Testing Your Setup

### Test 1: Check Services Running
```bash
# N8N health
curl http://localhost:5678/api/v1/health

# PostgreSQL
docker-compose exec postgres pg_isready -U n8n_user
```

### Test 2: Send Test Message
```bash
curl -X POST http://localhost:8000/api/chatbot/message \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"message":"Hello bot!","session_id":1}'
```

### Test 3: Check Database
```bash
php artisan tinker
> DB::table('chatbot_sessions')->count()
> DB::table('chatbot_messages')->count()
```

---

## 🔌 Create Your First N8N Workflow

### Workflow: Simple Echo Bot

1. **Create New Workflow** in n8n
2. **Add Webhook Trigger**
   - Method: POST
   - Path: `/webhook/chatbot-message`
   
3. **Add Set Node** (to echo message)
   - Message: `{{ $json.message }}`

4. **Add HTTP Response**
   - URL: `http://host.docker.internal:8000/api/webhooks/n8n/chatbot-response`
   - Method: POST
   - Body:
     ```json
     {
       "session_id": "{{ $json.session_id }}",
       "user_id": "{{ $json.user_id }}",
       "message": "You said: {{ $json.message }}",
       "metadata": {}
     }
     ```

5. **Activate & Test**

---

## 🌐 Enable Cloudflare Tunnel

### Get Tunnel Token
1. Go to https://dash.cloudflare.com
2. Tunnels > Create > Get Token
3. Copy the token

### Set Environment Variable
```env
# In .env file
CLOUDFLARE_TUNNEL_TOKEN=eyJhIjoiXX...
```

### Restart Services
```bash
docker-compose down
docker-compose up -d
```

### Access N8N Online
- https://repairmax.n8n.app (if you set up the DNS)

---

## 📊 Monitor & Logs

```bash
# Watch n8n logs
docker-compose logs -f n8n

# Watch PostgreSQL logs
docker-compose logs -f postgres

# Watch Laravel logs
tail -f storage/logs/laravel.log

# All services status
docker-compose ps
```

---

## 🐛 Quick Troubleshooting

| Problem | Fix |
|---------|-----|
| Can't access http://localhost:5678 | `docker-compose restart n8n` |
| Messages not saving | Run `php artisan migrate` |
| N8N can't reach Laravel | Use `http://host.docker.internal:8000` in Docker |
| Cloudflare tunnel not connecting | Check CLOUDFLARE_TUNNEL_TOKEN in .env |
| Webhook returning 404 | Verify path in N8N matches routes |

---

## 🎯 What's Included

- ✅ N8N Self-Hosted with PostgreSQL
- ✅ Cloudflare Tunnel Support
- ✅ Laravel Chatbot Integration Service
- ✅ Livewire Chat Widget Component
- ✅ API Endpoints & Webhooks
- ✅ Database Models & Migrations
- ✅ Authorization Policies
- ✅ Comprehensive Setup Guide

---

## 📖 More Info

See `N8N_SETUP_GUIDE.md` for detailed instructions

## 🎓 Learn More

- N8N: https://docs.n8n.io
- Cloudflare Tunnel: https://developers.cloudflare.com/cloudflare-one/connections/connect-networks/
- Laravel: https://laravel.com/docs

---

**Last Updated:** May 25, 2026  
**Status:** ✅ Ready for Development
