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
                        <button type="button" OnClick="link_to('kota');"
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
                        @if (!empty($info))
                            <form method="post" action="{{ route('kota.update') }}"class="needs-validation" novalidate
                                enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="id" value="{{ $info->id }}" />
                                <div class="row mb-3">
                                    <label class="col-lg-3">Nama Kota <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input type="text" name="name" placeholder="Nama Kota"
                                            value="{{ $info->name }}" class="form-control" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-lg-3">Pilih Provinsi<span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select class="form-select" aria-label="Default select example" name="provinceId">
                                            <option value="{{ $info->Province->id }}">{{ $info->Province->name }}</option>
                                            @foreach ($resProvinsi as $provinsi)
                                                <option value="{{ $provinsi->id }}">{{ $provinsi->name }}</option>
                                            @endforeach
                                        </select>
                                        
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-lg-3">Status <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select class="form-select" aria-label="Default select example" name="status">
                                            <option value="true" {{ $info->status == true ? "selected" : "" }}>Aktif</option>
                                            <option value="false" {{ $info->status == false ? "selected" : "" }}>Tdk Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <button type="reset" class="btn btn-danger">Batal</button>
                                </div>
                            </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
