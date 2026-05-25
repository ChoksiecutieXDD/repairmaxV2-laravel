#!/bin/bash
# RepairMax N8N Setup - Quick Commands Reference
# Run these commands in order to set up everything

echo "🚀 RepairMax N8N Setup - Quick Commands"
echo "========================================"
echo ""

# Colors
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Step 1: Start Docker
echo -e "${BLUE}Step 1: Starting Docker Services...${NC}"
echo "docker-compose up -d"
echo ""

# Step 2: Wait for services
echo -e "${BLUE}Step 2: Waiting for services to be ready...${NC}"
echo "docker-compose ps"
echo ""

# Step 3: Run migrations
echo -e "${BLUE}Step 3: Running Laravel migrations...${NC}"
echo "php artisan migrate"
echo ""

# Step 4: Check services
echo -e "${BLUE}Step 4: Verifying N8N is running...${NC}"
echo "curl http://localhost:5678/api/v1/health"
echo ""

# Step 5: View application
echo -e "${BLUE}Step 5: Access the applications${NC}"
echo "N8N Dashboard: http://localhost:5678"
echo "  Email: roxas.t.bscs@gmail.com"
echo "  Password: @Roxastristan1925"
echo ""
echo "Chatbot Page: http://localhost:8000/chatbot"
echo "  (Run: php artisan serve)"
echo ""

# Useful commands
echo -e "${YELLOW}Useful Commands:${NC}"
echo ""
echo "# View logs"
echo "docker-compose logs -f n8n"
echo "docker-compose logs -f postgres"
echo "tail -f storage/logs/laravel.log"
echo ""
echo "# Database access"
echo "php artisan tinker"
echo ""
echo "# Restart services"
echo "docker-compose restart"
echo ""
echo "# Stop services"
echo "docker-compose down"
echo ""
echo "# Check status"
echo "docker-compose ps"
echo ""

# Additional helpful info
echo -e "${GREEN}✅ Setup complete!${NC}"
echo ""
echo "Next steps:"
echo "1. Open http://localhost:5678 and login"
echo "2. Create your first workflow"
echo "3. Add chatbot to your pages with: @livewire('chatbot-widget')"
echo "4. For production, set CLOUDFLARE_TUNNEL_TOKEN in .env"
echo ""
echo "Documentation:"
echo "- N8N_QUICKSTART.md - 5 minute guide"
echo "- N8N_SETUP_GUIDE.md - Complete guide"
echo "- N8N_WORKFLOWS_TEMPLATES.json - Ready workflows"
echo ""
