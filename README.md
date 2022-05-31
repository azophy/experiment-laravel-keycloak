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

## step using this repo
1. preparation
  ```
  cd example-socialite
  echo 'APP_KEY=' > .env
  touch database/database.sqlite

  # using docker
  docker compose up
  docker compose exec web sh -c "cd /app ; php artisan key:generate"

  # without docker
  composer install
  php artisan key:generate
  ```

2. config keycloak & laravel socialite. Script setting keycloak yang ada di repo ini masih butuh di setting, khususnya untuk base url & redirect url dari aplikasi yang akan kita koneksi-kan ke Keycloak.

3. Test dengan membuka halaman web utama.

## step from scratch:
1. prepare php & composer. you may use:
  ```
  docker run -it --rm -v "$PWD:/app" -w /app php:8.1-cli-alpine sh
  curl -sS https://getcomposer.org/installer | php
  ```
2. install laravel. what I use:
  ```
  composer create-project laravel/laravel example-app
  ```

# example 2: using laravel web guard plugin (github.com/mariovalney/laravel-keycloak-web-guard)

Sepemahaman saya, pendekatan ini hampir sama dengan pendekatan pertama via Socialite. Kalau dipikir2, memang keycloak by default menggunakan protokol OIDC, yang merupakan ekstensi dari protokol OAuth 2.0 yang digunakan Socialite. Akibatnya memang flow yang digunakan akan cukup banyak kemiripan.

Perbedaan utama dari penggunaan library vs socialite ini adalah lib ini sudah menyertakan beberapa fungsionalitas lengkap seperti route + controller utk login & logout, middleware utk memeriksa hasil login, dan lain-lain. Kesamaannya antara lain lib ini blm menyertakan implementasi model User di database yang siap pakai, sehingga opsinya antara membuat model baru atau meng-extend base model yang disediakan oleh lib ini.

## steps from scratch
1. install packages
  ```
  composer require vizir/laravel-keycloak-web-guard
  ```
2. export config
  ```
  php artisan vendor:publish  --provider="Vizir\KeycloakWebGuard\KeycloakWebGuardServiceProvider"

  ```
3. setup keycloak:
  - Add accepted callback params : `/callback`
  - get public key in kaycloak admin page: Keycloak >> Realm Settings >> Keys >> RS256 >> Public Key
  - change `config/auth.php` according to https://github.com/mariovalney/laravel-keycloak-web-guard#laravel-auth
4. add protected routes. example:
  ```
  Route::get('/protected', function () {
      echo 'this page should be protected by login' ;
      echo '<br><pre>' ;
      print_r(Auth::user()) ;
      echo '</pre>' ;
      echo '<a href="/logout">Logout</a>';
  })->middleware('keycloak-web');
  ```
5. setting laravel
  - edit .env
  - edit redirect_url in `config/keycloak-web.php` into your protected route

### Notes
- per hari ini (23 mei 2022) masih terdapat bug sehingga fitur logout ini tidak bisa dipakai di keycloak versi 18 ke atas (https://github.com/mariovalney/laravel-keycloak-web-guard/issues/71 )

# Example 3 : Keycloak integration into Vanilla PHP project

Di sini saya mencoba melakukan integrasi dengan project PHP "kosongan" yang tanpa framework. Harapannya contoh yang ada di project ini bisa lebih applicable ke berbagai macam project, tidak cuman yg hanya berbasis laravel.

# Example 4: Keycloak PHP integration with a project separated between BE & FE

## plan:
  + create basic laravel project with above library: https://github.com/robsontenorio/laravel-keycloak-guard
  - setup basic client with keycloak javascript adapter: https://www.keycloak.org/docs/latest/securing_apps/#_javascript_adapter
  - try to connect

## install
1. cd example-fe-be
2. edit .env.example into .env
3. docker compose up
4. test: `http --json localhost:8000/api/protected`



