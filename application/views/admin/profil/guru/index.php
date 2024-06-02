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
                            <div class="col-lg-3 col-md-4 label ">NIP</div>
                            <div class="col-lg-9 col-md-8"><?= $data['nip_guru'] ?></div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-3 col-md-4 label ">Full Name</div>
                            <div class="col-lg-9 col-md-8"><?= $data['nama_guru'] ?></div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Username</div>
                            <div class="col-lg-9 col-md-8"><?= $data['username'] ?></div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Email</div>
                            <div class="col-lg-9 col-md-8"><?= $data['email'] ?></div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                            <div class="col-lg-9 col-md-8">
                                <?php if ($data['jenis_kelamin'] == "L") {
                                    echo "Laki - laki";
                                } else {
                                    echo "Perempuan";
                                } ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Jabatan</div>
                            <div class="col-lg-9 col-md-8"><?= $data['jabatan'] ?></div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Alamat</div>
                            <div class="col-lg-9 col-md-8"><?= $data['alamat'] ?></div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">No Telephon</div>
                            <div class="col-lg-9 col-md-8"><?= $data['no_telepon'] ?></div>
                        </div>

                    </div>

                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                        <!-- Profile Edit Form -->
                        <form>

                            <div class="row mb-3">
                                <label for="nip_guru" class="col-md-4 col-lg-3 col-form-label">NIP Guru</label>
                                <div class="col-md-8 col-lg-9">
                                    <input type="text" class="form-control" id="nip_guru" name="nip_guru" value="<?= $data['nip_guru'] ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                    <small id="nip_guru_help" class="form-text"></small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                                <div class="col-md-8 col-lg-9">
                                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $data['id_guru'] ?>">
                                    <input type="text" class="form-control" id="name" name="name" value="<?= $data['nama_guru'] ?>">
                                    <small id="nama_help" class="form-text"></small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                <div class="col-md-8 col-lg-9">
                                    <input type="text" class="form-control" id="username" name="username" value="<?= $data['username'] ?>" onkeypress='if (event.which === 32) return false;'>
                                    <small id="username_help" class="form-text"></small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                <div class="col-md-8 col-lg-9">
                                    <input type="text" class="form-control" id="email" name="email" value="<?= $data['email'] ?>">
                                    <small id="email_help" class="form-text"></small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="jenis_kelamin" class="col-md-4 col-lg-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-md-8 col-lg-9">
                                    <select class="form-select" aria-label="Default select" name="jenis_kelamin" id="jenis_kelamin">
                                        <option value="L" <?php if ($data['jenis_kelamin'] == "L") {
                                                                echo "selected";
                                                            } ?>>Laki - laki</option>
                                        <option value="P" <?php if ($data['jenis_kelamin'] == "P") {
                                                                echo "selected";
                                                            } ?>>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="jabatan" class="col-md-4 col-lg-3 col-form-label">Jabatan</label>
                                <div class="col-md-8 col-lg-9">
                                    <input type="text" class="form-control" id="jabatan" name="tahun_masuk" value="<?= $data['jabatan'] ?>">
                                    <small id="jabatan_help" class="form-text"></small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="alamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                                <div class="col-md-8 col-lg-9">
                                    <textarea name="alamat" class="form-control" id="alamat" style="height: 100px"><?= $data['alamat'] ?></textarea>
                                    <small id="alamat_help" class="form-text"></small>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="no_telepon" class="col-md-4 col-lg-3 col-form-label">No telephon</label>
                                <div class="col-md-8 col-lg-9">
                                    <input type="text" class="form-control" id="no_telepon" name="no_telepon" value="<?= $data['no_telepon'] ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                    <small id="no_telepon_help" class="form-text"></small>
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