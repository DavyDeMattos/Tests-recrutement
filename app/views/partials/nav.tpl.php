<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= $router->generate('main-home') ?>">Auto'loc</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $router->generate('main-home') ?>">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $router->generate('car-list') ?>">Voitures</a>
                </li>
            </ul>
        </div>
    </div>
</nav>