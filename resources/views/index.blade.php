<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checklist</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container my-4">
        <h2 class="text-center">Checklist Management</h2>

        <!-- Form Tambah Checklist -->
        <div class="card mb-4">
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
                        <input type="number" class="form-control" id="year" name="year" required>
                    </div>
                    <div class="mb-3">
                        <label for="item" class="form-label">Item:</label>
                        <input type="text" class="form-control" id="item" name="item" required>
                    </div>
                    <div class="form-group">
                        <label for="pic">Pilih PIC:</label>
                        <select name="pic" id="pic" class="form-control" required>
                            <option value="">-- Pilih PIC --</option>
                            @foreach ($pics as $pic)
                                <option value="{{ $checklist->picRelation->name ?? '-' }}" {{ old('pic') == $pic->name ? 'selected' : '' }}>
                                    {{ $pic->name }}
                                </option>
                            @endforeach
                        </select>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>