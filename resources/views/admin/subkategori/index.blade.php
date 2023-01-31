@extends('admin.layouts.app')
@section('title', 'Data SubKategori')

@section('content')
<div class="card shadow">
    <div class="card-header">
        <div class="card-title">
            <h4>Data SubKategori</h4>
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
                        <th>Nama Kategori</th>
                        <th>Nama SubKategori</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
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
                <h5 class="modal-title" id="exampleModalLabel">Form SubKategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-kategori">
                            <div class="mb-3 form-group">
                                <label for="" class="form-label">Nama SubKategori</label>
                                <input type="text" name="nama_subkategori" id="" class="form-control" placeholder="Nama SubKategori" required>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" placeholder="Deskripsi" id="" cols="30" rows="10" required></textarea>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="" class="form-label">Kategori</label>
                                <select name="kategori_id" id="" class="form-control">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategori as $item)
                                    <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="" class="form-label">Gambar</label>
                                <input type="file" name="image" id="" class="form-control" required>
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
                url : 'api/subkategori',
                success : function(data) {
                    let row;
                    data.map(function (val, index) {
                        row += `
                        <tr>
                            <td>${index+1}</td>
                            <td>${val.kategori.nama_kategori}</td>
                            <td>${val.nama_subkategori}</td>
                            <td>${val.deskripsi}</td>
                            <td><img src="/subkategori/${val.image}" width="150"></td>
                            <td>
                                <a data-toggle="modal" href="#modal-form" data-id="${val.id}" class="btn btn-warning modal-ubah">Edit</a>
                                <a href="#" data-id="${val.id}" class="btn btn-danger btn-hapus">Hapus</a>
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
                        url : 'api/subkategori/' + id,
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

            $('.modal-tambah').click(function() {
                $('#modal-form').modal('show');
                $('input[name="nama_kategori"]').val('');
                $('textarea[name="deskripsi"]').val('');
                $('select[name="kategori_id"]').val('Pilih Kategori');

                $('.form-kategori').submit(function(e) {
                    e.preventDefault();
                    const token = localStorage.getItem('token');
                    const formData = new FormData(this);

                    $.ajax({
                        url : 'api/subkategori',
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
                                alert('Data Berhasil Ditambah')
                                location.reload();
                            }
                        }
                    })
                });
            });

            $(document).on('click', '.modal-ubah', function() {
                $('#modal-form').modal('show');

                const id = $(this).data('id');
                $.get('/api/subkategori/' + id, function ({data}) {
                    $('input[name="nama_subkategori"]').val(data.nama_subkategori);
                    $('select[name="kategori_id"]').val(data.kategori_id);
                    $('textarea[name="deskripsi"]').val(data.deskripsi);

                    $('.form-kategori').submit(function(e) {
                        e.preventDefault();
                        const token = localStorage.getItem('token');
                        const formData = new FormData(this);

                        $.ajax({
                            url : `api/subkategori/${id}?_method=PUT`,
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
