Backend
=======

Local Deploy Sequence
---------------------

1. `git clone https://github.com/getJv/blog_backend.git`
2. `cd blog`
3. `php artisan migrate`
4. `php artisan passport:install`
5. `php artisan serve`

Routes
------

* `http://127.0.0.1:8000/api/register` 
* params: `{'name':'jhonatan','email':'jhonatan@test.com','password':'secret123','password_confirmation':'secret123'}`

* `http://127.0.0.1:8000/api/login` 
* params: `{'email':'jhonatan@test.com','password':'secret123'}`
