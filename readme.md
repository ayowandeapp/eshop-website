<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of any modern web application framework, making it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 1100 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for helping fund on-going Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell):

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[British Software Development](https://www.britishsoftware.co)**
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Pulse Storm](http://www.pulsestorm.net/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Eshop Ecommerce Website builts on Laravel Framework, MySQL,Bootstrap ##

### About project ###
the project consist of a fully functioning backend and frontend interface. users may register, view and order for products on the website and have it delivered. The project was built to enable ecommerce on the web, and to bring sellers closer to buyers. it was built on PHP Laravel Framework.

## Installation

In the project, open the env file and edit appropiately

     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=db_name //database name
     DB_USERNAME=root  //database username
     DB_PASSWORD=      //database password


     MAIL_DRIVER=smtp
     MAIL_HOST=smtp.gmail.com
     MAIL_PORT=587
     MAIL_USERNAME=ayooluwa71@gmail.com  //email address
     MAIL_PASSWORD=yqeetteeervh5aeed5taxyyydc //mail password
     MAIL_ENCRYPTION=tls

In the project directory, where you have package.json,run:
    To migrate all tables (or use the dummy.sql file to help start off. and populate the database)

      php artisan migrate

Also to start laravel framework,

	 php artisan serve


### The frontend ###

you may view all the listed product via categories and sub categories; by featured product and by recommended product. it also as the capacity to filter by category and minimum and maximum price And by searching using related keywords. it as a product details page which consist of prices in different currencies, recommended product, sizes, quantity. you may then add to Cart or add to a WishList. on the Cart page, you can change quantity,use coupon code,get quotes, remove item from cart and checkout. at checkout page, details of shipping address and delivery address is required. for users without an account, you would be redirected to login or register for an account to proceed. once the order is processed, there is an order page where the user may view all his/her orders. 

### The backend ###

It consist of an admin login page which redirects to the dashboard. (http://127.0.0.1:8000/admin)
The dashboard page shows the number of users, orders and a statistical chart.(http://127.0.0.1:8000/admin/dashboard)
Tthe category page, you may add new categories and sub categories, view, delete, deactivate, edit categories. (http://127.0.0.1:8000/admin/add-category) and (http://127.0.0.1:8000/admin/view-category)
For the product pages, you may add new products, view products, add product attribute, add product videos and images, edit product and delete product. (http://127.0.0.1:8000/admin/add-product) and (http://127.0.0.1:8000/admin/view-products)
For the order page, you may view all orders made, change the order status, delete orders and check the general information concerning the orders. (http://127.0.0.1:8000/admin/view-orders)
On the users page, you may check the details of the users and statistical chart.( http://127.0.0.1:8000/admin/view-users)
On the admin page, you may add new admins or sub admin (responsible for specific roles with limited access), change admin roles, delete admins. (http://127.0.0.1:8000/admin/view-admins)
Coupon pages: here you may add, view and delete coupon details. (http://127.0.0.1:8000/admin/add-coupon) and (http://127.0.0.1:8000/admin/view-coupons)
CMS pages: here you may add, view, edit and delete cms pages. (http://127.0.0.1:8000/admin/add-cms-page) and (http://127.0.0.1:8000/admin/view-cms-page)
Banners pages:here you may add, view, edit and delete frontend banners or slide shows. (http://127.0.0.1:8000/admin/add-banner) and (http://127.0.0.1:8000/admin/view-banners)
Currency Pages:here you may add, view, edit and delete different currency. (http://127.0.0.1:8000/admin/add-currency) and (http://127.0.0.1:8000/admin/view-currency)


### in the project directory, i have the database dummy.sql file to help you start off. as some of the tables where created maually ###