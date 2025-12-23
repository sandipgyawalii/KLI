<div class="main-sidebar sidebar-style-4">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index-2.html">{{ $all_view['profile']->title ?? env('APP_NAME') }}</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index-2.html">CP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            @if (Route::has('admin.dashboard'))
                <li class="{{ $panel == 'Dashboard' ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}"
                        class="nav-link "><i class="fas fa-fire"></i><span>Dashboard</span></a>
                </li>
            @endif
            <li class="menu-header">Profile</li>
            @if (Route::has('admin.profile.index'))
                <li class="dropdown {{ $panel == 'Profile' ? 'active' : '' }}">
                    <a href="{{ route('admin.profile.index') }}" class="nav-link "><i class="fas fa-columns"></i>
                        <span>Profile</span></a>
                </li>
            @endif

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i>
                    <span>Students</span></a>
                <ul class="dropdown-menu">
                    @if (Route::has('admin.student.index'))
                        <li><a class="nav-link " href="{{ route('admin.student.index') }}">All Students </a></li>
                    @endif

                    @if (Route::has('admin.blog.index'))
                        <li><a class="nav-link " href="{{ route('admin.blog.index') }}">Add Student </a></li>
                    @endif

                    @if (Route::has('admin.blog.index'))
                        <li><a class="nav-link " href="{{ route('admin.blog.index') }}">Shortlisted Students </a></li>
                    @endif
                    @if (Route::has('admin.blog.index'))
                        <li><a class="nav-link " href="{{ route('admin.blog.index') }}">Student Fee Status </a></li>
                    @endif
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Courses</span></a>
                <ul class="dropdown-menu">
                    @if (Route::has('admin.course.index'))
                        <li><a class="nav-link " href="{{ route('admin.course.index') }}">All Courses </a></li>
                    @endif

                    @if (Route::has('admin.blog.index'))
                        <li><a class="nav-link " href="{{ route('admin.blog.index') }}">Add Course </a></li>
                    @endif

                    @if (Route::has('admin.blog.index'))
                        <li><a class="nav-link " href="{{ route('admin.blog.index') }}">Assign Course </a></li>
                    @endif
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i>
                    <span>Payments</span></a>
                <ul class="dropdown-menu">
                    @if (Route::has('admin.blogcategory.index'))
                        <li><a class="nav-link " href="{{ route('admin.blogcategory.index') }}">Record Payment </a>
                        </li>
                    @endif

                    @if (Route::has('admin.blog.index'))
                        <li><a class="nav-link " href="{{ route('admin.blog.index') }}">Payment History </a></li>
                    @endif

                    @if (Route::has('admin.blog.index'))
                        <li><a class="nav-link " href="{{ route('admin.blog.index') }}">Pending Payments </a></li>
                    @endif
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Reports</span></a>
                <ul class="dropdown-menu">
                    @if (Route::has('admin.blogcategory.index'))
                        <li><a class="nav-link " href="{{ route('admin.blogcategory.index') }}">Student Fee Report </a>
                        </li>
                    @endif

                    @if (Route::has('admin.blog.index'))
                        <li><a class="nav-link " href="{{ route('admin.blog.index') }}">Monthly Collection </a></li>
                    @endif

                    @if (Route::has('admin.blog.index'))
                        <li><a class="nav-link " href="{{ route('admin.blog.index') }}">Pending Fee Report </a></li>
                    @endif
                    @if (Route::has('admin.blog.index'))
                        <li><a class="nav-link " href="{{ route('admin.blog.index') }}">New Vs Old Students </a></li>
                    @endif
                </ul>
            </li>

                <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i> <span>Settings</span></a>
                <ul class="dropdown-menu">
                    @if (Route::has('admin.blogcategory.index'))
                        <li><a class="nav-link " href="{{ route('admin.blogcategory.index') }}">User Management </a>
                        </li>
                    @endif

                    @if (Route::has('admin.blog.index'))
                        <li><a class="nav-link " href="{{ route('admin.blog.index') }}">Fee Settings </a></li>
                    @endif

                    @if (Route::has('admin.blog.index'))
                        <li><a class="nav-link " href="{{ route('admin.blog.iwndex') }}">Course Settings </a></li>
                    @endif
                    @if (Route::has('admin.blog.index'))
                        <li><a class="nav-link " href="{{ route('admin.blog.index') }}">Institute Info </a></li>
                    @endif
                </ul>
            </li>
        </ul>

    </aside>
</div>
