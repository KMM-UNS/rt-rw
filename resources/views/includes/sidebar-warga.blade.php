@php
$sidebarClass = !empty($sidebarTransparent) ? 'sidebar-transparent' : '';
@endphp
<!-- begin #sidebar -->
<div id="sidebar" class="sidebar {{ $sidebarClass }}">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        @if (!$sidebarSearch)
            <!-- begin sidebar user -->
            <ul class="nav">
                <li class="nav-profile">
                    <a href="javascript:;" data-toggle="nav-profile">
                        <div class="cover with-shadow"></div>
                        <div class="image">
                            <img src="/assets/img/user/user-13.jpg" alt="" />
                        </div>
                        <div class="info">
                            <b class="caret pull-right"></b>
                            {{ Auth::user()->name }}
                            <small>Warga</small>
                        </div>
                    </a>
                </li>
                {{-- <li>
                    <ul class="nav nav-profile">
                        <li><a href="javascript:;"><i class="fa fa-cog"></i> Settings</a></li>
                        <li><a href="javascript:;"><i class="fa fa-pencil-alt"></i> Send Feedback</a></li>
                        <li><a href="javascript:;"><i class="fa fa-question-circle"></i> Helps</a></li>
                    </ul>
                </li> --}}
            </ul>
            <!-- end sidebar user -->
        @endif
        <!-- begin sidebar nav -->
        <ul class="nav">
            @if ($sidebarSearch)
                <li class="nav-search">
                    <input type="text" class="form-control" placeholder="Sidebar menu filter..."
                        data-sidebar-search="true" />
                </li>
            @endif
            <li class="nav-header">Navigation</li>

        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->
