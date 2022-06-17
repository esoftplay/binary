FROM esoftplay/master:latest

RUN mkdir -p /var/www/html/binary
WORKDIR /var/www/html/binary

COPY . /var/www/html/binary
COPY modules/docker/sites.conf  /etc/nginx/conf.d/sites.conf
RUN mv config.sample.php config.php
RUN chmod -R 777 images
RUN rm -rf images/cache
RUN cat modules/docker/cronjob >> /etc/cron.d/cronjob
RUN crontab -l | { cat /etc/cron.d/cronjob; } | crontab