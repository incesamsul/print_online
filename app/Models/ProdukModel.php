<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class ProdukModel extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $guarded = ['id_produk'];

    public function kategori()
    {
        return $this->hasOne(CategoryModel::class, 'id_category', 'id_category');
    }
}
