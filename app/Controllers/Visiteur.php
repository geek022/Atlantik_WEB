<?php

namespace App\Controllers;

use App\Models\ModeleLiaison;
use App\Models\ModeleSecteur;
use App\Models\ModeleClient;
use App\Models\ModeleLesCategories;
use App\Models\ModeleTraversee;


helper(['assets', 'url', 'form']);
class Visiteur extends BaseController
{
    public function connexion()
    {
        helper(['form']);
        $session = session();
        $data['TitreDeLaPage'] = 'Se connecter';
        if (!$this->request->is('post')) {
            return view('Templates/Header', $data)
                . view('Visiteur/vue_Connexion')
                . view('Templates/Footer');
        }
        $regleValidation =
            [
                'txtMel' => 'required|valid_email',
                'txtMDP' => 'required',
            ];
        if (!$this->validate($regleValidation)) {
            $data['TitreDeLaPage'] = "Saisie incorrecte";
            return view('Templates/Header', $data)
                . view('Visiteur/vue_Connexion')
                . view('Templates/Footer');
        }
        $Mel = $this->request->getPost('txtMel');
        $MDP = $this->request->getPost('txtMDP');
        $modClient = new ModeleClient();
        $condition = ['mel' => $Mel, 'motdepasse' => $MDP];
        $utilisateurRetourne = $modClient->where($condition)->first();
        if ($utilisateurRetourne != null) {
            $session->set('noclient', $utilisateurRetourne->NOCLIENT);
            $session->set('mel', $utilisateurRetourne->MEL);
            $session->set('nom', $utilisateurRetourne->NOM);
            $session->set('prenom', $utilisateurRetourne->PRENOM);
            echo view('Templates/Header', $data);
            echo view('Visiteur/vue_ConnexionReussie');
        } else {
            $data['TitreDeLaPage'] = "Email ou/et mot de passe incorrect(s)";
            return view('Templates/Header', $data)
                . view('Visiteur/vue_Connexion')
                . view('Templates/Footer');
        }
    }
    public function deconnexion()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('connexion');
    }
    public function accueil()
    {
        $modTraversee = new ModeleTraversee();
        $data['traversees'] = $modTraversee->find(3);
        $data['TitreDeLaPage'] = 'Accueil';

        return view('Templates/Header')
            . view('Visiteur/vue_Accueil',$data)
            . view('Templates/Footer');
    }
    public function voirLesSecteurs($numSecteur = null)
    {
        $modLiaison = new ModeleLiaison();
        $modSecteur = new ModeleSecteur();
        if ($numSecteur === null && !$this->request->is('post')) {
            $data['secteurs'] = $modSecteur->findAll();
            $data['liaisons'] = $modLiaison->findAll();
            $data['TitreDeLaPage'] = 'Tous les secteurs';
            return view('Templates/Header')
                . view('Visiteur/vue_LesSecteurs', $data)
                . view('Templates/Footer');
        } else {
            $data['unSecteur'] = $modSecteur->find($numSecteur);
            if (empty($data['unSecteur'])) {
                throw  \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            $data['liaisons'] = $modLiaison->getPortDepartEtArrivee($numSecteur);
            $data['TitreDeLaPage'] = $data['unSecteur']->NOM;
            return view('Templates/Header')
                . view('Visiteur/vue_UnSecteur', $data)
                . view('Templates/Footer');
        }
    }
    public function inscription()
    {
        $data['TitreDeLaPage'] = 'Inscription';
        if (!$this->request->is('post')) {
            return view('Templates/Header')
                . view('Visiteur/vue_Inscription', $data)
                . view('Templates/Footer');
        }
        $regleValidation =
            [
                'txtNom' => 'required|string',
                'txtPrenom' => 'required|string',
                'txtAdresse' => 'required|string|max_length[50]',
                'txtCP' => 'required|numeric',
                'txtVille' => 'required|string|max_length[50]',
                'txtTel' => 'required|string',
                'txtMobil' => 'required|string',
                'txtMel' => 'required|valid_email',
                'txtMDP' => 'required',
                'txtMDPConfirmation' => 'matches[txtMDP]',
            ];
        if (!$this->validate($regleValidation)) {
            $data['TitreDeLaPage'] = "Saisie incorrecte";
            return view('Templates/Header')
                . view('Visiteur/vue_Inscription', $data)
                . view('Templates/Footer');
        }
        $donneesAInserer = array(
            'nom' => $this->request->getPost('txtNom'),
            'prenom' => $this->request->getPost('txtPrenom'),
            'adresse' => $this->request->getPost('txtAdresse'),
            'codepostal' => $this->request->getPost('txtCP'),
            'ville' => $this->request->getPost('txtVille'),
            'telephonefixe' => $this->request->getPost('txtTel'),
            'telephonemobile' => $this->request->getPost('txtMobil'),
            'mel' => $this->request->getPost('txtMel'),
            'motdepasse' => $this->request->getPost('txtMDP'),
        );
        $modClient = new ModeleClient();
        $donnees['clientAjoute'] = $modClient->insert($donneesAInserer, false);
        return view('Templates/Header')
            . view('Visiteur/vue_InscriptionReussie', $donnees)
            . view('Templates/Footer');
    }
    public function liaison($noLiaison = null)
    {
        $modLiaison = new ModeleLiaison();
        if ($noLiaison === null) {
            $data['lesLiaisons'] = $modLiaison->getAllLiaisons();
            $data['TitreDeLaPage'] = 'Les liaisons par secteur';
            return view('Templates/Header')
                . view('Visiteur/vue_Liaison', $data)
                . view('Templates/Footer');
        } else {
            $data['uneLiaison'] = $modLiaison->find($noLiaison);
            $data['depart'] = $modLiaison->getNomportDepart($noLiaison);
            $data['arrivee'] = $modLiaison->getNomportArrivee($noLiaison);
            $data['lesTarifs'] = $modLiaison->getTarifLiaison($noLiaison);
            if (empty($data['uneLiaison'])) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            $data['TitreDeLaPage'] = $data['uneLiaison']->NOLIAISON;
            return view('Templates/Header')
                . view('Visiteur/vue_VoirUneLiaison', $data)
                . view('Templates/Footer');
        }
    }
    public function voirHoraireTraversee($noliaison = null)
    {
        $modTraversee = new ModeleTraversee();
        $modLesCat = new ModeleLesCategories();
        $modLiaison = new ModeleLiaison();

        $data['traversees'] = [];
        if ($noliaison === null && $this->request->is('post')) {
            $data['liaison'] = $this->request->getPost('lstLiaisons');
            $data['date'] = $this->request->getPost('datepicker');

            $data['liaisons'] = $modLiaison->getPortDepartEtArriveeParNoLiaison($data['liaison']);
            $data['categories'] = $modLesCat->findAll();
            $data['bateaux'] = $modTraversee->getLesTraverseesBateaux($data['liaison'], $data['date']);
            $data['capacites'] = [];

            foreach ($data['bateaux'] as $bateau) {
                $capacitesParCategorie = [];
                foreach ($data['categories'] as $categorie) {
                    $capaciteMax = $modTraversee->getCapaciteMaximale($bateau->traversee, $categorie->LETTRECATEGORIE)[0]->capacitemax;
                    //$quantiteReservee = $modTraversee->getQuantiteEnregistree($bateau->traversee,$categorie->LETTRECATEGORIE)[0]->quantitereservee;
                    $capacitesParCategorie[$categorie->LETTRECATEGORIE] = $capaciteMax;
                }
                $data['capacites'][$bateau->traversee] = $capacitesParCategorie;
            }

            $data['TitreDeLaPage'] = 'Les traversées';
            return view('Templates/Header', $data)
                . view('Visiteur/vue_LesTraversees', $data)
                . view('Templates/Footer');
        } else {
            if (empty($data['traversees'])) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            return view('Templates/Header', $data)
                . view('Visiteur/vue_VoirTraversees', $data)
                . view('Templates/Footer');
        }
    }
}
