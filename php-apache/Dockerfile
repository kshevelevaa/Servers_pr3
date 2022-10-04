FROM php:7.2-apache
# рекурсивное создание папки
RUN mkdir -p /var/www/apache-server/html
# - рекурсивно обновляем и устанавливаем все необходимые пакеты линукса
# - первый пакет - набор утилит для apache
# - второй пакет - для авторизации в apache через бд
RUN apt-get update -y && apt-get install -y apache2-utils libaprutil1-dbd-mysql
# подключаем пакет с авторизацией через бд в apache
RUN a2enmod authn_dbd
RUN docker-php-ext-install mysqli