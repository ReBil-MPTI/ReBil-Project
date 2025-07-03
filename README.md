# 🚀 ReBil-MPTI - Laravel 12 Project Setup

<p align="center">
  <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel Logo" width="100" />
  &nbsp;&nbsp;&nbsp;&nbsp;
  <img src="https://cdn-icons-png.flaticon.com/512/2772/2772128.png" alt="Database Logo" width="80" />
</p>

> **ReBil-MPTI** adalah proyek Laravel yang dibangun dengan Laravel 12.x dan PHP 8.2 untuk sistem manajemen data berbasis web.

---

## Persyaratan Sistem

-   PHP >= 8.2
-   Laravel >= 12.x
-   Composer
-   Node.js dan npm

## Instalasi

1. **Kloning repositori ini**

    ```bash
    git clone https://github.com/ReBil-MPTI/ReBil-Project.git
    cd repo
    ```

2. **Instal dependensi PHP dengan Composer**

    ```bash
    composer install
    ```

3. **Salin file konfigurasi `.env`**

    ```bash
    cp .env.example .env
    ```

4. **Ubah Konfigurasi `.env`**

    open .env and change DB setting

5. **Generate kunci aplikasi**

    ```bash
    php artisan key:generate
    ```

6. **Jalankan Migration, Seeder**

    ```bash
    php artisan migrate --seed

7. **Instal dependensi Node.js dengan npm**

    ```bash
    npm install
    ```

8. **Jalankan Vite untuk mengompilasi aset**

    ```bash
    npm run dev
    ```

9. **Jalankan server pengembangan**

    ```bash
    php artisan serve
    ```
