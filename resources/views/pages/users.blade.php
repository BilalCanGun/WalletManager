@extends('layouts.admin')

@section('content')
    <div class="container mt-5 bg-white  p-4 rounded-3">
        <h2 class="mb-4">Kullanıcı Yönetimi</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Kullanıcı Listeleme --}}
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Ad Soyad</th>
                    <th>Email</th>
                    <th>Telefon</th>
                    <th>Doğum Tarihi</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->namesurname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->telno }}</td>
                        <td>{{ $user->borntime }}</td>
                        <td>
                            <!-- Güncelleme Butonu -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $user->userid }}">Düzenle</button>

                            <!-- Silme Butonu -->
                            <form action="{{ route('users.index') }}/{{ $user->userid }}" method="POST"
                                style="display:inline-block" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Sil</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Düzenleme Modalı -->
                    <div class="modal fade" id="editModal{{ $user->userid }}" tabindex="-1"
                        aria-labelledby="editModalLabel{{ $user->userid }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('users.index') }}/{{ $user->userid }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $user->userid }}">Kullanıcıyı Düzenle
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Kapat"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>Ad Soyad</label>
                                            <input type="text" name="namesurname" class="form-control"
                                                value="{{ $user->namesurname }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ $user->email }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Yeni Şifre (Boş bırakılırsa değişmez)</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>Telefon</label>
                                            <input type="text" name="telno" class="form-control"
                                                value="{{ $user->telno }}">
                                        </div>
                                        <div class="mb-3">
                                            <label>Doğum Tarihi</label>
                                            <input type="date" name="borntime" class="form-control"
                                                value="{{ $user->borntime }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Güncelle</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        <hr class="my-5">

        {{-- Yeni Kullanıcı Ekleme --}}
        <h4>Yeni Kullanıcı Ekle</h4>
        <form action="{{ route('users.index') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label>Ad Soyad</label>
                    <input type="text" name="namesurname" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Şifre</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Telefon</label>
                    <input type="text" name="telno" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Doğum Tarihi</label>
                    <input type="date" name="borntime" class="form-control">
                </div>
                <div class="col-md-12 mt-3">
                    <button type="submit" class="btn btn-success">Kullanıcı Ekle</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS (modal çalışması için gerekli) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
