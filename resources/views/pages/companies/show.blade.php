@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <a href="{{route('companies.index')}}" class="text-dark d-flex align-items-center"><i class="ph-arrow-left pe-2"></i></a>
                            Company Details
                        </div>
                        <div>
                            <a href="{{ route('companies.edit', ['company' => $company->id]) }}" class="btn btn-primary">Edit</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Name:</strong> {{ $company->name }}</li>
                            <li class="list-group-item"><strong>Email:</strong> {{ $company->email }}</li>
                            <li class="list-group-item"><strong>Website:</strong> <a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></li>
                            <li class="list-group-item">
                                <strong>Logo:</strong><br>
                                @if ($company->logo)
                                    <img src="{{ url('storage/' . $company->logo) }}" alt="{{ $company->name }} Logo" class="img-fluid" style="max-width: 200px; max-height: 200px;">
                                @else
                                    No logo available.
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
