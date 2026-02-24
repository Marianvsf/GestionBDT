# Manual de Usuario – Sistema GestionBDT

## 1. Introducción

GestionBDT es una plataforma para registrar, gestionar y dar seguimiento a incidencias tecnológicas dentro de BDT.

Este manual describe el uso del sistema para los perfiles:

- **Gerente**
- **Soporte**
- **Analista**
- **Usuario público** (solo Centro de Ayuda)

---

## 2. Acceso al sistema

### 2.1 Requisitos

- Navegador web actualizado (Chrome, Edge o Firefox).
- Sistema en ejecución en servidor local o institucional.

### 2.2 Ingreso

1. Abrir el navegador.
2. Acceder a la URL del sistema (ejemplo: `http://localhost:8000`).
3. Ingresar **Usuario Corporativo** y **Contraseña**.
4. Presionar **Acceder al Sistema**.

### 2.3 Usuario inicial (primera ejecución)

- **Usuario:** `admin`
- **Contraseña:** `123456`
- **Rol:** Gerente

> Recomendación: crear usuarios operativos y restringir el uso de la cuenta inicial.

### 2.4 Cierre de sesión

- Presionar **Salir** en la barra superior.

---

## 3. Roles y permisos

| Acción / Módulo                     | Gerente | Soporte |          Analista | Público |
| ----------------------------------- | ------: | ------: | ----------------: | ------: |
| Ver tablero de tickets              |      ✅ |      ✅ | ✅ (solo propios) |      ❌ |
| Crear incidencia                    |      ✅ |      ✅ |                ✅ |      ❌ |
| Cambiar estado de tickets           |      ✅ |      ✅ |                ❌ |      ❌ |
| Asignar tickets a Soporte           |      ✅ |      ❌ |                ❌ |      ❌ |
| Eliminar tickets                    |      ✅ |      ❌ |                ❌ |      ❌ |
| Ver detalle y comentarios           |      ✅ |      ✅ | ✅ (solo propios) |      ❌ |
| Agregar comentarios                 |      ✅ |      ✅ |                ❌ |      ❌ |
| Generar reporte CSV                 |      ✅ |      ✅ |                ❌ |      ❌ |
| Ver estadísticas                    |      ✅ |      ✅ |                ❌ |      ❌ |
| Crear / listar / eliminar usuarios  |      ✅ |      ❌ |                ❌ |      ❌ |
| Enviar solicitud al Centro de Ayuda |      ✅ |      ✅ |                ✅ |      ✅ |
| Ver solicitudes de ayuda            |      ✅ |      ✅ |                ❌ |      ❌ |

---

## 4. Menú principal

Según el rol, la barra superior puede mostrar:

- **Usuarios**
- **Crear usuario**
- **Solicitudes**
- **Estadísticas**
- **Reportes**
- **Incidencia**
- **Salir**

---

## 5. Gestión de incidencias (tickets)

## 5.1 Crear incidencia

1. Hacer clic en **Incidencia**.
2. Completar:
   - **Asunto**
   - **Descripción detallada**
3. Presionar **Enviar Reporte**.

### 5.1.1 Clasificación automática

Al guardar, el sistema asigna automáticamente:

- **Categoría** (Infraestructura, Seguridad, Hardware, Software o General)
- **Prioridad** (Alta, Media o Baja)

La clasificación se basa en palabras clave detectadas en la descripción.

---

## 5.2 Tablero de control

En el tablero se visualizan columnas como:

- ID
- Título
- Categoría
- Prioridad
- Asignado
- Estado
- Fecha de actualización

### 5.2.1 Estados disponibles

- **Pendiente**
- **En proceso**
- **Ejecutada**

### 5.2.2 Actualizar estado

(Soporte y Gerente)

1. Seleccionar nuevo estado en el ticket.
2. Presionar el icono de **guardar cambios** (check verde).

### 5.2.3 Asignar ticket

(Solo Gerente)

1. Seleccionar usuario de Soporte en el campo **Asignado a**.
2. Presionar el icono de **guardar cambios**.

### 5.2.4 Eliminar ticket

(Solo Gerente)

1. Presionar icono de papelera.
2. Confirmar eliminación.

---

## 5.3 Detalle de incidencia

Desde el título del ticket se abre el detalle con:

- Datos completos del ticket.
- Descripción original.
- Historial de comentarios de soporte.

### 5.3.1 Comentarios

(Soporte y Gerente)

1. Escribir comentario en **Agregar comentario**.
2. Presionar **Publicar comentario**.

---

## 6. Reportes (CSV)

(Soporte y Gerente)

1. Ir a **Reportes**.
2. Aplicar filtros opcionales:
   - Desde / Hasta (fecha)
   - Estado
   - Asignado a
   - Categoría (palabra clave)
3. Presionar **Generar CSV**.
4. El navegador descargará un archivo `.csv` con los tickets filtrados.

---

## 7. Estadísticas

(Soporte y Gerente)

En **Estadísticas** se muestra:

- Total de tickets
- Número de categorías
- Resumen de estados
- Número de prioridades
- Gráfico de tickets de los últimos 30 días
- Distribución por categoría
- Resumen por estado

### 7.1 Imprimir dashboard

- Presionar **Imprimir** para abrir versión imprimible.

---

## 8. Gestión de usuarios

(Solo Gerente)

## 8.1 Crear usuario

1. Ir a **Crear usuario**.
2. Completar:
   - Usuario
   - Contraseña
   - Rol (Gerente, Analista o Soporte)
3. Presionar **Crear**.

## 8.2 Listar usuarios

- Ir a **Usuarios** para ver ID, usuario y rol.

## 8.3 Eliminar usuario

1. En la lista, presionar papelera del usuario.
2. Confirmar eliminación.

**Regla importante:** no se permite eliminar el usuario de la sesión activa.

---

## 9. Centro de Ayuda

## 9.1 Enviar solicitud

Disponible para usuarios autenticados y público.

1. Abrir **Centro de Ayuda**.
2. Completar formulario:
   - Nombre completo _(obligatorio)_
   - Correo _(obligatorio y válido)_
   - Teléfono _(opcional)_
   - Asunto _(obligatorio)_
   - Descripción _(obligatorio)_
3. Presionar **Enviar solicitud**.

## 9.2 Visualizar solicitudes

(Soporte y Gerente)

En **Solicitudes** se muestran:

- Fecha
- Datos de contacto
- Asunto
- Usuario asociado (si aplica)
- Mensaje

---

## 10. Mensajes frecuentes

- **"Credenciales incorrectas"**: usuario o clave inválidos.
- **"Completa todos los campos"**: faltan datos obligatorios.
- **"Usuario ya existe o datos inválidos"**: nombre en uso o formato no válido.
- **"No puedes eliminar tu propio usuario"**: intento de eliminar sesión activa.
- **"Ingresa un correo válido"**: formato de email incorrecto en Centro de Ayuda.

---

## 11. Buenas prácticas de uso

- Registrar incidencias con descripciones claras y específicas.
- Cambiar estado del ticket cuando haya avances reales.
- Usar comentarios para trazabilidad técnica.
- Restringir cuentas con rol Gerente.
- Exportar reportes periódicamente para control operativo.

---

## 12. Soporte interno

Para soporte funcional o técnico del sistema, contactar al equipo TI de BDT por los canales institucionales definidos.

---

## 13. Control de versión del manual

- **Documento:** Manual de Usuario GestionBDT
- **Versión:** 1.0
- **Fecha:** 2026-02-24
