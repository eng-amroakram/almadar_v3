@extends('partials.panel.layout')
@section('title', $title)
<link rel="stylesheet" href="{{ asset('assets/css/custom.card.css') }}">

@section('content')
    <section class="mt-md-4 pt-md-2 mb-5 pb-4">
        <div class="row">

            @can('superadmin', 'App\\Models\User')
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card card-cascade bg-brown-color cascading-admin-card">
                        <div class="admin-up">
                            <i class="fas fa-city brown-color mr-3 z-depth-2"></i>
                            <div class="data">
                                <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">المدن</p>
                                <h4 class="font-weight-bold dark-grey-text">{{ models_count('City') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <!-- Card -->
                    <div class="card card-cascade bg-brown-color cascading-admin-card">
                        <div class="admin-up">
                            <i class="fas fa-boxes-stacked brown-color mr-3 z-depth-2"></i>

                            <div class="data">
                                <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">الاحياء</p>
                                <h4 class="font-weight-bold dark-grey-text">{{ models_count('Neighborhood') }}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- Card -->
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <!-- Card -->
                    <div class="card card-cascade bg-brown-color cascading-admin-card">

                        <!-- Card Data -->
                        <div class="admin-up">
                            <i class="fas fa-user-gear brown-color mr-3 z-depth-2"></i>
                            <div class="data">
                                <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">المستخدمين</p>
                                <h4 class="font-weight-bold dark-grey-text">{{ models_count('User') }}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- Card -->
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <!-- Card -->
                    <div class="card card-cascade bg-brown-color cascading-admin-card">

                        <!-- Card Data -->
                        <div class="admin-up">
                            <i class="fas fa-users brown-color mr-3 z-depth-2"></i>
                            <div class="data">
                                <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">العملاء</p>
                                <h4 class="font-weight-bold dark-grey-text">{{ models_count('Client') }}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- Card -->
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <!-- Card -->
                    <div class="card card-cascade bg-brown-color cascading-admin-card">

                        <!-- Card Data -->
                        <div class="admin-up">
                            <i class="fas fa-people-arrows brown-color mr-3 z-depth-2"></i>
                            <div class="data">
                                <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">الوسطاء</p>
                                <h4 class="font-weight-bold dark-grey-text">{{ models_count('Broker') }}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- Card -->
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <!-- Card -->
                    <div class="card card-cascade bg-brown-color cascading-admin-card">

                        <!-- Card Data -->
                        <div class="admin-up">
                            <i class="fab fa-shopify brown-color mr-3 z-depth-2"></i>
                            <div class="data">
                                <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">المبيعات</p>
                                <h4 class="font-weight-bold dark-grey-text">{{ models_count('Sale') }}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- Card -->
                </div>
            @endcan

            @can('super_admin_marketer', 'App\\Models\User')
                <div class="col-xl-3 col-md-6 mb-4">
                    <!-- Card -->
                    <div class="card card-cascade bg-brown-color cascading-admin-card">

                        <!-- Card Data -->
                        <div class="admin-up">
                            <i class="fas fa-building brown-color mr-3 z-depth-2"></i>
                            <div class="data">
                                <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">الطلبات</p>
                                <h4 class="font-weight-bold dark-grey-text">{{ models_count('Order') }}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- Card -->
                </div>
            @endcan

            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Card -->
                <div class="card card-cascade bg-brown-color cascading-admin-card">

                    <!-- Card Data -->
                    <div class="admin-up">
                        <i class="fas fa-globe brown-color mr-3 z-depth-2"></i>

                        <div class="data">
                            <p class="text-uppercase fs-6 fw-bold" style="text-align: left;">العروض</p>
                            <h4 class="font-weight-bold dark-grey-text">{{ models_count('Offer') }}</h4>
                        </div>
                    </div>
                </div>
                <!-- Card -->
            </div>

        </div>
    </section>
@endsection
