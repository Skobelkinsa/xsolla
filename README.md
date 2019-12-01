## REST API Calculator

Тестовое задание по реализации простого Rest API калькулятора

**Docker**

Для установки из докера выполните команду
```sh
$ docker pull skobelkinsa/xsolla_test
```
**Установка:**

 - Клонируем git [проект](https://github.com/Skobelkinsa/xsolla)
```sh
$ git clone https://github.com/Skobelkinsa/xsolla.git; cd xsolla;
```
 - Собираем через Composer
```sh
$ composer install
```
 - Запускаем локальный сервер
```sh
$ php bin/console server:start
```

**OpenAPI (Swagger)**

Документация находится в директории [http://127.0.0.1:8000/docs/]()

OpenAPI 3.0 Specification [http://127.0.0.1:8000/calc/openapi.json]()
Base dir: [/calc/](http://127.0.0.1:8000/calc/)

Поддерживаемые запросы: **GET** **POST**

Параметры запроса: 

 - **method** (string)
 параметр предназначен для определения математической операции варианты: 
 **'addition'** - сложение 2ух/3ёх чисел (A+B, A+B+C), 
 **'subtraction'** - вычитание A-B, 
 **'multiplication'** - деление A/B, 
 **'division'** - Умножение A*B
 - **items** (array) массив чисел, не менее 2, не более 3 для операции сложения.

**PHP-UNIT Tests**

Тесты расположены в папке tests/. Т.к. вся логика находится в 1 контроллере по этому достаточно выполнить
```sh
$ php bin/phpunit tests/Controller/СCalcController.php
```