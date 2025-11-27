# 🚀 NeoCMS Installation Guide

## System Requirements

- **PHP:** 8.0 to 8.4
- **Composer:** 2.0+
- **Database:** MySQL 5.7+, PostgreSQL 10+, or SQLite 3.8+
- **Web Server:** Apache, Nginx, or PHP built-in server

### Required PHP Extensions

- PDO (MySQL/PostgreSQL/SQLite)
- mbstring
- OpenSSL
- JSON
- cURL
- GD or Imagick (for image processing)

---

## Installation Methods

### Method 1: Quick Installation (Recommended)

```bash
# Clone the repository
git clone https://github.com/neonextechnologies/neocms.git
cd neocms

# Install dependencies
composer install

# Setup environment
cp .env.example .env

# Generate application key
php neo app:key

# Configure your database in .env
# Then run migrations
php neo migrate

# Seed initial data
php neo db:seed

# Start development server
php neo serve
```

Visit `http://localhost:8000` and login with:
- **Email:** admin@neocms.local
- **Password:** password

---

### Method 2: Composer Create-Project

```bash
composer create-project neonex/neocms my-cms
cd my-cms
php neo app:key
php neo migrate --seed
php neo serve
```

---

### Method 3: Manual Installation

1. **Download NeoCMS**
   ```bash
   git clone https://github.com/neonextechnologies/neocms.git
   cd neocms
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Environment Configuration**
   ```bash
   cp .env.example .env
   ```
   
   Edit `.env` and configure:
   ```env
   APP_NAME=NeoCMS
   APP_ENV=local
   APP_DEBUG=true
   APP_URL=http://localhost:8000
   
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=neocms
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate Application Key**
   ```bash
   php neo app:key
   ```

5. **Create Database**
   ```bash
   # MySQL
   mysql -u root -p
   CREATE DATABASE neocms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   EXIT;
   ```

6. **Run Migrations**
   ```bash
   php neo migrate
   ```

7. **Seed Initial Data**
   ```bash
   php neo db:seed
   ```

8. **Set Permissions** (Linux/Mac)
   ```bash
   chmod -R 775 storage bootstrap/cache
   chown -R www-data:www-data storage bootstrap/cache
   ```

9. **Start Server**
   ```bash
   php neo serve
   ```

---

## Database Configuration

### MySQL

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=neocms
DB_USERNAME=root
DB_PASSWORD=your_password
```

### PostgreSQL

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=neocms
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

### SQLite

```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
```

Create the database file:
```bash
touch database/database.sqlite
php neo migrate
```

---

## Web Server Configuration

### Apache

Create `.htaccess` in `public/` directory (already included):

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^ index.php [L]
</IfModule>
```

Ensure `mod_rewrite` is enabled:
```bash
sudo a2enmod rewrite
sudo service apache2 restart
```

Virtual host configuration:
```apache
<VirtualHost *:80>
    ServerName neocms.local
    DocumentRoot /path/to/neocms/public
    
    <Directory /path/to/neocms/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/neocms-error.log
    CustomLog ${APACHE_LOG_DIR}/neocms-access.log combined
</VirtualHost>
```

### Nginx

```nginx
server {
    listen 80;
    server_name neocms.local;
    root /path/to/neocms/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

---

## Docker Installation

### Using Docker Compose

Create `docker-compose.yml`:

```yaml
version: '3.8'

services:
  app:
    build:
      context: .
      dockerfile: Dockerfile
    ports:
      - "8000:8000"
    volumes:
      - .:/var/www/html
    environment:
      - DB_CONNECTION=mysql
      - DB_HOST=db
      - DB_DATABASE=neocms
      - DB_USERNAME=root
      - DB_PASSWORD=secret
    depends_on:
      - db
      - redis

  db:
    image: mysql:8.0
    ports:
      - "3306:3306"
    environment:
      MYSQL_ROOT_PASSWORD: secret
      MYSQL_DATABASE: neocms
    volumes:
      - dbdata:/var/lib/mysql

  redis:
    image: redis:7-alpine
    ports:
      - "6379:6379"

volumes:
  dbdata:
```

Create `Dockerfile`:

```dockerfile
FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

CMD php neo serve --host=0.0.0.0 --port=8000
```

Run:
```bash
docker-compose up -d
docker-compose exec app php neo migrate --seed
```

---

## Cache Configuration

### Redis (Recommended for Production)

Install Redis:
```bash
# Ubuntu/Debian
sudo apt install redis-server

# macOS
brew install redis
```

Configure `.env`:
```env
CACHE_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379
REDIS_PASSWORD=null
```

Install PHP Redis extension:
```bash
# Via PECL
pecl install redis

# Via Composer (alternative)
composer require predis/predis
```

### File Cache (Default)

```env
CACHE_DRIVER=file
```

---

## Initial Setup

### 1. Access Admin Panel

Visit: `http://your-domain.com/admin`

Default credentials:
- **Email:** admin@neocms.local
- **Password:** password

⚠️ **Change the default password immediately!**

### 2. Configure Site Settings

Navigate to: **Settings → General**

- Site Name
- Site Description
- Site Logo
- Timezone
- Language

### 3. Configure Email

Edit `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@neocms.local
MAIL_FROM_NAME="${APP_NAME}"
```

### 4. Enable Modules

```bash
# List available modules
php neo module:list

# Enable specific modules
php neo module:enable blog
php neo module:enable ecommerce
```

---

## Production Deployment

### 1. Environment Configuration

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

### 2. Optimize Performance

```bash
# Cache configuration
php neo config:cache

# Cache routes
php neo route:cache

# Cache views
php neo view:cache

# Optimize autoloader
composer install --no-dev --optimize-autoloader
```

### 3. Security

```bash
# Generate new app key
php neo app:key

# Set proper permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Disable directory listing
# Add to .htaccess or nginx config
```

### 4. Enable HTTPS

Use Let's Encrypt:
```bash
sudo certbot --nginx -d yourdomain.com
```

### 5. Setup Cron Jobs

Add to crontab:
```bash
* * * * * cd /path/to/neocms && php neo schedule:run >> /dev/null 2>&1
```

### 6. Setup Queue Worker

Using systemd:
```bash
sudo nano /etc/systemd/system/neocms-worker.service
```

```ini
[Unit]
Description=NeoCMS Queue Worker
After=network.target

[Service]
User=www-data
Group=www-data
Restart=always
ExecStart=/usr/bin/php /path/to/neocms/neo queue:work

[Install]
WantedBy=multi-user.target
```

Enable and start:
```bash
sudo systemctl enable neocms-worker
sudo systemctl start neocms-worker
```

---

## Troubleshooting

### Permission Issues

```bash
# Fix storage permissions
chmod -R 775 storage bootstrap/cache

# Set correct owner
chown -R www-data:www-data storage bootstrap/cache
```

### Composer Memory Limit

```bash
php -d memory_limit=-1 /usr/local/bin/composer install
```

### Database Connection Failed

- Verify database credentials in `.env`
- Ensure database server is running
- Check firewall rules
- Verify PHP PDO extension is installed

### 500 Internal Server Error

```bash
# Check logs
tail -f storage/logs/neo.log

# Clear cache
php neo cache:clear
php neo config:clear

# Check permissions
ls -la storage bootstrap/cache
```

### Module Not Found

```bash
# Regenerate autoload
composer dump-autoload

# Clear cache
php neo cache:clear

# Re-register modules
php neo module:discover
```

---

## Updating NeoCMS

### Via Git

```bash
# Backup database first!
php neo db:backup

# Pull latest changes
git pull origin main

# Update dependencies
composer install

# Run migrations
php neo migrate

# Clear caches
php neo cache:clear
php neo config:clear
php neo view:clear
```

### Via Composer

```bash
# Backup first
php neo db:backup

# Update
composer update neonex/neocms

# Migrate
php neo migrate

# Clear caches
php neo optimize:clear
```

---

## Getting Help

- 📚 [Documentation](https://docs.neocms.io)
- 💬 [Community Forum](https://forum.neocms.io)
- 🐛 [Issue Tracker](https://github.com/neonextechnologies/neocms/issues)
- 📧 [Email Support](mailto:support@neonex.dev)

---

## License

NeoCMS is open-source software licensed under the [MIT license](LICENSE).
