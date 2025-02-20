  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('be/dist/assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('be/dist/assets/modules/fontawesome/css/all.min.css') }}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('be/dist/assets/modules/jqvmap/dist/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('be/dist/assets/modules/summernote/summernote-bs4.css') }}">
  <link rel="stylesheet" href="{{ asset('be/dist/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('be/dist/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.25.0/contents.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('be/dist/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('be/dist/assets/css/components.css') }}">
  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
          dataLayer.push(arguments);
      }
      gtag('js', new Date());

      gtag('config', 'UA-94034622-3');
  </script>


  @stack('style')
