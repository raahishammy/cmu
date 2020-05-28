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
    </ul>
</nav>