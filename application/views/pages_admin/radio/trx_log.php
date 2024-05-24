<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <a href="<?= base_url('export/toexcelradio') ?>" class="btn btn-sm btn-secondary">Export Excel</a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="d-flex justify-content-center">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Show Deleted Master Data</label>
                    </div>
                </div>
                <div class="table-responsive p-2">
                    <table class="table table-striped" id="table-data">
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
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Last User</th>
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
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('radio/save_log') ?>" method="post" id="form-add" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Form Edit Use Komputer/Laptop</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <h5 class="card-title p-2">Detail Asset</h5>
                        <div class="card-body">
                            <input type="hidden" name="id_radio" value="">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">Kode ID</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="kode_id" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">Registrasi Perangkat</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="reg_perangkat" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">Brand Name</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="brand_name" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">Lokasi</label>
                                </div>
                                <div class="col-sm-9">
                                    <select class="form-select" aria-label="Default select example" name="lokasi" disabled>
                                        <option selected>Pilih Lokasi</option>
                                        <?php foreach ($lokasi as $list) : ?>
                                            <option value="<?= $list->id ?>"><?= $list->lokasi ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <h5 class="card-title p-2">Detail User</h5>
                        <div class="card-body">
                            <input type="hidden" name="karyawan_id" value="">

                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">NIK</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="number" maxlength="18" class="form-control" name="nik" readonly id="nik">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">Nama</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nama" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">Jabatan</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="jabatan" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">Departement</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="departement" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <h5 class="card-title p-2">Detail Status Pemakaian</h5>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">Upload File BA</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="file_ba" accept="application/pdf">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">Tanggal Mulai Pakai</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control waktu-pakai" name="waktu_pemakaian">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <label for="">Status Asset Sebelumnya</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="status">
                                </div>
                            </div>
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

<div class="modal fade" id="data-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table" id="table-user" style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NIK/Name</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Departement</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>
                                <button class="btn btn-sm btn-secondary"></i>Pilih</button>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">2</td>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        var showedFilter = false
        $(".waktu-pakai").flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });
        var table = $('#table-data').DataTable({
            ajax: {
                "url": "<?php echo base_url('radio/show_log'); ?>",
                "type": "GET",
                data: function(data) {
                    data.selected = showedFilter
                },
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
                    data: 'last_user'
                },
                {
                    data: 'id',
                    render: function(data) {
                        return `<div class="btn-group btn-group-xs" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-info show-log">Lihat Log</button>
                                    <button type="button" class="btn btn-warning add-use">Edit User Use</button>
                                </div>`
                    }
                }
            ],
            columnDefs: [{
                orderable: false,
                targets: [1, 2]
            }],

        });
        $("#flexSwitchCheckDefault").change(function() {
            // Dapatkan nilai checkbox saat ini
            var nilaiCheckbox = $(this).prop("checked");
            showedFilter = nilaiCheckbox
            // Cetak nilai checkbox
            table.ajax.reload()
        });
        tableUser()
        var table_user;

        function tableUser() {
            table_user = $('#table-user').DataTable({
                paging: false,
                scrollCollapse: true,
                scrollY: '50vh',
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
                        data: {
                            nik: 'nik',
                            nama: 'nama'
                        },
                        render: function(data) {
                            return `${data.nik}<br>${data.nama}`
                        }
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
                            return `<button class="btn btn-sm btn-secondary pilih"></i>Pilih</button>`
                        }
                    }
                ]
            });
        }

        function format(d) {
            let tr = ''
            d.log_user.forEach((item, index) => {
                tr += `<tr>
                            <td>${index + 1}</td>
                            <td>${item.last_use}</td>
                            <td>${item.karyawan.nama}</td>
                            <td>${item.karyawan.jabatan}</td>
                            <td>${item.karyawan.departement}</td>
                            <td>${item.status}</td>
                            <td><a href="<?= base_url('file_ba/radio/') ?>${item.file_ba}" target="_new"><i class="fa-solid fa-file"></i></a></td>
                        </tr>`;
            });
            let table = `<div class="table-responsive" style="overflow-y:scroll;height:190px;background:#C6D7E7">
                            <table class="table" id="log-table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Last Use</th>
                                        <th scope="col">Nama User</th>
                                        <th scope="col">Jabatan</th>
                                        <th scope="col">Departemen</th>
                                        <th scope="col">Last Status</th>
                                        <th scope="col">BA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${tr}
                                </tbody>
                            </table>
                        </div>`
            return table;
        }


        $('#data-user').on('shown.bs.modal', function() {
            let dd = $('div.dataTables_scrollHeadInner').children('table')
            dd.css({
                'width': '750px',
            })

        })
        const detailRows = [];

        table.on('click', 'tbody .show-log', function() {
            let tr = event.target.closest('tr');
            let row = table.row(tr);
            let idx = detailRows.indexOf(tr.id);

            if (row.child.isShown()) {
                tr.classList.remove('details');
                row.child.hide();

                // Remove from the 'open' array
                detailRows.splice(idx, 1);
            } else {
                tr.classList.add('details');
                row.child(format(row.data())).show();

                // Add to the 'open' array
                if (idx === -1) {
                    detailRows.push(tr.id);
                }
            }
        });
        $('#nik').on('click', function() {
            $('#data-user').modal('show')
        });

        $('#table-user').on('click', '.pilih', function() {
            var data = table_user.row($(this).parents('tr')).data()
            $('[name="karyawan_id"]').val(data.id)
            $('[name="nik"]').val(data.nik)
            $('[name="nama"]').val(data.nama)
            $('[name="jabatan"]').val(data.jabatan)
            $('[name="departement"]').val(data.departement)
            $('#data-user').modal('hide')
        });

        $('.table').on('click', '.add-use', function(e) {
            e.preventDefault();
            var data = table.row($(this).parents('tr')).data()
            $('[name="id_radio"]').val(data.id)
            $('[name="kode_id"]').val(data.kode_id)
            $('[name="reg_perangkat"]').val(data.reg_perangkat)
            $('[name="brand_name"]').val(data.brand_name)
            $('[name="lokasi"]').val(data.lokasi).trigger('change')
            $('#add').modal('show')
        });

        $('form#form-add').submit(function(e) {
            e.preventDefault();
            e.stopPropagation();
            let formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: formData,
                dataType: "JSON",
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.code == 200) {
                        successAlert('Data Berhasil Di Simpan')
                        table.ajax.reload()
                        $('#add').modal('hide')
                    } else {
                        errorAlert(response.message)
                    }


                },
                error(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText)
                }
            });
        });
    });
</script>