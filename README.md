# 🎟️ Sistema de Entradas para Conciertos – Laravel 10

Este proyecto es un sistema web para la gestión y compra de entradas a conciertos, desarrollado con Laravel 10 y Bootstrap 5. Ofrece funcionalidades tanto para usuarios como para administradores, incluyendo panel de control, compras, reembolsos y gestión de eventos.

---

## 🚀 Características principales

### 👤 Usuario normal
- Registro e inicio de sesión
- Visualización de eventos disponibles (`/eventos`)
- Visualización de detalles del evento (`/eventos/{id}`)
- Compra de entradas por localidad
- Reembolso de entradas
- Panel de “Mis entradas”

### 🛠️ Administrador
- Acceso al panel `/admin` con autenticación y middleware personalizado
- Crear, editar y eliminar eventos
- Crear, editar y eliminar localidades por evento
- Visualizar entradas vendidas por localidad (incluye usuario y fecha)
- Gestión de entradas (vista general)
- Panel central de administración con accesos a todo

---

## 📁 Estructura del Proyecto

```
/app
  └── Models
  └── Http
       └── Controllers
            ├── Admin (controladores administrativos)
/resources/views
  ├── admin
  ├── auth
  └── layouts
/routes
  └── web.php
```

---

## 🧩 Requisitos

- PHP >= 8.1
- Composer
- MySQL o MariaDB
- WAMP / XAMPP o entorno con Apache/Nginx
- Node.js y NPM (para compilar assets si se usa Laravel Mix)

---

## ⚙️ Instalación

```bash
git clone https://github.com/tu_usuario/tu_proyecto.git
cd tu_proyecto

# Instalar dependencias PHP
composer install

# Crear archivo de entorno
cp .env.example .env

# Configurar .env con credenciales de base de datos
# DB_DATABASE=bdproyecto

# Generar key
php artisan key:generate

# Crear la base de datos en MySQL y luego migrar
php artisan migrate --seed

# Si usas Laravel Mix:
npm install && npm run dev

# Iniciar servidor
php artisan serve
```

---

## 🧪 Usuarios de prueba

```bash
Usuario normal
Email: usuario@demo.com
Contraseña: 12345678

Administrador
Email: admin@demo.com
Contraseña: 12345678
```

> Puedes crear estos usuarios manualmente o por seed.

---

## 🛡️ Seguridad

- Rutas protegidas con `auth` y middleware personalizado `admin`
- Validaciones en formularios y controladores
- Confirmaciones para acciones destructivas como eliminar

---

## 📄 Licencia

MIT © 2025 - Proyecto académico
