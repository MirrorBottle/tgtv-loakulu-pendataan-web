<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{ route('dashboard') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li class="{{ Request::is('inventory-validations*') ? 'mm-active' : '' }}">
                <a href="{{ route('inventory-validations.index') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-edit"></i>
                    <span class="nav-text">Validasi</span>
                </a>
            </li>
            <li>
                <a class="has-arrow ai-icon mt-2" href="javascript:void(0);" aria-expanded="false">
                    <i class="flaticon-381-box"></i>
                    <span class="nav-text">Stok Item</span>
                </a>
                <ul aria-expanded="false">
                    <li class="{{ Request::is('inventory-logs/in*') ? 'mm-active' : '' }}"><a href="{{ route('inventory-logs.in') }}">Masuk</a></li>
                    <li class="{{ Request::is('inventory-logs/out*') ? 'mm-active' : '' }}"><a href="{{ route('inventory-logs.out') }}">Keluar</a></li>
                    <li class="{{ Request::is('inventory-logs/all*') ? 'mm-active' : '' }}"><a href="{{ route('inventory-logs.all') }}">Semua</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow ai-icon mt-2" href="javascript:void(0);" aria-expanded="false">
                    <i class="flaticon-381-internet"></i>
                    <span class="nav-text">Website Master</span>
                </a>
                <ul aria-expanded="false">
                    <li class="{{ Request::is('galleries*') ? 'mm-active' : '' }}"><a href="{{ route('galleries.index') }}">Galeri</a></li>
                    <li class="{{ Request::is('experiences*') ? 'mm-active' : '' }}"><a href="{{ route('experiences.index') }}">Experience</a></li>
                    <li class="{{ Request::is('inboxes*') ? 'mm-active' : '' }}"><a href="{{ route('inboxes.index') }}">Inbox</a></li>
                    <li class="{{ Request::is('missions*') ? 'mm-active' : '' }}"><a href="{{ route('missions.index') }}">Visi Misi</a></li>
                    <li class="{{ Request::is('setting*') ? 'mm-active' : '' }}"><a href="{{ route('setting.index') }}">Setting</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow ai-icon mt-2" href="javascript:void(0);" aria-expanded="false">
                    <i class="flaticon-381-database"></i>
                    <span class="nav-text">Master Data</span>
                </a>
                <ul aria-expanded="false">
                    <li class="{{ Request::is('users*') ? 'mm-active' : '' }}"><a href="{{ route('users.index') }}">Daftar Pengguna</a></li>
                    <li class="{{ Request::is('inventory-items*') ? 'mm-active' : '' }}"><a href="{{ route('inventory-items.index') }}">Daftar Item</a></li>
                    <li class="{{ Request::is('inventory-categories*') ? 'mm-active' : '' }}"><a href="{{ route('inventory-categories.index') }}">Kategori Item</a></li>
                </ul>
            </li>
            <li class="{{ Request::is('invoice*') ? 'mm-active' : '' }}">
                <a href="{{ route('invoice.index') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-file"></i>
                    <span class="nav-text">Buat Invoice</span>
                </a>
            </li>
        </ul>
    </div>
</div>
