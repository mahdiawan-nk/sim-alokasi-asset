<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <button class="btn btn-sm btn-primary add">Tambah Data Karyawan</button>
                <button class="btn btn-sm btn-warning add-excel">Import Excel Data Karyawan</button>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Export Data
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <li><a class="dropdown-item" href="<?=base_url('export/karyawanpdf')?>">PDF</a></li>
                        <li><a class="dropdown-item" href="<?=base_url('export/karywanexcel')?>">Excel</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-2">
                    <table class="table table-striped table-data">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">No</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">NIK/No.Bet</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Nama Karyawan</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Jenis Kelamin</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Lokasi Kerja</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Jabatan</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Departement</th>
                                <th class="text-secondary opacity-7 ps-2"></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('karyawan/save') ?>" method="post" id="form-add">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Form Tambah Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">NIK/No.BET</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="number" maxlength="18" class="form-control" name="nik" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Nama</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Jenis Kelamin</label>
                        </div>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki_radio" value="Laki-laki" required>
                                <label class="form-check-label" for="laki_radio">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan_radio" value="Perempuan" required>
                                <label class="form-check-label" for="perempuan_radio">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Lokasi Kerja</label>
                        </div>
                        <div class="col-sm-9">
                            <select class="form-select" aria-label="Default select example" name="lokasi_kerja" required>
                                <option value="">Pilih Lokasi</option>
                                <?php foreach ($lokasi as $list) : ?>
                                    <option value="<?= $list->id ?>"><?= $list->lokasi ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Jabatan</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="jabatan" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Departement</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="departement" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="add-excel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= base_url('karyawan/import') ?>" method="post" id="form-excel" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Form Import Data Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3 row">
                        <a href="<?= base_url('file/FORMAT IMPORT DATA KARYAWAN.xlsx') ?>">Download Format >>></a>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" name="file" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(function() {
        var table = $('.table-data').DataTable({
            ajax: {
                "url": "<?php echo base_url('karyawan/show'); ?>",
                "type": "GET",
                dataSrc: "",
            },
            columns: [{
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'nik'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'jenis_kelamin'
                },
                {
                    data: 'lokasi'
                },
                {
                    data: 'jabatan'
                },
                {
                    data: 'departement'
                },
                {
                    data: 'id',
                    render: function(data) {
                        return `<div class="btn-group btn-group-xs" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-warning edit">Edit</button>
                                    <button type="button" class="btn btn-danger hapus">Hapus</button>
                                </div>`
                    }
                }
            ],
            columnDefs: [{
                orderable: false,
                targets: [3, 4, 7]
            }],

        });

        $('.add').on('click', function() {
            $('form#form-add')[0].reset()
            $('#add').modal('show')
        });

        $('.add-excel').on('click', function() {
            $('#add-excel').modal('show')
        })

        $('.table').on('click', '.edit', function(e) {
            e.preventDefault();
            var data = table.row($(this).parents('tr')).data()
            $('form#form-add').attr('action', `<?= base_url('karyawan/save/') ?>${data.id}`)
            $('[name="nik"]').val(data.nik)
            $('[name="nama"]').val(data.nama)
            if (data.jenis_kelamain == 'Laki-laki') {
                $('#laki_radio').attr('checked', true)
            } else {
                $('#perempuan_radio').attr('checked', true)

            }
            $('[name="lokasi_kerja"]').val(data.lokasi_kerja).trigger('change')
            $('[name="jabatan"]').val(data.jabatan)
            $('[name="departement"]').val(data.departement)
            $('#add').modal('show')
        });

        $('.table').on('click', '.hapus', function(e) {
            e.preventDefault();
            var data = table.row($(this).parents('tr')).data()
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "GET",
                        url: "<?= base_url('karyawan/delete/') ?>" + data.id,
                        dataType: "JSON",
                        success: function(response) {
                            console.log(response)
                            successAlert('Data Berhasil Di Hapus')
                            table.ajax.reload()
                        },
                        error(jqXHR, textStatus, errorThrown) {
                            console.log(jqXHR.responseText)
                        }
                    });
                }
            });
        });
        $('form#form-add').submit(function(e) {
            e.preventDefault();
            e.stopPropagation();

            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(response) {
                    successAlert('Data Berhasil Di Simpan')
                    table.ajax.reload()
                    $('#add').modal('hide')
                },
                error(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText)
                }
            });
        });
    });
</script>