@extends('layouts.app')
@section('content')

    <div class="card">
        <div class="card-header d-flex">
            {{ __('Grandsons') }}
            <div class="ml-auto">
                <a href="{{ route('home') }}">Home</a> -
                <a href="{{ route('sons.index') }}">Sons</a> -
                <a href="{{ route('grandsons.index') }}">Grandsons</a>
            </div>
        </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="text-right">
                <a href="">Create son</a>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Birth Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($grandsons as $grandson)
                        <tr>
                            <td>{{ $grandson->id }}</td>
                            <td>{{ $grandson->name }}</td>
                            <td>{{ $grandson->birth_date }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No Grandsons found</td>
                        </tr>
                    @endforelse
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="4">
                                {!! $grandsons->links() !!}
                            </td>
                        </tr>
                    </tfoot>

                </table>
            </div>
        </div>
    </div>

@endsection