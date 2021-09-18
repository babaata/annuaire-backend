# Dockerfile
FROM mysql:5.7.32

RUN mkdir -p /tmp/psql_data/

COPY ./init_db.sql /tmp/psql_data/
COPY ./init_docker_mysql.sh /docker-entrypoint-initdb.d/