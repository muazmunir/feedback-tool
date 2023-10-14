<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">{{ __('Main') }}</li>
        <li>
            <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                <i class="mdi mdi-home"></i>
                <span>{{ __('Dashboard') }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('feedback-items.index') }}" class="waves-effect">
                <i class="mdi mdi-comment-account"></i>
                <span>{{ __('Feedback Items') }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('users.index') }}" class="waves-effect">
                <i class="fas fa-user"></i>
                <span>{{ __('Users') }}</span>
            </a>
        </li>
 
    </ul>
</div>