# Candidatozz

> Projeto crud candidatozz

# Instalação do projeto

## Requisitos

* PHP >= 7.0.0
* Composer >= v1.5
* MySQL >= 5.7.*

## Extensões PHP

* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* php ext-libsodium
* php ext-gmp

## Comandos para instalação

### Instalando as dependências

Entre no diretório da aplicação digite os comandos abaixo:

```
composer install
```

```
cp .env.example .env
```

```
php artisan key:generate
```

```
php artisan migrate --seed
```

```
php artisan passport:install
```

## Docs

Documentações das bibliotecas de terceiros utilizados no app

* Lumen passport - Autenticação API `https://github.com/dusterio/lumen-passport`
