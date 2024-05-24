<section>
	<div class="page-header min-vh-75">
		<div class="container">
			<div class="row">
				<div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
					<div class="card card-plain mt-8">
						
						<div class="card-body">
							<form role="form" action="<?= base_url('sign-in') ?>" method="POST">
								<label>Email or Username</label>
								<div class="mb-3">
									<input type="text" class="form-control" name="email_user" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
								</div>
								<label>Password</label>
								<div class="mb-3">
									<input type="password" class="form-control" name="password_user" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
								</div>
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" id="rememberMe" checked="">
									<label class="form-check-label" for="rememberMe">Remember me</label>
								</div>
								<div class="text-center">
									<button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- <div class="col-md-6">
					<div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
						<div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('https://www.riaubisa.com/foto_berita/2023-05-22-tabrak-aturan-pp-bumd-pt-bsp-diduga-jadi-perusahaan-keluarga.jpg');background-size:contain;background-repeat:no-repeat;"></div>
					</div>
				</div> -->
			</div>
		</div>
	</div>
</section>