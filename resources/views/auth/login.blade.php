@extends('templates.default')
@php
$title = 'Login';
$preTitle = 'Login';
$currentRouteName = Route::currentRouteName();
@endphp

@section('content')
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Page bg image-->
    <style>
        body {
            background-image: url('dist/assets/media/auth/bg10.jpeg');
        }

        [data-bs-theme="dark"] body {
            background-image: url('dist/assets/media/auth/bg10-dark.jpeg');
        }
    </style>
    <!--end::Page bg image-->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-lg-row-fluid">
            <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="dist/assets/media/auth/agency.png" alt="" />
                <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="dist/assets/media/auth/agency-dark.png" alt="" />
                <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Fast, Efficient and Productive</h1>
                <div class="text-gray-600 fs-base text-center fw-semibold">In this kind of post,
                    <a href="#" class="opacity-75-hover text-primary me-1">the blogger</a>introduces a person they’ve
                    interviewed
                    <br />and provides some background information about
                    <a href="#" class="opacity-75-hover text-primary me-1">the interviewee</a>and their
                    <br />work following this is a transcript of the interview.
                </div>
            </div>
        </div>
        <!--begin::Aside-->
        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
            <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                    <div class="d-flex flex-center flex-column-fluid pb-15 pb-lg-20">
                        <!-- <form class="form w-100" action="{{ route('login_process') }}" method="post"> -->
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form">
                            @csrf
                            <div class="text-center mb-11">
                                <h1 class="text-dark fw-bolder mb-3">PMKS</h1>
                                <div class="text-gray-500 fw-semibold fs-6">Penyandang Masalah Kesejahteraan Sosial dan
                                    Tipiring</div>
                            </div>
                            <!-- <div class="fv-row mb-8">
                                <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" />
                            </div> -->
                            <div class="fv-row mb-8">
                                <input type="text" placeholder="Username" name="username" autocomplete="off" class="form-control bg-transparent" />
                            </div>
                            <div class="fv-row mb-5">
                                <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" />
                            </div>
                            <!-- <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <div></div>
                                <a href="../../demo39/dist/authentication/layouts/overlay/reset-password.html" class="link-primary">Forgot Password ?</a>
                            </div> -->
                            <div class="d-grid mb-10 pt-2">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary" onclick="submitForm()">
                                    <span class="indicator-label">Masuk</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                            <!-- <div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
                                <a href="../../demo39/dist/authentication/layouts/overlay/sign-up.html" class="link-primary">Sign up</a>
                            </div> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Authentication - Sign-in-->
</div>
@endsection

@push('scripts')
<script src="dist/assets/js/custom/authentication/sign-in/general.js"></script>

<script>
    function submitForm() {
        var formData = $('#kt_sign_in_form').serialize();

        $.ajax({
            type: 'POST',
            url: "{{ route('login_process') }}",
            data: formData,
            dataType: 'json', // ? jika server mengembalikan response dalam format JSON
            success: function(response) {
                // ? handle success response
                console.log(response);
                // ? redirect or perform other actions as needed
                if (response.status == true) {
                    window.location.href = response.redirect;
                }
            },
            error: function(xhr, status, error) {
                // ? handle error response
                var errorMessage = xhr.responseJSON.message || 'Oops! Something went wrong.';
                console.error(errorMessage);
            },
        });
    }
</script>
@endpush