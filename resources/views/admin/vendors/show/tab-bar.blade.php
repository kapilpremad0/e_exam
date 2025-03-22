
{{-- @if ($user->is_approval == 1) --}}
<ul class="nav nav-pills mb-2">

    <!-- account -->
    <li class="nav-item">
        <a class="nav-link {{ Request::routeIs('admin.vendors.show') ? 'active' : '' }}" href="{{ route('admin.vendors.show',$user->id) }}">
            <i data-feather="user" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Detail</span>
        </a>
    </li>
    <!-- security -->

    
    <!-- billing and plans -->
    <li class="nav-item">
        <a class="nav-link {{ Request::routeIs('admin.vendors.subscriptions') ? 'active' : '' }}" href="{{ route('admin.vendors.subscriptions',$user->id) }}">
            <i data-feather="bookmark" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Subscriptions</span>
        </a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link {{ Request::routeIs('admin.vendors.transactions') ? 'active' : '' }}" href="{{ route('admin.vendors.transactions',$user->id) }}">
            <i data-feather="bookmark" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Transaction</span>
        </a>
    </li> --}}
    
    {{-- <li class="nav-item">
        <a class="nav-link {{ Request::routeIs('admin.vendors.winners') ? 'active' : '' }}" href="{{ route('admin.vendors.winners',$user->id) }}">
            <i data-feather="bookmark" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Winner</span>
        </a>
    </li> --}}



    
</ul>

{{-- @endif --}}