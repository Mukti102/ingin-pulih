
<div id="loading-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.8); z-index: 9999; flex-direction: column; align-items: center; justify-content: center;">
    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
        <span class="visually-hidden">Loading...</span>
    </div>
    <h5 class="mt-3 fw-bold">Mohon Tunggu...</h5>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const overlay = document.getElementById('loading-overlay');
        
        // 1. Trigger saat Form Filter dikirim
        const filterForm = document.getElementById('filter-form');
        if(filterForm) {
            filterForm.addEventListener('submit', function() {
                overlay.style.display = 'flex';
            });
        }

        // 2. Trigger saat tombol Reset (tautan) diklik
        const resetBtn = document.querySelector('a[href*="psychologs"]');
        if(resetBtn) {
            resetBtn.addEventListener('click', function() {
                overlay.style.display = 'flex';
            });
        }

        // 3. Trigger saat Form Hapus dikirim
        const deleteForms = document.querySelectorAll('.form-delete');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                // Hanya tampilkan loading jika user mengklik "OK" pada konfirmasi browser
                // Catatan: Jika Anda pakai SweetAlert, logic ini sedikit berbeda
                overlay.style.display = 'flex';
            });
        });
    });
</script>

<style>
    #loading-overlay {
        transition: all 0.3s ease-in-out;
    }
    /* Mencegah scroll saat loading muncul */
    .loading-active {
        overflow: hidden;
    }   
</style>