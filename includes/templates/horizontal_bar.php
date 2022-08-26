<div class="header @@classList">
  <!-- navbar -->
  <nav class="navbar-classic navbar navbar-expand-lg">
    <a id="nav-toggle" href="#"><i data-feather="menu" class="nav-icon me-2 icon-xs"></i></a>
    <!--Navbar nav -->
    <ul class="navbar-nav navbar-right-wrap ms-auto d-flex nav-top-wrap">
      <!-- List -->
      <li class="dropdown ms-2 center pb-3">
        <a class="rounded-circle" href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="avatar avatar-md avatar-indicators avatar-online">
            <picture>
              <?php
              if (isset($_SESSION["user"])) { ?>
                <source srcset="../public/build/img/avatar-2.avif" type="image/avif">
                <source srcset="../public/build/img/avatar-2.webp" type="image/webp">
                <img loading="lazy" src="../public/build/img/avatar-2.png" alt="avatar" class="rounded-circle">
              <?php } else if (isset($_SESSION["admin"])) { ?>
                <source srcset="../public/build/img/avatar-1.avif" type="image/avif">
                <source srcset="../public/build/img/avatar-1.webp" type="image/webp">
                <img loading="lazy" src="../public/build/img/avatar-1.png" alt="avatar" class="rounded-circle">
              <?php } ?>
            </picture>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
          <div class="px-4 pb-0 pt-2">
            <div class="lh-1 ">
              <h5 class="mb-1 text-center">
                <?php
                if (isset($_SESSION["user"])) {
                  echo "Usuario";
                } else if (isset($_SESSION["admin"])) {
                  echo "Administrador";
                }
                ?>
              </h5>
            </div>
            <div class=" dropdown-divider mt-3 mb-2"></div>
          </div>
          <ul class="list-unstyled">
            <li>
              <a class="dropdown-item" href="./cerrar-sesion">
                <i class="me-2 icon-xxs dropdown-item-icon" data-feather="power"></i>Cerrar sesión
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </nav>
</div>