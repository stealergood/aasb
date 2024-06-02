<div>
	<?php echo $error ?>
	<form action="<?php echo site_url('send') ?> " method="POST">
		<div class="mb-3">
			<label class="form-label">Email</label>
		<div class="input-group">
			<input class="form-control" name="email" value="<?=$ortu?>" >
		</div>
		</div>
		<div class="mb-3">
			<label class="form-label">Pesan</label>
			<div class="input-group">
			<input class="form-control" name="message">
		</div>
		</div>
		<div class="mb-3">
			<button class="btn btn-primary">Kirim</button>
		</div>
		</div>
	</form>
</div>
