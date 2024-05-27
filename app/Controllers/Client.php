<?php

namespace App\Controllers;

use App\Models\ModeleTraversee;
use App\Models\ModeleLiaison;
use App\Models\ModeleClient;
use App\Models\ModeleReservation;
use App\Models\ModeleEnregistrer;
use App\Models\ModeleTarifer;

helper(['assets', 'url', 'form']);
class Client extends BaseController
{
    public function client()
    {
        $session = session();
        $data['TitreDeLaPage'] = 'Profil';
        if (!$this->request->is('post')) {
            $modClient = new ModeleClient();
            $condition = ['mel' => $session->get('mel')];
            $data['utilisateur'] = $modClient->where($condition)->first();
            return view('Templates/Header', $data)
                . view('Client/vue_Profil')
                . view('Templates/Footer');
        }
    }
    public function modifierCompte()
    {
        $session = session();
        $data['TitreDeLaPage'] = 'Modifier le compte';
        if (!$this->request->is('post')) {
            $modClient = new ModeleClient();
            $condition = ['mel' => $session->get('mel')];
            $data['utilisateur'] = $modClient->where($condition)->first();
            return view('Templates/Header', $data)
                . view('Client/vue_ModifierCompte')
                . view('Templates/Footer');
        }
        $reglesValidation = [
            'txtNom' => 'required',
            'txtPrenom' => 'required',
            'txtAdresse' => 'required',
            'txtCodePostal' => 'required',
            'txtVille' => 'required',
            'txtTelephoneFixe' => 'required',
            'txtTelephoneMobile' => 'required',
            'txtMel' => 'required|valid_email',
        ];
        if (!$this->validate($reglesValidation)) {
            $modClient = new ModeleClient();
            $condition = ['mel' => $session->get('mel')];
            $data['utilisateur'] = $modClient->where($condition)->first();
            $data['validation'] = $this->validator;
            return view('Templates/Header', $data)
                . view('Client/vue_ModifierCompte')
                . view('Templates/Footer');
        }
        $modClient = new ModeleClient();
        $data = [
            'nom' => $this->request->getPost('txtNom'),
            'prenom' => $this->request->getPost('txtPrenom'),
            'adresse' => $this->request->getPost('txtAdresse'),
            'codepostal' => $this->request->getPost('txtCodePostal'),
            'ville' => $this->request->getPost('txtVille'),
            'telephonefixe' => $this->request->getPost('txtTelephoneFixe'),
            'telephonemobile' => $this->request->getPost('txtTelephoneMobile'),
            'mel' => $this->request->getPost('txtMel'),
        ];
        $motdepasse = $this->request->getPost('txtMDP');
        if (!empty($motdepasse)) {
            $data['motdepasse'] = $motdepasse;
        }
        $modClient->modifierUtilisateur($session->get('noclient'), $data);
        return redirect()->to('voirprofil');
    }
    public function reserverUneTraversee($notraversee = null)
    {
        $modTraversee = new ModeleTraversee();
        $modLiaison = new ModeleLiaison();
        $modClient = new ModeleClient();
        if ($notraversee === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $traversee = $modTraversee->where('notraversee', $notraversee)->find();
        if (!$traversee) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $noliaison = $traversee[0]->NOLIAISON;
        $liaison = $modLiaison->getPortDepartEtArrivee($noliaison);
        $clientID = session()->get('noclient');
        if ($clientID === null) {
            return redirect()->to('connexion');
        }
        $utilisateur = $modClient->find($clientID);
        $tarifs = $modLiaison->getTarifsByLiaison($noliaison);
        $data['traversee'] = $traversee;
        $data['liaisons'] = $liaison;
        $data['tarifs'] = $tarifs;
        $data['utilisateur'] = $utilisateur;
        $data['TitreDeLaPage'] = 'Réservation';

        return view('Templates/Header', $data)
            . view('Client/vue_VoirReservation', $data)
            . view('Templates/Footer');
    }

    public function reserver($notraversee = null)
    {
        if ($notraversee === null  || !$this->request->is('post')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $modReservation = new ModeleReservation();
        $modeEnregistrer = new ModeleEnregistrer();

        $quantites = $this->request->getPost('quantite');
        $clientID = session()->get('noclient');
        $dateheure = date('Y/m/d à\ H:i');
        $lettrecategorie = $this->request->getPost('lettrecategorie');

        $data =
            [
                'notraversee' => $notraversee,
                'noclient' => $clientID,
                'dateheure' => $dateheure,
                'montanttotal' => 0,
                'paye' => 0,
                'modereglement' => null
            ];
        $data['reservation'] = $modReservation->insert($data);
        $noreservation = $modReservation->getInsertID();
        foreach ($quantites as $notype => $quantite) {

            $data['enregistres'] =
                [
                    'noreservation' => $noreservation,
                    'lettrecategorie' => $lettrecategorie,
                    'notype' => $notype,
                    'quantitereservee' => $quantite,
                    'quantiteembarquee' => 0,
                ];
            $modeEnregistrer->insert($data['enregistres']);
        }
        return redirect()->to('bilan_reservation/' . $noreservation);
    }
    public function confirmeReservation()
    {
        $modReservation = new ModeleReservation();
        $data = [
            'notraversee' => $this->request->getPost('notraversee'),
            'noclient' => session()->get('noclient'),
            'date' => date('Y-m-d'),
            'montanttotal' => $this->request->getPost('montanttotal'),
            'paye' => 0,
            'modereglement' => $this->request->getPost('modereglement')
        ];
        $modReservation->save($data);
        return redirect()->to('accueil');
    }
    public function afficherHistorique()
    {
        $session = session();
        $data = [];
        $data['TitreDeLaPage'] = 'Toutes les réservations';

        $modReservation = new ModeleReservation();
        $data['reservations'] = $modReservation->getReservations($session->get('noclient'))->paginate(5);

        $data['pager'] = $modReservation->pager;

        return view('Templates/Header', $data)
            . view('Client/vue_Historique', $data)
            . view('Templates/Footer');
    }

    public function bilanReservation($noreservation)
    {
        $modReservation = new ModeleReservation();
        $modEnregistrer = new ModeleEnregistrer();

        $reservation = $modReservation->find($noreservation);
        if (!$reservation) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $enregistrements = $modEnregistrer->where('noreservation', $noreservation)->findAll();

        $data = [
            'reservation' => $reservation,
            'enregistrements' => $enregistrements,
            'TitreDeLaPage' => 'Bilan de la Réservation'
        ];

        return view('Templates/Header', $data)
            . view('Client/vue_BilanReservation', $data)
            . view('Templates/Footer');
    }
}
