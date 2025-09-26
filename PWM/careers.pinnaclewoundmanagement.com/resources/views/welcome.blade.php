<?php
$jc = collect($jobs)->groupBy("StateName");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pinnacle Wound Management - Careers</title>
        <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
        <link href="../structure.css" rel="stylesheet">
        <link href="../bootstrap.min.css" rel="stylesheet">
        <link href='../main.css' rel='stylesheet'>
        <link href='../customcss.css' rel='stylesheet'>
        <script  src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
    </head>
    <body class="d-flex flex-column min-vh-100">
        <div class="header-container fixed-top">
            <header class="header navbar navbar-expand-sm" style="border-radius: 0px;">

                <ul class="navbar-nav theme-brand flex-row  text-center">
                    <li class="nav-item">
                        <a href="/">
                            <img src="/logo.png" alt="logo">
                        </a>
                    </li>
                    <li class="nav-item theme-text">

                    </li>
                </ul>
                <ul class="navbar-item flex-row ml-md-auto">
                    <li class="navbar-item flex-row ml-md-auto">
                        <a href="/" class="nav-link dropdown-toggle text-white">Home</a>
                    </li>
                    <li class="navbar-item flex-row ml-md-auto">
                        <a href="https://www.pinnaclewoundmanagement.com/about-us.html" class="nav-link dropdown-toggle text-white">About Us</a>
                    </li>
                    <li class="navbar-item flex-row ml-md-auto">
                        <a href="https://www.pinnaclewoundmanagement.com/contact-us.html" class="nav-link dropdown-toggle text-white">Contact Us</a>
                    </li>
                </ul>
            </header>
        </div>
            <div class="main-container" id="container">
                <div id="content" class="main-content text-center col-lg-12">
                    <div class="col-lg-12">

                        <div class="">
                            <h2 class="headertext">Current Job Openings</h2>

                            <div class="col-lg-6 text-right" style="margin: auto;">
                                <span>Filter: </span>
                                <select class="form-control-sm" id="filter">
                                    <option></option>
                                    
                                    @foreach($jc as $c=>$v)
                                    <option value="#{{collect(collect($v)->unique('State')->values())->pluck("State")[0]}}">{{$c}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @foreach($jc as $c=>$v)
                            <div class="col-lg-12 text-center" id="{{collect(collect($v)->unique('State')->values())->pluck("State")[0]}}">
                                <div class="mt-4 mb-4 font-weight-bold text-info">{{$c}}</div>
                                @foreach($v as $j)
                                <ul class="list-group list-group-icons-meta col-lg-6 pb-2" style="margin:auto;">
                                    <li class="list-group-item list-group-item-action">
                                        <div class="row">
                                            <div class="media-body text-left col-lg-6">
                                               <h6 class="tx-inverse font-weight-bold">{{$j->Title}}</h6>
                                           </div>
                                           <div class="media-body text-right col-lg-6">
                                               <h6 class="tx-inverse font-weight-bold">{{$j->City . ', ' . $j->State}}</h6>
                                           </div>
                                        </div>
                                        <div class="row col-lg-12">
                                            <p class="mg-b-0 text-left">
                                                {{str_replace('<p>', '', \Illuminate\Support\Str::limit($j->Description, 200, $end='...'))}}
                                                <a href="/open-positions/{{$j->Slug}}" class="text-primary font-weight-bold">Read more</a>
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                                @endforeach
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                    
                </div>
            </div>
            
        <footer class="mt-auto" style="background-color: #eee; border-top: 1px solid #ddd;">
            
                <div class="copyright text-center mt-4 mb-4">
        <img src="../logo.png">
        <p></p>
      &copy;
      <script>
        document.write(new Date().getFullYear())
      </script>, all copyrights are reserved at PinnacleWoundManagement.com
    </div>
            </footer>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#filter').change( function () {
                    var targetPosition = $($(this).val()).offset().top;
                    $('html,body').animate({ scrollTop: targetPosition}, 'slow');
                });
            });
        </script>
    </body>
</html>
