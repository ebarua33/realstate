@extends('admin.admin_dashboard')

@section('admin')

<div class="page-content">
        <div class="row profile-body">
            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">

                            <h6 class="card-title">Update Amenitie</h6>

                            <form class="forms-sample" action="{{ route('update.amenities', $datas->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="amenities_name" class="form-label">Amenitie name</label>
                                    <input type="text" class="form-control @error('amenities_name') is-invalid @enderror" id="amenities_name"
                                        name="amenities_name" value="{{ $datas->amenities_name }}">
                                       @error('amenities_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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

@endsection
