@extends('layouts.admin')

@section('content')
    <div class="container mt-5 bg-white p-4 rounded-3">
        <h2 class="mb-4">Hedef Yönetimi</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Goal Listeleme --}}
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Fotoğraf</th>
                    <th>Ad Soyad</th>
                    <th>Hedef Adı</th>
                    <th>Fiyat</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($goals as $goal)
                    <tr>
                        <td>{{ $goal->goalid }}</td>
                        <td>
                            @if ($goal->image)
                                <img src="{{ asset('goal_images/' . $goal->image) }}" width="60" height="60"
                                    class="img-thumbnail">
                            @else
                                Yok
                            @endif
                        </td>
                        <td>{{ $goal->user?->namesurname ?? 'Kullanıcı Bulunamadı' }}</td>
                        <td>{{ $goal->goal_name }}</td>
                        <td>{{ number_format($goal->cost, 2) }}</td>
                        <td>
                            <!-- Düzenleme Butonu -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $goal->goalid }}">
                                Düzenle
                            </button>

                            <!-- Silme Butonu -->
                            <form action="{{ route('goals.destroy', $goal->goalid) }}" method="POST"
                                onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Sil</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Düzenleme Modalı -->
                    <div class="modal fade" id="editModal{{ $goal->goalid }}" tabindex="-1"
                        aria-labelledby="editModalLabel{{ $goal->goalid }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('goals.update', $goal->goalid) }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $goal->goalid }}">Hedef Düzenle</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Kapat"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>User ID</label>
                                        <select name="userid" class="form-select" required>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->userid }}"
                                                    {{ $goal->userid == $user->userid ? 'selected' : '' }}>
                                                    {{ $user->namesurname }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Hedef</label>
                                        <input type="text" name="goal_name" class="form-control"
                                            value="{{ $goal->goal_name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Fotoğraf (Opsiyonel)</label>
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                        @if ($goal->image)
                                            <img src="{{ asset('goal_images/' . $goal->image) }}" width="80"
                                                class="mt-2 img-thumbnail">
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label>Cost</label>
                                        <input type="number" step="0.01" name="cost" class="form-control"
                                            value="{{ $goal->cost }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Güncelle</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach

                @if ($goals->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center">Kayıt bulunamadı.</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <hr class="my-5">

        {{-- Yeni Goal Ekleme --}}
        <h4>Yeni Hedef Ekle</h4>
        <form action="{{ route('goals.store') }}" method="POST" enctype="multipart/form-data">

            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label>Kullanıcı Seç</label>
                    <select name="userid" class="form-select" required>
                        <option value="">-- Kullanıcı Seçin --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->userid }}" {{ old('userid') == $user->userid ? 'selected' : '' }}>
                                {{ $user->namesurname }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Hedef</label>
                    <input type="text" name="goal_name" class="form-control" required value="{{ old('goal_name') }}">
                </div>
                <div class="col-md-4">
                    <label>Fotoğraf (Opsiyonel)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                <div class="col-md-4">
                    <label>Cost</label>
                    <input type="number" step="0.01" name="cost" class="form-control" required
                        value="{{ old('cost') }}">
                </div>
                <div class="col-md-12 mt-3">
                    <button type="submit" class="btn btn-success">Goal Ekle</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS (modal için gerekli) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
