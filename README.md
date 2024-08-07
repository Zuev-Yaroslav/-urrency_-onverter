<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Инструкция
PHP, NGINX, Laravel, PostgreSQl
 - В .env поменяйте `DB_PORT`, `DB_DATABASE`, `DB_PASSWORD`.
 - `docker-compose up -d`, чтобы поднять контейнеры
 - `docker exec -it exchange_rates_app bash`
 - `php artisan migrate --seed`
 - `composer update`
 - `php artisan generate:key`
 - Используемый хост http://localhost:8876
 - Используемый домен ЦБ РФ https://www.cbr-xml-daily.ru

