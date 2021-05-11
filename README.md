# imperian-systems/unifi-controller

## Note: This package is backend only, no user interface is included

* Clone the repo

```
git clone https://github.com/imperian-systems/unifi-controller.git
```

* Create a new Laravel install

  - https://laravel.com/docs/8.x/installation#installation-via-composer

* Add repo path to composer.json

```
    "repositories": [
        {   
            "type": "path",
            "url": "path/to/repo/unifi-controller"
        }
    ],
```

* Install unifi-controller

```
composer require imperian-systems/unifi-controller
```

* Configure database in .env

* Setup database tables for Unifi controller

```
php artisan migrate
```

* Run web server

```
php artisan serve --host=[::]
```

* SSH into Unifi device and point to controller

```
set-inform http://1.2.3.4:8000/inform
```

* View stored data in JSON format

  - http://1.2.3.4:8000/api/device

* View errors in storage/log/laravel.log
