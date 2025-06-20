<?php
// File: application/views/audiometri/list.php
?>
<div class="container-fluid p-4">
	<div class="row mb-4">
		<div class="col-12">
			<h1 class="h2 mb-4">
				<i class="fas fa-list text-primary me-3"></i>
				Daftar Tes Audiometri
			</h1>
		</div>
	</div>

	<!-- Filter Section -->
	<div class="card mb-4">
		<div class="card-header bg-light">
			<h5 class="card-title mb-0">
				<i class="fas fa-filter me-2"></i>
				Filter Pencarian
			</h5>
		</div>
		<div class="card-body">
			<form method="get" action="<?= base_url('audiometri/list_tests') ?>">
				<div class="row">
					<div class="col-md-3 mb-3">
						<label for="nama" class="form-label">Nama</label>
						<input type="text" class="form-control" id="nama" name="nama"
							value="<?= $filters['nama'] ?? '' ?>" placeholder="Nama pasien">
					</div>
					<div class="col-md-3 mb-3">
						<label for="perusahaan" class="form-label">Perusahaan</label>
						<input type="text" class="form-control" id="perusahaan" name="perusahaan"
							value="<?= $filters['perusahaan'] ?? '' ?>" placeholder="Nama perusahaan">
					</div>
					<div class="col-md-2 mb-3">
						<label for="tanggal_dari" class="form-label">Tanggal Dari</label>
						<input type="date" class="form-control" id="tanggal_dari" name="tanggal_dari"
							value="<?= $filters['tanggal_dari'] ?? '' ?>">
					</div>
					<div class="col-md-2 mb-3">
						<label for="tanggal_sampai" class="form-label">Tanggal Sampai</label>
						<input type="date" class="form-control" id="tanggal_sampai" name="tanggal_sampai"
							value="<?= $filters['tanggal_sampai'] ?? '' ?>">
					</div>
					<div class="col-md-2 mb-3">
						<label class="form-label">&nbsp;</label>
						<div class="d-grid gap-2">
							<button type="submit" class="btn btn-primary">
								<i class="fas fa-search me-1"></i> Cari
							</button>
						</div>
					</div>
				</div>
				<?php if (!empty($filters)): ?>
					<div class="row">
						<div class="col-12">
							<a href="<?= base_url('audiometri/list_tests') ?>" class="btn btn-outline-secondary btn-sm">
								<i class="fas fa-times me-1"></i> Reset Filter
							</a>
						</div>
					</div>
				<?php endif; ?>
			</form>
		</div>
	</div>

	<!-- Results Section -->
	<div class="card">
		<div class="card-header bg-light d-flex justify-content-between align-items-center">
			<h5 class="card-title mb-0">
				Hasil Pencarian (<?= number_format($total_tests) ?> data)
			</h5>
			<div class="btn-group">
				<a href="<?= base_url('audiometri/create') ?>" class="btn btn-primary btn-sm">
					<i class="fas fa-plus me-1"></i> Tes Baru
				</a>
				<a href="<?= base_url('audiometri/export_excel') ?>" class="btn btn-success btn-sm">
					<i class="fas fa-file-excel me-1"></i> Export Excel
				</a>
			</div>
		</div>
		<div class="card-body p-0">
			<?php if (!empty($tests)): ?>
				<div class="table-responsive">
					<table class="table table-hover mb-0">
						<thead class="table-light">
							<tr>
								<th>No</th>
								<th>Tanggal Tes</th>
								<th>No RM</th>
								<th>Nama</th>
								<th>Umur</th>
								<th>Perusahaan</th>
								<th>Jabatan</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = (($current_page - 1) * 10) + 1;
							foreach ($tests as $test):
							?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= date('d/m/Y', strtotime($test['tanggal_tes'])) ?></td>
									<td><?= $test['no_rm'] ?></td>
									<td>
										<strong><?= $test['nama'] ?></strong><br>
										<small class="text-muted"><?= $test['jenis_kelamin'] ?></small>
									</td>
									<td><?= $test['umur'] ?> tahun</td>
									<td><?= $test['perusahaan'] ?></td>
									<td><?= $test['jabatan'] ?></td>
									<td>
										<?php
										$impression = $test['impression'];
										if (!empty($impression)) {
											echo '<span class="badge bg-success"><i class="fas fa-check me-1"></i>Sudah Direview</span>';
										} else {
											echo '<span class="badge bg-danger"><i class="fas fa-clock me-1"></i>Menunggu Review</span>';
										}
										?>
									</td>
									<td>
										<div class="btn-group btn-group-sm">
											<a href="<?= base_url('audiometri/view/' . $test['id']) ?>"
												class="btn btn-outline-primary" title="Lihat Detail">
												<i class="fas fa-eye"></i>
											</a>
											<a href="<?= base_url('audiometri/edit/' . $test['id']) ?>"
												class="btn btn-outline-secondary" title="Edit">
												<i class="fas fa-edit"></i>
											</a>
											<a href="<?= base_url('audiometri/export_pdf/' . $test['id']) ?>"
												class="btn btn-outline-info" title="Export PDF" target="_blank">
												<i class="fas fa-file-pdf"></i>
											</a>
											<button onclick="deleteRecord(<?= $test['id'] ?>)"
												class="btn btn-outline-danger" title="Hapus">
												<i class="fas fa-trash"></i>
											</button>
										</div>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>

				<!-- Pagination -->
				<?php if (!empty($pagination)): ?>
					<div class="card-footer bg-light">
						<div class="d-flex justify-content-between align-items-center">
							<div>
								Menampilkan <?= (($current_page - 1) * 10) + 1 ?> -
								<?= min($current_page * 10, $total_tests) ?> dari <?= number_format($total_tests) ?> data
							</div>
							<div>
								<?= $pagination ?>
							</div>
						</div>
					</div>
				<?php endif; ?>

			<?php else: ?>
				<div class="text-center py-5">
					<i class="fas fa-search fa-3x text-muted mb-3"></i>
					<h5 class="text-muted">Tidak ada data yang ditemukan</h5>
					<p class="text-muted">Coba ubah kriteria pencarian atau buat tes baru</p>
					<a href="<?= base_url('audiometri/create') ?>" class="btn btn-primary">
						<i class="fas fa-plus me-1"></i> Buat Tes Baru
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<style>
	.bg-orange {
		background-color: #fd7e14 !important;
	}
</style>
