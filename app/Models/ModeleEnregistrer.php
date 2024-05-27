<?php
namespace App\Models;
use CodeIgniter\Model;
class ModeleEnregistrer extends Model
{
    protected $table = 'enregistrer';
    protected $primaryKey = 'noreservation';
    protected $useAutoIncrement = false;
    protected $returnType = 'object';
    protected $allowedFields = ['lettrecategorie','notype','quantitereservee','quantiteembarquee'];
}
?>