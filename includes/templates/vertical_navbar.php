<nav class="navbar-vertical navbar">
  <div class="nav-scroller">
    <!-- Navbar nav -->
    <ul class="navbar-nav flex-column" id="sideNavbar">
      <li class="nav-item">
        <a class="nav-link has-arrow @@if (context.page ===  'dashboard') { active }" href="./">
          <i data-feather="home" class="nav-icon icon-xs me-2"></i> Panel de pólizas
        </a>
      </li>
    </ul>
    <div class="last-item copyright">
      <p>Hecho por: Brandon Gaona</p>
      <p>Todos los derechos reservados &#174 <?php echo date('Y') ?></p>
    </div>
  </div>
</nav>