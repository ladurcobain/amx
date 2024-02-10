<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.dashboards'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(URL::asset('assets/libs/swiper/swiper.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="card-title mb-0 flex-grow-1">
                    Daftar <?php echo $title; ?>
                </h5>
                <div>
                    <button type="button" OnClick="link_to('user');" class="btn btn-sm btn-secondary btn-label waves-effect waves-light"><i class="ri-arrow-left-circle-line label-icon align-middle fs-16 me-2"></i> Kembali</button>
                </div>
            </div>
            <div class="card-body">
                <?php if($alert = Session::get('alrt')): ?>
                <div class="alert <?php echo (($alert == "error")?'alert-danger':'alert-success'); ?> alert-dismissible fade show" management="alert">
                    <strong><?php echo (($alert == "error")?'Error':'Success'); ?>!</strong>
                    <?php echo Session::get('msgs'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close"></button>
                </div>
                <?php endif; ?>
                <div class="live-preview">
                    <?php if(!empty($info)): ?> 
                    <div>
                        <ul class="nav nav-tabs mb-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#info" role="tab" aria-selected="false">
                                    Informasi Umum
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#password" role="tab" aria-selected="false">
                                    Ganti Kata Sandi
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content text-muted">
                            <div class="tab-pane active" id="info" role="tabpanel">
                                <form method="post" action="<?php echo e(route('user.update')); ?>"class="needs-validation" novalidate enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
                                    <input type="hidden" name="id" value="<?php echo e($info->id); ?>" />
                                    <div class="row mb-3">
                                        <label class="col-lg-3">Username <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="text" name="username" placeholder="Username" value="<?php echo e($info->username); ?>" class="form-control" readonly />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-lg-3">Nama <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="text" name="fullname" placeholder="Nama" value="<?php echo e($info->username); ?>" class="form-control" autocomplete="off" required="required" />
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <button type="reset" class="btn btn-danger">Batal</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="password" role="tabpanel">
                                <form method="post" action="<?php echo e(route('user.password')); ?>"class="needs-validation" novalidate>
                                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
                                    <input type="hidden" name="id" value="<?php echo e($info->id); ?>" />
                                    <div class="row mb-3">
                                        <label class="col-lg-3">Old <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="text" value="<?php echo e($info->password); ?>" class="form-control" readonly />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="col-lg-3">Password <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input type="password" name="password" placeholder="Password" value="" class="form-control" autocomplete="off" required="required" />
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <button type="reset" class="btn btn-danger">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>	
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<!-- apexcharts -->
<script src="<?php echo e(URL::asset('/assets/libs/apexcharts/apexcharts.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('/assets/libs/jsvectormap/jsvectormap.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/libs/swiper/swiper.min.js')); ?>"></script>
<!-- dashboard init -->
<script src="<?php echo e(URL::asset('/assets/js/pages/dashboard-ecommerce.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/amx/resources/views/user/edit.blade.php ENDPATH**/ ?>