# Backend Test Sabio Ekuator

Berikut merupakan cara instalasi hasil test backend developer dari sabio ekuator

## Instalasi

### Prasyarat

Pastikan Anda telah menginstal [Composer](https://getcomposer.org/) dan [Node.js](https://nodejs.org/).

### Langkah-langkah Instalasi

1. Clone repositori:

    ```bash
    git clone https://github.com/robbirodhiyan/backend-test.git
    ```

2. Pindah ke direktori proyek:

    ```bash
    cd backend-test
    ```

3. Salin file `.env.example` menjadi `.env` dan konfigurasikan database:

    ```bash
    cp .env.example .env
    ```

4. Instal dependensi PHP dengan Composer:

    ```bash
    composer install
    ```

5. Generate key aplikasi:

    ```bash
    php artisan key:generate
    ```

6. Jalankan migrasi database dan lakukan seeding jika diperlukan:

    ```bash
    php artisan migrate --seed
    ```

7. Instal dependensi JavaScript:

    ```bash
    npm install
    ```

8. Compile asset:

    ```bash
    npm run dev
    ```

9. Jalankan server development:

    ```bash
    php artisan serve
    ```

Proyek sekarang dapat diakses di [http://localhost:8000](http://localhost:8000).
