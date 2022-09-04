FROM ubuntu:20.04

# Configuring tzdata settings
ENV TZ=Asia/Tokyo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# install git, vim, curl, apatche, php7.x, node, npm, composer
RUN apt-get update && \
  apt-get install git vim curl \
  apache2 \
  php libapache2-mod-php php-mbstring php-cli php-bcmath php-json php-xml php-zip php-pdo php-common php-tokenizer php-mysql php-curl php-gd php-soap php-xmlrpc \
  nodejs \
  npm -y && \
  curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
  npm install n -g && n stable && apt purge -y nodejs npm

# apatche Pass of AH00558
RUN echo "ServerName localhost" | tee /etc/apache2/conf-available/fqdn.conf && a2enconf fqdn && a2enmod rewrite

WORKDIR /var/www/html
EXPOSE 80
CMD ["apachectl", "-D", "FOREGROUND"]
