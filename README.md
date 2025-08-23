# Blog API con Symfony, API Platform y JWT

Este proyecto es un **Blog API** desarrollado con **Symfony 7**, **API Platform**, y autenticación mediante **JWT** usando **LexikJWTAuthenticationBundle**.  
Incluye **DTOs** y se puede ejecutar fácilmente usando **Docker Compose**.

---

## Tecnologías utilizadas

-   PHP 8.2 (FPM)
-   Symfony 7
-   API Platform
-   Doctrine ORM
-   MariaDB 10.11.2
-   Nginx (stable-alpine)
-   LexikJWTAuthenticationBundle (JWT)
-   Symfony Serializer y DTOs
-   Docker

---

## Características principales

-   Gestión de **Usuarios** (registro, login con JWT)
-   Gestión de **Articles**
-   DTOs para exponer solo los campos necesarios en la API
-   Autenticación y autorización con **JWT**
-   API RESTful lista para consumir desde frontend o mobile
-   Soporte para tests unitarios y funcionales

---

## Instalación con Docker

1. **Clonar el repositorio**

````bash
git clone https://github.com/YohanDacosta/blog_api_php.git
cd blog-api-php

````
2. **Crear los contenedares e imagenes**

````bash
docker-compose exec up -d --build

````
4. **Instalar dependencias**

````bash
docker-compose exec -it php bash
composer install
