<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Mixed_;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transaction';
    protected $primaryKey = 'idTransaction';
    protected $keyType = 'integer';
    protected $fillable=[
        'idCustomer',
        'totalAmount',  //tinh tong amount (count)
        'payment',  //select
        'paymentInfo',  //confirmed / unconfirmed
        'note', //nullable
        'invoice',  //boolean, checkbox muon in hay khong, tra ve list &#10004; (dau tich)
        'statusTransaction',    //boolean, mac dinh 1, in ra success
        'created_at',
        'updated_at'
    ];


    public function getCustomer(){
        return $this->belongsTo(Customer::class, "idCustomer","idCustomer");
    }

    public function getOrder(){
        return $this->hasMany(Order::class, "idTransaction","idTransaction");
    }

    public function scopeFilterCustomer($query, $idCustomer = ''){  //name giá trị mặc định ban đầu
        if($idCustomer != null && $idCustomer != '') {
            return $query->where("idCustomer", $idCustomer);
        }
        return $query;
    }

    public function scopeFilterStatus($query, $statusTransaction = ''){  //name giá trị mặc định ban đầu
        if($statusTransaction != null && $statusTransaction != '') {
            return $query->where("statusTransaction", $statusTransaction);
        }
        return $query;
    }

    /*public function showTotalAmount($query, $totalAmount = 0)
    {
        $result = Transaction::select('SELECT *
                          FROM  `purchases`
                          WHERE purchases.amount = (
                              SELECT SUM( payments.amount )
                              FROM payments
                              WHERE payments.purchase_id = purchases.id )');
        return $result;
    }*/
}
