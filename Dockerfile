FROM php:8.2-apache

# セキュリティヘッダ用のApacheモジュールを有効化
RUN a2enmod headers

# PHP本番環境用の推奨設定を適用（エラー詳細を画面に出さない・PHPバージョンを隠す）
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" && \
    sed -i 's/expose_php = On/expose_php = Off/' "$PHP_INI_DIR/php.ini"

RUN docker-php-ext-install pdo_mysql

COPY . /var/www/html/
EXPOSE 80
