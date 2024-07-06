## Prueba Backend Blendio (Operaciones matematicas):

### Descripcion de proyecto
Este proyecto contiene una serie de servicios que permiten realizar operaciones matemitcas simples mediante peticiones get y también mediante un comando Artisan.

### Instalación
1. Clonar el repositorio: 
    ```bash 
   git clone https://github.com/ktobarr/prueba-backend-blendio.git
      ```
2. Navegar al directorio del proyecto
    ```bash
   cd prueba-backend-blendio
      ```
3. Instalar las dependencias del proyecto:
    ```bash
   composer install
      ```
4. Generar la clave de la aplicación:
    ```bash
   php artisan key:generate
      ```
5. Iniciar el servidor:
    ```bash
   php artisan serve
    ```
   
### Uso 

Para hacer uso de la API, realizar una petición GET a la ruta:
   ```bash
    /{operation}/{operatorA}/{operatorB}
   ```
***Posibles operaciones a realizar***:

Para las peticiones las operaciones aceptadas son las siguiente:
- Suma: **add**
- Resta: **subtract**
- Multiplicación: **multiply**
- División: **divide**

**Ejemplo**
```bash
/add/10/5

Respuesta:
{"result": 15}
```
En caso de introducir una operacion invalida, devolverá un error del tipo:
```bash
{"error":"Invalid operation"}
```

### Uso como comando
Es posible realizar las operaciones através de un comando Artisan que toma como argumentos la operacion a realizar y los operandos.
La estructura es la siguiente:
```bash
php artisan operations {operatorA} {operatorB} {operation}
```

Las operaciones aceptadas por el comando son las siguiente:
- Suma: **add**
- Resta: **subtract**
- Multiplicación: **multiply**
- División: **divide**

En caso de introducir una operacion invalida, devolverá un mensaje de error del tipo
```bash
Invalid operation: ad
```
### Estructura
**Endpoints**

GET /{operation}/{operatorA}/{operatorB}

***Parámetros***:
- operation (string): tipo de operación (add, subtract,multiply, divide)
- OperatorA (int): primer operando
- OperatorB (int): segundo operando

***Servicios***
- AdditionService: suma dos enteros
- SubtractionService: resta dos enteros
- MultiplicationService: múltiplica dos enteros
- DivisionService: Divide dos enteros

***Controlador***
- OperationsController

***Enumeraciones***
- Operation:
  -     ADDITION: add - SUBTRACTION: subtract - MULTIPLICACION: multiply - DIVISION: divide 

### Pruebas unitarias
- OperationControllerTest

Para la ejecución de las pruebas unitarias:
```bash
php artisan test
```

### Observaciones
Para el desarrollo de esta prueba he creado un servicio por cada operación matemática para poder dividr las responsabilidades y mantener la teoría de que un servicio se encarga de una tarea en específico.
Al ser un proyecto con operaciones muy sencillas y considerando que este proyecto no crecerá, podría haber creado un solo servicio que lo englobará todo pero he optado por hacer multiples servicios.
