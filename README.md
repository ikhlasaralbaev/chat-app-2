RUN DOCKER

```sh {"id":"01J0QYFG4ZXYSWKSSNCG6PQ478"}
docker compose up --build -d
```

OPEN THE php-cli bash

```sh {"id":"01J0QYG8NMDB9Z2XFNYHK53CTG"}
docker compose exec -u 0 php-cli bash
```

MIGRATE PROJECT

```sh {"id":"01J0QYHMWF0XAMJCHZMTC22B39"}
php artisan migrate:fresh --seed
```

Default user
<br />
-- login: admin@gmail.com
<br />
-- password: password

Real key, port, hosts in .env.example file.
