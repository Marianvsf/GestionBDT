# 🏦 Sistema de Gestión de Incidencias - BDT

> **Banco Digital de los Trabajadores**
> Plataforma centralizada para el registro, seguimiento y resolución de incidencias tecnológicas.

![Status](https://img.shields.io/badge/Status-Despliegue_Listo-green)
![PHP](https://img.shields.io/badge/Backend-PHP_Nativo-blue)
![PostgreSQL](https://img.shields.io/badge/Database-PostgreSQL-blue)

---

## 📖 Descripción

GestionBDT es una solución **Fullstack** diseñada para modernizar la gestión de incidencias en BDT, eliminando los registros manuales y aportando eficiencia operativa.

Utiliza una arquitectura **MVC (Modelo-Vista-Controlador)** construida desde cero en **PHP Nativo**. Para entornos de producción requiere una base de datos **PostgreSQL** y la extensión `pdo_pgsql` habilitada.

### Objetivos

- Facilitar el seguimiento y resolución de incidencias técnicas.
- Mejorar la integridad de los datos.
- Reducir errores y tiempos de respuesta.

---

## 🚀 Características Principales

- **🔐 Persistencia de Sesión Robusta:** Mantiene la sesión del usuario entre recargas y navegaciones (server-side).
- **🤖 Clasificación Inteligente:** Algoritmo lógico basado en palabras clave que asigna Categoría y Prioridad.
- **📦 Portabilidad Total:** Ejecutable sin necesidad de instalar XAMPP, Apache o MySQL.
- **💾 Base de Datos Autocurable:** Reconstrucción automática de la base de datos si se elimina accidentalmente.
- **🎨 UI Moderna:** Interfaz limpias y responsiva con **Tailwind CSS**.
- **📝 Generación automática de usuario administrador:** Usuario y contraseña inicial para fácil acceso.

---

## 🛠️ Stack Tecnológico

- **Lenguaje:** PHP 8.x (CLI Server)
- **Base de Datos:** PostgreSQL
- **Frontend:** HTML5 + Tailwind CSS (CDN)
- **Arquitectura:** MVC Manual (Sin Frameworks)

## 📂 Estructura del Proyecto

```text
GestionBDT/
├── app/                  # Lógica del Negocio (MVC)
│   ├── Config/           # Conexión a BD y Migraciones
│   ├── Controllers/      # Controladores Auth y Tickets
│   ├── Models/           # Acceso a datos (User, Ticket)
│   └── Views/            # Plantillas HTML/PHP
├── database/             # (opcional) carpeta para dumps o migraciones
├── php/                  # PHP portable (binarios)
├── public/               # Punto de entrada (index.php) y Assets
└── README.md             # Documentación
```

---

## ⚡ Guía de Inicio Rápido

1. **Ejecutar el Servidor**

   ```bash
   # Para Windows (usando PHP portable incluido)
   ./php/php.exe -S localhost:8000 -t public
   ```

2. **Acceder al Sistema**
   - Navega: `http://localhost:8000`

3. **Credenciales de Acceso Iniciales**

   | Rol         | Usuario | Contraseña |
   | ----------- | ------- | ---------- |
   | **Gerente** | `admin` | `123456`   |

---

## 🌍 Despliegue en cualquier hosting (PHP + PostgreSQL)

La aplicación ahora soporta **PostgreSQL y SQLite** por variables de entorno, por lo que puedes desplegarla en Vercel, Render, Railway, Fly.io, VPS, cPanel, Apache o Nginx.

### 1) Configurar variables de entorno

Usa `.env.example` como base y crea tu `.env` en el servidor (o configura variables en el panel del proveedor):

```env
DB_CONNECTION=pgsql
DB_HOST=tu_host
DB_PORT=5432
DB_DATABASE=tu_bd
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_clave
```

También puedes usar una sola variable:

```env
DATABASE_URL=postgres://usuario:clave@host:5432/base
```

### 2) Publicar el proyecto

- Sube todo el proyecto al servidor.
- Configura el **document root** apuntando a la carpeta `public/`.
- Asegúrate de tener habilitada la extensión `pdo_pgsql` en PHP.

### 3) Primer arranque

- Al iniciar, el sistema crea tablas automáticamente si no existen.
- Se crea el usuario inicial `admin / 123456` si aún no existe.

### 4) Nota sobre ejecución local

Para desarrollo local se recomienda usar PostgreSQL (por ejemplo con Docker) y configurar las variables en `.env`.

> Recomendado para producción: PostgreSQL.

---

## 🧪 Prueba de IA de Clasificación

1. Ingresa a "Nuevo Reporte".
2. Escribe una descripción con palabras clave:
   - _Ejemplo:_ "No tengo conexión al **wifi** en mi oficina." (asigna: **Infraestructura / Alta**)
   - _Ejemplo:_ "Olvidé mi **clave** de acceso." (asigna: **Seguridad / Media**)

3. Guarda el ticket y revisa el Dashboard.

---

## 🔒 Seguridad

- Contraseñas hasheadas (simulado para demo).
- Protección contra acceso directo a rutas (Middleware de sesión).
- Saneamiento básico de inputs HTML.

---

## 🤝 Contribuciones

¡Las contribuciones son bienvenidas!

1. Haz un fork.
2. Crea tu rama (`git checkout -b feature/tu-mejora`)
3. Envía tu Pull Request.

Por favor, sigue el estilo de código y agrega comentarios descriptivos.

---

## 📜 Licencia

Este proyecto está bajo la [Licencia MIT](LICENSE).

---

## 📬 Contacto

Para dudas, sugerencias o soporte:  
**Autor:** [Marianvsf](https://github.com/Marianvsf)

---

**Desarrollado para el Banco Digital de los Trabajadores - 2026**
