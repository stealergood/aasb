<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Settings</h5>

                    <!-- Horizontal Form -->
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">App Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="app_name" name="app_name" value="<?= $settings['app_name'] ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                    <!--    <label for="slogan" class="col-md-4 col-lg-3 col-form-label">Slogan</label> -->
                        <label for="slogan" class="col-md-4 col-lg-3 col-form-label">Visi</label>
                        <div class="col-md-8 col-lg-9">
                            <textarea name="slogan" class="form-control" id="slogan" style="height: 100px"><?= $settings['slogan'] ?></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                    <!--    <label for="description" class="col-md-4 col-lg-3 col-form-label">Description</label> -->
                        <label for="description" class="col-md-4 col-lg-3 col-form-label">Misi</label>
                        <div class="col-md-8 col-lg-9">
                            <textarea name="description" class="form-control" id="description" style="height: 100px"><?= $settings['description'] ?></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                    <!--    <label for="meta_description" class="col-md-4 col-lg-3 col-form-label">Meta Description</label> -->
                    <!--    <div class="col-md-8 col-lg-9">
                            <textarea name="meta_description" class="form-control" id="meta_description" style="height: 100px"><?= $settings['meta_description'] ?></textarea>
                        </div>
                    </div> 

                    <div class="row mb-3">
                        <label for="meta_keyword" class="col-md-4 col-lg-3 col-form-label">Meta Keyword</label>
                        <div class="col-md-8 col-lg-9">
                            <textarea name="meta_keyword" class="form-control" id="meta_keyword" style="height: 100px"><?= $settings['meta_keyword'] ?></textarea>
                        </div>
                    </div> -->

                    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Logo Image</label>
                        <div class="col-md-8 col-lg-9">
                            <div id="uploaded_image">
                                <img src="<?= base_url() ?>assets/img/<?= $settings['logo'] ?>" alt="Logo Image" class="col-md-12 col-lg-6 col-xl-4 mb-2">
                            </div>
                            <div class="pt-2">
                                <input class="form-control" type="file" id="logo_image" name="logo_image">
                            </div>
                        </div>
                    </div>

                <!--    <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Favicob Image</label>
                        <div class="col-md-8 col-lg-9">
                            <div id="uploaded_favicon">
                                <img src="<?= base_url() ?>assets/img/<?= $settings['favicon'] ?>" alt="Favicon" class="col-md-12 col-lg-2 col-xl-2 mb-2">
                            </div>
                            <div class="pt-2">
                                <input class="form-control" type="file" id="favicon_image" name="favicon_image">
                            </div>
                        </div>
                    </div> -->

                    <div class="row mb-3">
                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="address" type="text" class="form-control" id="Address" value="<?= $settings['address'] ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="phone" type="text" class="form-control" id="Phone" value="<?= $settings['phone'] ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="email" type="email" class="form-control" id="Email" value="<?= $settings['email'] ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="website" class="col-md-4 col-lg-3 col-form-label">Website</label>
                        <div class="col-md-8 col-lg-9">
                            <input name="website" type="text" class="form-control" id="website" value="<?= $settings['website'] ?>"">
                        </div>
                    </div>

                    <div class=" text-center">
                            <button type="button" id="save_setting" name="save_setting" class="btn btn-primary">Save Changes</button>
                        </div>

                        
                        <!-- End Horizontal Form -->

                    </div>
                </div>

            </div>

        </div>
</section>