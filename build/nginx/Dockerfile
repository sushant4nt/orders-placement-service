FROM nginx:stable

COPY nginx.conf /etc/nginx/nginx.conf
COPY site.conf /etc/nginx/sites-enabled/site.conf

RUN echo "upstream php-upstream { server php-fpm:9000; }" > /etc/nginx/conf.d/upstream.conf

RUN usermod -u 1000 www-data

EXPOSE 8080 80 443

CMD ["nginx"]
