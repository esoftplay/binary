# Preparation
 * Install docker https://www.docker.com/get-started/
 * Make sure these port are available 80, 81 and 3307
 * install git [optional]
 * install framework [optional]
 * install mysql cli [optional]

# How to install framework [optional]
 * run command below
 ```bash
 mkdir -p /var/www/html/master
 cd /var/www/html/master
 git clone https://github.com/esoftplay/master.git ./
 docker-compose up -d
 mkdir -p /var/www/html/binary
 cd /var/www/html/binary
 git clone https://github.com/esoftplay/binary.git ./
 ```
 * create ./config.php as in http://dev.esoftplay.com
 * create database and change salt
 ```bash
 mysql -u root --password='root' --port 3307 -h 127.0.0.1 -e 'DROP DATABASE IF EXISTS binary'
 mysql -u root --password='root' --port 3307 -h 127.0.0.1 -e 'CREATE DATABASE IF NOT EXISTS binary'
 mysql -u root --password='root' --port 3307 -h 127.0.0.1 binary < database.sql
 curl -s -X POST -F 'code='$(date|md5) http://localhost/tools/repair/change_salt > /dev/null
 ```
 * open url http://localhost/
 * to close it you need to run `docker-compose down`

# How to run framework
 * run command below
```bash
cd /var/www/html/binary
docker-compose up -d
```

# How to create new project
 * run master or edit `docker-compose.yaml` to unmark sql service
 * create new folder and `cd` into this folder
 * run command below
 ```bash
 docker run -it -v $(pwd):/home/sites esoftplay/startbinary
 mysql -u root --password='root' --port 3307 -h 127.0.0.1 -e 'DROP DATABASE IF EXISTS new_binary'
 mysql -u root --password='root' --port 3307 -h 127.0.0.1 -e 'CREATE DATABASE IF NOT EXISTS new_binary'
 mysql -u root --password='root' --port 3307 -h 127.0.0.1 new_binary < database.sql
 docker-compose up -d
 curl -s -X POST -F 'code='$(date|md5) http://localhost/tools/repair/change_salt > /dev/null
 ```
 * open url http://localhost/

# How to run project
 * CD into the project folder
 * run `docker-compose up -d`
 * open url http://localhost/
 * edit the script if necessary

# Cronjob
 * `* * * * * /usr/bin/curl http://localhost/bin/fix`

# Learn more about the this framework
 * http://dev.esoftplay.com
