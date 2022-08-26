<?php
require_once __DIR__ . "/../../includes/app.php";
includeTemplate('head');
?>

<body>
  <!-- container -->
  <div class="container d-flex flex-column">
    <div class="row align-items-center justify-content-center g-0
        min-vh-100">
      <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0">
        <!-- Card -->
        <div class="card smooth-shadow-md">
          <!-- Card body -->
          <div class="card-body p-6">
            <?php if (isset($flag)) { ?>
              <div class="alerta btn btn-warning mb-4">
                <p class="mb-0"><?php echo sanitize($flag) ?></p>
              </div>
            <?php } ?>
            <div class="mb-4 text-center">
              <p class="mb-4">Favor de ingresar tu información de usuario.</p>
            </div>
            <!-- Form -->
            <form action="./login" method="POST">
              <!-- Username -->
              <div class="mb-3">
                <label for="username" class="form-label">Nombre de usuario</label>
                <input type="text" id="username" class="form-control" name="username" placeholder="Escribe tu nombre de usuario aquí" required="">
              </div>
              <!-- Password -->
              <div class="mb-8">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" id="password" class="form-control" name="password" placeholder="**************" required="">
              </div>
              <div>
                <!-- Button -->
                <div class="d-grid">
                  <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                </div>
                <div class="d-md-flex justify-content-between mt-4">
                  <div class="center text-center">
                    <a href="#" class="text-inherit fs-5">En caso de problemas contactar al administrador</a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Scripts -->
  <?php
  includeTemplate("scripts");
