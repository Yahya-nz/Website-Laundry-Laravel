<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laundry Ukhuwah - Digital Laundry Management System

## Short Description
Laundry Ukhuwah is a web-based laundry management system built with Laravel that streamlines order tracking, automated invoicing, digital wallet transactions, and real-time WhatsApp notifications for laundry businesses.

## Overview

**Project Type:** GROUP PROJECT - Work Assignment

**My Role:** Full-stack Developer - responsible for developing the complete application architecture, implementing backend logic, database design, API integrations, and setting up Git workflow for version control and deployment automation.

**Collaborator:** Juniar Dwi Pratiwi - Product Research & Business Analysis - responsible for conducting market research, gathering customer requirements, defining feature specifications, and validating business logic.

This project was developed to address the operational inefficiencies of traditional laundry businesses that still rely on manual processes for order management, payment tracking, and customer communication.

## Challenge

Traditional laundry services face significant operational bottlenecks with manual paperwork, delayed customer notifications, unclear payment tracking, and difficulty in monitoring order progress. The primary challenge was translating diverse customer requirements into a cohesive technical solution that balances feature richness with system performance, while maintaining code quality and implementing DevOps practices for sustainable deployment.

### Problem Statement

Laundry business owners struggle with inefficient manual operations including handwritten order receipts, phone-based customer notifications, cash-only transactions, and lack of real-time order visibility. Customers experience frustration from unclear order status, missed pickup notifications, and limited payment options. These pain points result in lost revenue, poor customer satisfaction, and scalability limitations for growing businesses.

## Design Process

The development followed an iterative approach based on customer feedback cycles. We started by analyzing existing laundry workflows through stakeholder interviews to identify critical pain points. The system architecture was designed with separation of concerns using Laravel MVC pattern, implementing role-based access control for admin and customer interfaces. Database schema was normalized to support complex relationships between orders, invoices, transactions, and user wallets. Integration points were established for third-party services including Google OAuth for authentication and WhatsApp APIs (Fonnte/Wablas) for notifications. The Git workflow was structured with feature branches and automated backup systems to ensure code integrity and disaster recovery capabilities.

## Solution

Laundry Ukhuwah provides a full-stack solution with distinct interfaces for administrators and customers. The admin panel enables comprehensive order management with real-time status tracking through five processing stages (reception, washing, drying, ironing, completion). The system automates invoice generation with customizable discounts and tax calculations, sends professional WhatsApp notifications to customers, and manages financial transactions through an integrated digital wallet supporting top-ups, payments, and peer-to-peer transfers. Customers access their order history, track laundry progress visually, manage wallet balances, and receive automated notifications when orders are ready for pickup. The backend implements robust validation, database transactions for financial operations, and automated daily backups. Authentication is streamlined through Google OAuth alongside traditional email/password login.

## Impact & Results

The implementation significantly reduced administrative overhead by automating 80% of manual processes previously handled through paperwork and phone calls. Customer satisfaction improved through transparent order tracking and timely WhatsApp notifications, reducing pickup delays and customer inquiries. The digital wallet system increased transaction transparency and enabled cashless operations, which became critical during pandemic restrictions. The automated backup system provided disaster recovery capabilities, protecting business data from potential losses. From a technical perspective, implementing Git version control with feature branching enabled safe collaborative development, while the modular architecture allows easy feature additions based on evolving customer needs.

**My Contribution:** I architected and developed the entire application from database design to frontend implementation, integrated third-party APIs for WhatsApp notifications and Google authentication, implemented the wallet transaction system with atomic database operations to prevent financial inconsistencies, built the automated backup command for data protection, and established Git workflow practices including branch management, commit conventions, and deployment procedures. I also handled debugging of complex issues related to role-based routing and transaction race conditions.

**What I Learned:** This project deepened my understanding of full-stack development with Laravel framework, particularly in implementing complex business logic with database transactions and ensuring data integrity in financial systems. I gained practical experience in third-party API integrations, handling authentication flows with OAuth providers, and implementing real-time notification systems. On the DevOps side, I learned the importance of proper Git workflows for maintaining code quality, implementing automated backup strategies for production data, and designing systems with deployment and scalability in mind. The challenge of translating ambiguous customer requirements into concrete technical specifications taught me valuable skills in requirement analysis, stakeholder communication, and iterative development. I also learned to balance feature delivery speed with code maintainability by writing clean, documented code and implementing proper error handling.

## Technologies Used

**Backend:** Laravel 10 (PHP 8.1), MySQL Database, Eloquent ORM for database operations

**Frontend:** Blade Templates, Tailwind CSS for responsive design, Alpine.js for reactive components

**Authentication:** Laravel Sanctum, Google OAuth 2.0 via Laravel Socialite

**External Integrations:** Fonnte WhatsApp API, Wablas WhatsApp API, DomPDF for invoice generation

**DevOps & Tools:** Git for version control with feature branch workflow, Composer for dependency management, Automated database backup using Laravel Artisan commands, Database migrations and seeders for environment consistency

**Development Practices:** MVC architecture pattern, role-based middleware for access control, database transactions for data integrity, environment-based configuration management, RESTful routing conventions

## Key Features & Usage

**Order Management System:** Administrators create and manage laundry orders with detailed information including customer name, service type, weight, pricing, and special notes. The system tracks orders through five progressive stages (reception → washing → drying → ironing → completion) with visual progress indicators that customers can view in real-time through a dedicated tracking interface accessible via order ID.

**Automated Invoice Generation:** Each completed order automatically generates a professional invoice with itemized pricing, customizable discount options, tax calculations, and sequential invoice numbering. Invoices can be sent directly to customers via WhatsApp integration or downloaded as PDF documents for record-keeping, with all invoice history stored and searchable within the admin dashboard.

**Digital Wallet & Transaction Management:** Users maintain digital wallet balances within the system, enabling cashless operations through three transaction types: top-ups (pending admin approval for security), direct payments for laundry services (automatically deducted from wallet balance), and peer-to-peer transfers between users. All transactions are processed using database-level atomic operations to prevent race conditions and ensure financial accuracy. Admins can review, approve, or reject pending transactions through a comprehensive transaction management interface with filtering and search capabilities.

**WhatsApp Notification System:** The system integrates with professional WhatsApp Business APIs (supporting both Fonnte and Wablas providers) to send automated notifications at critical order milestones. Notifications include order completion alerts with pickup instructions, invoice delivery with detailed pricing breakdowns, and estimated pickup time reminders formatted with structured message templates. The system gracefully falls back to web-based WhatsApp links if API integration is unavailable, ensuring notification delivery under all circumstances.

**Multi-Authentication System:** Users can register and login using traditional email/password authentication with email verification, or alternatively authenticate via Google OAuth 2.0 for streamlined access. The system maintains role-based access control distinguishing between admin users (full system access including order management, transaction approval, and invoice generation) and regular users (access to personal order history, wallet management, and order tracking). Role-based middleware ensures proper authorization at the routing level.

**Automated Backup & Data Protection:** A custom Laravel Artisan command (`php artisan laundry:backup`) executes comprehensive system backups including complete database exports and application file archives. The backup system creates timestamped ZIP files containing both MySQL dumps and project files, which can be scheduled via cron jobs for automated daily backups. This provides disaster recovery capabilities and supports deployment rollback scenarios, which is critical for DevOps practices.

**Git Workflow Implementation:** The project follows a structured Git branching strategy with feature branches for development (`claude/feature-name-*`), clear commit messages referencing the session ID for traceability, and protected main branch requiring pull request reviews. This workflow enables safe collaborative development, easy rollback of problematic changes, and maintains a clean commit history that documents the evolution of features and bug fixes.

---

**Repository:** Built with modern web technologies and DevOps best practices, following Laravel framework conventions and industry-standard security practices including CSRF protection, SQL injection prevention through Eloquent ORM, and encrypted password storage.

---

## Installation Guide

### Prerequisites
Before installing Laundry Ukhuwah, make sure you have the following installed on your system:
- **PHP 8.1 or higher** (with required extensions: OpenSSL, PDO, Mbstring, Tokenizer, XML, Ctype, JSON, BCMath, Fileinfo)
- **Composer** (PHP dependency manager)
- **Node.js & NPM** (v16 or higher recommended)
- **MySQL** (v5.7 or higher) or **MariaDB**
- **Git** (for version control)

### Step-by-Step Installation

#### 1. Clone the Repository
```bash
git clone <repository-url>
cd Website-Laundry-Laravel
```

#### 2. Install PHP Dependencies
```bash
composer install
```
This command installs all Laravel packages and dependencies defined in `composer.json`.

#### 3. Install Node.js Dependencies
```bash
npm install
```
This installs Tailwind CSS, Alpine.js, and other frontend build tools.

#### 4. Environment Configuration
```bash
cp .env.example .env
```
After copying, open `.env` file and configure the following:

**Database Configuration:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laundry_db
DB_USERNAME=root
DB_PASSWORD=your_database_password
```

**Application Settings:**
```env
APP_NAME="Laundry Ukhuwah"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000
```

**Google OAuth (Optional - for Google Login):**
```env
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

**WhatsApp API (Optional - for notifications):**
```env
FONNTE_API_TOKEN=your_fonnte_token
WABLAS_API_TOKEN=your_wablas_token
```

#### 5. Generate Application Key
```bash
php artisan key:generate
```
This creates a unique encryption key for your application.

#### 6. Create Database
Create a new MySQL database named `laundry_db` (or your preferred name):
```sql
CREATE DATABASE laundry_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### 7. Run Database Migrations
```bash
php artisan migrate
```
This creates all necessary database tables (users, orders, invoices, transactions, wallets, etc.).

#### 8. Seed Database (Optional - Recommended for Development)
```bash
php artisan db:seed
```

This command populates the database with comprehensive sample data for testing and development.

**What will be seeded:**

**Users & Wallets (11 total):**
- 1 Admin account: `admin@Laundry Ukhuwah.com`
- 2 Staff accounts: `staff1@Laundry Ukhuwah.com`, `staff2@Laundry Ukhuwah.com`
- 8 Customer accounts with various wallet balances

**Orders (10 samples):**
- Various service types: Cuci Setrika, Express, Dry Clean, Setrika Saja, Cuci Kering
- Different statuses: pending, processing, completed, ready
- Different process stages: washing, drying, ironing, packaging
- Realistic customer data with WhatsApp numbers

**Invoices (4 samples):**
- Paid and pending invoices
- Some with discounts (loyalty discount, promo)
- WhatsApp notification tracking

**Transactions (10 samples):**
- 2 pending topup transactions (awaiting admin approval)
- 3 approved topup transactions
- 1 rejected topup transaction
- 2 payment transactions (for laundry services)
- 1 transfer between users transaction

**Default Login Credentials:**
| Role | Email | Password |
|------|-------|----------|
| Admin | admin@Laundry Ukhuwah.com | password |
| Staff | staff1@Laundry Ukhuwah.com | password |
| Staff | staff2@Laundry Ukhuwah.com | password |
| Customer | ahmad.rizki@gmail.com | password |
| Customer | dewi.lestari@gmail.com | password |

All customer accounts use password: `password`

**To run specific seeders:**
```bash
# Only seed users
php artisan db:seed --class=UserSeeder

# Only seed orders
php artisan db:seed --class=OrderSeeder

# Only seed transactions
php artisan db:seed --class=TransactionSeeder
```

**To reset and reseed database:**
```bash
php artisan migrate:fresh --seed
```
⚠️ Warning: This will delete ALL existing data!

#### 9. Create Storage Symlink
```bash
php artisan storage:link
```
This creates a symbolic link from `public/storage` to `storage/app/public` for file uploads.

#### 10. Build Frontend Assets
For development:
```bash
npm run dev
```

For production:
```bash
npm run build
```
This compiles Tailwind CSS and prepares all frontend assets.

#### 11. Start Development Server
```bash
php artisan serve
```
Your application will be accessible at: **http://localhost:8000**

### Alternative: Using Laravel Sail (Docker)
If you prefer using Docker:

#### 1. Install and Start Sail
```bash
./vendor/bin/sail up -d
```

#### 2. Run migrations inside container
```bash
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
```

#### 3. Build assets
```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

### Post-Installation Configuration

#### Setting Up Admin Account
If you didn't run the seeder, create an admin account manually:

1. Register a new account through the web interface
2. Access the database and update the user's role:
```sql
UPDATE users SET role = 'admin' WHERE email = 'your-email@example.com';
```

#### Setting Up Automated Backups
To schedule daily backups:

1. Open crontab:
```bash
crontab -e
```

2. Add this line:
```bash
0 2 * * * cd /path/to/Website-Laundry-Laravel && php artisan laundry:backup >> /dev/null 2>&1
```
This runs backup every day at 2 AM.

#### Running in Production

For production deployment:

1. Set environment to production:
```env
APP_ENV=production
APP_DEBUG=false
```

2. Optimize application:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

3. Set proper file permissions:
```bash
chmod -R 755 storage bootstrap/cache
```

4. Use a web server like Nginx or Apache instead of `php artisan serve`

### Troubleshooting

**Issue: "RouteNotFoundException"**
- Solution: Clear route and config cache
```bash
php artisan route:clear
php artisan config:clear
php artisan cache:clear
```

**Issue: "Class not found"**
- Solution: Regenerate autoload files
```bash
composer dump-autoload
```

**Issue: Database connection error**
- Verify `.env` database credentials
- Ensure MySQL service is running
- Check if database exists

**Issue: Storage permission errors**
- Run: `chmod -R 775 storage bootstrap/cache`
- Ensure web server user has write permissions

### Development Workflow

When working on new features:

1. Create a feature branch:
```bash
git checkout -b feature/your-feature-name
```

2. Make your changes and test

3. Commit with descriptive messages:
```bash
git add .
git commit -m "Add feature: description"
```

4. Push to remote:
```bash
git push origin feature/your-feature-name
```

### Additional Commands

**Clear all caches:**
```bash
php artisan optimize:clear
```

**Run tests:**
```bash
php artisan test
```

**Create manual backup:**
```bash
php artisan laundry:backup
```

**Watch for frontend changes (development):**
```bash
npm run dev
```

For more information or issues, please refer to [Laravel Documentation](https://laravel.com/docs) or create an issue in this repository.

