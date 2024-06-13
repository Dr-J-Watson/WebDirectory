<?php

namespace WebDir\core\appli\core\domain\entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model{


    protected $table = 'department';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = ['id', 'nom'];

    public function personne(){
        return $this->belongsToMany('WebDir\core\appli\core\domain\entities\Personne', 'personne_departement', 'departement', 'personne',
        'id','uuid');
    }
}