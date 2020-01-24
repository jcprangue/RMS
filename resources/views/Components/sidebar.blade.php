<div class="wrapper">

        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header mb-5">
                <div class="user-panel">
                  <a class="float-left image" href="#">
                    <img src="{{ asset('/images/comment-gravatar.gif')}}" class="img-fluid rounded-circle" alt="User Image">
                  </a>
                  <div class="float-left info">
                    <p class="mb-1"><a href="#">{{ Auth::user()->name }}</a></p>
                    <small><small><a href="#"><span><i class="fa fa-user-circle-o"></i> My Account</span></a> &nbsp;  &nbsp; <a href="/logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></small></small>
                  </div>
                </div>
                
            </div>
            <ul class="list-unstyled components">
                
                <li>
                    <a href="/home">&nbsp;<i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp; Dashboard</a>
                </li>
                
                @if( Auth::user()->acl == 1 || Auth::user()->acl == 2 || Auth::user()->acl == 4 || Auth::user()->acl == 5)
                <li>
                    <a href="{{ url('incoming') }}">&nbsp;<i class="fa fa-file-o" aria-hidden="true"></i>&nbsp; Incoming</a>
                </li>
                @endif

                @if( Auth::user()->acl == 1 || Auth::user()->acl == 3 || Auth::user()->acl == 4 || Auth::user()->acl == 5)
                <li>
                    <a href="{{ url('outgoing') }}">&nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp; Outgoing</a>
                </li>
                @endif
<!--                 <li>
                    <a href="{{ url('incoming') }}">&nbsp;<i class="fa fa-file-o" aria-hidden="true"></i>&nbsp; Incoming</a>
                </li> 
                <li>
                    <a href="{{ url('outgoing') }}">&nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp; Outgoing</a>
                </li>-->
                
            </ul>
        </nav>