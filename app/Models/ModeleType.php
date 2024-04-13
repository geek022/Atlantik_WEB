<?php
namespace App\Models;
use CodeIgniter\Model;
class ModeleType extends Model
{
    protected $table = 'type';
    protected $primaryKey = 'lettrecategorie';
    protected $useAutoIncrement = false;
    protected $returnType = 'object';
    protected $allowedFields = ['lettrecategorie','notype', 'libelle'];
}
