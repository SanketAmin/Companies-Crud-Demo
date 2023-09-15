@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="card col-3">
            <a class="card-body d-flex flex-row justify-content-between text-dark" href="{{route('companies.index')}}">
                <h3 class="mb-0 d-flex align-items-center">All Companies</h3>
                <h3 class="mb-0 d-flex align-items-center">{{$companies->count()}}</h3>
            </a>
        </div>
    </div>
@endsection
