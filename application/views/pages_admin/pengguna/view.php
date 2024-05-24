<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <button class="btn btn-sm btn-primary add">Tambah Pengguna</button>
                <!-- <button class="btn btn-sm btn-secondary">Refreh Data</button> -->
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-2">
                    <table class="table table-striped" id="table-data">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">No</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Nama Pengguna</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Email</th>
                                <th class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ps-2">Role</th>
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
            <form action="<?= base_url('pengguna/save') ?>" method="post" id="form-add">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Form Penggunan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Username</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="username" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Email</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Level</label>
                        </div>
                        <div class="col-sm-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="level" id="laki_radio" value="1" required>
                                <label class="form-check-label" for="laki_radio">Administrator</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="level" id="perempuan_radio" value="2" required>
                                <label class="form-check-label" for="perempuan_radio">Petugas</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Password</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="password" >
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
                "url": "<?php echo base_url('pengguna/show'); ?>",
                "type": "GET",
                dataSrc: "",
            },
            columns: [{
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'username'
                },
                {
                    data: 'email'
                },
                {
                    data: 'level',
                    render: function(data) {
                        if (data == 1) {
                            return `<span class="badge bg-primary">Administrator</span>`
                        } else {
                            return `<span class="badge bg-info">Petugas</span>`
                        }
                    }
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
                targets: [3]
            }],

        });

        $('.add').on('click', function() {
            $('form#form-add')[0].reset()
            $('#add').modal('show')
        });

        $('.table').on('click', '.edit', function(e) {
            e.preventDefault();
            var data = table.row($(this).parents('tr')).data()
            $('form#form-add').attr('action', `<?= base_url('pengguna/save/') ?>${data.id_admin}`)
            $('[name="username"]').val(data.username)
            $('[name="email"]').val(data.email)
            if (data.level == 1) {
                $('#laki_radio').attr('checked', true)
            } else {
                $('#perempuan_radio').attr('checked', true)

            }
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
                        url: "<?= base_url('pengguna/delete/') ?>" + data.id_admin,
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
                    console.log(response)
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