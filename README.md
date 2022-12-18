<!-- Status -->

 <h1 align="center"> 
	🚧  Reto Api Laravel 🚀 
</h1> 

<hr> 

<p align="center">
  <a href="#dart-about">About</a> &#xa0; | &#xa0; 
  <a href="#rocket-technologies">Technologies</a> &#xa0; | &#xa0;
  <a href="#white_check_mark-requirements">Requirements</a> &#xa0; | &#xa0;
  <a href="#checkered_flag-starting">Starting</a> &#xa0; | &#xa0;
  <a href="#memo-license">License</a> &#xa0; | &#xa0;
  <a href="https://github.com/{{YOUR_GITHUB_USERNAME}}" target="_blank">Author</a>
</p>

<br>

## :dart: About ##

En este proyecto hemos realizado la parte backend de una aplicación, para jugar, crear partidas, y chats entre compañeros, con php Laravel

## :rocket: Technologies ##

Las tecnologias realizadas para este proyecto han sido:

- [PHP]
- [Laravel]


## :white_check_mark: Requirements ##

Antes de comenzar :checkered_flag:, se necesita instalar el composer. Composer es un manejador de
paquetes para PHP que proporciona un
estándar para administrar, descargar e
instalar dependencias y librerías. .

## :checkered_flag: Starting ##

```bash
# Instalar laravel
$ composer global require laravel/installer

# Crear nuevo proyecto
$composer create-project laravel/laravel Proyecto-6-php.laravel

# Lanzar el servidor
$ php artisan serve (lo tendremos levantado en localhost:8000)

```

## 📝 Description ##

En este sexto proyecto del bootcamp hemos realizado la parte de backend de una aplicación de juegos, donde los participantes pueden crear salas (chats) para mandar mensajes y comunicarse con sus compañeros.

El proyecto se realizó con php Laravel, y en primer lugar realizamos creamos las migraciones donde iran todos los datos de nuestra base de datos.

![migraciones](https://user-images.githubusercontent.com/109297564/208314299-f930ada7-b7bb-448a-b625-48eb18d43ded.jpg)

Una vez creadas todas las tablas, realizaremos las migraciones. Una vez creadas las migraciones añadiremos los items que vamos a necesitar en cada tabla, y también añadiremos las relaciones entre las tablas.

![Captura de pantalla 2022-12-18 115955](https://user-images.githubusercontent.com/109297564/208314320-aa0b7bc0-5f51-4d5f-915d-b787f3de01c1.jpg)

Así quedaria nuestras tablas relacionadas .
Indicar que para poder crear las relaciones también hemos tenido que crear los modelos de las tablas, ya que ahi indicaremos la relación existente.

![models](https://user-images.githubusercontent.com/109297564/208314898-3221041d-acae-41b6-95e4-217491d12d78.jpg)

A continuacion y para empezar con los endpoints añadiremos las rutas necesarias para cada uno de los endpoints necesarios para que la aplicación sea totalmente funcional.

Estas routas iran en el archivo api.php que se encuentra alojado en la carpeta routes.

![Captura de pantalla 2022-12-18 195915](https://user-images.githubusercontent.com/109297564/208314487-94b20ec1-dab5-4bf7-9a5d-d81260129562.jpg)

Y para poder darle funcionaludad a cada una de estas rutas, crearemos los controllers, donde crearemos toda la lógica para poder obtener todos los endpoints

![controllers](https://user-images.githubusercontent.com/109297564/208314589-2c7e3ef7-60e9-4b35-b01e-a0e224ba4dfd.jpg)
Como vemos en la imagen los  controllers se encuentran en la carpeta HTTP, que estará ubicada dentro de app.


![authcontroller](https://user-images.githubusercontent.com/109297564/208314685-794f1de3-cac4-4665-a72a-10269f4e3aaf.jpg)

En la imagen de arriba dejamos un ejemplo de controller. En este caso es el AuthController que es el encargado de realizar el registro(enla imagen) el login, y la autenticacón de cada usuario cada vez que entre en la app.

![register](https://user-images.githubusercontent.com/109297564/208314735-2ed52aea-b192-4923-befb-8685969319f3.jpg)
Para comprpobar la buena funcionalidad del endpoint, entramos en la aplicacion Postman, y probamos la ruta indicada para el registro de usuarios.


Una vez probados todos los endpoints ya tenemos un backend funcional, para la aplicación.

## ENDPOINTS ##

## //USER
Route::post('/register', [AuthController::class, 'register']); (Registro)
(Pasaremos por el body el siguiente JSON { ejemplo:
"name": "Olivia",
"email": "olivia@olivia.com",
"password":"olivia12345"

})
<br>
Route::post('/login', [AuthController::class, 'login']); (Login)
(Pasaremos por el body el siguiente JSON { ejemplo:
"email": "olivia@olivia.com",
"password":"olivia12345"
})
<br>

Route::post('/logout', [AuthController::class, 'logout']); (Logout)
(para hacer el Logout correctamente tendremos que pasar el TOKKEN)
<br>
Route::put('/update/{id}', [UserController::class, 'updateUser']); (Modificar usuario)
<br>
Route::get('/users', [UserController::class, 'getAllUsers']); (Obtener todos los usuarios)
<br>
Route::delete('/deleteUser', [UserController::class, 'deleteUser']); (Borrar usuario)

## //AUTH (comprobar que el usuario tiene Token y puede entrar en la app)

Route::group([
    'middleware'=>'jwt.auth'
], function(){
    Route::get('/me',[AuthController::class, 'profile']);
});

## //GAME

Route::post('/game', [GameController::class, 'createAGame']); (Crear juego)
(Pasaremos por el body {
"name":"Dragon ball Z"
})
<br>
Route::put('/updatedGame/{id}', [GameController::class, 'updatedGame']); (Modificar Juego)
(Pasaremos por el body el nuevo nombre del juego {
"name":"Dragon ball final bout"
})
<br>
Route::delete('/game/{name}', [GameController::class, 'deleteGameByName']); (Borrar Juego)
<br>
Route::get('/games', [GameController::class, 'getAllGames']); (Obtener todos los juegos)
<br>
Route::get('/game/name/{name}', [GameController::class, 'getGameByName']); (Encontrar juegos por nombre)


 ## //PARTY

Route::post('/party', [PartyController::class, 'createPArty']); (Crear Party)
(Pasaremos por el body, ej({
"title":"regates",
"gameId":2
}))
<br>
Route::post('/exitParty', [PartyController::class, 'exitParty']); (Salir de la Party)
<br>


## //MESSAGES

Route::post('/message', [MessagesController::class, 'postMessage']); (Crear Mensaje)
(Pasaremos por el body, ej({
"message":"Siguiente partida vale doble",
"partiesId":2
}))
<br>
Route::put('/message/{id}', [MessagesController::class, 'updateMessage']); (Modificar Mensaje)
(Pasaremos por el body, ej({
"message":"Siguiente partida vale doble",
"partiesId":2
}))
<br>
Route::delete('/message/{id}', [MessagesController::class, 'deleteMessage']); (Borrar Mensaje)
<br>
Route::get('/allMessages', [MessagesController::class, 'getAllMessages']); (Obtener todos los Mensajes)
<br>
Route::get('/AllMessagesByPartiesId/{partiesId}', [MessagesController::class, 'AllMessagesByPartiesId']);

## :memo: License ##

Este proyecto ha sido realizado por <a href="https://github.com/Naxete7">Ignacio Garcia Valero.</a>
