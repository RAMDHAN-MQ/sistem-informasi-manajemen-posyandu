@extends('layouts.master')

@section('title', 'Pengumuman')

@section('page-breadcrumb')
<li class="breadcrumb-item text-muted">Layanan</li>
<li class="breadcrumb-item fw-bold">Pengumuman</li>
@endsection

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h2 class="fw-bold">Pengumuman</h2>
    <button class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#createPengumumanModal">
        + Tambah
    </button>
</div>

<div class="row my-4">
    <div class="col-12">
        <div class="card p-4">
            <div class="row">
                <table id="pengumumanTable" class="table table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>NO</th>
                            <th>JUDUL</th>
                            <th>KETERANGAN</th>
                            <th>STATUS</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengumuman as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->judul }}</td>
                            <td>{{ $data->keterangan }}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input
                                        class="form-check-input change-status"
                                        type="checkbox"
                                        data-id="{{ $data->id }}"
                                        {{ $data->status == 'active' ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="#"
                                    class="editPengumuman text-decoration-none"
                                    data-id="{{ $data->id }}"
                                    data-judul="{{ $data->judul }}"
                                    data-keterangan="{{ $data->keterangan }}">
                                    <i class="bi bi-pencil me-2"></i>
                                </a>
                                <form action="{{ route('admin.pengumuman.destroy', $data->id) }}"
                                    method="POST"
                                    class="d-inline formDelete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="border-0 bg-transparent text-primary p-0 m-0">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- tambah -->
<div class="modal fade" id="createPengumumanModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.pengumuman.store') }}" method="POST">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Pengumuman</h5>
                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text"
                            name="judul"
                            class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan <span class="text-danger">*</span></label>
                        <textarea name="keterangan"
                            rows="4"
                            class="form-control"
                            required></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit"
                        class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

<!-- edit -->
<div class="modal fade" id="editPengumumanModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="editPengumumanForm" method="POST">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Pengumuman</h5>
                    <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text"
                            id="editJudul"
                            name="judul"
                            class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan <span class="text-danger">*</span></label>
                        <textarea id="editKeterangan"
                            name="keterangan"
                            rows="4"
                            class="form-control"
                            required></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit"
                        class="btn btn-primary">
                        Update
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection

@push('scripts')
<!-- datatable -->
<script>
    $(document).ready(function() {
        let table = $('#pengumumanTable').DataTable({
            order: [],
            pagingType: "simple_numbers",
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Cari...",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                paginate: {
                    next: "›",
                    previous: "‹"
                },
                zeroRecords: "Data tidak ditemukan",
                emptyTable: "Belum ada data"
            }
        });
    });
</script>

<!-- konfirmasi hapus -->
<script>
    $('.formDelete').submit(function(e) {
        e.preventDefault();
        let form = this;
        Swal.fire({
            title: 'Hapus Data?',
            text: 'Data yang dihapus tidak bisa dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.editPengumuman');
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                const judul = this.dataset.judul;
                const keterangan = this.dataset.keterangan;
                document.getElementById('editJudul').value = judul;
                document.getElementById('editKeterangan').value = keterangan;
                document.getElementById('editPengumumanForm').action =
                    `/admin/pengumuman/${id}`;
                new bootstrap.Modal(
                    document.getElementById('editPengumumanModal')
                ).show();
            });
        });
    });
</script>

<!-- notifikasi ketika ada data yang disimpan -->
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: @json(session('success')),
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif

<!-- ganti status -->
<script>
    $('.change-status').change(function() {
        let id = $(this).data('id');
        let status = $(this).is(':checked') ? 'active' : 'inactive';
        $.ajax({
            url: `/admin/pengumuman/status/${id}`,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: response.message,
                    timer: 1500,
                    showConfirmButton: false
                });
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Status gagal diubah'
                });
            }
        });
    });
</script>

@endpush