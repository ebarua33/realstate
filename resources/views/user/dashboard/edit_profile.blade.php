@extends('user.user_dashboard')

@section('user')
    <!--Page Title-->
    <section class="page-title centred" style="background-image: url(frontend/assets/images/background/page-title-5.jpg);">
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>User Profile </h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="index.html">Home</a></li>
                    <li>User Profile </li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->


    <!-- sidebar-page-container -->
    <section class="sidebar-page-container blog-details sec-pad-2">
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="blog-sidebar">
                        <div class="sidebar-widget post-widget">
                            <div class="widget-title">
                                <h4>User Profile </h4>
                            </div>
                            <div class="post-inner">
                                <div class="post">
                                    <figure class="post-thumb">
                                        <a href="blog-details.html"></a>
                                        <img src="{{ !empty($data->photo) ? url($data->photo) : url('upload/no_image.jpg') }}" alt="">
                                    </figure>
                                    <h5><a href="blog-details.html">{{ Auth::user()->name }}</a></h5>
                                    <p>{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-widget category-widget">
                            <div class="widget-title">
                                <h4>Category</h4>
                            </div>
                            @include('user.dashboard.dashboard_sidebar')
                        </div>

                    </div>
                </div>




                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="blog-details-content">
                        <div class="news-block-one">
                            <div class="inner-box">

                                <div class="lower-content">
                                    <h3>Edit Profile</h3>


                                    <form class="default-form" action="{{ route('store.profile') }}" method="post"  enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" id="name" required=""
                                                value="{{ $data->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label>User Name</label>
                                            <input type="text" name="username" id="username" required=""
                                                value="{{ $data->username }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" id="email" required=""
                                                value="{{ $data->email }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone" id="phone" required=""
                                                value="{{ $data->phone }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="address" id="address" required=""
                                                value="{{ $data->address }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="photo" class="form-label">Photo</label>
                                            <input type="file" class="form-control" name="photo" id="photo"
                                                onchange="previewImage(event)">
                                        </div>

                                        <div class="form-group">
                                            <img class="wd-70 rounded-circle" src="{{ !empty($data->photo) ? url($data->photo) : url('upload/no_image.jpg') }}"
                                                alt="profile" id="showimage" style="width: 100px; height: 100px" />
                                        </div>


                                        <div class="form-group message-btn">
                                            <button type="submit" class="theme-btn btn-one">Save Changes</button>
                                        </div>
                                    </form>



                                </div>
                            </div>
                        </div>


                    </div>


                </div>


            </div>
        </div>
    </section>
    <!-- sidebar-page-container -->

    <!-- subscribe-section -->
    <section class="subscribe-section bg-color-3">
        <div class="pattern-layer" style="background-image: url(frontend/assets/images/shape/shape-2.png);"></div>
        <div class="auto-container">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                    <div class="text">
                        <span>Subscribe</span>
                        <h2>Sign Up To Our Newsletter To Get The Latest News And Offers.</h2>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 form-column">
                    <div class="form-inner">
                        <form action="contact.html" method="post" class="subscribe-form">
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Enter your email" required="">
                                <button type="submit">Subscribe Now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- subscribe-section end -->

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
