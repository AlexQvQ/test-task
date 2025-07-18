<?php

namespace App\Models;

use App\Models\Group;
use App\Models\Price;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public function price(){
        return $this->HasOne(Price::class, 'id_product');
    }

    public function group(){
        return $this->belongsTo(Group::class, 'id_group');
    }
}
