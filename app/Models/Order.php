<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $primaryKey = 'idOrder';
    protected $keyType = 'integer';
    protected $fillable = [
        'idProduct',
        'quantity',
        'amount',
        'idTransaction',
        'statusOrder',
        "created_at",
        "updated_at"
    ];

    public function getProduct() {
        return $this->hasOne(Product::class, "idProduct","idProduct");
    }

    public function getTransaction() {
        return $this->belongsTo(Transaction::class, "idTransaction","idTransaction");
    }

    //search sẽ xử lí việc lọc, nếu phải lọc nhiều cái
    public function scopeFilterProduct($query, $idProduct=''){  //name giá trị mặc định ban đầu
        if($idProduct != null && $idProduct != '') {
            return $query->where("idProduct",$idProduct);
        }
        return $query;
    }

    public function scopeFilterTransaction($query,$idTransaction=''){
        if($idTransaction != null && $idTransaction != '') {
            return $query->where("idTransaction",$idTransaction);
        }
        return $query;
    }

    public function scopeFilterStatus($query,$statusOrder=''){
        if($statusOrder != null && $statusOrder != '') {
            return $query->where("statusOrder",$statusOrder);
        }
        return $query;
    }

}
