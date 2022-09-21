@extends('layouts.v_template')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex  justify-content-between">
                    <h4>Print list </h4>
                    <div class="table-tools d-flex justify-content-around ">
                        <input type="text" class="form-control card-form-header mr-3" placeholder="Cari Data Pengguna ..." id="cari-data-pengguna">
                        {{-- <select class="custom-select form-control mr-3" id="filter-data-pengguna">
                            <option value="" selected>Filter</option>
                            <option value=""></option>
                        </select> --}}
                        <button type="button" class="btn bg-main text-white float-right" data-toggle="modal" data-target="#produckModal"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-hover table-user table-action-hover table-produk" id="table-data">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Nama costumer</th>
                            <th>File</th>
                            <th>Status print</th>
                        </tr>
                        </thead>
                        @if ($print)

                        @if ($print->cart != null)
                        <tbody>
                            <tr>
                                <td>
                                    <img class="mr-4" src="{{ asset('data/gambar_produk/' . $print->cart->produk->gambar_produk) }}" width="100">
                                    {{ $print->cart->produk->nama_produk }}
                                </td>
                                <td>{{ $print->user->name }}</td>
                                <td class="align-middle">
                                    <a data-path="{{ asset('data/file_print/' . $print->cart->file)}}"class="btn bg-main btn-preview text-white" data-toggle="modal" data-target="#previewFile">lihat</a>
                                </td>
                                <td class="align-middle">
                                    @if ($print->cart->status_print == 'ready')
                                        <span class="badge badge-warning">ready</span>
                                        @elseif ($print->cart->status_print == 'antri')
                                        <span class="badge badge-primary">antri</span>
                                        @elseif ($print->cart->status_print == 'proses')
                                        <span class="badge badge-secondary">antri</span>
                                        @elseif ($print->cart->status_print == 'selesai')
                                        <span class="badge badge-success">selesai</span>
                                        @else
                                        <span class="badge badge-success">none</span>
                                    @endif
                                </td>
                            </tr>
                    </tbody>
                        @endif
                        @endif
                    </table>
                    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
                </div>
            </div>
        </div>
    </div>
</section>
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

    printPdf = function(url) {
        var iframe = this._printIframe;
        if (!this._printIframe) {
            iframe = this._printIframe = document.createElement('iframe');
            document.body.appendChild(iframe);

            iframe.style.display = 'none';
            iframe.onload = function() {
                setTimeout(function() {
                    iframe.focus();
                    iframe.contentWindow.print();
                }, 1);
            };
        }

        iframe.src = url;
    }


    let realTimePrint = setInterval(function(){
        let print = "{{ $print }}";
        if(print == ""){
            console.log('tidak ada');
            window.location.reload(1);
        } else {
            console.log('ada');
            @if ($print->cart != null)

            let pathPrint = "{{ asset('data/file_print/' . $print->cart->file) }}";
            printPdf(pathPrint);
            clearInterval(realTimePrint);
            window.location.href = '/admin/update_print_status/' + '{{ $print->cart->id_cart }}';
            @else
            console.log('tidak ada');
            window.location.reload(1);
            @endif
        }
    }, 3000);

    $('.btn-preview').on('click', function() {
        let path = $(this).data('path');
        $('#iframe-preview').attr('src',path);
    })


    $('#liPrintList').addClass('active');
    $('#liPrint').addClass('active');

</script>
@endsection
