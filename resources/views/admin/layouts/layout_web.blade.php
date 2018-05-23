<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>

<head>
    <title>Luscious a Restaurant Category Bootstrap responsive WebTemplate | Home :: w3layouts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Luscious a Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

    <script type="application/x-javascript">
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link href="{{asset('css/joyslove/bootstrap.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('css/joyslove/wickedpicker.css')}}" rel="stylesheet" type='text/css' media="all" />
    <link href="{{asset('css/joyslove/easy-responsive-tabs.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('css/joyslove/style.css')}}" rel='stylesheet' type='text/css' />
    {{--<link href="{{asset('css/joyslove/font-awesome.css')}}" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
          rel='stylesheet' type='text/css'>

    <link rel="stylesheet " href="{{asset('css/joyslove/chocolat.css')}}" type="text/css" media="all" />
    @yield('css')
</head>

<body>
@yield('content')

<!-- js -->
<script type="text/javascript" src="{{asset('js/joyslove/jquery-2.2.3.min.js')}}"></script>
<!-- //js -->
<!--search-bar-->
<script src="{{asset('js/joyslove/main.js')}}"></script>
<!--//search-bar-->

<!-- js for portfolio lightbox -->
<script src="{{asset('js/joyslove/jquery.chocolat.js')}}"></script>

<!--light-box-files -->
<script type="text/javascript ">
    $(function () {
        $('.portfolio-grids a').Chocolat();
    });
</script>
<!-- /js for portfolio lightbox -->
<!-- Calendar -->
<link rel="stylesheet" href="{{asset('css/joyslove/jquery-ui.css')}}" />
<script src="{{asset('js/joyslove/jquery-ui.js')}}"></script>
<script>
    $(function () {
        $("#datepicker,#datepicker1,#datepicker2,#datepicker3").datepicker();
    });
</script>
<!-- //Calendar -->

<!-- time -->
<script type="text/javascript" src="{{asset('js/joyslove/wickedpicker.js')}}"></script>
<script type="text/javascript">
    $('.timepicker').wickedpicker({
        twentyFour: false
    });
</script>
<!-- //time -->

<script src="{{asset('js/joyslove/responsiveslides.min.js')}}"></script>
<script>
    $(function () {
        $("#slider4").responsiveSlides({
            auto: true,
            pager: true,
            nav: true,
            speed: 1000,
            namespace: "callbacks",
            before: function () {
                $('.events').append("<li>before event fired.</li>");
            },
            after: function () {
                $('.events').append("<li>after event fired.</li>");
            }
        });
    });
</script>
<!-- script for responsive tabs -->
<script src="{{asset('js/joyslove/easy-responsive-tabs.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true, // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            activate: function (event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
        $('#verticalTab').easyResponsiveTabs({
            type: 'vertical',
            width: 'auto',
            fit: true
        });
    });
</script>
<!--// script for responsive tabs -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="{{asset('js/joyslove/move-top.js')}}"></script>
<script type="text/javascript" src="{{asset('js/joyslove/easing.js')}}"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $(".scroll").click(function (event) {
            event.preventDefault();
            $('html,body').animate({
                scrollTop: $(this.hash).offset().top
            }, 900);
        });
    });
</script>
<!-- start-smoth-scrolling -->

<script type="text/javascript">
    $(document).ready(function () {
        /*
                                var defaults = {
                                      containerID: 'toTop', // fading element id
                                    containerHoverID: 'toTopHover', // fading element hover id
                                    scrollSpeed: 1200,
                                    easingType: 'linear'
                                 };
                                */

        $().UItoTop({
            easingType: 'easeOutQuart'
        });

    });
</script>
<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<script type="text/javascript" src="{{asset('js/joyslove/bootstrap-3.1.1.min.js')}}"></script>
@yield('js')
@yield('footer-js')
</body>
</html>