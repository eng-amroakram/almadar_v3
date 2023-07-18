<header>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">

        <a class="ripple d-flex justify-content-center py-2" href="#!" data-ripple-color="primary">
            <img id="MDB-logo" src="{{ asset('assets/images/logo.png') }}" width="100" alt="MDB Logo" draggable="false">
        </a>

        <div class="position-sticky">
            <div class="list-group list-group-flush mx-3 mt-4">

                <a href="{{ route('panel.index') }}"
                    class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.index' ? ' active' : '' }}"
                    aria-current="true">
                    <i class="fas fa-tachometer-alt fa-fw me-3"></i>
                    <span>الصفحة الرئيسية</span>
                </a>

                @can('cities', App\Models\User::class)
                    <a href="{{ route('panel.cities.index') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.cities.index' ? ' active' : '' }}">
                        <i class="fas fa-city"></i>
                        <span>المدن</span>
                    </a>
                @endcan

                @can('neighborhoods', App\Models\User::class)
                    <a href="{{ route('panel.neighborhoods.index') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.neighborhoods.index' ? ' active' : '' }}">
                        <i class="fas fa-boxes-stacked"></i>

                        <span>الاحياء</span>
                    </a>
                @endcan

                @can('branches', App\Models\User::class)
                    <a href="{{ route('panel.branches.index') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.branches.index' ? ' active' : '' }}">
                        <i class="fas fa-diagram-project"></i>

                        <span>الفروع</span>
                    </a>
                @endcan

                @can('users', App\Models\User::class)
                    <a href="{{ route('panel.users.index') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.users.index' ? ' active' : '' }}">
                        <i class="fas fa-user-gear"></i>
                        <span>المستخدمين</span>
                    </a>
                @endcan

                @can('clients', App\Models\User::class)
                    <a href="{{ route('panel.clients.index') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.clients.index' ? ' active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>العملاء</span>
                    </a>
                @endcan

                @can('mediators', App\Models\User::class)
                    <a href="{{ route('panel.brokers.index') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.brokers.index' ? ' active' : '' }}">
                        <i class="fas fa-people-arrows"></i>
                        <span>الوسطاء</span>
                    </a>
                @endcan

                @can('orders', App\Models\User::class)
                    <a href="{{ route('panel.orders.index') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.orders.index' ? ' active' : '' }}">
                        <i class="fas fa-building fa-fw"></i>
                        <span>الطلبات</span>
                    </a>
                @endcan

                @can('assignedOrders', App\Models\User::class)
                    <a href="{{ route('panel.orders.assigned') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.orders.assigned' ? ' active' : '' }}">
                        <i class="fas fa-building fa-fw"></i>
                        <span>الطلبات المسندة</span>
                    </a>
                @endcan

                @can('directOffers', App\Models\User::class)
                    <a href="{{ route('panel.offers.direct-offer') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.offers.direct-offer' ? ' active' : '' }}">
                        <i class="fas fa-globe fa-fw"></i>
                        <span>العروض المباشرة</span>
                    </a>
                @endcan

                @can('indirectOffers', App\Models\User::class)
                    <a href="{{ route('panel.offers.in-direct-offer') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.offers.in-direct-offer' ? ' active' : '' }}">
                        <i class="fas fa-globe fa-fw"></i>
                        <span>{{ auth()->user()->user_type == 'office' ? 'العروض' : 'العروض الغير مباشرة' }}</span>
                    </a>
                @endcan

                @can('reservations', App\Models\User::class)
                    <a href="{{ route('panel.reservations.index') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.reservations.index' ? ' active' : '' }}">
                        <i class="far fa-address-book"></i>
                        <span>الحجوزات</span>
                    </a>
                @endcan

                @can('sales', App\Models\User::class)
                    <a href="{{ route('panel.sales.index') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.sales.index' ? ' active' : '' }}">
                        <i class="fas fa-cart-shopping"></i>
                        <span>المبيعات</span>
                    </a>
                @endcan

                @can('sales', App\Models\User::class)
                    <a href="{{ route('panel.sales.client-payments') }}"
                        class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.sales.client-payments' ? ' active' : '' }}">
                        <i class="fas fa-hand-holding-dollar"></i>
                        <span>دفعات العملاء</span>
                    </a>
                @endcan

                @can('sms', App\Models\User::class)
                    <a href="#"
                        class="list-group-item list-group-item-action py-2 ripple {{ Route::currentRouteName() == 'panel.sms' ? ' active' : '' }}">
                        <i class="fas fa-comment-sms"></i>
                        <span>الرسائل</span>
                    </a>
                @endcan

            </div>
        </div>
    </nav>

    <!-- Sidebar -->

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <!-- Container wrapper -->
        <div class="container">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
                aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Brand -->
            <a class="navbar-brand" href="#">
                <!-- <img src="images/logo.png" height="25" alt="MDB Logo" loading="lazy" /> -->
            </a>

            <div class="d-flex align-items-center">
                <div class="dropdown">

                    <a class="text-reset me-3 dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-mdb-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li class="logout">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-arrow-right-from-bracket text-danger"></i>
                                <span class="ms-1">تسجيل الخروج</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
</header>
