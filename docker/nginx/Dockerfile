# Используем образ с Nginx
FROM nginx:latest

# Копирование конфигурационного файла Nginx
COPY nginx.conf /docker/nginx/nginx.conf

# Открытие порта для веб-сервера
EXPOSE 80

# Запуск Nginx
CMD ["nginx", "-g", "daemon off;"]