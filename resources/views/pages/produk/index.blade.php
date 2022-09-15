@extends('layouts.v_template')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex  justify-content-between">
                    <h4>Produk</h4>
                    <div class="table-tools d-flex justify-content-around ">
                        <input type="text" class="form-control card-form-header mr-3" placeholder="Cari Data Pengguna ..." id="cari-data-pengguna">
                        {{-- <select class="custom-select form-control mr-3" id="filter-data-pengguna">
                            <option value="" selected>Filter</option>
                            <option value=""></option>
                        </select> --}}
                        <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#produckModal"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover table-user table-action-hover table-produk" id="table-data">
                        <thead>
                            <tr>
                                <th width="5%" class="sorting" data-sorting_type="asc" data-column_name="id" style="cursor: pointer">ID <span id="id_icon"></span></th>
                                <th>Nama kategori</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Kategori</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->nama_produk }}</td>
                                    <td>Rp. {{ number_format($row->harga_produk) }}</td>
                                    <td>{{ $row->deskripsi }}</td>
                                    <td>{{ $row->kategori->nama_category }}</td>
                                    <td>
                                        <button data-gambar_produk="{{ asset('/data/gambar_produk/'. $row->gambar_produk) }}" data-detail='@json($row)' class="btn btn-detail bg-main text-white" data-toggle="modal" data-target="#modalDetail">detail</button>
                                    </td>
                                    <td class="option">
                                        <div class="btn-group dropleft btn-option">
                                            <i type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </i>
                                            <div class="dropdown-menu">
                                                {{-- <a data-pengguna='@json($p)' data-toggle="modal" data-target="#modalPengguna" class="dropdown-item kaitkan" href="#"><i class="fas fa-link"> Kaitkan data</i></a> --}}
                                                <a data-pengguna='@json($row)' data-toggle="modal" data-target="#modalPengguna" class="dropdown-item edit" href="#"><i class="fas fa-pen"> Edit</i></a>
                                                <a data-id_produk="{{ $row->id_produk }}" class="dropdown-item hapus" href="#"><i class="fas fa-trash"> Hapus</i></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
                </div>
            </div>
        </div>
    </div>
</section>


  <!-- Modal -->
  <div class="modal fade" id="produckModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Product detail</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ URL::to('/admin/simpan_produk') }}" enctype="multipart/form-data">
                @csrf
          <div class="form-group">
              <label for="nama_produk">nama produk</label>
              <input type="text" class="form-control" name="nama_produk">
            </div>
            <div class="form-group">
              <label for="harga_produk">harga produk</label>
              <input type="text" class="form-control" name="harga_produk">
          </div>
            <div class="form-group">
              <label for="deskripsi">deskripsi produk</label>
              <textarea class="form-control" name="deskripsi"></textarea>
          </div>
            <div class="form-group">
              <label for="kategori">kategori produk</label>
              <select name="kategori" id="" class="form-control">
                  <option value="1">print</option>
              </select>
          </div>
            <div class="form-group">
              <label for="gambar">gambar produk</label>
              <input type="file" class="form-control" name="gambar">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-dark">Simpan</button>
        </form>
        </div>
      </div>
    </div>
  </div>



  <!-- Modal -->
  <div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDetailLabel">Detail produk</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <img src="{{ asset('img/jpg/slider/index.jpg') }}" class="img-thumbnail" id="gambar_produk">
            <table class="table">
                <tr>
                    <td>Nama produk</td>
                    <td>:</td>
                    <td id="nama_produk"></td>
                </tr>
                <tr>
                    <td>Kategori produk</td>
                    <td>:</td>
                    <td id="kategori_produk"></td>
                </tr>
                <tr>
                    <td>Harga produk</td>
                    <td>:</td>
                    <td id="harga_produk"></td>
                </tr>
                <tr>
                    <td>Deskripsi produk</td>
                    <td>:</td>
                    <td id="deskripsi"></td>
                </tr>
                {{-- <tr>
                    <td colspan="3" id="deskripsi"></td>
                </tr> --}}
            </table>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('script')
<script>
    $(document).ready(function() {

        $('.btn-detail').on('click',function(){
            let dataDetail = $(this).data('detail');
            let gambarProduk = $(this).data('gambar_produk');
            $('#modalDetail #nama_produk').html(dataDetail.nama_produk);
            $('#modalDetail #gambar_produk').attr('src',gambarProduk);
            $('#modalDetail #kategori_produk').html(dataDetail.kategori.nama_category);
            $('#modalDetail #harga_produk').html(dataDetail.harga_produk);
            $('#modalDetail #deskripsi').html(dataDetail.deskripsi);
        })


        // TOMBOL HAPUS USER
        $('.table-produk tbody').on('click', 'tr td a.hapus', function() {
            let idProduk = $(this).data('id_produk');
            Swal.fire({
                title: 'Apakah yakin?'
                , text: "Data tidak bisa kembali lagi!"
                , type: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Ya, Konfirmasi'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        , url: '/admin/delete_produk'
                        , method: 'post'
                        , dataType: 'json'
                        , data: {
                            id_produk: idProduk
                        }
                        , success: function(data) {
                            if (data == 1) {
                                Swal.fire('Berhasil', 'Data telah terhapus', 'success').then((result) => {
                                    location.reload();
                                });
                            }
                        }
                        , error: function(err){
                            console.log(err);
                        }
                    })
                }
            })
        });



    });

    $('#liProduk').addClass('active');

</script>
@endsection
