<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <button class="btn btn-sm btn-primary add">Tambah Data Radio</button>
                <button class="btn btn-sm btn-warning add-excel">Import Excel Data Radio</button>

                <!-- <button class="btn btn-sm btn-secondary">Refreh Data</button> -->
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-2">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">No</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Kode</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Registrasi Prangkat</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Brand Name</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Model</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Type</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Lokasi</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Detail Lokasi</th>
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
            <form action="<?= base_url('radio/save') ?>" method="post" id="form-add">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Form Tambah Komputer/Laptop</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Kode ID</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="kode_id" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Registrasi Perangkat</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="reg_perangkat" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Brand Name</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="brand_name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Model</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="model_radio" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Type</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="type_radio" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Lokasi</label>
                        </div>
                        <div class="col-sm-9">
                            <select class="form-select" aria-label="Default select example" name="lokasi" required>
                                <option selected>Pilih Lokasi</option>
                                <?php foreach ($lokasi as $list) : ?>
                                    <option value="<?= $list->id ?>"><?= $list->lokasi ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Detail Lokasi</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="detail_lokasi" required>
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
            <form action="<?= base_url('radio/import') ?>" method="post" id="form-excel" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Form Import Data Radio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3 row">
                        <a href="<?= base_url('file/FORMAT DATA RADIO.xlsx') ?>">Download Format >>></a>
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
        var table = $('.table').DataTable({
            ajax: {
                "url": "<?php echo base_url('radio/show'); ?>",
                "type": "GET",
                dataSrc: "",
            },
            columns: [{
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'kode_id'
                },
                {
                    data: 'reg_perangkat'
                },
                {
                    data: 'brand_name'
                },
                {
                    data: 'model_radio'
                },
                {
                    data: 'type_radio'
                },
                {
                    data: 'lokasi_name'
                },
                {
                    data: 'detail_lokasi'
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
                targets: [1, 2]
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
            console.log(data)
            $('form#form-add').attr('action', `<?= base_url('radio/save/') ?>${data.id}`)
            $('[name="kode_id"]').val(data.kode_id)
            $('[name="reg_perangkat"]').val(data.reg_perangkat)
            $('[name="brand_name"]').val(data.brand_name)
            $('[name="model_radio"]').val(data.model_radio)
            $('[name="type_radio"]').val(data.type_radio)
            $('[name="detail_lokasi"]').val(data.detail_lokasi)
            $('[name="lokasi"]').val(data.lokasi).trigger('change')
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
                        url: "<?= base_url('radio/delete/') ?>" + data.id,
                        dataType: "JSON",
                        success: function(response) {
                            successAlert('Data Berhasil Di Hapus')
                            table.ajax.reload()
                        },
                        error(jqXHR, textStatus, errorThrown) {
                            console.log(jqXHR.responseText)
                        }
                    });
                    successAlert('Data Berhasil Di Hapus')
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