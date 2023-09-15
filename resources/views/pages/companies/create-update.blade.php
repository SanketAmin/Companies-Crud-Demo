@extends('layouts.app')

@section('content')
    <div class="content d-flex justify-content-center row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <a href="{{route('companies.index')}}" class="text-dark d-flex align-items-center"><i class="ph-arrow-left pe-2"></i></a>
                        <h5 class="mb-0">{{isset($company) ? 'Edit Company' : 'Add Company'}}</h5>
                    </div>
                </div>
                <div class="card-body">
                    @if(isset($company))
                        <form action="{{route('companies.update',$company->id)}}" id="companyForm" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    <input type="hidden" name="edit_profile" value="1">
                    @else
                        <form action="{{route('companies.store')}}" id="companyForm" method="POST" enctype="multipart/form-data">
                    @endif
                        @csrf
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{old('name', isset($company) ? $company->name : '')}}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-6 mb-3">
                                <label class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{ old('email', isset($company) ? $company->email : '') }}">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" name="logo" id="logo" class="form-control" value="">
                            @if (isset($company) && $company->logo)
                                <img src="{{ asset('storage/' . $company->logo) }}" id="logoPreview" alt="Logo Preview" class="mt-2" style="max-width: 200px; max-height: 200px;">
                            @else
                                <img src="#" id="logoPreview" alt="Logo Preview" class="mt-2" style="max-width: 200px; max-height: 200px; display: none;">
                            @endif
                            @error('logo')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="website">Website<span class="text-danger">*</span></label>
                            <input type="url" name="website" id="website" class="form-control" value="{{ old('website', isset($company) ? $company->website : '') }}">
                        </div>
                        <div class="">
                            <a href="{{route('companies.index')}}" class="btn btn-light">Cancel</a>
                            <button type="submit" class="btn btn-primary ms-3">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('#logo').on('change', function() {
                var input = this;

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#logoPreview')
                            .attr('src', e.target.result)
                            .show();
                    };

                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#logoPreview').attr('src', '').hide();
                }
            });

            $.validator.addMethod("extension", function(value, element, param) {
                param = typeof param === "string" ? param.replace(/,/g, '|') : "png|jpe?g";
                return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
            }, "Please select only file of png, jpg, jpeg");

            $('#companyForm').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 255,
                    },
                    email: {
                        email: true,
                        required: true,
                        maxlength: 255,
                    },
                    logo: {
                        extension: true,
                    },
                    website: {
                        url: true,
                        required: true,
                        maxlength: 255,
                    },
                },
                ignore: 'input[type=hidden], .select2-search__field',
                errorClass: 'validation-invalid-label',
                successClass: 'validation-valid-label',
                validClass: 'validation-valid-label',
                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },


                // Different components require proper error label placement
                errorPlacement: function(error, element) {

                    // Input with icons and Select2
                    if (element.hasClass('select2-hidden-accessible')) {
                        error.appendTo(element.parent());
                    }

                    // Input group, form checks and custom controls
                    else if (element.parents().hasClass('form-control-feedback') || element.parents().hasClass('form-check') || element.parents().hasClass('input-group')) {
                        error.appendTo(element.parent().parent());
                    }

                    // Other elements
                    else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
