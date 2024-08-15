
# Setup Docker Laravel 11 com PHP 8.3 e PostgresSQL

### Passo a passo
Clone Repositório
```sh
git clone -b main https://github.com/matheuspcv13/laravel-docker.git nome_projeto
```
```sh
cd nome_projeto
```

Crie o Arquivo .env
```sh
cp .env.example .env
```

Suba os containers do projeto
```sh
docker-compose up --build -d
```

Acesse o container app
```sh
docker-compose exec app bash
```


Instale as dependências do projeto
```sh
composer install
```

Gere a key do projeto Laravel
```sh
php artisan key:generate
```


Rodar as migrations
```sh
php artisan migrate
```

Acesse o projeto
[http://localhost:8000](http://localhost:8000)
