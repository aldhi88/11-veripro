<ul class="metismenu list-unstyled" id="side-menu">

    <li class="menu-title">{{Auth::user()->master_users->auth_roles->name}}</li>

    {{-- <li>
        <a href="{{ route('tagihan.file') }}" target="_blank" class="waves-effect">
            <i class="ri-dashboard-line"></i>
            <span>File BA</span>
        </a>
    </li> --}}

    {{-- Administrator --}}
    @if (Auth::user()->master_users->auth_role_id == 1)
        <li>
            <a href="{{ route('dashboard.index') }}" class="waves-effect">
                <i class="ri-dashboard-line"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ri-group-line "></i>
                <span>Data Akun</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('account.index') }}">Semua Data</a></li>
                <li><a href="{{ route('account.create') }}">Buat Baru</a></li>
            </ul>
        </li>

    @endif

    {{-- =================PROCUREMENT===================== --}}
    @if (Auth::user()->master_users->auth_role_id == 2)
        <li>
            <a href="{{ route('tagihan.indexPro') }}" class="waves-effect">
                <i class="ri-todo-line"></i>
                <span>Dashboard</span>

                <span class="badge badge-pill badge-danger float-right py-1">{{$dtToc}}</span>
            </a>
            {{-- <a href="{{ route('dashboard.index') }}" class="waves-effect">
                <i class="ri-dashboard-line"></i>
                <span>Dashboard</span>
            </a> --}}
        </li>
        <li>
            <a href="{{ route('lov.indexPejabat') }}" class="waves-effect">
                <i class="ri-user-2-line"></i>
                <span>Data Pejabat</span>
            </a>
        </li>
        <li>
            <a href="{{ route('lov.indexSetting') }}" class="waves-effect">
                <i class="ri-settings-2-line"></i>
                <span>Pengaturan</span>
            </a>
        </li>

        {{-- <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ri-settings-2-line"></i>
                <span>Pengaturan</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('lov.indexPejabat') }}">Notifkasi TOC</a></li>
            </ul>
        </li> --}}

        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ri-team-line"></i>
                <span>Data Mitra</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('account.mitra') }}">Semua Data</a></li>
                <li>
                    <a href="{{ route('account.mitraPending') }}">Persetujuan
                    @if ($newMitra > 0)
                        <span class="badge badge-pill badge-success float-right">{{$newMitra}}</span>
                    @endif
                </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ri-file-paper-2-line"></i>
                <span>Data KHS</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('khs.index') }}">KHS Induk</a></li>
                <li><a href="{{ route('khs.create') }}">Buat Baru</a></li>
            </ul>
        </li>

        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ri-file-user-line"></i>
                <span>SP</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('sp.index') }}">Data SP Induk</a></li>
                <li><a href="{{ route('sp.create') }}">SP Baru</a></li>
            </ul>
        </li>

        {{-- <li>
            <a href="{{ route('tagihan.indexPro') }}" class="waves-effect">
                <i class="ri-todo-line"></i>
                <span>Tagihan Mitra</span>
            </a>
        </li> --}}
    @endif

    {{-- =================User===================== --}}
    @if (Auth::user()->master_users->auth_role_id == 3)
        {{-- <li>
            <a href="{{ route('dashboard.index') }}" class="waves-effect">
                <i class="ri-dashboard-line"></i>
                <span>Dashboard</span>
            </a>
        </li> --}}
        <li>
            <a href="{{ route('tagihan.indexUser') }}" class="waves-effect">
                <i class="ri-todo-line"></i>
                <span>Dashboard</span>
            </a>
        </li>
    @endif

    {{-- =================Mitra===================== --}}
    @if (Auth::user()->master_users->auth_role_id == 4)
        {{-- <li>
            <a href="{{ route('dashboard.index') }}" class="waves-effect">
                <i class="ri-dashboard-line"></i>
                <span>Dashboard</span>
            </a>
        </li> --}}
        <li>
            <a href="{{ route('tagihan.index') }}" class="waves-effect">
                <i class="ri-todo-line"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('sp.indexMitra') }}" class="waves-effect">
                <i class="ri-file-user-line"></i>
                <span>Data SP</span>
            </a>
        </li>
        {{-- <li>
            <a href="{{ route('tagihan.index') }}" class="waves-effect">
                <i class="ri-todo-line"></i>
                <span>Tagihan Saya</span>
            </a>
        </li> --}}
    @endif



</ul>
