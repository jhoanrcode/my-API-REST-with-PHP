# my-API-REST-with-PHP
Simple API REST creado en PHP basada en MVC para realizar peticiones ( GET, POST, PUT, DELETE .. ) a bases de datos SQL por medio de endpoints determinados por routes.

## Configuración
1. Actualice las credenciales de la conexion a base de datos desde el archivo `config.php`.

        define('DB_HOST', 'xxxxx');
        define('DB_USER', 'xxxx');
        define('DB_PASS', 'xxxx');
        define('DB_NAME', 'xxxx');
   
2. Ejecute el script que se encuentra el archivo `database.sql` en la base de datos indicada anteriormente.

## Caracteristicas
Gracias a la configuracion en el archivo .htaccess cada endpoint esta asociado a una route en especifico, por ejemplo:

`'/users' => 'UserService@list'` equivale a `GET /users` → Listado de usuarios.

`'/users/create' => 'UserService@create'` equivale a `POST /users/create` → Crear usuarios.

## Consumir API
Peticiones API a traves Fetch API de Javascript:

```js
/* @Route("/", methods: {"GET"}) */

fetch('http://127.0.0.1/YourNameFile/')
  .then(res => res.json())
  .then(console.log)

/*{
  "status":"success",
  "message":"Inicio API - Bienvenido!!"
}*/
```

```js
/* @Route("/users", methods: {"GET"}) */
let config = {  method: 'GET' }
fetch('http://127.0.0.1/YourNameFile/users', config)
  .then(res => res.json())
  .then(console.log)

/*{
  "status":"success",
  "message":"Listado usuarios",
  "data": [{ data_users }]
}*/
```

```js
/* @Route("/users/create", methods: {"POST"}) */
const newUserData = {
  name: 'Jhoan',
  email: 'jhoan@example.com',
  phone: 111111111,
};
let config = {
  method: 'POST',
  body: JSON.stringify(newUserData)
}

fetch('http://127.0.0.1/YourNameFile/users/create', config)
  .then(res => res.json())
  .then(console.log)

/*{
  "status":"success",
  "message":"Usuario creado exitosamente"
}*/
```
