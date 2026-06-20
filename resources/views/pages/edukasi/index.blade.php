@extends('layouts.master')

@section('title', 'Edukasi Kesehatan')

@section('page-breadcrumb')
<li class="breadcrumb-item text-muted">Layanan</li>
<li class="breadcrumb-item fw-bold">Edukasi Kesehatan</li>
@endsection

@section('content')

<div class="d-flex justify-content-between align-items-center">
    <h2 class="fw-bold">Data Edukasi Kesehatan</h2>
    <div class="d-flex">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEdukasi" onclick="resetForm()"></i>+ Tambah</button>
    </div>
</div>

<div class="row my-4">
    <div class="col-12">
        <div class="card p-4">
            <div class="table-responsive">
                <table id="edukasiTable" class="table table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center" style="width: 5%;">NO</th>
                            <th style="width: 20%;">GAMBAR</th>
                            <th style="width: 60%;">JUDUL & ISI</th>
                            <th class="text-center" style="width: 15%;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($edukasi as $data)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td><img src="{{ asset('storage/' . $data->gambar) }}" style="height: 50px; width: 50px; object-fit: cover;"></td>
                            <td>
                                <h6 class="fw-bold">{{ $data->judul }}</h6>
                                <small class="text-muted">{{ Str::limit($data->isi, 50) }}</small>
                            </td>
                            <td class="text-center">
                                <a href="#"
                                    class="editEdukasi text-decoration-none"
                                    data-id="{{ $data->id }}"
                                    data-judul="{{ $data->judul }}"
                                    data-gambar="{{ $data->gambar }}"
                                    data-isi="{{ $data->isi }}">
                                    <i class="bi bi-pencil me-2"></i>
                                </a>
                                <form action="{{ route('admin.edukasi.destroy', $data->id) }}"
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
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Data tidak ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- tambah -->
<div class="modal fade" id="modalEdukasi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalTitle">Tambah Artikel</h5>
            </div>
            <form id="formEdukasi" action="{{ route('admin.edukasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div id="methodField"></div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Judul Artikel</label>
                        <input type="text" class="form-control" name="judul" id="judul" required>
                    </div>
                    <div class="mb-3">
                        <label>Gambar</label>
                        <input type="file" class="form-control" name="gambar" id="gambar">
                    </div>
                    <div class="mb-3">
                        <label>Isi Artikel</label>
                        <textarea class="form-control" name="isi" id="isi" rows="6" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- edit -->
<div class="modal fade" id="editEdukasiModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="editEdukasiForm" method="POST">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalTitle">Edit Edukasi</h5>
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
                        <label>Gambar</label>
                        <input type="file"
                            name="gambar"
                            class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Isi <span class="text-danger">*</span></label>
                        <textarea id="editIsi"
                            name="isi"
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
        let table = $('#edukasiTable').DataTable({
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
        const editButtons = document.querySelectorAll('.editEdukasi');
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.dataset.id;
                const judul = this.dataset.judul;
                const isi = this.dataset.isi;
                document.getElementById('editJudul').value = judul;
                document.getElementById('editIsi').value = isi;
                document.getElementById('editEdukasiForm').action =
                    `/admin/edukasi/${id}`;
                new bootstrap.Modal(
                    document.getElementById('editEdukasiModal')
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
@endpush