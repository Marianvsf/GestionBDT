# 🏦 Sistema de Gestión de Incidencias - BDT

> **Banco Digital de los Trabajadores**
> Plataforma centralizada para el registro, seguimiento y resolución de incidencias tecnológicas.

![Status](https://img.shields.io/badge/Status-Despliegue_Listo-green)
![PHP](https://img.shields.io/badge/Backend-PHP_Nativo-blue)
![SQLite](https://img.shields.io/badge/Database-SQLite-lightgrey)

## 📖 Descripción

Este proyecto es una solución **Fullstack** desarrollada para modernizar la gestión de proyectos del BDT. Reemplaza el registro manual en hojas de cálculo por un sistema web robusto que garantiza la integridad de los datos y la eficiencia operativa.

El sistema utiliza una arquitectura **MVC (Modelo-Vista-Controlador)** construida desde cero con **PHP Nativo**, asegurando un rendimiento óptimo y una **portabilidad total** (Zero-Installation) gracias a su base de datos integrada SQLite y su servidor embebido.

## 🚀 Características Principales

- **🔐 Persistencia de Sesión Robusta:** Mantiene la sesión del usuario activa entre recargas y navegaciones (Server-side Sessions).
- **🤖 Clasificación Inteligente (IA Simulata):** Algoritmo lógico que analiza la descripción del problema y asigna automáticamente Categoría y Prioridad (ej: "wifi" → Infraestructura).
- **📦 Portabilidad Total:** No requiere instalación de XAMPP, Apache o MySQL. Todo el entorno corre desde la carpeta del proyecto.
- **💾 Base de Datos Autocurable:** Si el archivo de base de datos se borra, el sistema lo reconstruye automáticamente con datos iniciales.
- **🎨 UI Moderna:** Interfaz limpia y responsiva construida con **Tailwind CSS**.

## 🛠️ Stack Tecnológico

- **Lenguaje:** PHP 8.x (Modo CLI Server).
- **Base de Datos:** SQLite 3.
- **Frontend:** HTML5 + Tailwind CSS (CDN).
- **Arquitectura:** MVC Manual (Sin Frameworks).

## 📂 Estructura del Proyecto

```text
proyecto-bdt/
├── app/                  # Lógica del Negocio (MVC)
│   ├── Config/           # Conexión a BD y Migraciones
│   ├── Controllers/      # Controladores de Auth y Tickets
│   ├── Models/           # Acceso a datos (User, Ticket)
│   └── Views/            # Plantillas HTML/PHP
├── database/             # Archivo bdt.sqlite (Base de datos física)
├── php/                  # Entorno PHP Portable (Binarios)
├── public/               # Punto de entrada (index.php) y Assets
└── README.md             # Documentación

```

## ⚡ Guía de Inicio Rápido (Despliegue)

Este proyecto está diseñado para funcionar sin instalaciones previas. Sigue estos pasos para levantar el entorno:

### 1. Ejecutar el Servidor

Abre una terminal en la carpeta raíz del proyecto y ejecuta el siguiente comando:

```bash
# Para Windows (usando el PHP portable incluido)
./php/php.exe -S localhost:8000 -t public

```

### 2. Acceder al Sistema

Abre tu navegador web y visita:
`http://localhost:8000`

### 3. Credenciales de Acceso

El sistema genera un usuario administrador por defecto:

| Rol         | Usuario | Contraseña |
| ----------- | ------- | ---------- |
| **Gerente** | `admin` | `123456`   |

## 🧪 Cómo probar la "IA" de Clasificación

Para verificar el requerimiento **RF-03 (Clasificación Automática)**:

1. Inicia sesión y ve a **"Nuevo Reporte"**.
2. En el campo de descripción, escribe una frase que contenga palabras clave:

- _Prueba 1:_ "No tengo conexión al **wifi** en mi oficina." (El sistema asignará: **Infraestructura / Alta**)
- _Prueba 2:_ "Olvidé mi **clave** de acceso." (El sistema asignará: **Seguridad / Media**)

3. Guarda el ticket y verifica la tabla en el Dashboard.

## 🔒 Seguridad

- Contraseñas hasheadas (simulado para demo).
- Protección contra acceso directo a rutas (Middleware de sesión).
- Saneamiento básico de inputs HTML.

---

**Desarrollado para el Banco Digital de los Trabajadores - 2026**

```

```
