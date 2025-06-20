<?php
// File: application/views/audiometri/footer.php
?>
    </div> <!-- End Content Wrapper -->

    <!-- Footer -->
    <div class="footer-custom">
        <p class="mb-0">
            Made with <i class="fas fa-heart text-danger"></i> by ArChiee | 
            Copyright &copy; <?= date('Y') ?> All Rights Reserved.
        </p>
    </div>

    <!-- Report Modal -->
    <div class="modal fade" id="reportModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Filter Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="reportForm" action="<?= base_url('audiometri/export_excel') ?>" method="get">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_dari" class="form-label">Tanggal Dari</label>
                                    <input type="date" class="form-control" id="tanggal_dari" name="tanggal_dari">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal_sampai" class="form-label">Tanggal Sampai</label>
                                    <input type="date" class="form-control" id="tanggal_sampai" name="tanggal_sampai">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="perusahaan_filter" class="form-label">Perusahaan (Opsional)</label>
                            <input type="text" class="form-control" id="perusahaan_filter" name="perusahaan" 
                                   placeholder="Masukkan nama perusahaan">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" form="reportForm" class="btn btn-success">
                        <i class="fas fa-download me-1"></i> Download Excel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        function showReportModal() {
            new bootstrap.Modal(document.getElementById('reportModal')).show();
        }
        
        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
        
        // Confirm delete actions
        function confirmDelete(url, message = 'Yakin ingin menghapus data ini?') {
            if (confirm(message)) {
                window.location.href = url;
            }
        }
        
        // AJAX delete function
        function deleteRecord(id, redirectUrl = null) {
            if (!confirm('Yakin ingin menghapus data ini?')) {
                return;
            }
            
            fetch('<?= base_url('audiometri/delete/') ?>' + id, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status) {
                    alert('Data berhasil dihapus');
                    if (redirectUrl) {
                        window.location.href = redirectUrl;
                    } else {
                        location.reload();
                    }
                } else {
                    alert('Gagal menghapus data: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus data');
            });
        }
    </script>
</body>
</html>
