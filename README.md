Backend
=======

Local Deploy Sequence
---------------------

1. Run `git clone https://github.com/getJv/blog_backend.git`
2. Run `cd blog`
3. Run `composer install`
4. Run `php artisan key:generate`
5. Set your database params at .env file 
6. Run `php artisan migrate`
6. Run `php artisan passport:install`
7. update your `Client secret` at .env file (PASSPORT_CLIENT_SECRET)
7. Run your code under `php artisan serve`  or your prfered webserver
8. Enjoy your App

Routes
------

* `http://127.0.0.1:8000/api/register` 
* params: `{'name':'jhonatan','email':'jhonatan@test.com','password':'secret123','password_confirmation':'secret123'}`

* `http://127.0.0.1:8000/api/login` 
* params: `{'email':'jhonatan@test.com','password':'secret123'}`
