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
