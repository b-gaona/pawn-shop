<?php
require_once __DIR__ . "/../../includes/app.php";
includeTemplate('head');

auth();
?>

<body>
  <div id="db-wrapper">
    <!-- Sidebar -->
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
                  <h3 class="mb-0 fw-bold center">Registro de pólizas</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mb-8">
          <div class="col-xl-3 col-lg-4 col-md-12 col-12">
            <div class="mb-4 mb-lg-0">
              <h4 class="mb-2">Datos personales y datos de la prenda</h4>
              <p class="mb-0 fs-5 text-muted">Datos del cliente, titular y beneficiario, así como también los datos de la prenda y los montos involucrados</p>
            </div>
          </div>
          <div class="col-xl-9 col-lg-8 col-md-12 col-12">
            <!-- card -->
            <div class="card">
              <!-- card body -->
              <div class="card-body">
                <div class=" mb-6">
                  <h4 class="mb-1">Datos del cliente</h4>
                </div>
                <div>
                  <!-- border -->
                  <div class="mb-6">
                    <h4 class="mb-1">Consumidor</h4>
                  </div>
                  <form action="" method="POST">
                    <!-- row -->
                    <div class="mb-3 row">
                      <label for="fullName" class="col-sm-4 col-form-label
                          form-label">Nombre completo</label>
                      <?php
                      if (isset($consumidor)) {
                        $nombreCompleto = $consumidor->getName();
                        $nombreCompleto = explode(" ", $nombreCompleto);
                        $num = count($nombreCompleto);
                        switch ($num) {
                          case 2:
                            $nombre = $nombreCompleto[0];
                            $apellido = $nombreCompleto[1];
                            break;
                          case 3:
                            $nombre = $nombreCompleto[0];
                            $apellido = $nombreCompleto[1] . " " . $nombreCompleto[2];
                            break;
                          case 4:
                            $nombre = $nombreCompleto[0] . " " . $nombreCompleto[1];
                            $apellido = $nombreCompleto[2] . " " . $nombreCompleto[3];
                            break;
                          case 5:
                            $nombre = $nombreCompleto[0] . " " . $nombreCompleto[1];
                            $apellido = $nombreCompleto[2] . " " . $nombreCompleto[3] . " " . $nombreCompleto[4];
                            break;
                          case 6:
                            $nombre = $nombreCompleto[0] . " " . $nombreCompleto[1];
                            $apellido = $nombreCompleto[2] . " " . $nombreCompleto[3] . " " . $nombreCompleto[4] . " " . $nombreCompleto[5];
                            break;
                          default:
                            $nombre = $consumidor->getName();
                            $apellido = $consumidor->getName();
                            break;
                        }
                      }
                      ?>
                      <div class="col-sm-4 mb-3 mb-lg-0">
                        <input type="text" class="form-control" name="name1" placeholder="Nombre (s)" id="fullName" value="<?php if (isset($nombre)) echo sanitize($nombre); ?>" required>
                      </div>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" name="lastname1" placeholder="Apellido (s)" id="lastName" value="<?php if (isset($apellido)) echo sanitize($apellido); ?>" required>
                      </div>
                    </div>
                    <!-- row -->
                    <div class="mb-3 row">
                      <label for="phone" class="col-sm-4 col-form-label
                          form-label">Teléfono</label>
                      <div class="col-md-8 col-12">
                        <input type="text" class="form-control" name="phone1" placeholder="Ejemplo. 8991242424" id="phone" value="<?php if (isset($consumidor)) echo sanitize($consumidor->getCellphone()); ?>" required>
                      </div>
                    </div>
                    <!-- row -->
                    <div class="mb-3 row">
                      <label for="addressLine" class="col-sm-4 col-form-label
                          form-label">Dirección</label>
                      <div class="col-md-8 col-12">
                        <input type="text" class="form-control" name="address1" placeholder="Ejemplo. Francisco de Goya 759" id="addressLine" value="<?php if (isset($consumidor)) echo sanitize($consumidor->getAddress()); ?>" required>
                      </div>
                    </div>
                    <div>
                      <h4 class="mb-2 pt-6">Titular</h4>
                    </div>
                    <div class="mb-3 row">
                      <label for="fullName" class="col-sm-4 col-form-label
                          form-label">Nombre completo</label>
                      <?php
                      if (isset($titular)) {
                        $nombreCompleto = $titular->getName();
                        $nombreCompleto = explode(" ", $nombreCompleto);
                        $num = count($nombreCompleto);
                        switch ($num) {
                          case 2:
                            $nombre = $nombreCompleto[0];
                            $apellido = $nombreCompleto[1];
                            break;
                          case 3:
                            $nombre = $nombreCompleto[0];
                            $apellido = $nombreCompleto[1] . " " . $nombreCompleto[2];
                            break;
                          case 4:
                            $nombre = $nombreCompleto[0] . " " . $nombreCompleto[1];
                            $apellido = $nombreCompleto[2] . " " . $nombreCompleto[3];
                            break;
                          case 5:
                            $nombre = $nombreCompleto[0] . " " . $nombreCompleto[1];
                            $apellido = $nombreCompleto[2] . " " . $nombreCompleto[3] . " " . $nombreCompleto[4];
                            break;
                          case 6:
                            $nombre = $nombreCompleto[0] . " " . $nombreCompleto[1];
                            $apellido = $nombreCompleto[2] . " " . $nombreCompleto[3] . " " . $nombreCompleto[4] . " " . $nombreCompleto[5];
                            break;
                          default:
                            $nombre = $titular->getName();
                            $apellido = $titular->getName();
                            break;
                        }
                      }
                      ?>
                      <div class="col-sm-4 mb-3 mb-lg-0">
                        <input type="text" class="form-control" name="name2" placeholder="Nombre (s)" id="fullName" value="<?php if (isset($nombre)) echo sanitize($nombre); ?>" required>
                      </div>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" name="lastname2" placeholder="Apellido (s)" id="lastName" value="<?php if (isset($apellido)) echo sanitize($apellido); ?>" required>
                      </div>
                    </div>
                    <!-- row -->
                    <div class="mb-3 row">
                      <label for="phone" class="col-sm-4 col-form-label
                          form-label">Teléfono</label>
                      <div class="col-md-8 col-12">
                        <input type="text" class="form-control" name="phone2" placeholder="Ejemplo. 8991242424" id="phone" value="<?php if (isset($titular)) echo sanitize($titular->getCellphone()); ?>" required>
                      </div>
                    </div>
                    <!-- row -->
                    <div class="mb-3 row">
                      <label for="addressLine" class="col-sm-4 col-form-label
                          form-label">Dirección</label>
                      <div class="col-md-8 col-12">
                        <input type="text" class="form-control" name="address2" placeholder="Ejemplo. Francisco de Goya 759" id="addressLine" value="<?php if (isset($titular)) echo sanitize($titular->getAddress()); ?>" required>
                      </div>
                    </div>
                    <div>
                      <h4 class="mb-2 pt-6">Beneficiario <span class="text-muted">(Opcional)</span></h4>
                    </div>
                    <div class="mb-3 row">
                      <label for="fullName" class="col-sm-4 col-form-label
                          form-label">Nombre completo</label>
                      <?php
                      if (isset($beneficiario)) {
                        $nombreCompleto = $beneficiario->getName();
                        $nombreCompleto = explode(" ", $nombreCompleto);
                        $num = count($nombreCompleto);
                        switch ($num) {
                          case 2:
                            $nombre = $nombreCompleto[0];
                            $apellido = $nombreCompleto[1];
                            break;
                          case 3:
                            $nombre = $nombreCompleto[0];
                            $apellido = $nombreCompleto[1] . " " . $nombreCompleto[2];
                            break;
                          case 4:
                            $nombre = $nombreCompleto[0] . " " . $nombreCompleto[1];
                            $apellido = $nombreCompleto[2] . " " . $nombreCompleto[3];
                            break;
                          case 5:
                            $nombre = $nombreCompleto[0] . " " . $nombreCompleto[1];
                            $apellido = $nombreCompleto[2] . " " . $nombreCompleto[3] . " " . $nombreCompleto[4];
                            break;
                          case 6:
                            $nombre = $nombreCompleto[0] . " " . $nombreCompleto[1];
                            $apellido = $nombreCompleto[2] . " " . $nombreCompleto[3] . " " . $nombreCompleto[4] . " " . $nombreCompleto[5];
                            break;
                          default:
                            $nombre = $beneficiario->getName();
                            $apellido = $beneficiario->getName();
                            break;
                        }
                      }
                      ?>
                      <div class="col-sm-4 mb-3 mb-lg-0">
                        <input type="text" class="form-control" name="name3" placeholder="Nombre (s)" id="fullName" value="<?php if (isset($nombre)) echo sanitize($nombre); ?>">
                      </div>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" name="lastname3" placeholder="Apellido (s)" id="lastName" value="<?php if (isset($apellido)) echo sanitize($apellido); ?>">
                      </div>
                    </div>
                    <div>
                      <h4 class="mb-2 pt-6">Datos de la prenda</h4>
                    </div>
                    <!-- row -->
                    <div class="mb-3 row">
                      <label for="phone" class="col-sm-4 col-form-label
                          form-label">Monto del préstamo</label>
                      <div class="col-md-8 col-12">
                        <input type="number" class="form-control" name="loan_amount" placeholder="Ingrese la cantidad en MXN" id="phone" value="<?php if (isset($producto)) echo sanitize($producto->getLoan_amount()); ?>" required>
                      </div>
                    </div>
                    <!-- row -->
                    <div class="mb-3 row">
                      <label for="phone" class="col-sm-4 col-form-label
                          form-label">Monto del avalúo</label>
                      <div class="col-md-8 col-12">
                        <input type="number" class="form-control" name="appraisal_amount" placeholder="Ingrese la cantidad en MXN" id="phone" value="<?php if (isset($producto)) echo sanitize($producto->getAppraisal_amount()); ?>" required>
                      </div>
                    </div>
                    <!-- row -->
                    <div class="mb-3 row">
                      <label for="addressLine" class="col-sm-4 col-form-label
                          form-label">Características de la prenda</label>
                      <div class="col-md-8 col-12">
                        <input type="text" class="form-control" name="description" placeholder="Ejemplo. Automóvil Chrysler Mod 2013" id="addressLine" value="<?php if (isset($producto)) echo sanitize($producto->getDescription()); ?>" required>
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
