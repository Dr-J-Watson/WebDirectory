<?php

namespace WebDir\core\appli\core\domain\entities;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model{


    protected $table = 'department';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = ['id', 'nom', 'etage', 'description'];

    public function personne(){
        return $this->belongsToMany('WebDir\core\appli\core\domain\entities\Entree', 'personne_departement',
        'id','uuid');
    }
}