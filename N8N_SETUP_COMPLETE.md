# 🤖 RepairMax N8N + Chatbot Integration - Complete Setup Summary

## What's Been Set Up

Your RepairMax Laravel application now has **complete n8n self-hosted integration** with Cloudflare Tunnel support for a production-ready chatbot system.

### ✅ Components Installed

#### 1. **Service Layer** (`app/Services/N8nService.php`)
- Service class for communicating with n8n
- Methods for all chatbot interactions:
  - `sendChatbotMessage()` - Core chat interaction
  - `triggerRepairStatus()` - Repair inquiries
  - `triggerBookingConfirmation()` - Appointment confirmations  
  - `triggerAppointmentScheduling()` - Schedule appointments
  - `getProductRecommendations()` - Product suggestions
  - `triggerSupportTicket()` - Support requests
  - `healthCheck()` - Connection verification

#### 2. **API Controllers** 
- `app/Http/Controllers/N8n/ChatbotController.php`
  - Chat message handling
  - Session management
  - Conversation history retrieval
  
- `app/Http/Controllers/N8n/WorkflowWebhookController.php`
  - Receives callbacks from n8n workflows
  - Processes chatbot responses
  - Updates database records
  - Creates notifications

#### 3. **API Routes** (`routes/n8n.php`)
- Authenticated endpoints for chatbot API
- Webhook endpoints for n8n callbacks
- Proper rate limiting and security

#### 4. **Livewire Component** (`app/Livewire/ChatbotWidget.php`)
- Beautiful, interactive chatbot UI
- Conversation history
- Session management
- Real-time message updates

#### 5. **Database Models & Migrations**
- `ChatbotSession` - Conversation sessions
- `ChatbotMessage` - Individual messages with metadata
- Migration file for seamless setup
- Relationships and scopes pre-configured

#### 6. **Authorization Policies** (`app/Policies/ChatbotSessionPolicy.php`)
- User data protection
- Only users can access their own conversations

#### 7. **Documentation Files**
- `N8N_SETUP_GUIDE.md` - Comprehensive setup instructions
- `N8N_QUICKSTART.md` - Quick reference guide
- `N8N_WORKFLOWS_TEMPLATES.json` - Ready-to-import workflow templates

---

## 📋 Step-by-Step Setup Instructions

### Phase 1: Docker & Services (5 minutes)

```bash
# 1. Navigate to project
cd c:\Users\Andrew\Downloads\repairmaxV2-laravel

# 2. Start Docker services
docker-compose up -d

# 3. Verify services
docker-compose ps

# 4. Check n8n is running
curl http://localhost:5678/api/v1/health
```

**Expected Output:**
```
STATUS: healthy ✅
```

### Phase 2: Database Setup (2 minutes)

```bash
# 1. Run migrations
php artisan migrate

# 2. Verify tables
php artisan tinker
>>> DB::table('chatbot_sessions')->count()
```

### Phase 3: N8N Configuration (10 minutes)

1. **Open N8N**
   - Local: http://localhost:5678
   - Production: https://repairmax.n8n.app

2. **Login**
   - Email: `roxas.t.bscs@gmail.com`
   - Password: `@Roxastristan1925`

3. **Configure Settings**
   - Go to Settings (gear icon)
   - Set Webhook Base URL: `https://repairmax.n8n.app` (or your domain)
   - Enable Community Nodes if desired

### Phase 4: Create First Workflow (15 minutes)

See `N8N_WORKFLOWS_TEMPLATES.json` for importable workflow templates.

**Quick Example - Echo Bot:**

1. New Workflow → Name: "Echo Bot"
2. Add **Webhook** node
   - Method: POST
   - Path: `/webhook/chatbot-message`
3. Add **Set** node - pass through message
4. Add **HTTP Request** node
   - POST to: `http://host.docker.internal:8000/api/webhooks/n8n/chatbot-response`
5. Activate workflow

### Phase 5: Add Chatbot to Your Pages (1 minute)

In any Blade template:

```blade
@livewire('chatbot-widget')
```

Or create dedicated page:

```bash
php artisan route:list | grep chatbot
# Visit: /chatbot
```

### Phase 6: Enable Cloudflare Tunnel (10 minutes)

1. **Create Tunnel in Cloudflare Dashboard**
   - https://dash.cloudflare.com → Tunnels
   - Create tunnel, get token

2. **Set Environment Variable**
   ```env
   CLOUDFLARE_TUNNEL_TOKEN=eyJhIjoiXX...
   ```

3. **Restart Services**
   ```bash
   docker-compose down
   docker-compose up -d
   ```

4. **Configure Public Hostname**
   - Subdomain: `repairmax`
   - Domain: `n8n.app`
   - URL: `http://n8n-app:5678`

---

## 🔌 API Endpoints Reference

### Authentication Required Endpoints

```
POST   /api/chatbot/message
       - Send message to chatbot
       - Body: { message, session_id? }

GET    /api/chatbot/sessions
       - List user's conversations
       
GET    /api/chatbot/sessions/{id}/messages
       - Get messages in session
       
POST   /api/chatbot/sessions
       - Create new session
       - Body: { title? }
       
DELETE /api/chatbot/sessions/{id}
       - Delete session
```

### N8N Webhook Endpoints (No auth)

```
POST /api/webhooks/n8n/chatbot-response
POST /api/webhooks/n8n/repair-status-update
POST /api/webhooks/n8n/booking-confirmation
POST /api/webhooks/n8n/appointment-notification
POST /api/webhooks/n8n/product-recommendation
POST /api/webhooks/n8n/support-ticket
POST /api/webhooks/n8n/health
```

---

## 🧪 Testing

### Test 1: Basic Connection

```bash
# Check n8n
curl http://localhost:5678/api/v1/health

# Check Laravel health webhook
curl -X POST http://localhost:8000/api/webhooks/n8n/health
```

### Test 2: Send Message (with auth token)

```bash
# Get auth token from your Laravel app
TOKEN=$(php artisan tinker --execute="echo auth()->user()->createToken('test')->plainTextToken")

curl -X POST http://localhost:8000/api/chatbot/message \
  -H "Authorization: Bearer $TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "message": "Hello bot!",
    "session_id": 1
  }'
```

### Test 3: Verify Database

```bash
php artisan tinker

# Check sessions
>>> App\Models\ChatbotSession::all()

# Check messages
>>> App\Models\ChatbotMessage::all()

# Check specific session
>>> App\Models\ChatbotSession::find(1)->messages
```

---

## 📊 Project Structure

```
your-project/
├── app/
│   ├── Services/
│   │   └── N8nService.php              ← Core integration
│   ├── Http/Controllers/N8n/
│   │   ├── ChatbotController.php       ← Chat endpoints
│   │   └── WorkflowWebhookController.php ← N8N callbacks
│   ├── Livewire/
│   │   └── ChatbotWidget.php           ← Chat UI component
│   ├── Models/
│   │   ├── ChatbotSession.php
│   │   └── ChatbotMessage.php
│   └── Policies/
│       └── ChatbotSessionPolicy.php
├── routes/
│   ├── n8n.php                         ← All chatbot routes
│   └── api.php                         ← Includes n8n routes
├── resources/views/
│   ├── livewire/
│   │   └── chatbot-widget.blade.php   ← Chat UI
│   └── pages/
│       └── chatbot.blade.php           ← Chatbot page
├── database/migrations/
│   └── *_create_chatbot_messages_table.php
├── docker-compose.yml                  ← N8N + Postgres + Cloudflare
├── .env.n8n                           ← N8N config template
├── N8N_SETUP_GUIDE.md                 ← Detailed guide
├── N8N_QUICKSTART.md                  ← Quick reference
└── N8N_WORKFLOWS_TEMPLATES.json       ← Importable workflows
```

---

## 🎯 Chatbot Capabilities

Your chatbot can now handle:

1. **Repair Status Inquiries**
   - "Where is my repair?"
   - Real-time status updates

2. **Booking Confirmations**
   - "Confirm my appointment"
   - Auto-generate confirmation codes

3. **Appointment Scheduling**
   - "Book an appointment"
   - Check availability and schedule

4. **Product Recommendations**
   - "What parts do you have?"
   - Personalized suggestions

5. **Customer Support**
   - "I need help"
   - Create support tickets

6. **General Chat**
   - "How much does it cost?"
   - FAQs and information

---

## 🔒 Security Features

- ✅ User authentication required for chat API
- ✅ Role-based access control via Policies
- ✅ Rate limiting on endpoints
- ✅ HTTPS via Cloudflare Tunnel
- ✅ Encrypted n8n encryption key
- ✅ PostgreSQL database backend
- ✅ CSRF protection (Laravel default)
- ✅ Secure webhook validation possible

---

## 🚀 Production Checklist

Before going live:

- [ ] Docker services stable and healthy
- [ ] PostgreSQL database backed up
- [ ] N8N encryption key secured in .env
- [ ] Cloudflare Tunnel configured and tested
- [ ] All workflows imported and activated
- [ ] SSL certificate valid (Cloudflare handles this)
- [ ] Environment variables set correctly
- [ ] Rate limiting tuned for your scale
- [ ] Error logging configured
- [ ] Backup strategy implemented
- [ ] Monitoring and alerts set up

---

## 📚 Documentation Files

| File | Purpose |
|------|---------|
| `N8N_QUICKSTART.md` | 5-minute quick start |
| `N8N_SETUP_GUIDE.md` | Comprehensive setup instructions |
| `N8N_WORKFLOWS_TEMPLATES.json` | Ready-to-use workflow templates |
| `docker-compose.yml` | Docker configuration |
| `.env.n8n` | Environment variables template |

---

## 🆘 Troubleshooting

### Issue: Can't access http://localhost:5678

**Solution:**
```bash
docker-compose logs n8n
docker-compose restart n8n
```

### Issue: Messages not saving to database

**Solution:**
```bash
php artisan migrate
php artisan tinker
>>> DB::table('chatbot_messages')->count()
```

### Issue: N8N can't reach Laravel webhook

**Solution:**
- Use `http://host.docker.internal:8000` in Docker containers
- Or use `http://localhost:8000` for host machine
- Check `LARAVEL_WEBHOOK_URL` in environment

### Issue: Cloudflare Tunnel not connecting

**Solution:**
```bash
# Check token
echo $CLOUDFLARE_TUNNEL_TOKEN

# View tunnel logs
docker-compose logs cloudflared

# Restart tunnel
docker-compose restart cloudflared
```

---

## 📞 Support Resources

- **N8N Documentation:** https://docs.n8n.io
- **Laravel Documentation:** https://laravel.com/docs
- **Cloudflare Documentation:** https://developers.cloudflare.com
- **Livewire Documentation:** https://livewire.laravel.com

---

## 🎓 Next Steps

1. ✅ Set up Docker and services
2. ✅ Configure n8n and database
3. ✅ Create first workflow
4. ✅ Test chatbot functionality
5. 🔄 Add domain-specific workflows
6. 📱 Deploy to production
7. 📊 Monitor performance
8. 🔧 Optimize and scale

---

**Status:** ✅ Ready for Development & Testing  
**Last Updated:** May 25, 2026  
**Version:** 1.0  

**Quick Links:**
- Access N8N: http://localhost:5678
- View Chatbot: http://localhost:8000/chatbot
- Check Status: docker-compose ps

---

### Need Help?

1. Check the relevant guide (QUICKSTART or SETUP_GUIDE)
2. Review logs: `docker-compose logs -f`
3. Test connection: `curl http://localhost:5678/api/v1/health`
4. Run migrations: `php artisan migrate`
5. Check database: `php artisan tinker`

You're all set! Happy chatting! 🎉
