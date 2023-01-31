@extends('admin.layouts.app')
@section('title', 'Data Pembayaran')

@section('content')
<div class="card shadow">
    <div class="card-header">
        <div class="card-title">
            <h4>Data Pembayaran</h4>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-end mb-4">
            <a href="#modal-form" class="btn btn-primary modal-tambah">Tambah Data</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Order</th>
                        <th>Jumlah</th>
                        <th>Nomor Rekening</th>
                        <th>Atas Nama</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-kategori">
                            <div class="mb-3 form-group">
                                <label for="" class="form-label">Tanggal</label>
                                <input type="text" name="tanggal" id="" class="form-control" placeholder="Tanggal" readonly>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="" class="form-label">Jumlah</label>
                                <input name="jumlah" class="form-control" placeholder="Jumlah" id="" readonly>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="" class="form-label">Nomor Rekening</label>
                                <input name="nomor_rekening" class="form-control" placeholder="Nomor Rekening" id="" readonly>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="" class="form-label">Atas Nama</label>
                                <input name="atas_nama" class="form-control" placeholder="Atas Nama" id="" readonly>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="" class="form-label">Status</label>
                                <select name="status" id="" class="form-control">
                                    <option value="DITERIMA">DITERIMA</option>
                                    <option value="DITOLAK">DITOLAK</option>
                                    <option value="MENUNGGU">MENUNGGU</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script>

        $(function() {

            $.ajax({
                url : 'api/payment',
                success : function(data) {
                    let row;
                    data.map(function (val, index) {
                        tgl = new Date(val.created_at);
                        tgl_lengkap = `${tgl.getDate()}-${tgl.getMonth()}-${tgl.getFullYear()}`
                        row += `
                        <tr>
                            <td>${index+1}</td>
                            <td>${tgl_lengkap}</td>
                            <td>${val.order_id}</td>
                            <td>${val.jumlah}</td>
                            <td>${val.nomor_rekening}</td>
                            <td>${val.atas_nama}</td>
                            <td>${val.status}</td>
                            <td>
                                <a data-toggle="modal" href="#modal-form" data-id="${val.id}" class="btn btn-warning modal-ubah">Edit</a>
                            </td>
                        </tr>
                        `;
                    });

                    $('tbody').append(row)
                }
            });

            $(document).on('click', '.btn-hapus', function() {

                const id = $(this).data('id');
                const token = localStorage.getItem('token');

                confirm_dialogue = confirm('Apakah Anda Yakin ?');

                if (confirm_dialogue) {
                    $.ajax({
                        url : 'api/payment/' + id,
                        type : 'DELETE',
                        headers : {
                            "Authorization" : 'Bearer ' + token
                        },
                        success : function(data) {
                            if (data.message == 'Data Berhasil Dihapus') {
                                alert('Data Berhasil Dihapus')
                                location.reload();
                            }
                        }
                    })
                }

            });

            $(document).on('click', '.modal-ubah', function() {
                $('#modal-form').modal('show');

                const id = $(this).data('id');
                $.get('/api/payment/' + id, function ({data}) {
                    tgl = new Date(data.created_at);
                    tgl_lengkap = `${tgl.getDate()}-${tgl.getMonth()}-${tgl.getFullYear()}`

                    $('input[name="tanggal"]').val(tgl_lengkap);
                    $('input[name="order_id"]').val(data.order_id);
                    $('input[name="jumlah"]').val(data.jumlah);
                    $('input[name="nomor_rekening"]').val(data.nomor_rekening);
                    $('input[name="atas_nama"]').val(data.atas_nama);
                    $('select[name="status"]').val(data.status);

                    $('.form-kategori').submit(function(e) {
                        e.preventDefault();
                        const token = localStorage.getItem('token');
                        const formData = new FormData(this);

                        $.ajax({
                            url : `api/payment/${id}?_method=PUT`,
                            type : 'POST',
                            data : formData,
                            cache : false,
                            contentType : false,
                            processData : false,
                            headers : {
                                "Authorization" : 'Bearer ' + token
                            },
                            success : function(data) {
                                if (data.success) {
                                    alert('Data Berhasil Diubah')
                                    location.reload();
                                }
                            }
                        })
                    });
                });
            });

        });


    </script>
@endpush
