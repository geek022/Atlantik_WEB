<!DOCTYPE html>
<html lang="fr">

<head>
  <title>Projet Atlantik</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="javascript:void(0)">
        <?php helper('assets', 'img'); ?>
        <img src="<?php echo img_url('18.jpg'); ?>" alt="atlantik" style="width:40px;" class="rounded-pill">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mynavbar">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('voirlestarifs') ?>">Afficher les liaisons par secteur</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('voirliaison') ?>">Afficher les tarifs pour une liaison</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('voirunetraversee') ?>"> Les horaires de traversées </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('voirreservation') ?>"> Réservations </a>
          </li>
        </ul>
        <form class="d-flex">
          <?php
          $session = session();
          if (!is_null($session->get('mel'))) : ?>
            <?php echo 'Bonjour ' . $session->get('prenom') . ' ' . $session->get('nom') . '&nbsp;&nbsp;'; ?>
            <a href="<?php echo site_url('deconnexion') ?>" class="btn btn-primary">Se déconnecter</a>&nbsp;&nbsp;
            <a href="<?php echo site_url('accueil') ?>" class="btn btn-primary">Accueil</a>&nbsp;&nbsp;
            <a href="<?php echo site_url('voirprofil')?>" class="btn btn-primary">Profil</a>&nbsp;&nbsp;
          <?php else : ?>
            <a href="<?php echo site_url('connexion') ?>" class="btn btn-primary">Se connecter</a>&nbsp;&nbsp;
            <a href="<?php echo site_url('inscription') ?>" class="btn btn-primary">S'inscrire</a>&nbsp;&nbsp;
          <?php endif; ?>
        </form>
      </div>
    </div>
  </nav>
  <div class="container-fluid mt-3">
    <h3>Navbar Forms</h3>
    <p>You can also include forms inside the navigation bar.</p>
  </div>
  <div class="container-fluid">
    <form class="d-flex justify-content-center mt-3">

    </form>
  </div>
  <!--<?php
  helper(['assets', 'img']);
  ?>
  <div class="d-flex justify-content-center">
    <img src="<?php echo img_url('maxresdefault.jpg'); ?>" alt="atlantik" width="70%" height="auto">
  </div>-->

</body>

</html>