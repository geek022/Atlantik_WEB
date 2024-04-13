<?php
namespace App\Models;
use CodeIgniter\Model;
class ModeleSecteur extends Model
{
    protected $table = 'secteur';
    protected $primaryKey = 'nosecteur';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = ['nom'];
}
?>