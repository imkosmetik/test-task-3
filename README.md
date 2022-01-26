<p align="center">
    <h1 align="center">Тестовое задание</h1>
    <br>
</p>

Для ТЗ был использован базовый шаблон фреймворка Yii2. Необходимую документацию по структуре проекта и т.п. можно найти по адресу [Yii 2](https://www.yiiframework.com/doc/guide/2.0/ru)

Необходимые инструменты для установки 
------------
- [Composer](https://getcomposer.org/)
- php >= 7.2
- [Docker-compose](https://docs.docker.com/compose/install/)

Установка
------------
Скопировать и настроить (при необходимости) файл конфигурации

    cp .env-dist .env

Установка и запуск контейнеров

    docker-compose up -d

Установить пакеты

    composer install    
    
Выполнить миграции

    php yii migrate    
    
Заполнить БД тестовыми данными 

    php yii seed/seed-catalog
    
Тестовое задание будет доступно по адресу (если в .env файле была изменена переменная APP_PORT, то вместо 80 необходимо поставить значение переменной):

    http://127.0.0.1:80