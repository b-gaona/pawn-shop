<?php
require_once __DIR__ . "/../../includes/app.php";
includeTemplate('head');

auth();
?>

<body>
  <div id="db-wrapper">
    <?php
    includeTemplate('vertical_navbar');
    ?>
    <!-- page content -->
    <div id="page-content">
      <?php includeTemplate("horizontal_bar") ?>
      <!-- Container fluid -->
      <div class="container-fluid px-6 py-4">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div>
              <div class="border-bottom pb-5 mb-5 d-flex align-items-center justify-content-center">
                <div class="mb-2 mb-lg-0">
                  <h3 class="mb-0 fw-bold center">Registro de sucursales</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-8">
          <div class="col-xl-3 col-lg-4 col-md-12 col-12">
            <div class="mb-4 mb-lg-0">
              <h4 class="mb-2">Datos de la sucursal</h4>
              <p class="mb-0 fs-5 text-muted">Datos de la sucursal, así como también datos de su próximo registro a la aplicación</p>
            </div>
          </div>
          <div class="col-xl-9 col-lg-8 col-md-12 col-12">
            <!-- card -->
            <div class="card">
              <!-- card body -->
              <div class="card-body">
                <?php if (isset($flag)) { ?>
                  <div class="alerta btn btn-warning mb-4">
                    <p class="mb-0"> <?php echo $flag ?></p>
                  </div>
                <?php } ?>
                <div class=" mb-6">
                  <h4 class="mb-1">Datos de la sucursal</h4>
                </div>
                <div>
                  <!-- border -->
                  <div class="mb-6">
                    <h4 class="mb-1">Sucursal</h4>
                  </div>
                  <form action="" method="POST">
                    <div class="mb-3 row">
                      <label for="name" class="col-sm-4 col-form-label
                          form-label">Nombre de la sucursal</label>
                      <div class="col-md-8 col-12">
                        <input name="name" type="text" class="form-control" placeholder="Ejemplo. Libertad Longoria" id="name" value="<?php echo sanitize($sucursal->getName()); ?>" required>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="username" class="col-sm-4 col-form-label
                          form-label">Nombre de usuario</label>
                      <div class="col-md-8 col-12">
                        <input name="username" type="text" class="form-control" placeholder="Ejemplo. sucursal_1" id="username" value="<?php echo sanitize($sucursal->getUsername()); ?>" required>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label for="password" class="col-sm-4 col-form-label
                          form-label">Contraseña</label>
                      <div class="col-md-8 col-12">
                        <input name="password" type="password" class="form-control" placeholder="**************" id="password" value="<?php echo sanitize($sucursal->getPassword()); ?>" required>
                      </div>
                    </div>
                    <div class="offset-md-4 col-md-8 mt-6">
                      <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Scripts -->
  <?php
  includeTemplate("scripts");
