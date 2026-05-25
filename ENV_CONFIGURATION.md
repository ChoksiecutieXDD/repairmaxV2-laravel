# Environment Variables Configuration Guide

## 🔑 Required Environment Variables

Add these to your `.env` file:

### N8N Configuration

```env
# N8N Service Configuration
N8N_HOST=https://repairmax.n8n.app
N8N_WEBHOOK_URL=https://repairmax.n8n.app
N8N_ENCRYPTION_KEY=repairmax_master_key_2026_xyz

# For local development
N8N_HOST=http://localhost:5678
N8N_WEBHOOK_URL=http://localhost:5678
```

### Cloudflare Tunnel

```env
# Cloudflare Tunnel Token (get from https://dash.cloudflare.com)
CLOUDFLARE_TUNNEL_TOKEN=eyJhIjoiXX...
```

### Laravel API URLs

```env
# For N8N to reach Laravel
LARAVEL_WEBHOOK_URL=http://host.docker.internal:8000

# For development (on your machine)
LARAVEL_API_URL=http://localhost:8000
```

### Database Configuration (if not using default)

```env
# PostgreSQL - only if you changed credentials in docker-compose.yml
DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=n8n_db
DB_USERNAME=n8n_user
DB_PASSWORD=n8n_password
```

---

## 📋 Step-by-Step Configuration

### 1. Copy Template
```bash
cp .env.n8n .env.local
```

### 2. Add to Your .env
```bash
# Open your .env file and add the variables from the sections above
```

### 3. Verify Variables
```bash
# Check variables are set
php artisan tinker
>>> config('services.n8n.host')
```

### 4. Test Connection
```bash
# Verify environment is loaded
php artisan env
```

---

## 🔍 Verify Everything

### Check Docker Environment

```bash
# View docker-compose environment variables
docker-compose config | grep -i n8n
docker-compose config | grep -i cloudflare
```

### Check Laravel Environment

```bash
php artisan tinker

# Check if services are configured
>>> getenv('N8N_HOST')
>>> getenv('N8N_WEBHOOK_URL')
>>> getenv('LARAVEL_WEBHOOK_URL')
```

### Test Connections

```bash
# Test N8N connection
curl http://localhost:5678/api/v1/health

# Test Laravel webhook endpoint
curl -X POST http://localhost:8000/api/webhooks/n8n/health
```

---

## ⚠️ Important Notes

- **Development:** Use `http://localhost:5678` for N8N_HOST
- **Production:** Use Cloudflare Tunnel URL like `https://repairmax.n8n.app`
- **Docker Network:** Use `http://host.docker.internal:8000` for Laravel in Docker
- **Security:** Never commit `.env` files to version control
- **Cloudflare Token:** Keep token secure, rotate regularly

---

## 🚀 Common Environment Scenarios

### Scenario 1: Local Development

```env
N8N_HOST=http://localhost:5678
N8N_WEBHOOK_URL=http://localhost:5678
LARAVEL_WEBHOOK_URL=http://host.docker.internal:8000
LARAVEL_API_URL=http://localhost:8000
```

### Scenario 2: Production with Cloudflare

```env
N8N_HOST=https://repairmax.n8n.app
N8N_WEBHOOK_URL=https://repairmax.n8n.app
CLOUDFLARE_TUNNEL_TOKEN=eyJhIjoiXX...
LARAVEL_WEBHOOK_URL=https://api.youromain.com
LARAVEL_API_URL=https://api.yourdomain.com
```

### Scenario 3: Staging/Testing

```env
N8N_HOST=https://staging-n8n.yourdomain.com
N8N_WEBHOOK_URL=https://staging-n8n.yourdomain.com
LARAVEL_WEBHOOK_URL=https://staging-api.yourdomain.com
LARAVEL_API_URL=https://staging-api.yourdomain.com
```

---

## ✅ Configuration Checklist

- [ ] `N8N_HOST` set (localhost or Cloudflare URL)
- [ ] `N8N_WEBHOOK_URL` set
- [ ] `LARAVEL_WEBHOOK_URL` set
- [ ] `LARAVEL_API_URL` set
- [ ] `CLOUDFLARE_TUNNEL_TOKEN` set (if using Cloudflare)
- [ ] `N8N_ENCRYPTION_KEY` set
- [ ] Docker services running
- [ ] Laravel migrations completed
- [ ] Verify connection with `curl` commands
- [ ] Test with Postman or similar tool

---

## 🐛 Troubleshooting

### N8N Returns 502 Bad Gateway
- Check `N8N_HOST` URL is correct
- Verify Docker services are running: `docker-compose ps`
- Check N8N logs: `docker-compose logs n8n`

### Laravel Cannot Reach N8N
- Verify `LARAVEL_WEBHOOK_URL` is correct
- For Docker: use `http://host.docker.internal:8000`
- Check firewall rules

### Cloudflare Tunnel Not Connecting
- Verify `CLOUDFLARE_TUNNEL_TOKEN` is correct
- Check tunnel logs: `docker-compose logs cloudflared`
- Verify DNS records in Cloudflare dashboard

### Webhooks Returning 404
- Check path matches workflow path in N8N
- Verify route is registered: `php artisan route:list | grep webhook`
- Check for typos in URL

---

## 📝 Reference

**Related Files:**
- `.env.n8n` - Template with all variables
- `docker-compose.yml` - Container configuration
- `routes/n8n.php` - API routes
- `app/Services/N8nService.php` - Service configuration

**Documentation:**
- N8N Docs: https://docs.n8n.io
- Laravel Config: https://laravel.com/docs/configuration
- Docker Compose: https://docs.docker.com/compose/

---

**Last Updated:** May 25, 2026
