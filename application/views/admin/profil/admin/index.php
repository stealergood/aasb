<section class="section profile">
    <div class="row">

        <div class="card">
            <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">

                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Profile Details</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                    </li>

                </ul>
                <div class="tab-content pt-2">

                    <div class="tab-pane fade show active profile-overview" id="profile-overview">

                        <div class="row mt-3">
                            <div class="col-lg-3 col-md-4 label ">Full Name</div>
                            <div class="col-lg-9 col-md-8"><?= $data['name'] ?></div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Username</div>
                            <div class="col-lg-9 col-md-8"><?= $data['username'] ?></div>
                        </div>

                    </div>

                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                        <!-- Profile Edit Form -->
                        <form>

                            <div class="row mb-3">
                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                <div class="col-md-8 col-lg-9">
                                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $data['id_admin'] ?>">
                                    <input type="text" class="form-control" id="name" name="name" value="<?= $data['name'] ?>">
                                    <small id="nama_help" class="form-text"></small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="Job" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                <div class="col-md-8 col-lg-9">
                                    <input type="text" class="form-control" id="username" name="username" value="<?= $data['username'] ?>" onkeypress='if (event.which === 32) return false;'>
                                    <small id="username_help" class="form-text"></small>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="button" name="simpan_profil" id="simpan_profil" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form><!-- End Profile Edit Form -->

                    </div>

                    <div class="tab-pane fade pt-3" id="profile-change-password">
                        <!-- Change Password Form -->
                        <form>

                            <div class="row mb-3">
                                <label for="password_lama" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="password_lama" type="password" class="form-control" id="password_lama">
                                    <small id="password_lama_help" class="form-text"></small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="paswword_baru" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="password_baru" type="password" class="form-control" id="password_baru">
                                    <small id="password_baru_help" class="form-text"></small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password_ulang" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="password_ulang" type="password" class="form-control" id="password_ulang">
                                    <small id="password_ulang_help" class="form-text"></small>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="button" id="simpan_password" name="simpan_password" class="btn btn-primary">Change Password</button>
                            </div>
                        </form><!-- End Change Password Form -->

                    </div>

                </div><!-- End Bordered Tabs -->

            </div>
        </div>

    </div>
</section>