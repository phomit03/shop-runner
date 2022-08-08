<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;
    protected $table = "catalog";
    protected $primaryKey = "idCatalog";
    protected $keyType = 'integer';
    protected $fillable = [
        "nameCatalog",
        "idAdvanced",
        "created_at",
        "updated_at"
    ];

    public function scopeCatalogSearch($query,$Search = ''){
        if($Search != null && $Search != ''){
            return $query->where("nameCatalog","like",'%'.$Search.'%');
        }
        return $query;
    }
}
