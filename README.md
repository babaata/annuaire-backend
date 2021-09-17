# annuaire-backend
Api de l'annuaire des competences en Guinee.

# Configurer le Dockerfile et docker-compose.yaml
example de Dockerfile (python)
```sh
FROM python:3.8.3-alpine

ENV MICRO_SERVICE=/app


RUN mkdir -p $MICRO_SERVICE
RUN mkdir -p $MICRO_SERVICE/static

# where the code lives
WORKDIR $MICRO_SERVICE

# set environment variables
ENV PYTHONDONTWRITEBYTECODE 1
ENV PYTHONUNBUFFERED 1

# install psycopg2 dependencies
RUN apk update \
    && apk add --virtual build-deps gcc python3-dev musl-dev \
    && apk add postgresql-dev gcc python3-dev musl-dev \
    && apk del build-deps \
    && apk --no-cache add musl-dev linux-headers g++
RUN apk --update add libxml2-dev libxslt-dev libffi-dev gcc musl-dev libgcc openssl-dev curl
RUN apk add jpeg-dev zlib-dev freetype-dev lcms2-dev openjpeg-dev tiff-dev tk-dev tcl-dev
# install dependencies
RUN pip install --upgrade pip
# copy project
COPY . $MICRO_SERVICE
RUN pip install -r requirements.txt
RUN pip install gunicorn psycopg2
RUN pip install pillow
COPY ./entrypoint.sh $MICRO_SERVICE

CMD ["/bin/bash", "/app/entrypoint.sh"]

```
docker-compose avec nginx, gunicorn, postgresql
```yaml
version: '3.7'
networks:
  proxy_https_default:
     external: true
services:
  nginx:
    build: ./nginx
    ports:
      - 1300:80
    environment:
      - VIRTUAL_HOST=${DOMAIN}
      - VIRTUAL_PORT=80
      - LETSENCRYPT_HOST=${DOMAIN}
      - LETSENCRYPT_EMAIL=dev.harouna@gmail.com
    volumes:
      - static_volume:/app/static
      - media:/app/media
    depends_on:
      - web
    restart: "on-failure"
    networks:
      - default
      - proxy_https_default
  web:
    build: . #build the image for the web service from the dockerfile in parent directory
    command: sh -c "python manage.py makemigrations &&
                    python manage.py migrate &&
                    python manage.py collectstatic --noinput &&
                    gunicorn regitor.wsgi:application --bind 0.0.0.0:${APP_PORT}"
    volumes:
      - .:/app:rw # map data and files from parent directory in host to microservice directory in docker containe
      - static_volume:/app/static
      - media:/app/media
    env_file:
      - .env
    image: regitor_backend

    expose:
      - "${APP_PORT}"
    restart: "on-failure"
    depends_on:
      - db
  db:
    image: postgres:11-alpine
    volumes:
      - ./init.sql:/docker-entrypoint-initdb.d/init.sql
      - postgres_data:/var/lib/postgresql/data
    environment:
      - POSTGRES_PASSWORD=${POSTGRES_PASSWORD}
      - POSTGRES_DB=${DB_NAME}
      - PGPORT=${DB_PORT}
      - POSTGRES_USER=${POSTGRES_USER}
    restart: "on-failure"


volumes:
  postgres_data:
  static_volume:
  media:
```

# Regre de contribution
Regarder dans CONTRIBUTING.md

# Credit
Babaata