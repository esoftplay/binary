FROM esoftplay/master:latest

RUN mkdir -p /var/www/html/binary
WORKDIR /var/www/html/binary

COPY . /var/www/html/binary
COPY modules/docker/sites.conf  /etc/nginx/conf.d/sites.conf
RUN chmod -R 777 images
RUN rm -rf images/cache
