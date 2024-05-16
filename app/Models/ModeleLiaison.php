<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleLiaison extends Model
{
    protected $table = 'liaison';
    protected $primaryKey = 'noliaison';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = ['noport_depart', 'nosecteur', 'noport_arrivee', 'distance'];

    public function getAllLiaisons()
    {
        return $this->join('secteur', 'secteur.nosecteur = liaison.nosecteur', 'inner')
            ->join('port as pd', 'pd.noport = liaison.noport_depart', 'inner')
            ->join('port as pa', 'pa.noport = liaison.noport_arrivee', 'inner')
            ->select('secteur.nom,liaison.noliaison,pd.nom as portdepart,pa.nom as nomport,liaison.distance')
            ->orderBy('secteur.nom', 'asc')
            ->get()->getResult();
    }
    public function getNomportDepart($noLiaison)
    {
        return $this->join('port as pd', 'pd.noport = liaison.noport_depart', 'inner')
            ->where('liaison.noliaison', $noLiaison)
            ->select('pd.nom')
            ->get()->getResult();
    }
    public function getNomportArrivee($noLiaison)
    {
        return $this->join('port as pa', 'pa.noport = liaison.noport_arrivee', 'inner')
            ->where('liaison.noliaison', $noLiaison)
            ->select('pa.nom')
            ->get()->getResult();
    }
    public function getTarifLiaison($noLiaison)
    {
        return $this->join('port portdepart', 'portdepart.noport = liaison.noport_depart', 'inner')
            ->join('port portarrivee', 'portarrivee.noport = liaison.noport_arrivee', 'inner')
            ->join('tarifer', 'tarifer.noliaison = liaison.noliaison', 'inner')
            ->join('periode', 'periode.noperiode = tarifer.noperiode', 'inner')
            ->join('type', 'type.notype = tarifer.notype', 'inner')
            ->join('categorie', 'categorie.lettrecategorie = type.lettrecategorie', 'inner')
            ->where('liaison.noliaison', $noLiaison, 'periode.datefin >=', date('Y-m-d'))
            ->select('categorie.lettrecategorie,categorie.libelle as libellecategorie,type.lettrecategorie as lettretype,tarifer.notype,type.libelle as libelletype,periode.datedebut,periode.datefin,tarifer.tarif')
            ->get()->getResult();
    }
    public function getPortDepartEtArrivee($nosecteur)
    {
        return $this->join('port as pd', 'pd.noport = liaison.noport_depart', 'inner')
            ->join('port as pa', 'pa.noport = liaison.noport_arrivee', 'inner')
            ->select('pd.nom as portdepart,pa.nom as portarrivee,noliaison')
            ->where('nosecteur', $nosecteur)
            ->get()->getResult();
    }
    public function getPortDepartEtArriveeParNoLiaison($noLiaison)
    {
        return $this->join('port as pd', 'pd.noport = liaison.noport_depart', 'inner')
            ->join('port as pa', 'pa.noport = liaison.noport_arrivee', 'inner')
            ->select('pd.nom as depart, pa.nom as arrivee,noliaison')
            ->where('noliaison', $noLiaison)
            ->get()->getResult();
    }
}
