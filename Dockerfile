#FROM debian:latest
FROM bitnami/php-fpm:7.2-debian-9

MAINTAINER Vítězslav Dvořák <info@vitexsoftware.cz>

RUN apt update;  apt-get install -my wget gnupg dpkg-dev debconf unzip ssmtp

ADD vendorzone_*_all.deb /repo/vendorzone_all.deb
#RUN gdebi -n /tmp/vendorzone_all.deb

RUN cd /repo ; dpkg-scanpackages . /dev/null | gzip -9c > Packages.gz 
RUN echo "deb [trusted=yes] file:///repo/ ./" > /etc/apt/sources.list.d/local.list

RUN wget -O - http://v.s.cz/info@vitexsoftware.cz.gpg.key | apt-key add -
RUN echo deb http://v.s.cz/ stable main | tee /etc/apt/sources.list.d/vitexsoftware.list

RUN apt update; #DEBIAN_FRONTEND="noninteractive" apt-get -y --allow-unauthenticated install vendorzone
#    DEBCONF_DEBUG="developer" 

RUN rm -rfv /app ; ln -s /usr/share/vendorzone /app ;
RUN composer require pear/mail -d /usr/share/vendorzone/
RUN composer require pear/mail_mime -d /usr/share/vendorzone/

EXPOSE 9000

WORKDIR /app
CMD [ "php-fpm", "-F", "--pid", "/opt/bitnami/php/tmp/php-fpm.pid", "-y", "/opt/bitnami/php/etc/php-fpm.conf" ]
