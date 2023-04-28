<!DOCTYPE html>
<html lang="en">

@include('layouts.head')
<body class="">
<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>
<!-- [ Pre-loader ] End -->
<!-- [ navigation menu ] start -->

@include('layouts.sidebar')

<!-- [ navigation menu ] end -->
<!-- [ Header ] start -->
@include('layouts.header')
<!-- [ Header ] end -->



<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">


      @yield('content')

    </div>
</div>
<!-- [ Main Content ] end -->


<!-- Required Js -->
@include('layouts.scripting')
</body>

</html>
