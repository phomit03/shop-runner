<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = "customer";
    protected $primaryKey = "idCustomer";
    protected $keyType = 'integer';

    protected $fillable = [
        "nameCustomer",
        "phoneCustomer",
        "emailCustomer",
        "addressCustomer",
        "created_at",
        "updated_at"
    ];

    public function scopeCustomerSearch($query,$Search = ''){
        if($Search != null && $Search != ''){
            return $query->where("nameCustomer","like",'%'.$Search.'%');
        }
        return $query;
    }
}
