<?php

namespace App\Http\Controllers;

use App\Models\ProdukModel;
use Illuminate\Http\Request;

class Home extends Controller
{

    public function beranda()
    {
        $data['produk'] = ProdukModel::all();
        return view('pages.halaman_depan.beranda', $data);
    }

    public function cart()
    {
        return view('pages.halaman_depan.cart');
    }

    public function addToCart(Request $request, $idProduk)
    {
        $produk = ProdukModel::where('id_produk', $idProduk)->first();
        $cart = session()->get('cart');

        $cart[$idProduk] = [
            "nama_produk" => $produk->nama_produk,
            "qty" => $request->qty,
            "harga_produk" => $produk->harga_produk,
            "gambar_produk" => $produk->gambar_produk,
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('message', 'berhasil masuk ke keranjang');
    }

    // delete or remove product of choose in cart
    public function removeFromCart($idProduk)
    {
        if ($idProduk) {

            $cart = session()->get('cart');

            if (isset($cart[$idProduk])) {

                unset($cart[$idProduk]);

                session()->put('cart', $cart);
            }

            return redirect()->back()->with('message', 'berhasil mengeluarkan barang dari keranjang');
        }
    }

    // update product of choose in cart
    public function updateCart(Request $request)
    {
        if ($request->id and $request->quantity) {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);

            session()->flash('success', 'Cart updated successfully');
        }
    }
}