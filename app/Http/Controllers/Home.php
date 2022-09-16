<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Payment\TripayController;
use App\Models\Cart;
use App\Models\CategoryModel;
use App\Models\Like;
use App\Models\ProdukModel;
use Illuminate\Http\Request;

class Home extends Controller
{

    public function beranda()
    {
        $data['produk'] = ProdukModel::all();
        $data['kategori'] = CategoryModel::all();
        return view('pages.halaman_depan.beranda', $data);
    }


    public function aboutUs()
    {
        return view('pages.halaman_depan.about_us');
    }

    public function cart()
    {
        if (auth()->user() == null) {
            return redirect()->back()->with('message', 'login terlebih dahulu');
        }
        $tripay = new TripayController();
        $data['channels'] = $tripay->getPaymentChannels();
        $data['cart'] = Cart::where('id_user', auth()->user()->id)->get();
        return view('pages.halaman_depan.cart', $data);
    }

    public function like()
    {
        if (auth()->user() == null) {
            return redirect()->back()->with('message', 'login terlebih dahulu');
        }

        $data['like'] = Like::where('id_user', auth()->user()->id)->get();
        return view('pages.halaman_depan.like', $data);
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
