<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">
                        Daftar <?php echo $title; ?>
                    </h5>
                    <div>
                        <button type="button" OnClick="link_add('user');"
                            class="btn btn-sm btn-secondary btn-label waves-effect waves-light"><i
                                class="ri-add-circle-line label-icon align-middle fs-16 me-2"></i> Tambah</button>
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
                        <div>
                            <form method="post" action="<?php echo e(route('user.filter')); ?>">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />
                                <div class="row mb-3">
                                    <div class="col-lg-6"></div>
                                    <div class="col-lg-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                placeholder="Cari Berdasarkan Nama <?php echo e(ucfirst($title)); ?> ..."
                                                value="<?php echo e($q); ?>" name="keyword" autocomplete="off" />
                                            <button class="btn btn-outline-secondary" type="submit"
                                                id="button-addon2">Cari</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                style="width:100%">
                                <thead class="text-muted table-light">
                                    <tr>
                                        <th>Username</th>
                                        <th width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($results)): ?>
                                        <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($row->username); ?></td>
                                                <td align="center">
                                                    <div class="hstack gap-1 mt-4 mt-sm-0">
                                                        <button type="button"
                                                            onClick="edit_data('user', '<?php echo e($row->id); ?>');"
                                                            class="btn btn-outline-warning btn-sm waves-effect waves-light">Ubah</button></button>
                                                        <button type="button"
                                                            onClick="delete_data('user', '<?php echo e($row->id); ?>');"
                                                            class="btn btn-outline-danger btn-sm waves-effect waves-light">Hapus</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="2">
                                                <p class="card-text text-center">
                                                    <small class="text-muted">No data found</small>
                                                </p>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot class="text-semibold table-light">
                                    <tr>
                                        <td colspan="2">
                                            <div
                                                class="align-items-center pt-2 justify-content-between row text-center text-sm-start">
                                                <div class="col-sm">
                                                    <div class="text-muted">
                                                        Total <b><?php echo e($results->total()); ?></b> Data
                                                    </div>
                                                </div>
                                                <div class="col-sm-auto mt-3 mt-sm-0">
                                                    <ul
                                                        class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                                                        <?php echo e($results->onEachSide(1)->links()); ?>

                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/amx/resources/views/user/index.blade.php ENDPATH**/ ?>