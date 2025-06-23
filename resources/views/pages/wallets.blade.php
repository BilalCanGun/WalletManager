@extends('layouts.admin')

@section('content')
    <div class="container mt-5 bg-white  p-2 rounded-3">
        <div class="container">
            <h2 class="mb-4">Cüzdan Yönetimi</h2>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Yeni Cüzdan Ekleme Formu --}}
            <form action="{{ route('wallets.store') }}" method="POST" class="mb-4">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label>Kullanıcı</label>
                        <select name="userid" class="form-control" required>
                            @foreach ($users as $user)
                                <option value="{{ $user->userid }}">{{ $user->namesurname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Tür</label>
                        <input type="text" name="type" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <label>Değer</label>
                        <input type="number" step="0.01" name="value" class="form-control" required>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-success w-100">Ekle</button>
                    </div>
                </div>
            </form>

            {{-- Wallet Listeleme --}}
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Kullanıcı</th>
                        <th>Tür</th>
                        <th>Değer</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wallets as $wallet)
                        <tr>
                            <td>{{ $wallet->walletid }}</td>
                            <td>{{ $wallet->user->namesurname ?? 'Tanımsız' }}</td>
                            <td>{{ $wallet->type }}</td>
                            <td>{{ $wallet->value }}</td>
                            <td>
                                {{-- Güncelleme Butonu --}}
                                <form action="{{ route('wallets.update', $wallet->walletid) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <select name="userid" class="form-control mb-1" required>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->userid }}"
                                                {{ $wallet->userid == $user->userid ? 'selected' : '' }}>
                                                {{ $user->namesurname }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="text" name="type" class="form-control mb-1"
                                        value="{{ $wallet->type }}" required>
                                    <input type="number" step="0.01" name="value" class="form-control mb-1"
                                        value="{{ $wallet->value }}" required>
                                    <button type="submit" class="btn btn-primary btn-sm">Güncelle</button>
                                </form>

                                {{-- Silme Butonu --}}
                                <form action="{{ route('wallets.destroy', $wallet->walletid) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
