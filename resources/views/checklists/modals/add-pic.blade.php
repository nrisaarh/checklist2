{{-- Modal Tambah PIC baru --}}
<div class="modal fade" id="addPicModal" tabindex="-1" aria-labelledby="addPicModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addPicModalLabel" style="color: black">Tambah PIC Baru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="addPicForm">
                @csrf
                <div class="mb-3">
                    <label for="newPicName" class="form-label">Nama PIC:</label>
                    <input type="text" class="form-control" id="newPicName" name="new_pic"
                        required autofocus>
                </div>
                <button type="button" id="saveNewPic" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
</div>

{{-- Add New PIC --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<script>
    // Pastikan modal diatur dengan benar saat dibuka
document.getElementById('addPicModal').addEventListener('shown.bs.modal', function () {
    this.setAttribute('aria-hidden', 'false');
});

// Pastikan modal diatur kembali saat ditutup
document.getElementById('addPicModal').addEventListener('hidden.bs.modal', function () {
    this.setAttribute('aria-hidden', 'true');
});

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
