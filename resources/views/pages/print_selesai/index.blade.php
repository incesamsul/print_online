@extends('layouts.v_template')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex  justify-content-between">
                    <h4>Print Selesai </h4>
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
                            <th>Status print</th>
                        </tr>
                        </thead>
                        <tbody id="tbody-antrian">
                            @foreach ($print as $row)
                                <tr>
                                    <td>{{ $row->produk->nama_produk }}</td>
                                    <td>{{ $row->user->name }}</td>
                                    <td>
                                        @if ($row->status_print == 'ready')
                                        <span class="badge badge-warning">ready</span>
                                        @elseif ($row->status_print == 'antri')
                                        <span class="badge badge-primary">antri</span>
                                        @elseif ($row->status_print == 'proses')
                                        <span class="badge badge-secondary">proses</span>
                                        @elseif ($row->status_print == 'selesai')
                                        <span class="badge badge-success">selesai</span>
                                        @else
                                        <span class="badge badge-success">none</span>
                                    @endif
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


@endsection
@section('script')
<script>




    $('#liPrintSelesai').addClass('active');
    $('#liPrint').addClass('active');

</script>
@endsection
