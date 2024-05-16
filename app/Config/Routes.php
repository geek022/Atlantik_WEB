<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
 
//Visiteur
$routes->match(['get', 'post'], 'connexion', 'Visiteur::connexion');
$routes->get('deconnexion', 'Visiteur::deconnexion');
$routes->get('inscription', 'Visiteur::inscription');
$routes->get('voirsecteurs/(:alphanum)', 'Visiteur::voirLesSecteurs/$1');
$routes->get('voirsecteurs', 'Visiteur::voirLesSecteurs');
$routes->get('voirunsecteur/(:alphanum)', 'Visiteur::voirLeSecteurs/$1');
$routes->match(['get','post'],'inscription', 'Visiteur::inscription');
$routes->get('accueil/(:alphanum)', 'Visiteur::accueil/$1');
$routes->get('accueil', 'Visiteur::accueil');
$routes->get('voirliaison/(:alphanum)', 'Visiteur::liaison/$1');
$routes->get('voirliaison', 'Visiteur::liaison');
$routes->get('voirlestarifs/(:alphanum)', 'Visiteur::liaison/$1');
$routes->get('voirlestarifs', 'Visiteur::liaison');
$routes->get('voiruneliaison/(:alphanum)', 'Visiteur::liaison/$1');
$routes->get('voiruneliaison', 'Visiteur::liaison');
$routes->match(['get','post'],'voirunetraversee/(:alplanum)','Visiteur::voirHoraireTraversee/$1');
$routes->get('voirunetraversee','Visiteur::voirHoraireTraversee');
$routes->post('voirunetraversee','Visiteur::voirHoraireTraversee');
//Client
$routes->get('voirprofil', 'Client::client');
$routes->match(['get','post'],'modifiercompte', 'Client::modifierCompte',["filter"=>"filterclient"]);
$routes->post('modifier','Client::modifierCompte');



