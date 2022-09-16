<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $guarded = ['id_transaksi'];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'id_cart', 'id_cart');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
