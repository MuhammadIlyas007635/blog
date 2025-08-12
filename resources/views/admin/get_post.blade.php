<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin </title>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <div class="block margin-bottom-sm">
                        <div class="title"><strong>Posts Table</strong></div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>

                                        <th>Username</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($posts as $post)
                                        <tr>
                                            <th scope="row">{{ $i++ }}</th>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->user->name ?? 'N/A' }}</td>

                                            <td>{{ $post->status }}</td>
                                            <td>
                                                @if ($post->image)
                                                    <img src="{{ asset('post_images/' . $post->image) }}"
                                                        alt="Post Image" height="200px" width="100px">
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" class="btn btn-danger"
                                                    onclick="confirmDelete({{ $post->id }})">
                                                    Delete
                                                </a>

                                                <form id="delete-form-{{ $post->id }}"
                                                    action="{{ url('/delete_post', $post->id) }}" method="get"
                                                    style="display: none;">
                                                    @csrf

                                                </form>
                                                <a href="{{ url('/eidt_post', $post->id) }}"
                                                    class="btn btn-primary">Edit</a>


                                                @auth
                                                    @if (Auth::user()->usertype == 'admin')
                                                        <a href="{{ url('/approve_post', $post->id) }}"
                                                            class="btn btn-success">Approved</a>
                                                    @endif
                                                @endauth
                                            </td>

                                        </tr>
                                    @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </section>






            @include('admin.footer')
</body>

</html>
<script>
    function confirmDelete(postId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + postId).submit();
            }
        });
    }
</script>
