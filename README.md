# Docker para Desafio

### Primeiro fazer o clone do projeto ou baixar o memso em zip

```
git clone https://github.com/juniorsantos/app.git && cd app
```

Logo após o clone do projeto fazer uma copia do .env.example para o .env

```
cp .env.example .env
```

Adicionar o USER_UID de seu usuário
Primeiro use o comando abaixo para pegar o seu UID no Linux ou no Mac OS

```
echo $UID
```
Copie o número informado e coloque no .env no parametro USER_UID está no final do arquivo

### Execute o comando para iniciar a docker
```
docker-compose up -d --build
```
Acesse a docker do aplicativo com o seguinte comando.

```
docker exec -it app_php sh
```
Após acessar a maquina docker, execute o comando para instalar o laravel.

```
composer install
```

Após instalar o laravel popule o banco (dentro da docker)

```
php artisan migrate --seed
```

Caso precise limpar e popular novamente: (dentro da docker)

```
php artisan migrate:fresh --seed
```

Para rodar o teste de unidade (dentro da docker)

```
php artisan test
```

### Configurando /etc/hosts

Edite o arquivo /etc/hosts e adicione o nome do host suitebox.
```
nano /etc/hosts
```
Adicione o host.
```
127.0.0.1	app.local
```

A documentação se econtra em

```
https://app.local/doc
```
Endpoint

```
https://app.local/api
```
###Usuario e senha padrão

"email": "user@test.com",
"password": "password"
