<div class="card mb-4">
    <div class="card-header bg-primary text-white">Form Tambah Checklist</div>
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
                <select name="year" id="year" class="form-control" required>
                    <option value="" disabled selected>-- Pilih Tahun --</option>
                    @foreach ($years as $year)
                        <option value="{{ $year->year }}">{{ $year->year }}</option>
                    @endforeach
                    <option value="new">Tambah Tahun Baru</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="item" class="form-label">Item:</label>
                <input type="text" class="form-control" id="item" name="item" required>
            </div>
            <div class="form-group">
                <label for="pic">Pilih PIC:</label>
                <div class="d-flex align-items-center">
                    <select name="pic" id="pic" class="form-control mb-3" required>
                        {{-- <option value="" disabled selected>-- Pilih PIC --</option> --}}
                        @forelse ($pics as $pic)
                            <option value="{{ $pic->name }}">{{ $pic->name }}</option>
                        @empty
                            <option value=""> </option>
                        @endforelse
                        <option value="new">Tambah PIC Baru</option> <!-- Opsi Tambah PIC -->
                    </select>
                    @foreach ($pics as $pic)
                        <span class="delete-icon" data-id="{{ $pic->id }}">
                            <i class="fa-solid fa-trash"></i>
                        </span>
                    @endforeach
                </div>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <input type="text" class="form-control" id="status" name="status">
            </div>
            <div class="mb-3">
                <label for="note" class="form-label">Note:</label>
                <textarea class="form-control" id="note" name="note" rows="2"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
