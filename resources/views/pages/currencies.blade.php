@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h2>Döviz Kurları</h2>
        <div class="container mt-4">

            <a href="{{ url('/update-currencies') }}" class="btn btn-primary">Döviz Kurlarını Güncelle</a>
            <a href="{{ url('/update-gold') }}" class="btn btn-warning">Altın Fiyatlarını Güncelle</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kod</th>
                    <th>Ad</th>
                    <th>USD Karşılığı</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($currencies as $index => $currency)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $currency->code }}</td>
                        <td>{{ $currency->name }}</td>
                        <td>{{ $currency->usd_rate }}$</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
