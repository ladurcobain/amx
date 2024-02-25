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
                        <button type="button" OnClick="link_to('customer');"
                            class="btn btn-sm btn-secondary btn-label waves-effect waves-light"><i
                                class="ri-arrow-left-circle-line label-icon align-middle fs-16 me-2"></i> Kembali</button>
                    </div>
                </div>
                <div class="card-body">
                    @if ($alert = Session::get('alrt'))
                        <div class="alert <?php echo $alert == 'error' ? 'alert-danger' : 'alert-success'; ?> alert-dismissible fade show" management="alert">
                            <strong><?php echo $alert == 'error' ? 'Error' : 'Success'; ?>!</strong>
                            <?php echo Session::get('msgs'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="live-preview">
                        <div>
                            <form method="post" action="{{ route('customer.store') }}"class="needs-validation" novalidate
                                enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <div class="row mb-3">
                                    <label class="col-lg-3">Nama Lengkap<span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input type="text" name="name" placeholder="Nama Lengkap" value=""
                                            class="form-control" autocomplete="off" required="required" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-lg-3">No. Handphone<span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input type="text" pattern="\d*" maxlength="14" name="phoneNumber" placeholder="No. Handphone" value=""
                                            class="form-control" autocomplete="off" required="required" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-lg-3">Email<span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input type="email" name="email" placeholder="Email" value=""
                                            class="form-control" autocomplete="off" required="required" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-lg-3">Alamat<span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input type="test" name="address" placeholder="Alamat" value=""
                                            class="form-control" autocomplete="off" required="required" />
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
