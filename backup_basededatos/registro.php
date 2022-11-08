<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Barbers Razor</title>

  <!-- CSS -->
  <link rel="stylesheet" href="registro.css">
  <!-- BOOTSTRAP -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <style>
    #lbError {
      color: red;
    }
  </style>
</head>

<body>
  <div class="container">
    <header>
      <h1 id="registro">REGISTRARSE</h1>
    </header>
    <br>
    <br>
    <form class="row g-3">
      <div class="col-md-4">
        <label for="validationServer01" class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control is-valid" id="txtNombre" required>

      </div>
      <div class="col-md-4">
        <label for="validationServer02" class="form-label">Apellido</label>
        <input type="text" name="apellido" class="form-control is-valid" id="txtApellido" required>
        <br>
      </div>

      <br>

      <div class="col-md-5">
        <label for="inputEmail4" class="form-label">Email</label>
        <input type="text" name="email " class="form-control" id="txtEmail" placeholder="ejemplo@gmail.com">
      </div>

      <br>

      <div class="col-md-4">
        <label for="inputPassword4" class="form-label">Contraseña</label>
        <input type="password" name="password" class="form-control" id="txtPassword">
        <br>
      </div>

      <br>

      <div class="col-md-12">
        <div>
          <button type="button" class="btn-primary" onclick="EnviarDatosUsuarios()">Registrarse</button>
          <div id="lbError">
          </div>
        </div>
      </div>



    </form>

  </div>

  <script>

    function EnviarDatosUsuarios() {
      let nombre = document.getElementById("txtNombre");
      let apellido = document.getElementById("txtApellido");
      let email = document.getElementById("txtEmail");
      let password = document.getElementById("txtPassword");


      let lbError = document.getElementById("lbError");

      if (nombre.value == "") {
        lbError.innerText = "Debe ingresar un nombre";
        nombre.focus();
        return false;
      }
      if (apellido.value == "") {
        lbError.innerText = "Debe ingresar un Apellido";
        apellido.focus();
        return false;
      }

      if (email.value == "") {
        lbError.innerText = "Debe ingresar un mail valido";
        email.focus();
        return false;
      }
      if (password.value == "") {
        lbError.innerText = "Debe ingresar una contraseña";
        password.focus();
        return false;
      }

      datos = {
        "accion": "agregar",
        "nombre": nombre.value,
        "apellido": apellido.value,
        "correo_electronico": email.value,
        "password": password.value
      };
      llamdaApi("/clase/Trabajo-Aplicaciones/api/usuario.php", datos, deregreso);

      function deregreso() {
        if (this.readyState === 4) {
          if (this.status == 200) {
            let php2 = this.responseText.replaceAll("'", '"');
            let json = JSON.parse(php2);
            if (json["error"] == "no") {
              //alert("redirigiendo a reservas.php");   
              window.location.href = "/clase/Trabajo-Aplicaciones/reservas.html";

            } else {
              document.getElementById("lbError").innerText = json["descripcion"];
            }
          }
        }
      }
    }


    function llamdaApi(url, datos, funcion_regreso) {
      let xhr = new XMLHttpRequest();
      xhr.onreadystatechange = funcion_regreso;
      xhr.open("POST", url)
      xhr.setRequestHeader("Accept", "application/json");
      xhr.setRequestHeader("Content-Type", "application/json");
      xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
      xhr.send(JSON.stringify(datos));
      

    }
    
    function Api_Usuario(datos){
      const request = new XMLHttpRequest();
      request.open('POST', 'api/usuarios.php', false);  // `false` makes the request synchronous
      request.send(data);  
      if (request.status === 200) {
        console.log(request.responseText);
      }
    }


  </script>
</body>

</html>