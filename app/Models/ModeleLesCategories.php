<?php
namespace App\Models;
use CodeIgniter\Model;
class ModeleLesCategories extends Model
{
    protected $table = 'categorie';
    protected $primaryKey = 'lettrecategorie';
    protected $useAutoIncrement = false;
    protected $returnType = 'object';
    protected $allowedFields = ['lettrecategorie', 'libelle'];
}
?>