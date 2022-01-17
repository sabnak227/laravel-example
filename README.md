# Package manager
Managing dep
```
composer require xxx
composer install
composer update
```

Dep file and lock file
```
composer.json/composer.lock
```

dumping class map
```
composer dump-autoload
```
this will essentially updates the following files:
- `vendor/composer/autoload_xxxx.php`

# Project initialization
Docker approach, using [laravel sail](https://laravel.com/docs/8.x/installation#getting-started-on-macos)
```
./vendor/bin/sail up
```

# Important concepts to get yourself prepared to read the swipe code
- [request lifecycle](https://laravel.com/docs/8.x/lifecycle)
- [migration](https://laravel.com/docs/8.x/migrations#generating-migrations)
- [factory/seeder](https://laravel.com/docs/8.x/seeding#introduction)
- [models](https://laravel.com/docs/8.x/eloquent-relationships)
- [controller](https://laravel.com/docs/8.x/controllers)
- [validation](https://laravel.com/docs/8.x/validation)
- [eloquent](https://laravel.com/docs/8.x/eloquent)
- [route](https://laravel.com/docs/8.x/routing)
- [events](https://laravel.com/docs/8.x/events)
- [queues](https://laravel.com/docs/8.x/queues)
- [model observers](https://laravel.com/docs/8.x/eloquent#observers)
- [service container](https://laravel.com/docs/8.x/container)
- [tests](https://laravel.com/docs/8.x/testing)

cli commands:
```
./vendor/bin/sail php artisan verb:noun [options]
```

# Building a post crud app
### migration
laravel ship with basic user management
```
# migrate up
php artisan migrate
# migrate down
php artisan migrate:rollback
# migrate refresh
php artisan migrate:refresh
# migrate with seed
php artisan migrate:refresh --seed

```
create a post table
```
php artisan make:migration create_post_table
```

Discussions:
- how migrations table works in database
- relationships

### models
create post model
```
php artisan make:model Post
```

define relationships
user has many posts

### factory and seeder
create post factory
```
php artisan make:factory PostFactory
```
create seeder
```
php artisan make:seeder PostTableSeeder
```
seed database
```
php artisan migrate:refresh --seed
```

### Controller
```
php artisan make:controller PostController
or
php artisan make:controller PostController --resource
```

make a new request and resource
```
php artisan make:request PostRequest
php artisan make:resource PostResource
php artisan make:resource PostCollection --collection
```

### Service container
Assume a random adapter in App/Service/TestClient.php

Register it into service container
```
php artisan make:provider TestProvider
```

Note the difference between `bind` and `singleton`

### Model Observer
Create observer
```
php artisan make:observer PostObserver --model=Post
```
then register it in `EventServiceProvider`

check log for output

### Events
```
php artisan make:event TestEvent
php artisan make:listener TestEventListener --event=TestEvent
```
register in `EventServiceProvider`


### queues
```
php artisan make:job TestJob
```

### async processing
change `.env`'s `QUEUE_CONNECTION` from `sync` to `database`
```
php artisan queue:table

php artisan migrate
```

To process, run
```
php artisan queue:work
```

Making event listener queueable:
event listener should implement the `ShouldQueue` interface

### event vs queues
event decouples the business logic and can be easily swapped to different listeners when necessary
queue requires to be called explicitly but more straight forward, ideal for heavy jobs


### Test
