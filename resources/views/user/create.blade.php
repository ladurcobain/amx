@extends('layouts.master')
@section('content')

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
                @if ($alert = Session::get('alrt'))
                <div class="alert <?php echo (($alert == "error")?'alert-danger':'alert-success'); ?> alert-dismissible fade show" management="alert">
                    <strong><?php echo (($alert == "error")?'Error':'Success'); ?>!</strong>
                    <?php echo Session::get('msgs'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true" aria-label="Close"></button>
                </div>
                @endif
                <div class="live-preview">
                    <div>
                        <form method="post" action="{{ route('user.store') }}"class="needs-validation" novalidate enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="row mb-3">
                                <label class="col-lg-3">Username <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="username" placeholder="Username" value="" class="form-control" autocomplete="off" required="required" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-lg-3">Password <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="password" class="form-control" name="password" placeholder="Password" value="" autocomplete="off" required="required" />
                                </div>
                            </div>
                            <hr />
                            <div class="row mb-3">
                                <label class="col-lg-3">Nama <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="fullname" placeholder="Nama" value="{{ Session::flash('fullname') }}" class="form-control" autocomplete="off" required="required" />
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
        </div>
    </div>
</div>

@endsection