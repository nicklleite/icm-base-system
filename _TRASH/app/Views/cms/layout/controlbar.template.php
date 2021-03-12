<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNavigation">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavigationItems" aria-controls="mainNavigationItems" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="mainNavigationItems">
        <div class="container">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Painel</a>
                </li>
            </ul>
            <ul class="navbar-nav my-2 my-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-alt"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userMenu">
                        <div class="navbar__user-info">
                            <?php foreach ($session_info as $row) : ?>
                                <h6><?= $row['user_fullname'] ?></h6>
                                <small class="text-muted"><?= $row['user_email'] ?></small>
                            <?php endforeach; ?>
                        </div>
                        <div class="dropdown-divider"></div>
                        <h6 class="dropdown-header text-body">Administração</h6>
                        <a class="dropdown-item" href="<?= base_url(route_to('cms.users.index')) ?>">Usuários</a>
                        <a class="dropdown-item" href="#">Páginas</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url(route_to('cms.profile.index')) ?>">Perfil</a>
                        <a class="dropdown-item" href="#">Configurações</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url(route_to('cms.logout')) ?>">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>