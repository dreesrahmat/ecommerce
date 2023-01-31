@extends('admin.layouts.app')
@section('title', 'Laporan Penjualan')

@section('content')
<div class="card shadow">
    <div class="card-header">
        <div class="card-title">
            <h4>Data Penjualan</h4>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-2">
            <form action="">
                <div class="d-flex justify-content-between">
                    <div class="mb-3 mr-2 form-group">
                        <label for="dari" class="form-label">Dari</label>
                        <input type="date" name="dari" id="dari" class="form-control" placeholder="Dari" required>
                    </div>
                    <div class="mb-3 form-group">
                        <label for="dari" class="form-label">Sampai</label>
                        <input type="date" name="sampai" id="sampai" class="form-control" placeholder="Sampai" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>

        @if (request()->input('dari'))
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah Dibeli</th>
                        <th>Total</th>
                        <th>Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                    </tr>
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection

@push('js')
    <script>

        $(function() {

            const dari = '{{ request()->input('dari') }}'
            const sampai = '{{ request()->input('sampai') }}'

            function rupiah(angka) {
                const numb = 1000000;
                const format = angka.toString().split('').reverse().join('');
                const convert = format.match(/\d{1,3}/g);
                return 'Rp ' + convert.join('.').split('').reverse().join('')
            }

            const token = localStorage.getItem('token');
            $.ajax({
                url : `/api/report?dari=${dari}&sampai=${sampai}`,
                headers : {
                    "Authorization" : 'Bearer ' + token
                },
                success : function({data}) {
                    let row;
                    data.map(function (val, index) {
                        row += `
                        <tr>
                            <td>${index+1}</td>
                            <td>${val.nama_produk}</td>
                            <td>${rupiah(val.harga)}</td>
                            <td>${val.jumlah_dibeli}</td>
                            <td>${val.total_qty}</td>
                            <td>${rupiah(val.pendapatan)}</td>
                        </tr>
                        `;
                    });

                    $('tbody').append(row)
                }
            });

        });


    </script>
@endpush
