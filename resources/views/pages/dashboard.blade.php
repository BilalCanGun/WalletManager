@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="avatar-md bg-soft-primary rounded">
                                    <iconify-icon icon="solar:user-outline"
                                        class="avatar-title fs-32 text-primary"></iconify-icon>
                                </div>
                            </div>
                            <div class="col-8 text-end">
                                <p class="text-muted mb-1">Kullanıcı Sayısı</p>
                                <h3 class="text-dark mt-1 mb-0">{{ $userCount }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer py-2 bg-light bg-opacity-50">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('users.index') }}" class="text-reset fw-semibold fs-12">Görüntüle</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="avatar-md bg-soft-success rounded">
                                    <iconify-icon icon="solar:target-outline"
                                        class="avatar-title fs-32 text-success"></iconify-icon>
                                </div>
                            </div>
                            <div class="col-8 text-end">
                                <p class="text-muted mb-1">Hedef Sayısı</p>
                                <h3 class="text-dark mt-1 mb-0">{{ $goalCount }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer py-2 bg-light bg-opacity-50">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('goals.index') }}" class="text-reset fw-semibold fs-12">Görüntüle</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="avatar-md bg-soft-warning rounded">
                                    <iconify-icon icon="solar:wallet-outline"
                                        class="avatar-title fs-32 text-warning"></iconify-icon>
                                </div>
                            </div>
                            <div class="col-8 text-end">
                                <p class="text-muted mb-1">Varlık Sayısı</p>
                                <h3 class="text-dark mt-1 mb-0">{{ $walletCount }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer py-2 bg-light bg-opacity-50">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('wallets.index') }}" class="text-reset fw-semibold fs-12">Görüntüle</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
