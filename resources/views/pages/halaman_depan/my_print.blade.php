@extends('layouts_halaman_depan.template')

@section('content')
<section class="breadcrumb-section pb-3 pt-3">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">My Print</a></li>
        </ol>
    </div>
</section>

<section class="other-products pb-4 pt-4">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="section-title table-responsive">
                    <h2>Print list</h2>
                    <table class="table table-striped">
                        <tr>
                            <th>Product</th>
                            {{-- <th>Harga</th> --}}
                            <th>File</th>
                            <th>Status print</th>
                            <th>Aksi</th>
                        </tr>
                        @foreach ($print as $id=>$row)
                            <tr>
                                <td>
                                    <img class="mr-4" src="{{ asset('data/gambar_produk/' . $row->print->produk->gambar_produk) }}" width="100">
                                    {{ $row->print->produk->nama_produk }}
                                </td>
                                <td class="align-middle">
                                    <a data-path="{{ asset('data/file_print/' . $row->print->file)}}"class="btn bg-main btn-preview text-white" data-toggle="modal" data-target="#previewFile">lihat</a>
                                </td>
                                <td class="align-middle">
                                    @if ($row->print->status_print == 'ready')
                                        <span class="badge badge-warning">ready</span>
                                        @elseif ($row->print->status_print == 'antri')
                                        <span class="badge badge-primary">antri</span>
                                        @elseif ($row->print->status_print == 'proses')
                                        <span class="badge badge-secondary">proses</span>
                                        @elseif ($row->print->status_print == 'selesai')
                                        <span class="badge badge-success">selesai</span>
                                        @else
                                        <span class="badge badge-success">none</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if ($row->print->status_print == 'ready')
                                    <a href="{{ URL::to('/print/' . $row->id_print_list) }}" class="btn bg-main text-white">Print</a>
                                    @else
                                    <a href="#" class="btn btn-secondary" >Print</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="col-sm-4">
              <div class="section-title">
                  <h2>User menu</h2>
                  @include('components.user_menu')
              </div>
          </div>
        </div>
        <div class="row mt-4">

        </div>
    </div>
</section>



  <!-- Modal -->
  <div class="modal fade" id="previewFile" tabindex="-1" aria-labelledby="previewFileLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="previewFileLabel">Preview file</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <iframe id="iframe-preview" style="width: 100%;height:100vh;" src="" frameborder="0"></iframe>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')
<script>

    var loadFile = function(event){
        var output = document.querySelector('#preview');
        output.src = URL.createObjectURL(event.target.files[0]);
    }
    $('.btn-preview').on('click', function() {
        let path = $(this).data('path');
        $('#iframe-preview').attr('src',path);
    })
    $('#liDashboard').addClass('active');

</script>
@endsection
