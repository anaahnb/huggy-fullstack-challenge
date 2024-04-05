<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Sobre

Aplicação de agenda de contatos como parte do desafio para a vaga de Full Stack na Huggy.
Você pode acessar o protótipo da intefarce no [Figma](https://www.figma.com/file/g044NtrFul2H160eRFeHKB/Desafio-Front?type=design&node-id=1-2310&mode=design&t=xkZy3BfWTK1PEDew-0) e a documentaçãoda API no [Postman](https://www.postman.com/cryosat-geoscientist-4230260/workspace/aplicaes/documentation/33926909-8ed8ffbf-4980-4299-980a-f5eeb0b68e29). 
Esse projeto foi desenvolvida com Laravel 10 e VueJS 3.


## Intruções

Após clonar o projeto, instale as dependências do projeto
```bash
npm install
composer install
```

Execute os comandos abaixo para gerarem as tabelas do banco de dados e chaves no seu arquivo .env
```bash
php artisan migrate:fresh --seed
php artisan key:generate
php artisan jwt:secret

```
Para executar o projeto é preciso que dois comandos sejam executados simultaneamente em dois terminais diferentes dentro do diretório do projeto:
```bash
npm run dev
php artisan serve
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
