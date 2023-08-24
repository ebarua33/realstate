@extends('admin.admin_dashboard')
@section('admin')
    <div class="page-content">
        <div class="row profile-body">
            <!-- left wrapper start -->
            <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
                <div class="card rounded">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div>
                                <img class="wd-70 rounded-circle"
                                    src="{{ !empty($data->photo) ? url($data->photo) : url('upload/no_image.jpg') }}"
                                    alt="profile" />
                                <span class="h4 ms-3">{{ $data->username }}</span>
                            </div>

                        </div>
                        <p>
                            Hi! I'm Amiah the Senior UI Designer at
                            NobleUI. We hope you enjoy the design
                            and quality of Social.
                        </p>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
                            <p class="text-muted">
                                {{ $data->name }}
                            </p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                            <p class="text-muted">{{ $data->email }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
                            <p class="text-muted">{{ $data->phone }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
                            <p class="text-muted">
                                {{ $data->address }}
                            </p>
                        </div>
                        <div class="mt-3 d-flex social-links">
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="github"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="twitter"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                                <i data-feather="instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- left wrapper end -->
            <!-- middle wrapper start -->
            <div class="col-md-8 col-xl-8 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Edit Password</h6>

                            <form class="forms-sample" action="{{ route('admin.update.password') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Current Password</label>
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" autocomplete="off"
                                        name="current_password">
                                       @error('current_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="new_password" autocomplete="newpassword">
                                        @error('new_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="confir_password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password" autocomplete="newpassword"
                                        name="confirm_password">
                                </div>

                                <button type="submit" class="btn btn-primary me-2">Save Changes</button>
                                <button class="btn btn-secondary">Cancel</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <!-- middle wrapper end -->
            <!-- right wrapper start -->

            <!-- right wrapper end -->
        </div>
    </div>
    <script>
        function previewImage(event) {
            var input = event.target;
            var preview = document.getElementById('showimage');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
