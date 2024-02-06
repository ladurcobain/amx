<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.Apex_Scatter_Chart'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?> Apexcharts <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?> Apex Scatter Charts <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Basic Scatter Chart</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="basic_scatter" data-colors='["--vz-primary", "--vz-success", "--vz-warning"]' class="apex-charts" dir="ltr"></div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Scatter - Datetime Chart</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="datetime_scatter" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-warning", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Scatter Images Chart</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div id="images_scatter" data-colors='["--vz-primary", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('assets/libs/apexcharts/apexcharts.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/js/pages/apexcharts-scatter.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/hmamacbook/Downloads/Laravel 2/default/resources/views/charts-apex-scatter.blade.php ENDPATH**/ ?>