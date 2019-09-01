Figured Test Blog - Backend
===========================

Live Demo on Heroku
-------------------

[https://figured-test-blog-frontend.herokuapp.com/](https://figured-test-blog-frontend.herokuapp.com/)
* Here i'm using only postgress as DB - because its free :D 
* The Heroku app needs to wake up on the first hit. Please be patient ;)

Video App
---------

[App apresentation](https://youtu.be/AQody6oaqjs)

[![Watch the video](https://img.youtube.com/vi/AQody6oaqjs/maxresdefault.jpg)](https://youtu.be/AQody6oaqjs)

Test Requirement
----------------

1. Please build a blog **(DONE)**
2. Users can read posts **(DONE)**
3. Admin user can login and create, update and delete posts. **(DONE)**
4. Using Laravel **(DONE)**
5. PHP7 **(DONE)**
6. MongoDB for storing the blog posts **(DONE)**
7. MySQL for users and auth **(DONE)**
8. Extra brownie points you can use Vue.js **(DONE)**
9. Really try to wow us with the exercise, good clean code, laravel features, tests **(Partial DONE)**
10. Aim for skinny controllers along with fatter models   **(DONE)**
11. Request-level validation and aim to keep methods small and clean **(DONE)**
12. Middleware for authentication **(DONE)**
13. if using any style guides. [Vuetify](https://vuetifyjs.com) **(DONE)**
14. prefer validation over exception handling **(DONE)**

Frontend Project
----------------

* [https://github.com/getJv/blog_frontend](https://github.com/getJv/blog_frontend)

Local Deploy Sequence
---------------------

1. Run `git clone https://github.com/getJv/blog_backend.git`
2. Run `cd blog`
3. Run `composer install`
4. Run `php artisan key:generate`
5. Set your database params at .env file 
6. Run `php artisan migrate --seed`
6. Run `php artisan passport:install`
7. update your `Client secret` at .env file (PASSPORT_CLIENT_SECRET)
8. Run your under your prefered webserver
9. Enjoy your App

Docker Users
------------

Just use the `docker-compose up -d` to set up your local machine
