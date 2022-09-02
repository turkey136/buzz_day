FROM ubuntu:20.04

# Configuring tzdata settings
ENV TZ=Asia/Tokyo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update && apt-get install git vim curl lsb-release ca-certificates apt-transport-https software-properties-common -y
RUN add-apt-repository ppa:ondrej/php && apt-get update

# install apatche, php8.1, node, npm
RUN apt-get install apache2 php8.1 nodejs npm -y

WORKDIR /var/www/html

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 80
CMD ["apachectl", "-D", "FOREGROUND"]
