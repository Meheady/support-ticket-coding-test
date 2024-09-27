composer install --ignore-platform-reqs

cp .env.example .env

php artisan key:generate

php artisan migrate

php artisan migrate:fresh --seed

php artisan storage:link

php artisan serve

======
Default Login Credentials (you can change it from DB email purpose)
======

CUSTOMER

Email: necit.meheady@gmail.com

Password: password

ADMIN

Email: hmmehedi55@gmail.com

Password: password

Set Email Credentials in .env file or login admin user > settings > setup/configure email (for sending email)

php artisan queue:work [run this command another terminal (if any issue rerun this command)]

Home page --- http://127.0.0.1:8000/

Login Page --- http://127.0.0.1:8000/login

Customer Registration page --- http://127.0.0.1:8000/register


