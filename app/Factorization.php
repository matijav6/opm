<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factorization extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'faktorizacija';
    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['zadatak_broj','velicina_matrice','matrica'];
}
