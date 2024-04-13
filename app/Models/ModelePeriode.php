<?php
namespace App\Models;
use CodeIgniter\Model;
class ModelePeriode extends Model
{
    protected $table = 'periode';
    protected $primaryKey = 'noperiode';
    protected $useAutoIncrement = false;
    protected $returnType = 'object';
    protected $allowedFields = ['noperiode', 'datedebut', 'datefin'];

    public function getPeriode($noLiaison)
    {
        return $this->join('tarifer','tarifer.noperiode = periode.noperiode','inner')
        ->join('liaison','tarifer.noliaison = liaison.noliaison','inner')
        ->where('periode.datefin >=',date('Y-m-d'),$noLiaison)
        ->select('periode.datedebut,periode.datefin')
        ->get()->getResult();
    }
}