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
                        <button type="button" OnClick="link_add('customer');"
                            class="btn btn-sm btn-secondary btn-label waves-effect waves-light"><i
                                class="ri-add-circle-line label-icon align-middle fs-16 me-2"></i> Tambah</button>
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
                            <form method="post" action="{{ route('customer.filter') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <div class="row mb-3">
                                    <div class="col-lg-6"></div>
                                    <div class="col-lg-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                placeholder="Cari Berdasarkan Nama {{ ucfirst($title) }} ..."
                                                value="{{ $q }}" name="keyword" autocomplete="off" />
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
                                        <th>Nama Lengkap</th>
                                        <th>No. Handphone</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
                                        <th width="5%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($results))
                                        @foreach ($results as $row)
                                            <tr>
                                                <td>{{ $row->name }}</td>
                                                <td>{{ $row->phoneNumber }}</td>
                                                <td>{{ $row->email }}</td>
                                                <td>{{ $row->address }}</td>
                                                <td>
                                                    <span
                                                        class="badge text-<?php echo $row->status != true ? 'bg-secondary' : 'bg-primary'; ?>">{{ App\Helpers\Status::tipeStatus($row->status) }}
                                                    </span>
                                                </td>
                                                <td align="center">
                                                    <div class="hstack gap-1 mt-4 mt-sm-0">
                                                        <button type="button"
                                                            onClick="edit_data('customer', '{{ $row->id }}');"
                                                            class="btn btn-outline-warning btn-sm waves-effect waves-light">Ubah</button></button>
                                                        <button type="button"
                                                            onClick="delete_data('customer', '{{ $row->id }}');"
                                                            class="btn btn-outline-danger btn-sm waves-effect waves-light">Hapus</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="2">
                                                <p class="card-text text-center">
                                                    <small class="text-muted">No data found</small>
                                                </p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                                <tfoot class="text-semibold table-light">
                                    <tr>
                                        <td colspan="6">
                                            <div
                                                class="align-items-center pt-2 justify-content-between row text-center text-sm-start">
                                                <div class="col-sm">
                                                    <div class="text-muted">
                                                        Total <b>{{ $results->total() }}</b> Data
                                                    </div>
                                                </div>
                                                <div class="col-sm-auto mt-3 mt-sm-0">
                                                    <ul
                                                        class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                                                        {{ $results->onEachSide(1)->links() }}
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

@endsection
