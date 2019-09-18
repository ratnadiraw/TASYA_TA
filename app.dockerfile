# Development

FROM php:7-fpm-alpine

# Create app directory and set as working directory
RUN mkdir -p /opt/ppl
WORKDIR /opt/ppl
RUN chown -R www-data:www-data /opt/ppl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

# Use default www-data (non-root) user
# USER www-data

# Install app dependencies (done before copying app source to optimize caching)
COPY composer.json /opt/ppl/
COPY composer.lock /opt/ppl/
RUN composer install --no-scripts --no-autoloader

# Copy app source to container
COPY . /opt/ppl

# Permission problem fix
USER root
RUN chown -R www-data:www-data /opt/ppl
USER www-data

# Set Laravel permissions
RUN mkdir -p /opt/ppl/storage
RUN mkdir -p /opt/ppl/bootstrap/cache
RUN chmod -R 0755 /opt/ppl/storage
RUN chmod -R 0755 /opt/ppl/bootstrap/cache

# Regenerate autoloader classmap and run post-install scripts
# RUN composer dump-autoload --optimize && composer run-script po

# Clear cache
#RUN php artisan cache:clear
#RUN php artisan config:clear
#RUN php artisan view:clear
#RUN php artisan route:clear

# Regenerate cache (TODO: check whether to enable this in dev)
#RUN php artisan config:cache
#RUN php artisan route:cache

EXPOSE 9000
CMD ["php-fpm"]
