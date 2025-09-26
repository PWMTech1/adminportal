<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{$metaTitle}}</title>
        <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
        <link href="../structure.css" rel="stylesheet">
        <link href="../bootstrap.min.css" rel="stylesheet">
        <link href='../main.css' rel='stylesheet'>
        <link href='../customcss.css' rel='stylesheet'>
        <script type="text/javascript" src="../jquery-3.1.1.min.js"></script>
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
                        <h3 class="headertext">{{$job[0]->Title}}</h3>
                        <p class="font-weight-bold">
                            {{$job[0]->City . ', ' . $job[0]->State}}
                        </p>
                        <div class="row">
                            <div class="col-lg-6 text-left" style="margin: auto;">
                                {!! $job[0]->Description !!}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 pr-0 pl-0">
                        <div class="card bg-info">
                            <div class="card-body">
                                <div class="col-lg-4" style="margin: auto;">
                                    <form onsubmit="return false;">
                                        @csrf()
                                        <input type="hidden" id="hdnPostId" value="{{$job[0]->id}}">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group text-left">
                                                    <span>First Name</span>
                                                    <input type="text" class="form-control form-control-sm" id="firstname" placeholder="First Name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group text-left">
                                                    <span>Last Name</span>
                                                    <input type="text" class="form-control form-control-sm" placeholder="Last Name" required id="lastname">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group text-left">
                                                    <span>Email</span>
                                                    <input type="email" class="form-control form-control-sm" id="email" placeholder="Email" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group text-left">
                                                    <span>Phone</span>
                                                    <input type="text" class="form-control form-control-sm" placeholder="Phone" required id="phone">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group text-left">
                                                    <span>Resume / CV</span>
                                                    <input type="file" class="custom-file-container__custom-file__custom-file-input" id="cv" name="file" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <button type="submit" class="btn btn-light" id="btnSubmit">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

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
            $(document).on("click", "#btnSubmit", function(){
            var fd = new FormData();
            fd.append('PostId', $("#hdnPostId").val());
            fd.append("FirstName", $("#firstname").val());
            fd.append("LastName", $("#lastname").val());
            fd.append("Email", $("#email").val());
            fd.append("Phone", $("#phone").val());
            const fileInput = document.getElementById('cv');
            fd.append("CV", fileInput.files[0]);
            fd.append("FileName", fileInput.files[0].name);
            fd.append("Extension", fileInput.files[0].type);
            //console.log(fd);
            $.ajax({
                    type: 'POST',
                    url: '/post/saveapplicant',
                    data: fd,
                    processData: false,
                    contentType: false
                }).done(function(data) {
                    console.log(data);
                       alert("Your application has been submitted");
                       window.location.reload();
                });
            });
        </script>
    </body>
</html>
