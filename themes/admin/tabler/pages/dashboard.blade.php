@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-header')
<div class="row g-2 align-items-center">
    <div class="col">
        <div class="page-pretitle">Overview</div>
        <h2 class="page-title">Dashboard</h2>
    </div>
    <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
                <i class="ti ti-plus"></i>
                Create new report
            </a>
            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                <i class="ti ti-plus"></i>
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row row-deck row-cards">
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Total Users</div>
                    <div class="ms-auto lh-1">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last 7 days</a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item active" href="#">Last 7 days</a>
                                <a class="dropdown-item" href="#">Last 30 days</a>
                                <a class="dropdown-item" href="#">Last 3 months</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="h1 mb-3">2,452</div>
                <div class="d-flex mb-2">
                    <div>Conversion rate</div>
                    <div class="ms-auto">
                        <span class="text-green d-inline-flex align-items-center lh-1">
                            7%
                            <i class="ti ti-trending-up ms-1"></i>
                        </span>
                    </div>
                </div>
                <div class="progress progress-sm">
                    <div class="progress-bar bg-primary" style="width: 75%" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" aria-label="75% Complete">
                        <span class="visually-hidden">75% Complete</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Total Pages</div>
                </div>
                <div class="h1 mb-3">132</div>
                <div class="d-flex mb-2">
                    <div>Published</div>
                    <div class="ms-auto">
                        <span class="text-green d-inline-flex align-items-center lh-1">
                            12%
                            <i class="ti ti-trending-up ms-1"></i>
                        </span>
                    </div>
                </div>
                <div class="progress progress-sm">
                    <div class="progress-bar bg-success" style="width: 85%" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" aria-label="85% Complete">
                        <span class="visually-hidden">85% Complete</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Total Posts</div>
                </div>
                <div class="h1 mb-3">487</div>
                <div class="d-flex mb-2">
                    <div>Published</div>
                    <div class="ms-auto">
                        <span class="text-red d-inline-flex align-items-center lh-1">
                            -2%
                            <i class="ti ti-trending-down ms-1"></i>
                        </span>
                    </div>
                </div>
                <div class="progress progress-sm">
                    <div class="progress-bar bg-info" style="width: 65%" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" aria-label="65% Complete">
                        <span class="visually-hidden">65% Complete</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="subheader">Active Modules</div>
                </div>
                <div class="h1 mb-3">8</div>
                <div class="d-flex mb-2">
                    <div>Installed</div>
                    <div class="ms-auto">
                        <span class="text-green d-inline-flex align-items-center lh-1">
                            3
                            <i class="ti ti-check ms-1"></i>
                        </span>
                    </div>
                </div>
                <div class="progress progress-sm">
                    <div class="progress-bar bg-warning" style="width: 80%" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" aria-label="80% Complete">
                        <span class="visually-hidden">80% Complete</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row row-deck row-cards mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recent Activity</h3>
            </div>
            <div class="card-body">
                <div class="divide-y">
                    <div>
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar">JL</span>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>John Doe</strong> created a new page
                                </div>
                                <div class="text-muted">2 minutes ago</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar">SM</span>
                            </div>
                            <div class="col">
                                <div class="text-truncate">
                                    <strong>Sarah Miller</strong> updated settings
                                </div>
                                <div class="text-muted">15 minutes ago</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
