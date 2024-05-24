<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleTraversee extends Model
{
    protected $table = 'traversee';
    protected $primaryKey = 'notraversee';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = ['noliaison', 'nobateau', 'dateheuredepart', 'dateheurearrivee'];




    public function getQuantiteEnregistree($notraversee, $lettrecategorie)
    {
        return $this->join('reservation', 'reservation.notraversee=traversee.notraversee', 'inner')
            ->join('enregistrer', 'enregistrer.noreservation=reservation.noreservation', 'inner')
            ->join('type', 'type.notype=enregistrer.notype and type.lettrecategorie=enregistrer.lettrecategorie', 'inner')
            ->where('traversee.notraversee', $notraversee)
            ->where('enregistrer.lettrecategorie', $lettrecategorie)
            ->select('SUM(enregistrer.quantitereservee)')
            ->get()->getRow();
    }

    public function getCapaciteMaximale($notraversee, $lettrecategorie)
    {
        return $this->join('bateau', 'bateau.nobateau=traversee.nobateau', 'inner')
            ->join('contenir', 'bateau.nobateau=contenir.nobateau', 'inner')
            ->join('categorie','categorie.lettrecategorie=contenir.lettrecategorie','inner')
            ->where('traversee.notraversee', $notraversee)
            ->where('contenir.lettrecategorie', $lettrecategorie)
            ->select('contenir.capacitemax')
            ->get()->getResult();
    }
    public function getLesTraverseesBateaux($noliaison, $datetraversee)
    {
        $date = date('Y-m-d', strtotime($datetraversee));
        return $this->join('bateau', 'bateau.nobateau=traversee.nobateau', 'inner')
            ->where('noliaison', $noliaison)
            ->where('dateheuredepart >=', $date)
            ->select('traversee.notraversee as traversee,traversee.dateheuredepart as depart,traversee.dateheurearrivee as arrivee,bateau.nom as nom')
            ->get()->getResult();
    }
    public function GetPeriode()
    {
        return $this->join('bateau', 'bateau.nobateau=traversee.nobateau', 'inner')
            ->join('contenir', 'bateau.nobateau=contenir.nobateau', 'inner')
            ->join('type', 'type.lettrecategorie=contenir.lettrecategorie', 'inner')
            ->join('tarifer', 'tarifer.notype=type.notype', 'inner')
            ->join('periode', 'periode.noperiode=tarifer.noperiode', 'inner')
            ->select('periode.datedebut,periode.datefin')
            ->get()->getResult();
        
    }
    public function getNoliaisonByNotraversee($notraversee)
    {
        return $this->join('liaison','liaison.noliaison = traversee.noliaison','inner')
        ->where('traversee.notraversee',$notraversee)
        ->select('liaison.noliaison')
        ->get()->getRow();
    }
    public function getDonneesParnoTraversee($notraversee)
    {
        return $this->join('bateau','bateau.nobateau = traversee.nobateau','inner')
        ->join('contenir','contenir.nobateau = bateau.nobateau','inner')
        ->join('categorie','categorie.lettrecategorie = contenir.lettrecategorie','inner')
        ->where('traversee.notraversee',$notraversee)
        ->select('contenir.capacitemax, notraversee')
        ->get()->getResult();
    }
}
