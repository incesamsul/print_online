<?php

use App\Models\FavoritModel;
use App\Models\KategoriModel;
use App\Models\Like;
use App\Models\LogAktivitasModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use phpDocumentor\Reflection\Types\Null_;
use PhpParser\Node\Expr\FuncCall;

use function PHPUnit\Framework\isNull;

function count_pdf_pages($fileName) {
    $path = public_path() . '/data/file_print/' . $fileName;
    $pdf = file_get_contents($path);
    $number = preg_match_all("/\/Page\W/", $pdf, $dummy);
    return $number;
}

function isLike($idUser, $idProduk){
    return Like::where('id_user', $idUser)->where('id_produk', $idProduk)->first();
}

function removeSpace($string)
{
    return str_replace(" ", "", $string);
}

function getUserRoleName($userRoleId)
{
    return DB::table('users')
        ->Join('role', 'role.id_role', '=', 'users.id_role')
        ->where('users.id_role', $userRoleId)
        ->select('nama_role')
        ->first()->nama_role;
}


function sweetAlert($pesan, $tipe)
{
    echo '<script>document.addEventListener("DOMContentLoaded", function() {
        Swal.fire(
            "' . $pesan . '",
            "proses berhasil di lakukan",
            "' . $tipe . '",
        );
    })</script>';
}
