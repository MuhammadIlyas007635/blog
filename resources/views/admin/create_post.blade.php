<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dark Bootstrap Admin </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="admincss/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="admincss/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="admincss/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="admincss/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="admincss/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="admincss/img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.sidebar')
        <!-- Sidebar Navigation end-->
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Dashboard</h2>
                </div>
            </div>
            <section class="no-padding-top no-padding-bottom">
                <div class="col-lg-6">
                    <div class="block">
                        <div class="title"><strong class="d-block">Create Post</strong></div>
                        <div class="block-body">
                            <form action="{{ route('store_post') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="form-control-label">Title</label>
                                    <input type="text" placeholder="title" name="title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Description</label>
                                    <input type="description" placeholder="description" name="description" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Image</label>
                                    <input type="file" placeholder="image" name="image" class="form-control">
                                </div>


                                <div class="form-group">
                                    <input type="submit" value="Create" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>






            @include('admin.footer')
</body>

</html>
