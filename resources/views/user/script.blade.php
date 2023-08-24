
 <!-- jequery plugins -->
    <script src="frontend/assets/js/jquery.js"></script>
    <script src="frontend/assets/js/popper.min.js"></script>
    <script src="frontend/assets/js/bootstrap.min.js"></script>
    <script src="frontend/assets/js/owl.js"></script>
    <script src="frontend/assets/js/wow.js"></script>
    <script src="frontend/assets/js/validation.js"></script>
    <script src="frontend/assets/js/jquery.fancybox.js"></script>
    <script src="frontend/assets/js/appear.js"></script>
    <script src="frontend/assets/js/scrollbar.js"></script>
    <script src="frontend/assets/js/isotope.js"></script>
    <script src="frontend/assets/js/jquery.nice-select.min.js"></script>
    <script src="frontend/assets/js/jQuery.style.switcher.min.js"></script>
    <script src="frontend/assets/js/jquery-ui.js"></script>
    <script src="frontend/assets/js/nav-tool.js"></script>

    <!-- main-js -->
    <script src="frontend/assets/js/script.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>
