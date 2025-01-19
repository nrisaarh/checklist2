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