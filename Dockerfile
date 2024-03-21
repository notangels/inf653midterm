FROM docker/whalesay:latest
LABEL Name=phprest Version=0.0.1
RUN apt-get -y update && apt-get install -y fortunes
CMD ["sh", "-c", "/usr/games/fortune -a | cowsay"]
# Install required system packages and dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Adding Postgres support:
RUN docker-php-ext-install pdo_pgsql