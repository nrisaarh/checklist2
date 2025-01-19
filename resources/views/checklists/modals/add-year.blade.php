  <!-- Modal Tambah Tahun Baru -->
  <div class="modal fade" id="addYearModal" tabindex="-1" aria-labelledby="addYearModalLabel"
  aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="addYearModalLabel">Tambah Tahun Baru</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"
                  aria-label="Close"></button>
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
    document.getElementById('year').addEventListener('change', function() {
        if (this.value === 'new') {
            // Buka modal untuk menambahkan tahun baru
            new bootstrap.Modal(document.getElementById('addYearModal')).show();
            this.value = ''; // Reset pilihan dropdown
        }
    });

    document.getElementById('saveNewYear').addEventListener('click', function() {
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
                    body: JSON.stringify({
                        new_year: newYear
                    }),
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