<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class PrintList extends Model
{
    use HasFactory;

    protected $table = 'print_list';
    protected $guarded = ['id_print_list'];

    public function produk()
    {
        return $this->belongsTo(ProdukModel::class, 'id_produk', 'id_produk');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
