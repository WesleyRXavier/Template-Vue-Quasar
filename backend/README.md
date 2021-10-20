<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

#  BackEnd

O backend desenvolvido em Laravel 8 - autenticacao da Api com Laravel-Sanctum


## Install the dependencies
```bash
composer install
```
##  Arquivo Env
```bash
 Duplicar o arquivo env.example e renomear para .env

indicar a base de dados 

```
### Criar as tabelas e popular tabela "users" com registros de teste
```bash
Rodar o comando php artisan migrate --seed
```

### Gerar a chave da aplicação
```bash
Rodar o comando php artisan key:generate
```


### iniciar o servidor da Api
```bash
Php artisan serve
```



