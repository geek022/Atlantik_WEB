<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleTarifer extends Model
{
    protected $table = 'tarifer';
    protected $primaryKey = 'noperiode';
    protected $useAutoIncrement = false;
    protected $returnType = 'object';
    protected $allowedFields = ['noperiode', 'lettrecategorie', 'notype', 'noliaison', 'tarif'];

    public function getAllTarif()
    {
        return $this->join('liaison', 'liaison.noliaison = tarifer.noliaison', 'inner')
            ->join('periode', 'periode.noperiode=tarifer.noperiode', 'inner')
            ->select('tarifer.tarif')
            ->get()->getResult();
    }
    public function getTarif($noLiaison)
    {
        return $this->join('liaison', 'liaison.noliaison = tarifer.noliaison', 'inner')
            ->join('periode', 'periode.noperiode=tarifer.noperiode', 'inner')
            ->where('tarifer.noliaison', $noLiaison)
            ->select('tarifer.tarif')
            ->get()->getResult();
    }

    public function getTarifParTraversee($notraversee,$noLiaison)
    {
        return $this->join('type','type.notype = tarifer.notype','inner')
        ->join('liaison','liaison.noliaison = tarifer.noliaison','inner')
        ->join('traversee','traversee.noliaison = liaison.noliaison')
        ->where('notraversee',$notraversee)
        ->where('noliaison',$noLiaison)
        ->distinct('tarifer.tarif, type.lettrecategorie, type.libelle')
        ->get()->getResult();
    }
    
}
