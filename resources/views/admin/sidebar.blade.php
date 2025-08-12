<nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="admincss/img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">{{Auth::user()->name}}</h1>
            {{-- <p>Web Developer</p> --}}
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="heading"></span>
        <ul class="list-unstyled">
                <li class="active"><a href="{{ url('/home') }}"> <i class="icon-home"></i>Home </a></li>
                <li><a href="{{ url('/get_post') }}"> <i class="icon-grid"></i>Tables </a></li>

                <li><a href="{{ url('/create_post') }}"> <i class="icon-padnote"></i>Create_Post </a></li>


        </ul>

      </nav>
