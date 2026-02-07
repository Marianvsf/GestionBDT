# 🏦 Sistema de Gestión de Incidencias - BDT

> **Banco Digital de los Trabajadores**
> Plataforma centralizada para el registro, seguimiento y resolución de incidencias tecnológicas.

![Status](https://img.shields.io/badge/Status-Despliegue_Listo-green)
![PHP](https://img.shields.io/badge/Backend-PHP_Nativo-blue)
![SQLite](https://img.shields.io/badge/Database-SQLite-lightgrey)

---

## 📖 Descripción

GestionBDT es una solución **Fullstack** diseñada para modernizar la gestión de incidencias en BDT, eliminando los registros manuales y aportando eficiencia operativa.

Utiliza una arquitectura **MVC (Modelo-Vista-Controlador)** construida desde cero en **PHP Nativo**, garantizando **portabilidad total** (Zero-Installation) gracias a SQLite y al servidor embebido.

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
- **Base de Datos:** SQLite 3
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
├── database/             # bdt.sqlite (Base de datos física)
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
