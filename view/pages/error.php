<?php
require_once __DIR__ . "/../../includes/app.php";
includeTemplate('head');
?>

<body>
  <!-- Error page -->
  <div class="container min-vh-100 d-flex justify-content-center
      align-items-center">
    <!-- row -->
    <div class="row">
      <!-- col -->
      <div class="col-12">
        <!-- content -->
        <div class="text-center">
          <div class="mb-3">
            <!-- img -->
            <img src="./build/img/404-error-img.png" alt="" class="img-fluid">
          </div>
          <!-- text -->
          <h1 class="display-4 fw-bold">Oops! esta página no fue encontrada.</h1>
          <p class="mb-4">Inténtalo de nuevo o regresa luego.</p>
          <!-- button -->
          <a href="./" class="btn btn-primary">Ir a la página principal</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Scripts -->
  <?php
  includeTemplate("scripts");
