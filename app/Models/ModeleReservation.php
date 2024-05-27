<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeleReservation extends Model
{
    protected $table = "reservation";
    protected $primaryKey = "noreservation";
    protected $useAutoIncrement = true;
    protected $returnType = "object";
    protected $allowedFields = ['notraversee', 'noclient', 'dateheure', 'montanttotal', 'paye', 'modereglement'];


    public function getReservations($noclient)
    {
        return $this->join('traversee', 'traversee.notraversee = reservation.notraversee', 'inner')
            ->join('liaison', 'liaison.noliaison = traversee.noliaison', 'inner')
            ->join('port pd', 'pd.noport = liaison.noport_depart', 'inner')
            ->join('port pa', 'pa.noport = liaison.noport_arrivee', 'inner')
            ->where('reservation.noclient', $noclient)
            ->select('reservation.noreservation, reservation.dateheure, pd.nom as portdepart, pa.nom as portarrivee,montanttotal,paye,dateheuredepart');
    }
}
