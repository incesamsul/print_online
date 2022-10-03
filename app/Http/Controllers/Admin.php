<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CategoryModel;
use App\Models\PrintList;
use App\Models\ProdukModel;
use App\Models\Transaksi;
use App\Models\User;
use CreateProdukTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Admin extends Controller
{

    protected $userModel;
    protected $profileUserModel;
    protected $kritikSaranModel;
    protected $kuisionerModel;
    protected $penilaianModel;


    public function __construct()
    {
        $this->userModel = new User();
    }

    public function pengguna()
    {
        $data['pengguna'] = $this->userModel->getAllUser();
        return view('pages.pengguna.index', $data);
    }

    public function kategori()
    {
        $data['category'] = CategoryModel::all();
        return view('pages.kategori.index', $data);
    }

    public function transaksi()
    {
        $data['transaksi'] = Transaksi::all();
        return view('pages.transaksi.index', $data);
    }

    public function produk()
    {
        $data['produk'] = ProdukModel::all();
        return view('pages.produk.index', $data);
    }

    public function listPrint($idProduk)
    {
        $data = [];
        $data['id_produk'] = $idProduk;
        return view('pages.list_print.index', $data);
    }

    public function printProses($idProduk)
    {
        $data['id_produk'] = $idProduk;
        $data['print'] = PrintList::where('status_print', 'proses')->where('id_produk', $idProduk)->first();
        return view('pages.print_proses.index', $data);
    }

    public function printSelesai($idProduk)
    {
        $data['id_produk'] = $idProduk;
        $data['print'] = PrintList::where('status_print', 'selesai')->where('id_produk', $idProduk)->get();
        return view('pages.print_selesai.index', $data);
    }

    public function getDataAntrian($id_produk)
    {
        return response([
            'response' => PrintList::where('status_print', 'antri')->where('id_produk', $id_produk)->with('produk')->with('user')->first()
        ], 200);
    }

    public function getDataProses($id_produk)
    {
        $print = PrintList::where('status_print', 'proses')->where('id_produk', $id_produk)->with('produk')->with('user')->first();
        $jmlHalaman = $print ? count_pdf_pages($print->file) : 0;
        return response([
            'halaman' => $jmlHalaman,
            'response' => $print
        ], 200);
    }

    public function getDataNotif()
    {
        $notif = PrintList::where('read', '0')->with('produk')->with('user')->get();
        return response([
            'notif' => $notif,
        ], 200);
    }

    public function tandaiSudahDibaca()
    {
        PrintList::query()->update(['read' => '1']);
        return redirect()->back();
    }

    public function updatePrintStatus($idPrintList)
    {
        PrintList::where('id_print_list', $idPrintList)->update([
            'status_print' => 'proses',
        ]);
        return redirect()->back();
    }


    public function updatePrintStatusSelesai($idPrintList)
    {
        PrintList::where('id_print_list', $idPrintList)->update([
            'status_print' => 'selesai',
            'read' => '0',
        ]);
        return redirect()->back();
    }

    public function detailProduk($id_produk = null)
    {
        if (!is_numeric($id_produk)) {
            return redirect()->back();
        }
        $data['produk'] = ProdukModel::all();
        $data['detail_produk'] = ProdukModel::where('id_produk', $id_produk)->first();
        return view('pages.halaman_depan.detail_produk', $data);
    }



    public function profileUser()
    {
        $data['user'] = User::all();
        $data['profile'] = $this->profileUserModel->getProfileUser();
        return view('pages.rekaptulasi_data.index', $data);
    }

    public function simpanProduk(Request $request)
    {
        $image = $request->file('gambar');
        $imageName = uniqid() . '.' . 'jpg';
        $image->move(public_path('data/gambar_produk/') . '/', $imageName);

        ProdukModel::create([
            'id_category' => $request->kategori,
            'gambar_produk' => $imageName,
            'nama_produk' => $request->nama_produk,
            'harga_warna' => $request->harga_warna,
            'harga_bw' => $request->harga_bw,
            'deskripsi' => $request->deskripsi,
        ]);
        return redirect()->back()->with('message', 'produk Berhasil di tambahkan');
    }

    public function ubahProduk(Request $request)
    {

        $image = $request->file('gambar');
        if ($image) {
            $imageName = uniqid() . '.' . 'jpg';
            $image->move(public_path('data/gambar_produk/') . '/', $imageName);
            ProdukModel::where('id_produk', $request->id)->update([
                'gambar_produk' => $imageName,
                'nama_produk' => $request->nama_produk,
                'harga_warna' => $request->harga_warna,
                'harga_bw' => $request->harga_bw,
                'deskripsi' => $request->deskripsi,
            ]);
        } else {
            ProdukModel::where('id_produk', $request->id)->update([
                'nama_produk' => $request->nama_produk,
                'harga_warna' => $request->harga_warna,
                'harga_bw' => $request->harga_bw,
                'deskripsi' => $request->deskripsi,
            ]);
        }


        return redirect()->back()->with('message', 'produk Berhasil di ubah');
    }

    public function deleteProduk(Request $request)
    {
        ProdukModel::where('id_produk', $request->id_produk)->delete();
        return 1;
    }




    // fetch data user by admin
    function fetchData(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            if ($request->filter == "") {
                $data['pengguna'] = DB::table('users')
                    ->where('role', '!=', 'Admin')
                    ->Where('name', 'like', '%' . $query . '%')
                    ->Where('email', 'like', '%' . $query . '%')
                    ->orderBy($sort_by, $sort_type)
                    ->paginate(5);
            } else {
                $data['pengguna'] = DB::table('users')
                    ->where('role', '!=', 'Admin')
                    ->Where('role', '=', $request->filter)
                    ->Where('name', 'like', '%' . $query . '%')
                    ->Where('email', 'like', '%' . $query . '%')
                    ->orderBy($sort_by, $sort_type)
                    ->paginate(5);
            }

            return view('pages.pengguna.users_data', $data)->render();
        }
    }

    public function createPengguna(Request $request)
    {
        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->email),
            'role' => $request->tipe_pengguna,
        ]);
        return redirect('/admin/pengguna')->with('message', 'Pengguna Berhasil di tambahkan');
    }

    public function updatePengguna(Request $request)
    {
        $user = User::where([
            ['id', '=', $request->id]
        ])->first();
        $user->update([
            'name' => $request->nama,
            'email' => $request->email,
            'role' => $request->tipe_pengguna,
        ]);
        return redirect('/admin/pengguna')->with('message', 'Pengguna Berhasil di update');
    }

    public function deletePengguna(Request $request)
    {
        User::destroy($request->post('user_id'));
        return 1;
    }
}
