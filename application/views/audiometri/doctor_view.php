<?php
// File: application/views/audiometri/doctor_view.php
?>
<div class="container-fluid p-4">
	<div class="row mb-4">
		<div class="col-12">
			<h1 class="h3 mb-4">
				<i class="fas fa-user-md text-primary me-3"></i>
				Panel Dokter - Data Pasien Hari Ini
			</h1>
		</div>
	</div>

	<!-- Info Section -->
	<div class="alert alert-info" role="alert" aria-live="polite" aria-atomic="true">
		<i class="fas fa-info-circle me-2"></i>
		<strong>Informasi:</strong> Halaman ini menampilkan data pasien hari ini. Anda hanya dapat mengedit bagian <strong>Impression</strong> untuk setiap pasien.
	</div>

	<!-- Results Section -->
	<div class="card">
		<div class="card-header bg-light d-flex justify-content-between align-items-center">
			<h5 class="card-title mb-0">
				Data Pasien Hari Ini (<?= date('d/m/Y') ?>) - <?= number_format(count($tests)) ?> pasien
			</h5>
			<div class="text-muted">
				<i class="fas fa-calendar-day me-1"></i>
				<?= date('l, d F Y') ?>
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
								<th>Nama Pasien</th>
								<th>Umur</th>
								<th>Perusahaan</th>
								<th>Jabatan</th>
								<th>Status Review</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 1;
							foreach ($tests as $test):
							?>
								<tr>
									<td><?= $no++ ?></td>
									<td class="vertical-align: top"><?= date('d/m/Y', strtotime($test['tanggal_tes'])) ?></td>
									<td><?= $test['no_rm'] ?></td>
									<td class="td-nama-pasien">
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
											echo '<span class="badge bg-warning"><i class="fas fa-clock me-1"></i>Menunggu Review</span>';
										}
										?>
									</td>
									<td>
										<a href="<?= base_url('audiometri/review_dokter/' . $test['id']) ?>"
											class="btn btn-sm btn-outline-primary"
											title="Review Data">
											<i class="fas fa-edit"></i> Review
										</a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			<?php else: ?>
				<div class="text-center py-5">
					<i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
					<h5 class="text-muted">Tidak ada data pasien hari ini</h5>
					<p class="text-muted">Belum ada tes audiometri yang dilakukan hari ini</p>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<style>
	.bg-pink {
		background-color: #e91e63 !important;
	}

	.table td {
		vertical-align: middle;
	}

	.badge {
		font-size: 0.75em;
	}

	.btn-group-sm .btn {
		padding: 0.25rem 0.5rem;
	}

	/* Semua td pada tbody rata atas */
	.table tbody td {
		vertical-align: top;
	}

	/* Kecuali kolom Nama Pasien, tetap vertikal tengah */
	.table tbody td.td-nama-pasien {
		vertical-align: middle;
	}
</style>
