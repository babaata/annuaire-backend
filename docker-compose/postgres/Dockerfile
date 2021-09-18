# Dockerfile
FROM postgres:10.1

RUN mkdir -p /tmp/psql_data/

COPY ./docker-compose/postgres/init.sql /tmp/psql_data/
COPY ./docker-compose/postgres/init_docker_postgres.sh /docker-entrypoint-initdb.d/