<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Like;
use App\Models\ProdukModel;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{

    public function myAccount(){
        return view('pages.halaman_depan.my_account');
    }

    public function myTransaksi(){
        $data['transaksi'] = Transaksi::where('id_user', auth()->user()->id)->get();
        return view('pages.halaman_depan.my_transaksi',$data);
    }   

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

    public function like($idProduk){
        $like = Like::where('id_user',auth()->user()->id)->where('id_produk', $idProduk)->first();
        if(!$like){
            Like::create([
                'id_user' => auth()->user()->id,
                'id_produk' => $idProduk,
            ]);
        }

        return redirect()->back();
    }

    public function unlike($idProduk){
        $like = Like::where('id_user',auth()->user()->id)->where('id_produk', $idProduk)->delete();
        return redirect()->back();
    }



    public function removeFromCart($idCart){
        $cart = Cart::where('id_cart', $idCart);
        File::delete(public_path("data/file_print") . '/' . $cart->first()->file);
        $cart->delete();
        return redirect()->back()->with('message','berhasil menghapus item');
    }

}



