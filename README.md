# CEMS Laravel

## Docker Deployment

### Prerequisites

- Docker >= 20.10
- Docker Compose >= 2.0

### Quick Start

```bash
# 1. Clone project
git clone <repository-url>
cd cems-laravel

# 2. Start containers
docker-compose up -d --build

# 3. Wait for containers to be ready (~30 detik)
docker-compose ps

# 4. Generate application key
docker-compose exec app php artisan key:generate

# 5. Apply migrations (if needed)
docker-compose exec app php artisan migrate

# 6. Access application
# Open http://localhost:8080
```

### Commands

| Command | Description |
|---------|-------------|
| `docker-compose up -d` | Start all services |
| `docker-compose up -d --build` | Build & start (use after code changes) |
| `docker-compose down` | Stop all services |
| `docker-compose down -v` | Stop & remove volumes (**WARNING**: deletes all data) |
| `docker-compose exec app sh` | Enter app container |
| `docker-compose logs -f` | View logs |
| `docker-compose logs -f app` | View app logs only |

### Troubleshooting

#### Permission Issues

Jika ada error permission:

```bash
# Fix storage permissions
docker-compose exec app chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Jika masih masalah, fix secara manual:
docker-compose exec app chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
```

#### Database Data Hilang

SQL hanya di-import saat **pertama kali** container dibuat. Jika data hilang:

```bash
# Cara 1: Import manual dari host
docker-compose exec -T db mysql -ucems_user -pcems_password cems < cems_2026-03-15.sql

# Cara 2: Reset seluruh database (hapus volume)
docker-compose down -v
docker-compose up -d --build
```

**Penting**: Jangan gunakan `-v` saat deploy jika ingin menjaga data!

#### App Key Tidak Valid

```bash
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan config:clear
```

### Environment Variables

Default dari docker-compose.yml:

| Variable | Default Value |
|----------|---------------|
| DB_HOST | db |
| DB_DATABASE | cems |
| DB_USERNAME | cems_user |
| DB_PASSWORD | cems_password |
| APP_ENV | local |
| APP_DEBUG | true |

### Ports

| Service | Port |
|---------|------|
| App (HTTP) | 8080 |
| Database | 3306 |

### Production Deployment

```bash
# Build tanpa cache
docker-compose build --no-cache

# Start dengan restart policy
docker-compose up -d

# Set environment production
docker-compose exec app php artisan config:cache
docker-compose exec app php artisan route:cache
```

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- [Expressive, intuitive database ORM](https://laravel.com/docs/eloquent).
- [Database agnostic schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).