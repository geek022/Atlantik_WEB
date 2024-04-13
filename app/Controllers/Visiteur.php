<?php

namespace App\Controllers;

use App\Models\ModeleLiaison;
use App\Models\ModeleSecteur;
use App\Models\ModeleClient;
use App\Models\ModelePeriode;
use App\Models\ModeleLesCategories;

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
        return view('Templates/Header')
            . view('Visiteur/vue_Accueil')
            . view('Templates/Footer');
    }
    public function voirLesSecteurs($numSecteur = null)
    {
        $modSecteur = new ModeleSecteur();
        if ($numSecteur === null) {
            $data['lesSecteurs'] = $modSecteur->findAll();
            $data['TitreDeLaPage'] = 'Tous les secteurs';
            return view('Templates/Header')
                . view('Visiteur/vue_LesSecteurs', $data)
                . view('Templates/Footer');
        } else {
            $data['unSecteur'] = $modSecteur->find($numSecteur);
            if (empty($data['unSecteur'])) {
                throw  \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            $data['TitreDeLaPage'] = $data['unSecteur']->NOM;
            return view('Templates/Header')
                . view('Visiteur/vue_UnSecteur', $data)
                . view('Templates/Footer');
        }
    }
    public function inscription($noClient = null)
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
        $modClient->getInsertID();
        return view('Templates/Header')
            . view('Visiteur/vue_InscriptionReussie', $donnees)
            . view('Templates/Footer');
    }
    public function liaison($noLiaison = null)
    {
        $modLiaison = new ModeleLiaison();
        //$modPeriode = new ModelePeriode();
        //$modLesCat = new ModeleLesCategories();
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
            //$data['lesPeriodes'] = $modPeriode->getPeriode($noLiaison);
            $data['lesTarifs'] = $modLiaison->getTarifLiaison($noLiaison);
            //$data['lesTypes'] = $modLiaison($noLiaison);
            //$data['lesCategories'] = $modLesCat->findAll();
            if (empty($data['uneLiaison'])) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            $data['TitreDeLaPage'] = $data['uneLiaison']->NOLIAISON;
            return view('Templates/Header')
                . view('Visiteur/vue_VoirUneLiaison', $data)
                . view('Templates/Footer');
        }
    }
}