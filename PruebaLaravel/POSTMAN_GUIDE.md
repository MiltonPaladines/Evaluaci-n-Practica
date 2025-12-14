# Guía de Postman - API GameZone

## Configuración Base

**URL Base:** `http://localhost:8000/api`

---

## Endpoints Disponibles

### 1. REGISTRO DE USUARIO (Público)

**Método:** POST  
**Endpoint:** `/register`  
**URL Completa:** `http://localhost:8000/api/register`

**Headers:**
```
Content-Type: application/json
Accept: application/json
```

**Body (JSON):**
```json
{
    "name": "Juan Pérez",
    "email": "juan@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "role": "user"
}
```

**Respuesta Exitosa (201):**
```json
{
    "success": true,
    "message": "Usuario registrado exitosamente",
    "data": {
        "user": {
            "id": 1,
            "name": "Juan Pérez",
            "email": "juan@example.com",
            "role": "user",
            "created_at": "2025-12-14T22:00:00.000000Z",
            "updated_at": "2025-12-14T22:00:00.000000Z"
        },
        "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
    }
}
```

---

### 2. LOGIN (Público)

**Método:** POST  
**Endpoint:** `/login`  
**URL Completa:** `http://localhost:8000/api/login`

**Headers:**
```
Content-Type: application/json
Accept: application/json
```

**Body (JSON):**
```json
{
    "email": "juan@example.com",
    "password": "password123"
}
```

**Respuesta Exitosa (200):**
```json
{
    "success": true,
    "message": "Inicio de sesión exitoso",
    "data": {
        "user": {
            "id": 1,
            "name": "Juan Pérez",
            "email": "juan@example.com",
            "role": "user",
            "created_at": "2025-12-14T22:00:00.000000Z"
        },
        "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
    }
}
```

---

### 3. LOGOUT (Protegido)

**Método:** POST  
**Endpoint:** `/logout`  
**URL Completa:** `http://localhost:8000/api/logout`

**Headers:**
```
Content-Type: application/json
Accept: application/json
Authorization: Bearer {TOKEN}
```

**Respuesta Exitosa (200):**
```json
{
    "success": true,
    "message": "Cierre de sesión exitoso"
}
```

---

### 4. OBTENER JUEGOS (Público)

**Método:** GET  
**Endpoint:** `/juegos`  
**URL Completa:** `http://localhost:8000/api/juegos`

**Headers:**
```
Accept: application/json
```

**Respuesta Exitosa (200):**
```json
[
    {
        "id": 1,
        "nombre": "The Legend of Zelda",
        "descripcion": "Juego de aventura clásico",
        "anio": 1986,
        "precio": 59.99
    }
]
```

---

### 5. OBTENER PLATAFORMAS (Público)

**Método:** GET  
**Endpoint:** `/plataformas`  
**URL Completa:** `http://localhost:8000/api/plataformas`

**Headers:**
```
Accept: application/json
```

---

### 6. CREAR JUEGO (Admin)

**Método:** POST  
**Endpoint:** `/juegos`  
**URL Completa:** `http://localhost:8000/api/juegos`

**Headers:**
```
Content-Type: application/json
Accept: application/json
Authorization: Bearer {TOKEN_ADMIN}
```

**Body (JSON):**
```json
{
    "nombre": "Elden Ring",
    "descripcion": "RPG de acción",
    "anio": 2022,
    "precio": 59.99
}
```

---

## Pasos en Postman

### Para Registrar un Usuario:

1. **Abre Postman**
2. **Crea una nueva solicitud (New → Request)**
3. **Configura:**
   - Método: **POST**
   - URL: `http://localhost:8000/api/register`
4. **Ve a la pestaña "Headers"** y agrega:
   - Key: `Content-Type` | Value: `application/json`
   - Key: `Accept` | Value: `application/json`
5. **Ve a la pestaña "Body"** → Selecciona **raw** → Elige **JSON**
6. **Pega el JSON:**
```json
{
    "name": "Carlos López",
    "email": "carlos@example.com",
    "password": "password123",
    "password_confirmation": "password123",
    "role": "user"
}
```
7. **Click en Send**

### Para Login:

1. Repite el proceso anterior
2. Método: **POST**
3. URL: `http://localhost:8000/api/login`
4. Body:
```json
{
    "email": "carlos@example.com",
    "password": "password123"
}
```
5. **Click en Send**
6. **Copia el token** de la respuesta

### Para Usar Token (En solicitudes protegidas):

1. Ve a la pestaña **"Authorization"**
2. Type: **Bearer Token**
3. Token: **Pega el token que obtuviste del login**
4. O agrega manualmente en Headers:
   - Key: `Authorization` | Value: `Bearer {tu_token_aqui}`

---

## Ejemplo de Usuario para Pruebas

Si creaste un usuario en las migraciones, puedes usar:
```json
{
    "email": "admin@example.com",
    "password": "password"
}
```

---

## Tips

- Los tokens expiran, así que si una solicitud falla con "Unauthorized", haz login de nuevo
- El rol "admin" puede crear/editar/eliminar juegos
- El rol "user" solo puede ver el catálogo
- Siempre envía `Content-Type: application/json` en POST

