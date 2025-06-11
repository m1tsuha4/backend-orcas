<!-- Vendor JS Files -->
<script src="{{ asset('dist_front/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist_front/assets/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('dist_front/assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('dist_front/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('dist_front/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('dist_front/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
<script src="{{ asset('dist_front/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('dist_front/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('dist_front/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

<!-- Main JS File -->
<script src="{{ asset('dist_front/assets/js/main.js') }}"></script>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script>
            iziToast.error({
                title: '',
                position: 'topRight',
                message: '{{ $error }}',
            });
        </script>
    @endforeach

 @endif

 @if (session()->get('success'))
     <script>
         iziToast.success({
             title: '',
             position: 'topRight',
             message: '{{ session()->get('success') }}',
         });
     </script>
 @endif

 @if (session()->get('error'))
     <script>
         iziToast.error({
             title: '',
             position: 'topRight',
             message: '{{ session()->get('error') }}',
         });
     </script>
 @endif
