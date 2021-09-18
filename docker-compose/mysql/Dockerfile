# Dockerfile
FROM mysql:5.7.32

RUN mkdir -p /tmp/psql_data/

COPY ./docker-compose/mysql/init.sql /tmp/psql_data/
COPY ./docker-compose/mysql/init_docker_postgres.sh /docker-entrypoint-initdb.d/