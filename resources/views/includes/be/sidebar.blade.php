<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand mt-2">
            <a href="index.html">
                <img src="{{ asset('be/gambar-logo.jpeg')  }}" alt="" style="width: 100px;">
            </a>
        </div>

        <ul class="sidebar-menu mt-5">

            <li><a class="nav-link" href="{{ route('dashboard') }}"><i class="far fa-square"></i> <span>Blank Page</span></a></li>

            <li class="menu-header">Blog</li>

            <li><a class="nav-link" href="{{ route('kategori-artikel') }}"><i class="fas fa-tag"></i> <span>Kategori</span></a></li>
            <li><a class="nav-link" href="{{ route('tag-artikel') }}"><i class="fas fa-tag"></i> <span>Tag</span></a></li>
            <li><a class="nav-link" href="{{ route('artikel') }}"><i class="fas fa-globe"></i> <span>Artikel</span></a></li>
            <!-- <li><a class="nav-link" href="{{ route('tanya_jawab') }}"><i class="fas fa-globe"></i> <span>Tanya Jawab</span></a></li> -->

            <li class="menu-header">Video Edukasi</li>
            <li><a class="nav-link" href="{{ route('video_edukasi') }}"><i class="fas fa-video"></i> <span>Manajemen Video</span></a></li>

            <li class="menu-header">Pengaturan</li>
            <li><a class="nav-link" href="{{ route('slider') }}"><i class="fas fa-images"></i> <span>Slider</span></a></li>
            <li><a class="nav-link" href="{{ route('permissions') }}"><i class="fas fa-cog"></i> <span>Hak Akses</span></a></li>
            <li><a class="nav-link" href="{{ route('role') }}"><i class="fas fa-list"></i> <span>Level Pengguna</span></a></li>
            <li><a class="nav-link" href="{{ route('user') }}"><i class="fas fa-users"></i> <span>Pengguna</span></a></li>


        </ul>


    </aside>
</div>
