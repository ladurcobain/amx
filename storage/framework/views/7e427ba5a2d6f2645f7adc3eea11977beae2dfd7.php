

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">
                        Daftar <?php echo $title; ?>
                    </h5>
                    <div>
                        <button type="button" OnClick="link_to('branch');"
                            class="btn btn-sm btn-secondary btn-label waves-effect waves-light"><i
                                class="ri-arrow-left-circle-line label-icon align-middle fs-16 me-2"></i> Kembali</button>
                    </div>
                </div>
                <div class="card-body">
                    <?php if($alert = Session::get('alrt')): ?>
                        <div class="alert <?php echo $alert == 'error' ? 'alert-danger' : 'alert-success'; ?> alert-dismissible fade show" management="alert">
                            <strong><?php echo $alert == 'error' ? 'Error' : 'Success'; ?>!</strong>
                            <?php echo Session::get('msgs'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true"
                                aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <div class="live-preview">
                        <?php if(!empty($info)): ?>
                            <form method="post" action="<?php echo e(route('branch.update')); ?>"class="needs-validation" novalidate
                                enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
                                <input type="hidden" name="id" value="<?php echo e($info->id); ?>" />
                                <div class="row mb-3">
                                    <label class="col-lg-3">Nama Cabang <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input type="text" name="name" placeholder="Nama Cabang" value="<?php echo e($info->name); ?>"
                                            class="form-control" autocomplete="off" required="required" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-lg-3">Alamat <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <textarea name="address" placeholder="Alamat" class="form-control" 
                                            autocomplete="off" required="required" rows="6"><?php echo e($info->address); ?></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-lg-3">No.Telpon <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input type="number" name="phoneNumber" placeholder="No.Telpon" value="<?php echo e($info->phoneNumber); ?>"
                                            class="form-control" autocomplete="off" required="required" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-lg-3">Pilih Provinsi<span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select class="form-select" aria-label="Default select example" name="provinceId">
                                            <option value="<?php echo e($info->Province->id); ?>"><?php echo e($info->Province->name); ?></option>
                                            <?php $__currentLoopData = $resProvinsi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $provinsi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($provinsi->id); ?>"><?php echo e($provinsi->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-lg-3">Pilih Kota<span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select class="form-select" aria-label="Default select example" name="cityId">
                                            <option value="<?php echo e($info->City->id); ?>"><?php echo e($info->City->name); ?></option>
                                            <?php $__currentLoopData = $resKota; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($kota->id); ?>"><?php echo e($kota->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-lg-3">Status <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select class="form-select" aria-label="Default select example" name="status">
                                            <option value="true" <?php echo e($info->status == true ? "selected" : ""); ?>>Aktif</option>
                                            <option value="false" <?php echo e($info->status == false ? "selected" : ""); ?>>Tdk Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <button type="reset" class="btn btn-danger">Batal</button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\amx\resources\views/branch/edit.blade.php ENDPATH**/ ?>