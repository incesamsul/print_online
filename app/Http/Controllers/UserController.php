<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Like;
use App\Models\PrintList;
use App\Models\ProdukModel;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{

    public function myAccount()
    {
        return view('pages.halaman_depan.my_account');
    }

    public function myPrint()
    {
        $data['print'] = Transaksi::where('id_user', auth()->user()->id)->where('status', 'paid')->get();
        return view('pages.halaman_depan.my_print', $data);
    }

    public function print($idPrintList)
    {
        PrintList::where('id_print_list', $idPrintList)->update([
            'status_print' => 'antri',
        ]);
        return redirect()->back()->with('message', 'print masuk ke antrian');
    }

    public function myTransaksi()
    {
        $data['transaksi'] = Transaksi::where('id_user', auth()->user()->id)->get();
        return view('pages.halaman_depan.my_transaksi', $data);
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

    public function like($idProduk)
    {
        $like = Like::where('id_user', auth()->user()->id)->where('id_produk', $idProduk)->first();
        if (!$like) {
            Like::create([
                'id_user' => auth()->user()->id,
                'id_produk' => $idProduk,
            ]);
        }

        return redirect()->back();
    }

    public function unlike($idProduk)
    {
        $like = Like::where('id_user', auth()->user()->id)->where('id_produk', $idProduk)->delete();
        return redirect()->back();
    }



    public function removeFromCart($idCart)
    {
        $cart = Cart::where('id_cart', $idCart);
        File::delete(public_path("data/file_print") . '/' . $cart->first()->file);
        $cart->delete();
        return redirect()->back()->with('message', 'berhasil menghapus item');
    }


    public function hitungTotalPembayaran($file, $idCart)
    {

        $curl = curl_init();

        $data = [
            'file'         => public_path('data/file_print/' . $file),
            'folder'       => auth()->user()->id,
        ];

        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'http://localhost/test_something/pdf/converter.php',
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ));

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $response = json_decode($response);

        Cart::where('id_cart', $idCart)->update([
            'lbr_warna' => $response->warna,
            'lbr_bw' => $response->bw,
        ]);

        return redirect()->back()->with('message', 'berhasil di hitung');
    }
}
