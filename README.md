EXPERIMENT SETUP LOGIN LARAVEL DENGAN KEYCLOAK
==============================================

## urutan plan
- [x] setup keycloak di local dengan docker/docker compose. reference:
  - https://www.keycloak.org/getting-started/getting-started-docker
  - https://dev.to/krishxda/keycloak-docker-setup-tutorial-16ip
- [ ] implementasi keycloak login pakai laravel socialite (yang Abit paling familiar, https://socialiteproviders.com/Keycloak/)
- [ ] pakai web guard (https://github.com/mariovalney/laravel-keycloak-web-guard)
- [ ] pakai JWT(https://github.com/robsontenorio/laravel-keycloak-guard)

## used applications
- docker with docker-compose
- Laravel 9 , PHP 8.1

## how to user this repo

1. Clone this repo
2. `docker compose up`

## cara config keycloak (setup realm, user, client)
- manual: ikuti tutorial di https://www.keycloak.org/getting-started/getting-started-docker#_create_a_realm
- otomatis:
  1. pastikan server keycloak sudah jalan
  2. jalan script utk auto setup dengan command:

    ```
    docker compose exec keycloak sh /app/scripts/keycloak-autosetup-example.sh
    ```

    script di atas akan membuat realm, user, & client dengan rincian:
    - nama realm: test_realm
    - nama client: test_client
    - nama user: testuser, password: testpassword
- cara test: bisa memanfaatkan aplikasi tester dari keycloak di keycloak.org/app . cukup masukkan alamat server keylok, nama realm, serta nama client. setelah itu bisa coba login dengan username yang sudah dibuat di tahap sebelumnya

# example 1: With Laravel Socialite

```
cd example-socialite
echo 'APP_KEY=' > .env
touch database/database.sqlite
docker compose up
docker compose exec web sh -c "cd /app ; php artisan key:generate"
```

step from scratch:
1. prepare php & composer. you may use:
  ```
  docker run -it --rm -v "$PWD:/app" -w /app php:8.1-cli-alpine sh
  curl -sS https://getcomposer.org/installer | php
  ```
2. install laravel. what I use:
  ```
  composer create-project laravel/laravel example-app
  ```

