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

                            <h6 class="card-title">Edit Profile</h6>

                            <form class="forms-sample" action="{{ route('admin.profile.store', $data->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" autocomplete="off"
                                        name="name" value="{{ $data->name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        autocomplete="off" value="{{ $data->username }}">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $data->email }}">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ $data->phone }}">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        autocomplete="off" value="{{ $data->address }}">
                                </div>
                                <div class="mb-3">
                                    <label for="photo" class="form-label">Photo</label>
                                    <input type="file" class="form-control" name="photo" id="image" onchange="previewImage(event)">
                                </div>
                                <div class="form-check mb-3">
                                    <img class="wd-70 rounded-circle"
                                        src="{{ !empty($data->photo) ? url($data->photo) : url('upload/no_image.jpg') }}"
                                        alt="profile" id="showimage" />
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
