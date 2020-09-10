ARG MARIADB_VERSION=""

FROM mariadb:${MARIADB_VERSION:-latest}

COPY ./src/_installation/* /docker-entrypoint-initdb.d/

WORKDIR /docker-entrypoint-initdb.d

ARG MYSQL_DATABASE="login1"

RUN export DB=${MYSQL_DATABASE} \
    && sed -i "s/\`login\`/\`$DB\`/g" ./*.sql
