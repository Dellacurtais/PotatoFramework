<?php
namespace Models;

use Illuminate\Database\Eloquent\Model;

class Bolsas extends Model {

    public function __construct(array $attributes = []){
        parent::__construct($attributes);
        $this->setTable("Teste");
    }

}
