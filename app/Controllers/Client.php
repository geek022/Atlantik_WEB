<?php

namespace App\Controllers;

use App\Models\ModeleClient;

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
    public function afficherHistorique() 
    {
        $session = session();
        $data = [];        
        $data['TitreDeLaPage'] = 'Toutes les réservations';
        //$pager = \Config\Services::pager();
        $modClient = new ModeleClient();
        $data['reservations'] = $modClient->getReservations($session->get('noclient'));
        $data['pager'] = $modClient->pager;
        return view('Templates/Header', $data)
            . view('Client/vue_Historique', $data)
            . view('Templates/Footer');
    }
}
