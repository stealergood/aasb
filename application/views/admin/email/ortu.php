<div>
	<?php echo $error ?>
	<form action="<?php echo site_url('send') ?> " method="POST">
		<div class="mb-3">
			<label class="form-label">Email</label>
			<div class="input-group">
				<input class="form-control" name="email" value="<?=$email_ortu?>" >
			</div>
		</div>
		<div class="mb-3">
			<label class="form-label">Nama Orang Tua</label>
			<div class="input-group">
				<input class="form-control" name="nama_ortu" value="<?=$nama_ortu?>">
			</div>
		</div>
		<div class="mb-3">
			<label class="form-label">Nama Siswa</label>
			<div class="input-group">
				<input class="form-control" name="nama_siswa" value="<?=$nama_siswa?>">
			</div>
		</div>
		<div class="mb-3">
			<label class="form-label">Status Kehadiran</label>
			<div class="input-group">
				<input class="form-control" name="status_kehadiran" value="<?=$status_kehadiran?>">
			</div>
		</div>

		<div class="mb-3">
			<label class="form-label">Pesan</label>
			<div class="input-group">
				<textarea class="form-control" name="message" rows="5"></textarea>
			</div>
		</div>
		<div class="mb-3">
			<button class="btn btn-primary">Kirim</button>
		</div>
		</div>
	</form>
</div>
