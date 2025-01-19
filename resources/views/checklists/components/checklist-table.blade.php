<!-- Daftar Checklist -->
<div class="card mb-3 mt-5 shadow-lg">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Daftar Checklist</h5>
    </div>
    <div class="card-body">
        <!-- Informasi Tahun dan PIC -->
        <div class="mb-3">
            <p class="mb-1" style="color: black; font-weight: bold;">
                <i class="fas fa-calendar-alt"></i> Tahun:
                <span class="text-primary">{{ $selectedYear ?? 'Belum dipilih' }}</span>
            </p>
            <p class="mb-0" style="color: black; font-weight: bold;">
                <i class="fas fa-user"></i> PIC:
                <span class="text-primary">{{ $selectedPic ?? 'Belum dipilih' }}</span>
            </p>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="bg-light text-center">
                    <tr>
                        <th rowspan="2" class="align-middle">No</th>
                        <th rowspan="2" class="align-middle">Jenis Inspeksi</th>
                        <th colspan="12" class="align-middle">Bulan</th>
                        <th rowspan="2" class="align-middle">Status</th>
                        <th rowspan="2" class="align-middle">Note</th>
                        <th rowspan="2" class="align-middle">Aksi</th>
                    </tr>
                    <tr>
                        @foreach (['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'] as $month)
                            <th>{{ $month }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse ($checklists as $key => $checklist)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>{{ $checklist->item }}</td>
                            
                            @for ($i = 1; $i <= 12; $i++)
                                <td class="text-center">
                                    <input type="checkbox" class="form-check-input"
                                        name="month_check[{{ $checklist->id }}][{{ $i }}]"
                                        {{ in_array($i, $checklist->completed_months ?? []) ? 'checked' : '' }}>
                                </td>
                            @endfor
                            <td class="text-center">{{ $checklist->status }}</td>
                            <td>{{ $checklist->note }}</td>
                            <td class="text-center">
                                <!-- Tombol Edit -->
                                <a href="{{ route('checklists.edit', $checklist->id) }}"
                                    class="btn btn-sm btn-warning mx-1">
                                    <i class="fas fa-edit">Edit</i>
                                </a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('checklists.destroy', $checklist->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger mx-1"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="17" class="text-center">Belum ada data checklist.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>