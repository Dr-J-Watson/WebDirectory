<?php

namespace WebDir\core\appli\core\domain\entities;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class User extends Model {
    use HasUuids;

    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['user_id', 'id', 'password', 'role'];
}