1. После клонирования с помощью cmd откройте папку проекта и по очереди выполните следующие команды:

```
composer install
cp .env.example .env
php artisan key:generate
```

2. Создайте пустую БД в вашей СУБД и отредактируйте файл.env, укажите в нем параметры вашей БД. Например:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

3. Запустите миграции и сидеры с помощью cmd.

```
php artisan migrate --seed
```

4. Запустите локальный сервер

```
php artisan serve
```

