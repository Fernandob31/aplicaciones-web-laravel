<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

# Boyz in the Sneaker 👟

### **Materia:** Aplicaciones Web
### **Integrantes:**
* **Fernando Benitez**
* **Gaston Llampa**

## **Entrega 20/4**
1. Preparacion de repositorio con Github, junto con ramas main y dev
2. Conexion con Vercel, a traves de workflows para el trabajo colaborativo sin limitacion de Vercel
3. Pagina inicial con nombre inicial de la tienda y nombres de los integrantes

---

## 📝 Introducción del Proyecto
El Proyecto Laravel consiste en una aplicación web desarrollada con el framework Laravel que permite la administración de productos o servicios que una empresa venderá de manera online. 

Nuestra tienda, **Boyz in the Sneaker**, está especializada en la comercialización de calzado. Este sistema web es de **uso exclusivo para el personal de la empresa**, funcionando como un panel administrativo robusto (Back-office) donde los empleados pueden gestionar el ciclo de vida de los productos.

---

## 🛠️ Especificaciones Técnicas

Para garantizar el rendimiento y utilizar las últimas capacidades del lenguaje, el proyecto se ha desarrollado bajo el siguiente stack:

* **Framework:** Laravel 13.x
* **Motor de Lenguaje:** PHP 8.5.5 (Ambiente de vanguardia)
* **Gestor de Dependencias:** Composer
* **Frontend Tooling:** React
* **Despliegue:** Vercel (vía GitHub Actions para integración continua)

### ⚠️ Nota sobre la versión de PHP
El proyecto utiliza **PHP 8.5.5**. Se ha configurado de esta manera para aprovechar las mejoras en el motor de reflexión y el manejo de propiedades virtuales. Para correr el proyecto de forma local, asegúrese de tener habilitadas las siguientes extensiones en su `php.ini`:
* `pdo_mysql`
* `fileinfo`
* `mbstring`
* `openssl`

---

## 🚀 Instalación Local

1. **Clonar el repositorio:**
   ```bash
   git clone [URL-DEL-REPO]
   cd aplicaciones-web-laravel

2. **Instalación de dependencias de PHP** 
    '''bash
    composer install
3. **Configuración del Entorno (.env)**
    '''bash
    cp .env.example .env
    php artisan key:generate
4. **Instalación de Frontend y Assets**
    '''bash
    npm install
    npm run build
5. **Ejecucion del proyect**
    '''bash
    php artisan serve