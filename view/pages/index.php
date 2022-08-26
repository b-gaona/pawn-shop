<?php
require_once __DIR__ . "/../../includes/app.php";
includeTemplate('head');

use App\Sucursal;
use App\Cliente;
use App\Producto;

auth();
?>

<body>
  <div id="db-wrapper">
    <!-- Sidebar -->
    <?php
    includeTemplate('vertical_navbar');
    ?>
    <!-- Page content -->
    <div id="page-content">
      <?php includeTemplate("horizontal_bar") ?>
      <!-- Container fluid -->
      <div class="bg-primary pt-10 pb-21"></div>
      <div class="container-fluid mt-n22 px-6">
        <div class="row mb-3">
          <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div>
              <div class="d-flex justify-content-center align-items-center">
                <div>
                  <?php if (isset($success)) { ?>
                    <div class="btn btn-warning alerta">
                      <p class="mb-0"><?php echo sanitize($success); ?></p>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-md-12 col-12">
            <!-- Page header -->
            <div>
              <div class="d-flex justify-content-between align-items-center flex-wrap">
                <?php if (isset($_SESSION["admin"])) { ?>
                  <div class="mt-2">
                    <a href="./formulario-sucursal" class="btn btn-white">Agregar nueva sucursal</a>
                  </div>
                <?php } else if (isset($_SESSION["user"])) { ?>
                  <div class="mt-2">
                    <a href="./formulario-poliza" class="btn btn-white">Agregar nueva póliza</a>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <!-- POLIZAS-->
          <div class="row mt-6">
            <div class="col-md-12 col-12">
              <!-- card  -->
              <div class="card">
                <!-- card header  -->
                <div class="card-header bg-white border-bottom-0 py-4 pb-0">
                  <h4 class="mb-0 text-center">Pólizas registradas</h4>
                </div>
                <!-- table  -->
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0" id="table_id">
                    <thead class="table-light">
                      <tr>
                        <th class="text-center">PDF</th>
                        <th class="text-center">Sucursal</th>
                        <th class="text-center">Fecha de registro</th>
                        <th class="text-center">Afiliado</th>
                        <th class="text-center">Folio de la prenda</th>
                        <th class="text-center">Descripción de la prenda</th>
                        <?php if (isset($_SESSION["admin"])) { ?>
                          <th></th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($polizas as $poliza) {
                        $idConsumidor = $poliza->getId_customer();
                        $consumidor = Cliente::find($idConsumidor);

                        $idTitular = $poliza->getId_holder();
                        $titular = Cliente::find($idTitular);

                        $idBeneficiario = $poliza->getId_beneficiary();
                        $beneficiario = Cliente::find($idBeneficiario);

                        $idProducto = $poliza->getId_product();
                        $producto = Producto::find($idProducto);

                        $idSucursal = $poliza->getId_branch_office();
                        $sucursal = Sucursal::find($idSucursal);
                      ?>
                        <tr class="text-center">
                          <td>
                            <a href="./poliza-pdf?polid=<?php echo $poliza->getId(); ?>&consid=<?php echo $idConsumidor ?>&titid=<?php echo $idTitular ?>&benid=<?php echo $idBeneficiario ?>&prodid=<?php echo $idProducto ?>&sucid=<?php echo $idSucursal ?>">
                              <picture>
                                <source srcset="./build/img/icon-pdf.avif" type="image/avif">
                                <source srcset="./build/img/icon-pdf.webp" type="image/webp">
                                <img loading="lazy" src="./build/img/icon-pdf.png" alt="Archivo PDF">
                              </picture>
                            </a>
                          </td>
                          <td class="align-middle">
                            <h5 class="fw-bold mb-1"> <a href="#" class="text-inherit"><?php if (isset($sucursal)) echo sanitize($sucursal->getName()); ?></a></h5>
                          </td>
                          <td class="align-middle"><?php if (isset($poliza)) echo sanitize($poliza->getDate()); ?></td>
                          <td class="align-middle"><?php if (isset($consumidor)) echo sanitize($consumidor->getName());  ?></td>
                          <td class="align-middle"><?php if (isset($poliza)) echo sanitize($poliza->getInvoice());  ?></td>
                          <td class="align-middle text-dark"><?php if (isset($producto)) echo sanitize($producto->getDescription());  ?></td>
                          <?php if (isset($_SESSION["admin"])) { ?>
                            <td class="align-middle">
                              <div class="dropdown dropstart">
                                <a class="text-muted text-primary-hover" href="#" role="button" id="dropdownTeamOne" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <i class="icon-xxs" data-feather="more-vertical"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownTeamOne">
                                  <a class="dropdown-item" href="./formulario-poliza?id=<?php echo $poliza->getId() . "&tipo=poliza"; ?>">Modificar</a>
                                  <a class="dropdown-item" href="?id=<?php echo $poliza->getId() . "&tipo=poliza"; ?>">Eliminar</a>
                                </div>
                              </div>
                            </td>
                          <?php } ?>
                        </tr>
                      <?php
                      } ?>
                    </tbody>
                  </table>
                </div>
                <!-- card footer  -->
                <div class="card-footer bg-white text-center">
                  <?php
                  if (isset($_GET["all"]) && $_GET["all"] == true) {
                    echo "<a href=\"./\">Ver registros del día de hoy</a>";
                  } else {
                    echo "<a href=\"?all=true\">Ver todas las pólizas</a>";
                  } ?>
                </div>
              </div>

            </div>
          </div>
          <!-- SUCURSALES  -->
          <?php if (isset($_SESSION["admin"])) { ?>
            <div class="row my-6">
              <!-- card  -->
              <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                <div class="card h-100">
                  <!-- card header  -->
                  <div class="card-header bg-white border-bottom-0 py-4">
                    <h4 class="mb-0 text-center">Sucursales registradas</h4>
                  </div>
                  <!-- table  -->
                  <div class="table-responsive">
                    <table class="table text-nowrap">
                      <thead class="table-light">
                        <tr class="text-center">
                          <th>Nombre</th>
                          <th>Usuario</th>
                          <th>Contraseña</th>
                          <th>Fecha de registro</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($sucursales as $sucursal) { ?>
                          <tr class="text-center">
                            <td class="align-middle">
                              <h5 class="fw-bold mb-1"><?php if (isset($sucursal)) echo sanitize($sucursal->getName()); ?></h5>
                            </td>
                            <td class="align-middle"><?php if (isset($sucursal)) echo sanitize($sucursal->getUsername());  ?></td>
                            <td class="align-middle"><?php if (isset($sucursal)) echo sanitize($sucursal->getPassword());  ?></td>
                            <td class="align-middle"><?php if (isset($sucursal)) echo sanitize($sucursal->getDate());  ?></td>
                            <td class="align-middle">
                              <?php if (isset($sucursal) && $sucursal->getUsername() != "luis_gurria_admin") { ?>
                                <div class="dropdown dropstart">
                                  <a class="text-muted text-primary-hover" href="#" role="button" id="dropdownTeamOne" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-xxs" data-feather="more-vertical"></i>
                                  </a>
                                  <div class="dropdown-menu" aria-labelledby="dropdownTeamOne">
                                    <a class="dropdown-item" href="./formulario-sucursal?id=<?php echo $sucursal->getId() . "&tipo=sucursal"; ?>">Modificar</a>
                                    <a class="dropdown-item" href="?id=<?php echo $sucursal->getId() . "&tipo=sucursal"; ?>">Eliminar</a>
                                  </div>
                                </div>
                              <?php } ?>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <!-- Scripts -->
    <?php
    includeTemplate("scripts");
