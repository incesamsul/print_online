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
                        </tr>
                        </thead>
                        <tbody id="tbody-antrian">
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

    $.ajaxSetup({
        timeout: 3000,
        retryAfter:3000
    });

    function reqAntri(param){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            , url: '/admin/get_data_antrian'
            , dataType: 'json'
            , success: function(data) {
                console.log('u do it');
                console.log(data);
                if(data.response == null){
                    $('#tbody-antrian').html('<tr><td colspan="4" class="text-center">tdk ada antrian print</td></tr>');
                    setTimeout ( function(){ reqAntri( param ) }, $.ajaxSetup().retryAfter );
                } else {
                    console.log(data);
                    let basePath = "{{ asset('data/file_print/' )}}";
                    let pathPrint = basePath + '/' + data.response.file;

                    let tableHTML = '';
                        tableHTML += '<tr>';
                        tableHTML += '<td>' + data.response.produk.nama_produk + '</td>';
                        tableHTML += '<td>' + data.response.user.name + '</td>';
                        tableHTML += '<td class="align-middle"><a data-path="' + pathPrint + '"class="btn bg-main btn-preview text-white" data-toggle="modal" data-target="#previewFile">lihat</a></td>';
                        tableHTML += '</tr>';
                    $('#tbody-antrian').html(tableHTML);

                    printPdf(pathPrint);
                    setTimeout(() => {
                        window.location.href = '/admin/update_print_status/' + data.response.id_print_list;
                    }, 10000);

                    $('.btn-preview').on('click', function() {
                        let path = $(this).data('path');
                        console.log(path);
                        $('#iframe-preview').attr('src',path);
                    })

                }
            }
            , error: function(err){
                console.log(err);
            }
        })
    }
    reqAntri();


    $('#liPrintList').addClass('active');
    $('#liPrint').addClass('active');

</script>
@endsection
