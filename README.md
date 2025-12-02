## Getting Started

Копируем .evn.example в .env
Переопределяем локальные переменные, если нужно:

    FORWARD_PORT - порт, на котором будет доступно HTTP-соединение с приложением
    FORWARD_DB_PORT - порт, на котором будет доступно соединение с MariaDb для локального хоста (127.0.0.1)
    FORWARD_REDIS_PORT - порт, на котором будет доступен Redis для локального хоста (127.0.0.1)

### Docker

Вносим записИ В  /etc/hosts

    127.0.0.1       test-leads.lo
    127.0.0.1       api.test-leads.lo

Поднимаем контейнеры

    docker compose up -d --build

Устанавливаем зависимости (composer)

    docker compose exec php-app composer update

Заполняем ключ приложения для шифрования

    docker compose exec --user=root php-app php artisan key:generate

Выполняем миграции (внутри контейнера)

    docker compose exec php-app php artisan migrate

Заполняем БД нужными из Seeders
    
    docker compose exec php-app php artisan db:seed TestUser

Сервер должен запуститься, чтобы проверить переходим [link](http://test-leads.lo/up)


После заполнения БД тестовыми данными доступна авторизация по адресу:

    POST http://test-leads.lo/api/login
    FORM_DATA:
    email, password
