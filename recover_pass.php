<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">


    <title>Login</title>
    
    
    <link rel="stylesheet" href="css/normalize.css">

    <link rel='stylesheet prefetch' href='css/font-awesome.min.css'>

        <link rel="stylesheet" href="css/style.css">

    
    
    
  </head>

  <body>

    <div class="logmod">
  <div class="logmod__wrapper">
    <!--<span class="logmod__close">Close</span>-->
    <div class="logmod__container">
      <ul class="logmod__tabs">
       
        <li data-tabtar="lgm-1"><a href="#">Recuperar Clave</a></li>
         <li data-tabtar="lgm-2"><a href="#">Ingresar</a></li>
      </ul>
      <div class="logmod__tab-wrapper">
      <div class="logmod__tab lgm-1">
        <div class="logmod__heading">
          <span class="logmod__heading-subtitle">Introduzca su EMAIL <strong>para recuperar su clave de acceso </strong></span>
        </div>
        <div class="logmod__form">
          <form accept-charset="utf-8"  method="POST" action="users/user_registration.php" class="simform">
          
          <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="name">Nombre *</label>
                <input class="string optional" maxlength="255" name="name" id="name" placeholder="Nombre" type="text" size="50" required/>
              </div>
            </div>
            
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">Email *</label>
                <input class="string optional" maxlength="255" name="user-email" id="user-email" placeholder="Email" type="email" size="50" required/>
              </div>
            </div>
            

            <div class="simform__actions">
              <input class="submit" name="commit" type="submit" value="Enviar" />
            </div> 
          </form>
        </div> 
      </div>
            
            <!--LOGIN-->

      <div class="logmod__tab lgm-2">
        <div class="logmod__heading">
          <span class="logmod__heading-subtitle">Ingrese su email y contraseña <strong>para acceder</strong></span>
        </div> 
        <div class="logmod__form">
          <form accept-charset="utf-8"  method="POST" action='users/control.php' class="simform">
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-name">Email*</label>
                <input class="string optional" maxlength="255" name="user-name" id="user-name" placeholder="Email" type="email" size="50" required/>
              </div>
            </div>
            <div class="sminputs">
              <div class="input full">
                <label class="string optional" for="user-pw">Contraseña *</label>
                <input class="string optional" maxlength="255" name="user-pw" id="user-pw" placeholder="Contraseña" type="password" size="50" required/>
                            <!--<span class="hide-password">Show</span>-->
              </div>
            </div>
            <div class="simform__actions">
              <input class="submit" name="commit" type="submit" value="Entrar" />
              <span class="simform__actions-sidetext"><a class="special" role="link" href="index.php">Desea registrarse?</a></span>

            </div> 
          </form>
        </div> 
        
          </div>
      </div>
    </div>
  </div>
</div>
    <script src='js/jquery.min.js'></script>

    

    <script src="js/index.js"></script>


    
    
    
  </body>
</html>
