<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="<?=base_url()?>" class="nav-link <?= ($this->router->fetch_class() == "dashboard") ? "active": ""?>" >
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?=base_url()?>referrals" class="nav-link <?= ($this->router->fetch_class() == "referrals") ? "active": ""?>">
                <i class="nav-icon far fa-plus-square"></i>
                <p>Referrals</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?=base_url()?>connections" class="nav-link <?= ($this->router->fetch_class() == "connections") ? "active": ""?>">
                <i class="nav-icon fas fa-tree"></i>
                <p>Connections</p>
            </a>
        </li>
        
     <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Plan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <?php if($this->aauth->get_user_role() == 'Admin'){?>
              <li class="nav-item">
                <a href="<?=base_url()?>plan/create-plan" class="nav-link <?= ($this->router->fetch_class() == "create-plan") ? "active": ""?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Plan</p>
                </a>
              </li>
              <li class="nav-item <?= ($this->router->fetch_class() == "plans") ? "active": ""?>">
                <a href="<?=base_url()?>plans" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
          <?php }else{ ?>
              <li class="nav-item">
                <a href="<?=base_url()?>plan/buy-plan" class="nav-link <?= ($this->router->fetch_class() == "buy-plan") ? "active": ""?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buy Plan</p>
                </a>
              </li>
          <?php } ?>
            </ul>
          </li>
    </ul>
</nav>