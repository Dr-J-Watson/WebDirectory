<?php

namespace WebDir\core\appli\core\domain\entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Entree extends Model{

    use HasUuids;

    protected $table = 'entree';
    protected $primaryKey = 'uuid';
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['uuid', 'lastName', 'firstName', 'numBureau', 'telFixe', 'telMobile', 'email', 'image'];

    public function department(){
        return $this->belongsToMany(
            'WebDir\core\appli\core\domain\entities\Service',
            'entree_department',
            'entree_id',
            'department_id'
        );
    }
}