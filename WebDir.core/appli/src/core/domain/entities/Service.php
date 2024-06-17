<?php

namespace WebDir\core\appli\core\domain\entities;

use Illuminate\Database\Eloquent\Model;

class Service extends Model{


    protected $table = 'department';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = true;

    protected $fillable = ['id', 'nom', 'etage', 'description'];

    public function personne(){
        return $this->belongsToMany(
            'WebDir\core\api\core\domain\entities\Entree',
            'entree_department',
            'department_id',
            'entree_id'
        );
    }
}