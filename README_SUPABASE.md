# Supabase Backend Integration Guide

This guide will help you set up Supabase as the backend for your Laravel application and deploy it on Vercel.

## Prerequisites

1. A [Supabase](https://supabase.com) account
2. A [Vercel](https://vercel.com) account
3. Node.js and npm installed locally
4. PHP 8.3+ and Composer installed locally

## Step 1: Set Up Supabase Project

### 1.1 Create a New Supabase Project

1. Go to [supabase.com](https://supabase.com) and sign in
2. Click "New Project"
3. Fill in your project details:
   - **Name**: Your project name (e.g., "e-School")
   - **Database Password**: Choose a strong password (save this!)
   - **Region**: Choose the closest region to your users
4. Click "Create new project" and wait for setup to complete

### 1.2 Get Your Supabase Credentials

Once your project is created:

1. Go to **Settings** → **API** in the left sidebar
2. Copy the following values:
   - **Project URL** (e.g., `https://xxxxx.supabase.co`)
   - **anon/public key** (for client-side use)
   - **service_role key** (for server-side use - keep this secret!)

### 1.3 Get Database Connection String

1. Go to **Settings** → **Database** in the left sidebar
2. Under "Connection string", copy the **URI** connection string
3. Alternatively, note these values:
   - **Host**: `db.xxxxx.supabase.co`
   - **Port**: `5432`
   - **Database**: `postgres`
   - **User**: `postgres`
   - **Password**: (the password you set during project creation)

## Step 2: Configure Your Laravel Application

### 2.1 Install Dependencies

```bash
composer install
npm install
```

### 2.2 Create .env File

Copy the example environment file and configure it:

```bash
cp .env.example .env
```

Then edit `.env` with your Supabase credentials:

```env
# Database Configuration (Supabase PostgreSQL)
DB_CONNECTION=pgsql
DB_HOST=db.your-project-ref.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=your-database-password

# Supabase Configuration
SUPABASE_URL=https://your-project-ref.supabase.co
SUPABASE_KEY=your-anon-key
SUPABASE_SERVICE_KEY=your-service-role-key
```

### 2.3 Generate Application Key

```bash
php artisan key:generate
```

### 2.4 Run Migrations

```bash
php artisan migrate
```

## Step 3: Deploy to Vercel

### 3.1 Install Vercel CLI

```bash
npm install -g vercel
```

### 3.2 Login to Vercel

```bash
vercel login
```

### 3.3 Initialize Vercel Project

In your project directory:

```bash
vercel
```

Follow the prompts:
- **Set up and deploy?**: Yes
- **Which scope?**: Choose your account
- **Link to existing project?**: No
- **What's your project's name?**: Your project name
- **In which directory is your code located?**: ./
- **Want to override the settings?**: No

### 3.4 Configure Environment Variables in Vercel

Go to your Vercel project dashboard:

1. Navigate to **Settings** → **Environment Variables**
2. Add the following variables:

```
APP_NAME=e-School
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.vercel.app

DB_CONNECTION=pgsql
DB_HOST=db.your-project-ref.supabase.co
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=postgres
DB_PASSWORD=your-database-password

SUPABASE_URL=https://your-project-ref.supabase.co
SUPABASE_KEY=your-anon-key
SUPABASE_SERVICE_KEY=your-service-role-key

# Other required variables from .env.example
```

### 3.5 Deploy

```bash
vercel --prod
```

## Step 4: Using Supabase Features

### 4.1 Authentication

Laravel's built-in authentication will work with Supabase PostgreSQL database. Users are stored in the `users` table.

### 4.2 Real-time Features

You can use Supabase's real-time capabilities by installing the Supabase PHP client:

```php
use Supabase\LaravelPhp\Facades\Supabase;

// Example usage in a controller
$client = Supabase::client();
$data = $client->from('your_table')->select('*')->execute();
```

### 4.3 Storage

For file storage, you can use Supabase Storage or continue using Laravel's filesystem with S3-compatible storage.

## Troubleshooting

### Common Issues

1. **Database Connection Errors**
   - Verify your Supabase project is active
   - Check that your IP address is not blocked (Supabase allows all IPs by default)
   - Ensure database password is correct

2. **Migration Errors**
   - Make sure you're using PostgreSQL-compatible migrations
   - Check that the `pgsql` extension is enabled in PHP

3. **Vercel Deployment Issues**
   - Ensure all environment variables are set in Vercel
   - Check Vercel function logs for errors
   - Verify build command is correct

## Additional Resources

- [Supabase Documentation](https://supabase.com/docs)
- [Laravel Documentation](https://laravel.com/docs)
- [Vercel Documentation](https://vercel.com/docs)
- [Supabase PHP Client](https://github.com/supabase-community/supabase-php)

## Support

If you encounter any issues, please check:
1. Supabase dashboard logs
2. Vercel function logs
3. Laravel logs in storage/logs/laravel.log
