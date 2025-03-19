# Proyek Interview Rimba Ananta Vikasi Interview

Repositori ini berisi hasil proyek interview Rimba Ananta Vikasi Interview yang diselesaikan oleh Arief Umarjati.

## Gambaran Proyek

Aplikasi ini adalah aplikasi management user.

## Petunjuk Instalasi

Ikuti langkah-langkah berikut untuk menyiapkan dan menjalankan aplikasi:

### Prasyarat

-   PHP 8.1 atau lebih tinggi
-   Composer
-   MySQL atau MariaDB
-   Node.js dan NPM (untuk aset frontend)

### Langkah-langkah Instalasi

1. **Clone repositori**

```bash
git clone https://github.com/multabisu/rimba-ananta-vikasa-interview-arief-umarjati.git
cd rimba-ananta-vikasa-interview-arief-umarjati


composer install
cp .env.example .env
npm install
npm run watch
php artisan migrate
php artisan db:seed
php artisan serve
php artisan test
```
