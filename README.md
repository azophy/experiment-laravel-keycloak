EXPERIMENT SETUP LOGIN LARAVEL DENGAN KEYCLOAK
==============================================

## urutan plan
- [x] setup keycloak di local dengan docker/docker compose. reference:
  - https://www.keycloak.org/getting-started/getting-started-docker
  - https://dev.to/krishxda/keycloak-docker-setup-tutorial-16ip
- [ ] implementasi keycloak login pakai laravel socialite (yang Abit paling familiar, https://socialiteproviders.com/Keycloak/)
- [ ] pakai web guard (https://github.com/mariovalney/laravel-keycloak-web-guard)
- [ ] pakai JWT(https://github.com/robsontenorio/laravel-keycloak-guard)

## how to user this repo

0. Setup keycloak. The easiest ways is to use docker:

```
docker run -p 8080:8080 -e KEYCLOAK_ADMIN=admin -e KEYCLOAK_ADMIN_PASSWORD=admin quay.io/keycloak/keycloak:18.0.0 start-dev
```
1. Clone this repo
2. `docker compose up`
