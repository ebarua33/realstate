@extends('admin.admin_dashboard')

@section('admin')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <div class="page-content">
        <div class="row profile-body">
            <!-- middle wrapper start -->
            <div class="col-md-12 col-xl-12 middle-wrapper">
                <div class="row">
                    <div class="col-md-12 stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Form Grid</h6>
                                <form method="POST" id="myForm" action="{{ route('store.property') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Property Name</label>
                                                <input type="text" class="form-control" name="property_name"
                                                    id="property_name" placeholder="Enter first name">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Property Status</label>
                                                <select class="form-select" name="property_status" id="property_status">
                                                    <option selected="" disabled="">Select Status</option>
                                                    <option value="rent">For Rent</option>
                                                    <option value="buy">For Buy</option>
                                                </select>
                                            </div>
                                        </div><!-- Col -->
                                    </div><!-- Row -->

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Lowest Price</label>
                                                <input type="text" class="form-control" name="lowest_price"
                                                    id="lowest_price" placeholder="Enter first name">
                                            </div>
                                        </div><!-- Col -->

                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Max Price</label>
                                                <input type="text" class="form-control" name="max_price" id="max_price"
                                                    placeholder="Enter first name">
                                            </div>
                                        </div><!-- Col -->
                                    </div><!-- Row -->

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label">Property Thumbnail</label>
                                                <input type="file" class="form-control" name="property_thumbnail"
                                                    id="property_thubmnail" onchange="mainThumUrl(this)"
                                                    placeholder="Choose Image">
                                                <img src="" id="mainThum" alt="">
                                            </div>
                                        </div><!-- Col -->

                                        <div class="col-sm-6">
                                            <div class="form-group mb-3">
                                                <label class=" form-label">Multi Images</label>
                                                <input type="file" class="form-control" name="photo_name[]"
                                                    id="photo_name" placeholder="Enter first name" multiple>
                                                <div class="row" id="preview_img"></div>
                                            </div>
                                        </div><!-- Col -->
                                    </div><!-- Row -->

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class=" mb-3">
                                                <label class="form-label">Bedrooms</label>
                                                <input type="text" class="form-control" name="bedrooms">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-3">
                                            <div class=" mb-3">
                                                <label class="form-label">Bathrooms</label>
                                                <input type="text" class="form-control" name="bathrooms">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-3">
                                            <div class=" mb-3">
                                                <label class="form-label">Garage</label>
                                                <input type="text" class="form-control" name="garage">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-3">
                                            <div class=" mb-3">
                                                <label class="form-label">Garage Size</label>
                                                <input type="text" class="form-control" name="garage_size">
                                            </div>
                                        </div><!-- Col -->
                                    </div><!-- Row -->

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class=" mb-3">
                                                <label class="form-label">Address</label>
                                                <input type="text" class="form-control" name="address">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-3">
                                            <div class=" mb-3">
                                                <label class="form-label">City</label>
                                                <input type="text" class="form-control" name="city">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-3">
                                            <div class=" mb-3">
                                                <label class="form-label">State</label>
                                                <input type="text" class="form-control" name="state">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-3">
                                            <div class=" mb-3">
                                                <label class="form-label">Postal Code</label>
                                                <input type="text" class="form-control" name="postal_code">
                                            </div>
                                        </div><!-- Col -->
                                    </div><!-- Row -->

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class=" mb-3">
                                                <label class="form-label">Property Size</label>
                                                <input type="text" class="form-control" name="property_size">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class=" form-label">Property Video</label>
                                                <input type="file" class="form-control" name="property_video">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-4">
                                            <div class=" mb-3">
                                                <label class="form-label">Neighborhood</label>
                                                <input type="text" class="form-control" name="neighborhood">
                                            </div>
                                        </div><!-- Col -->
                                    </div><!-- Row -->


                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class=" mb-3">
                                                <label class="form-label">Latitude</label>
                                                <input type="text" class="form-control" name="latitude">
                                                <a href="https://www.itilog.com/" target="_blank">Go here to get
                                                    Latitude</a>
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">
                                            <div class=" mb-3">
                                                <label class="form-label">Longitude</label>
                                                <input type="text" class="form-control" name="longitude">
                                                <a href="https://www.itilog.com/" target="_blank">Go here to get
                                                    Longitude</a>
                                            </div>
                                        </div><!-- Col -->
                                    </div><!-- Row -->


                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class=" mb-3">
                                                <label class="form-label">Property Type</label>
                                                <select class="form-select" name="propertytype_id" id="propertytype_id">
                                                    <option selected="" disabled="">Select Property type</option>
                                                    @foreach ($propertyType as $data)
                                                        <option value="{{ $data->id }}">{{ $data->type_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-4">
                                            <div class=" mb-3">
                                                <label class="form-label">Property Amenities</label>
                                                <select class="js-example-basic-multiple form-select" name="amenities_id[]"
                                                    multiple="multiple" data-width="100%">
                                                    @foreach ($amenities as $data)
                                                        <option value="{{ $data->id }}">{{ $data->amenities_name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-4">
                                            <div class=" mb-3">
                                                <label class="form-label">Agent</label>
                                                <select class="form-select" name="agent_id" id="agent_id">
                                                    <option selected="" disabled="">Select Agent</option>
                                                    @foreach ($agent as $data)
                                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div><!-- Col -->
                                    </div><!-- Row -->


                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">Short Description</label>
                                            <textarea class="form-control" name="short_desc" id="short_desc" rows="2"></textarea>
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">Long Description</label>
                                            <textarea class="form-control" name="long_desc" name="tinymce" id="tinymceExample" rows="10"></textarea>
                                        </div>
                                    </div><!-- Col -->

                                    <hr>

                                    <div class="mb-3">
                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" name="featured" value="1"
                                                class="form-check-input" id="checkInline1">
                                            <label class="form-check-label" for="checkInline1">
                                                Features Property
                                            </label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input type="checkbox" name="hot" value="1"
                                                class="form-check-input" id="checkInline2">
                                            <label class="form-check-label" for="checkInline2">
                                                Hot Property
                                            </label>
                                        </div>
                                    </div>


                                    {{-- //////////////// Facility Item //////////// --}}
                                    <div class="row add_item">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="facility_name" class="form-label">Facilities </label>
                                                <select name="facility_name[]" id="facility_name" class="form-control">
                                                    <option value="">Select Facility</option>
                                                    <option value="Hospital">Hospital</option>
                                                    <option value="SuperMarket">Super Market</option>
                                                    <option value="School">School</option>
                                                    <option value="Entertainment">Entertainment</option>
                                                    <option value="Pharmacy">Pharmacy</option>
                                                    <option value="Airport">Airport</option>
                                                    <option value="Railways">Railways</option>
                                                    <option value="Bus Stop">Bus Stop</option>
                                                    <option value="Beach">Beach</option>
                                                    <option value="Mall">Mall</option>
                                                    <option value="Bank">Bank</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="distance" class="form-label"> Distance </label>
                                                <input type="text" name="distance[]" id="distance"
                                                    class="form-control" placeholder="Distance (Km)">
                                            </div>
                                        </div>
                                        <div class=" col-md-4" style="padding-top: 30px;">
                                            <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add
                                                More..</a>
                                        </div>
                                    </div> <!---end row-->


                                    {{-- //////////////// Facility Item End//////////// --}}

                                      <button type="sybmit" class="btn btn-primary">Save</button>

                                </form>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- middle wrapper end -->
            <!-- right wrapper start -->

            <!-- right wrapper end -->
        </div>
    </div>


    <!--========== Start of add multiple class with ajax ==============-->
    <div style="visibility: hidden">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                <div class="container mt-2 mb-3">
                    <div class="row">

                        <div class=" col-md-4">
                            <label for="facility_name">Facilities</label>
                            <select name="facility_name[]" id="facility_name" class="form-control">
                                <option value="">Select Facility</option>
                                <option value="Hospital">Hospital</option>
                                <option value="SuperMarket">Super Market</option>
                                <option value="School">School</option>
                                <option value="Entertainment">Entertainment</option>
                                <option value="Pharmacy">Pharmacy</option>
                                <option value="Airport">Airport</option>
                                <option value="Railways">Railways</option>
                                <option value="Bus Stop">Bus Stop</option>
                                <option value="Beach">Beach</option>
                                <option value="Mall">Mall</option>
                                <option value="Bank">Bank</option>
                            </select>
                        </div>
                        <div class=" col-md-4">
                            <label for="distance">Distance</label>
                            <input type="text" name="distance[]" id="distance" class="form-control"
                                placeholder="Distance (Km)">
                        </div>
                        <div class=" col-md-4" style="padding-top: 20px">
                            <span class="btn btn-success btn-sm addeventmore"><i class="fa fa-plus-circle">Add</i></span>
                            <span class="btn btn-danger btn-sm removeeventmore"><i
                                    class="fa fa-minus-circle">Remove</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



            <!----For Section-------->
<script type="text/javascript">
   $(document).ready(function(){
      var counter = 0;
      $(document).on("click",".addeventmore",function(){
            var whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
      });
      $(document).on("click",".removeeventmore",function(event){
            $(this).closest("#whole_extra_item_delete").remove();
            counter -= 1
      });
   });
</script>
<!--========== End of add multiple class with ajax ==============-->



<!--========== Java Script Validation ==============-->
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    property_name: {
                        required: true,
                    },

                    property_status: {
                        required: true,
                    },

                    lowest_price: {
                        required: true,
                    },

                    max_price: {
                        required: true,
                    },

                },
                messages: {
                    property_name: {
                        required: 'Please Enter Property Name',
                    },

                    property_status: {
                        required: 'Please Enter Property Status',
                    },

                    lowest_price: {
                        required: 'Please Enter Lowest Price',
                    },

                    max_price: {
                        required: 'Please Enter Max Price',
                    },

                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>

<!--========== Toastr ==============-->
    <script type="text/javascript">
        function mainThumUrl(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#mainThum').attr('src', e.target.result).width(80).height(80);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>


<!--========== Show Multiple Image With Javascript ==============-->
    <script>
        $(document).ready(function() {
            $('#photo_name').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png|webp|avif)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(100)
                                        .height(80); //create image element
                                    $('#preview_img').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>
@endsection



