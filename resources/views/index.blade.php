<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checklist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<body>
    <div class="container my-4">
        <h2 class="text-center">Checklist Management</h2>

        <!-- Form Tambah Checklist -->
        <div class="card mb-8">
            <div class="card-header">Tambah Checklist</div>
            <div class="card-body">
                <form action="{{ route('checklists.store') }}" method="POST">
                    @csrf
                    <label for="month">Pilih Bulan:</label>
                    <select name="month" id="month" required>
                        <option value="">-- Pilih Bulan --</option>
                        @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $key => $month)
                            <option value="{{ $key + 1 }}">{{ $month }}</option>
                        @endforeach
                    </select>
                    <div class="mb-3">
                        <label for="year" class="form-label">Tahun:</label>
                        <div class="d-flex align-items-center">
                            <select name="year" id="year" class="form-control" required>
                                <option value="" disabled selected>-- Pilih Tahun --</option>
                                @for ($y = 2025; $y <= date('Y'); $y++)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                                <option value="new">Tambah Tahun Baru</option>
                                <!-- Opsi untuk menambahkan tahun baru -->
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="item" class="form-label">Item:</label>
                        <input type="text" class="form-control" id="item" name="item" required>
                    </div>
                    <div class="form-group">
                        <label for="pic">Pilih PIC:</label>
                        <div class="d-flex align-items-center">
                            <select name="pic" id="pic" class="form-control mb-3" required>
                                <option value="" disabled selected>-- Pilih PIC --</option>
                                @foreach ($pics as $pic)
                                    <option value="{{ $pic->name }}">{{ $pic->name }}</option>
                                @endforeach
                                <option value="new">Tambah PIC Baru</option> <!-- Opsi Tambah PIC -->
                            </select>
                            <span class="delete-icon" data-id="{{ $pic->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </span>
                        </div>
                    </div>

                    {{-- Modal Tambah PIC baru --}}
                    <div class="modal fade" id="addPicModal" tabindex="-1" aria-labelledby="addPicModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addPicModalLabel">Tambah PIC Baru</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="addPicForm">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="newPicName" class="form-label">Nama PIC:</label>
                                            <input type="text" class="form-control" id="newPicName" name="new_pic"
                                                required>
                                        </div>
                                        <button type="button" id="saveNewPic" class="btn btn-primary">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status:</label>
                        <select class="form-control" id="status" name="status">
                            <option value="Completed">Completed</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Note:</label>
                        <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>

        <!-- Daftar Checklist -->
        <div class="card">
            <div class="card-header">Daftar Checklist</div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Item</th>
                            <th>PIC</th>
                            <th>Status</th>
                            <th>Note</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($checklists as $checklist)
                            <tr>
                                @php
                                    $months = [
                                        'Januari',
                                        'Februari',
                                        'Maret',
                                        'April',
                                        'Mei',
                                        'Juni',
                                        'Juli',
                                        'Agustus',
                                        'September',
                                        'Oktober',
                                        'November',
                                        'Desember',
                                    ];
                                @endphp
                                <td>{{ $months[$checklist->month - 1] }}</td>

                                <td>{{ $checklist->item }}</td>
                                <td>{{ $checklist->pic }}</td>
                                <td>{{ $checklist->status }}</td>
                                <td>{{ $checklist->note }}</td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('checklists.edit', $checklist->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('checklists.destroy', $checklist->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data checklist.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Add New PIC --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        document.getElementById('pic').addEventListener('change', function() {
            if (this.value === 'new') {
                // Buka modal
                new bootstrap.Modal(document.getElementById('addPicModal')).show();
                this.value = ''; // Reset pilihan dropdown
            }
        });

        document.getElementById('saveNewPic').addEventListener('click', function() {
            const newPicName = document.getElementById('newPicName').value;

            if (newPicName.trim() !== '') {
                // Kirim data ke server melalui AJAX
                fetch('{{ route('pics.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            name: newPicName
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Tambahkan PIC baru ke dropdown
                            const newOption = document.createElement('option');
                            newOption.value = newPicName;
                            newOption.textContent = newPicName;
                            document.getElementById('pic').appendChild(newOption);

                            // Pilih PIC baru di dropdown
                            document.getElementById('pic').value = newPicName;

                            // Tutup modal
                            bootstrap.Modal.getInstance(document.getElementById('addPicModal')).hide();
                            alert(data.message); // Menampilkan pesan sukses
                        } else {
                            alert('Gagal menambahkan PIC baru.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                alert('Nama PIC tidak boleh kosong.');
            }
        });
    </script>

    {{-- Destroy PIC --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteIcons = document.querySelectorAll('.delete-icon');

            deleteIcons.forEach(icon => {
                icon.addEventListener('click', function() {
                    const picId = this.getAttribute('data-id');
                    const confirmation = confirm('Apakah Anda yakin ingin menghapus PIC ini?');

                    if (confirmation) {
                        fetch(`/pics/${picId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json',
                                },
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert('PIC berhasil dihapus!');
                                    location
                                        .reload(); // Reload halaman untuk memperbarui dropdown
                                } else {
                                    alert('Gagal menghapus PIC!');
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    }
                });
            });
        });
    </script>

   <!-- Modal Tambah Tahun Baru -->
<div class="modal fade" id="addYearModal" tabindex="-1" aria-labelledby="addYearModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addYearModalLabel">Tambah Tahun Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addYearForm">
                    @csrf
                    <div class="mb-3">
                        <label for="newYear" class="form-label">Masukkan Tahun Baru:</label>
                        <input type="number" class="form-control" id="newYear" name="new_year" required>
                        <div id="yearError" class="text-danger mt-1" style="display: none;">Masukkan tahun yang valid (minimal tahun 2025).</div>
                    </div>
                    <button type="button" id="saveNewYear" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('year').addEventListener('change', function () {
        if (this.value === 'new') {
            // Buka modal untuk menambahkan tahun baru
            new bootstrap.Modal(document.getElementById('addYearModal')).show();
            this.value = ''; // Reset pilihan dropdown
        }
    });

    document.getElementById('saveNewYear').addEventListener('click', function () {
        const newYearInput = document.getElementById('newYear');
        const yearError = document.getElementById('yearError');
        const newYear = parseInt(newYearInput.value);

        if (!newYear || newYear < 2025) {
            // Tampilkan pesan error jika input tidak valid
            yearError.style.display = 'block';
        } else {
            // Sembunyikan pesan error
            yearError.style.display = 'none';

            // Kirim data ke server
            fetch('{{ route('addYear') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ new_year: newYear }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Tambahkan tahun baru ke dropdown
                        const yearDropdown = document.getElementById('year');
                        const newOption = document.createElement('option');
                        newOption.value = newYear;
                        newOption.textContent = newYear;
                        yearDropdown.appendChild(newOption);

                        // Pilih tahun baru di dropdown
                        yearDropdown.value = newYear;

                        // Tutup modal
                        bootstrap.Modal.getInstance(document.getElementById('addYearModal')).hide();
                    } else {
                        yearError.textContent = 'Gagal menambahkan tahun baru.';
                        yearError.style.display = 'block';
                    }
                })
                .catch(() => {
                    yearError.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
                    yearError.style.display = 'block';
                });
        }
    });
</script>

</body>

</html>
