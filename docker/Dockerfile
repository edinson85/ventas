FROM amazonlinux:2

#USER PARAMS
USER root

# INSTALL NGINX
RUN yum -y update
COPY ./conf/nginx/nginx.repo /etc/yum.repos.d/
RUN yum -y update && yum -y install nginx && yum -y install initscripts

# INSTALL PING COMMAND
RUN yum install iputils

# INSTALL AND CONFIGURE PHP
RUN yum install gcc-c++ zlib-devel amazon-linux-extras -y
RUN amazon-linux-extras enable php8.2 && amazon-linux-extras install php8.2 -y
RUN yum -y install php php-bcmath php-cli php-mbstring php-xml php-opcache php-fpm php-intl php-gd php-pear php-devel php-sodium gd gd-devel wget unzip memcached tar

# INSTALL XDEBUG
RUN pecl install xdebug

# INSTALL AND CONFIGURE GIT
RUN yum -y install git

# INSTALL AND CONFIGURE COMPOSER
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"   \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer  \
    && php -r "unlink('composer-setup.php');"                                   \
    && ln -s /usr/local/bin/composer /usr/local/bin/composer.phar               \
    && composer self-update                                               \
    && composer --version

# SEPTUP SSH WITH SECURE ROOT LOGIN
RUN yum -y update \
    && yum -y install openssh-server netcat \
    && mkdir /var/run/sshd \
    && echo 'root:password' | chpasswd \
    && sed -i 's/\#PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config \
    && yum -y install nano


RUN alias gits='git status' && alias gitc='git commit' && alias gitb='git branch' \
    && alias gitl='git log'&& alias gitd='git describe'&& alias gitm='git merge' && alias gitch='git checkout'

# CHANGE HOSTS FILE
#COPY ./conf/hosts/hosts /etc/hosts

# LOAD CONFIG FOR NGINX
COPY ./conf/nginx/default.conf /etc/nginx/conf.d/default.conf

# LOAD PHP.INI CUSTOM
COPY ./conf/php/php.ini /etc/php.ini

# INSTALL SSL SELF SIGNED CERTIFICATE FOR DOMAIN TBO
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout nginx-selfsigned.key -out nginx-selfsigned.crt -subj "/C=CO/ST=BOG/L=BOG/O=Edinson Solarte, Inc./OU=IT/CN=Edinson.Solarte"

# RESTART NGIX AND PHP-FPM
RUN systemctl enable nginx.service && systemctl enable php-fpm.service

RUN git config --global --add safe.directory /usr/share/nginx/html

RUN git config --global user.email "edsolarte85@gmail.com"
RUN git config --global user.name "Edinson.Solarte"
RUN git config --global core.filemode false

CMD ["/usr/sbin/init"]