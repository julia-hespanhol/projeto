FROM mysql:5.7 as database_onboarding

COPY sql/baseline-structure.sql /docker-entrypoint-initdb.d/01_baseline-structure.sql
COPY sql/baseline-data.sql /docker-entrypoint-initdb.d/02_baseline-data.sql

EXPOSE 3306

CMD ["mysqld"]