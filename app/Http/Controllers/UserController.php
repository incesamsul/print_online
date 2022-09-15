<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ProdukModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{

    public function addToCart(Request $request, $idProduk)
    {
        $produk = ProdukModel::where('id_produk', $idProduk)->first();
        
        $file = $request->file('file');
        $fileName = uniqid() . '.' . 'pdf';
        $file->move(public_path('data/file_print/') . '/', $fileName);

        Cart::create([
            'id_user' => auth()->user()->id,
            'id_produk' => $idProduk,
            'file' => $fileName,
            'total' => 0
        ]);

        return redirect()->back()->with('message', 'berhasil masuk ke keranjang');
    }


    public function removeFromCart($idCart){
        $cart = Cart::where('id_cart', $idCart);
        File::delete(public_path("data/file_print") . '/' . $cart->first()->file);
        $cart->delete();
        return redirect()->back()->with('message','berhasil menghapus item');
    }

}



