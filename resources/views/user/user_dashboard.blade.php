<!DOCTYPE html>
<html lang="en">

<head>
   @include('user.css')

</head>


<!-- page wrapper -->

<body>

    <div class="boxed_wrapper">


        <!-- preloader -->
        @include('user.preload')
        <!-- preloader end -->


        <!-- switcher menu -->

        <!-- end switcher menu -->


        <!-- main header -->
        @include('user.header')
        <!-- main-header end -->

        <!-- Mobile Menu  -->
        @include('user.mobile_menu')
        <!-- End Mobile Menu -->


        <!-- Main Section -->
        @yield('user')
        <!-- End Main Section -->


        <!-- main-footer -->
        @include('user.footer')
        <!-- main-footer end -->



        <!--Scroll to top-->
        <button class="scroll-top scroll-to-target" data-target="html">
            <span class="fal fa-angle-up"></span>
        </button>
    </div>


   <!-- Script Section-->
   @include('user.script')
   <!-- End Script Section-->

</body>

<!-- End of .page_wrapper -->

</html>
