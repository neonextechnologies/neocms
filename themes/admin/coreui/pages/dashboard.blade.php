@extends('layouts.app')

@section('title', 'Dashboard')

@section('breadcrumb')
<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-primary">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold">2,452 
                        <span class="fs-6 fw-normal">(7% 
                            <svg class="icon">
                                <use xlink:href="#cil-arrow-top"></use>
                            </svg>)
                        </span>
                    </div>
                    <div>Total Users</div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon">
                            <use xlink:href="#cil-options"></use>
                        </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                <canvas class="chart" id="card-chart1" height="70"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-info">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold">132 
                        <span class="fs-6 fw-normal">(12% 
                            <svg class="icon">
                                <use xlink:href="#cil-arrow-top"></use>
                            </svg>)
                        </span>
                    </div>
                    <div>Total Pages</div>
                </div>
            </div>
            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                <canvas class="chart" id="card-chart2" height="70"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-warning">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold">487 
                        <span class="fs-6 fw-normal">(-2% 
                            <svg class="icon">
                                <use xlink:href="#cil-arrow-bottom"></use>
                            </svg>)
                        </span>
                    </div>
                    <div>Total Posts</div>
                </div>
            </div>
            <div class="c-chart-wrapper mt-3" style="height:70px;">
                <canvas class="chart" id="card-chart3" height="70"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-danger">
            <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                <div>
                    <div class="fs-4 fw-semibold">8</div>
                    <div>Active Modules</div>
                </div>
            </div>
            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                <canvas class="chart" id="card-chart4" height="70"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <div>
                <h4 class="card-title mb-0">Traffic</h4>
                <div class="small text-medium-emphasis">January - July 2023</div>
            </div>
        </div>
        <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">
            <canvas class="chart" id="main-chart" height="300"></canvas>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header">Recent Activity</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table border mb-0">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th>User</th>
                                <th>Activity</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="align-middle">
                                <td>
                                    <div class="clearfix">
                                        <div class="float-start">
                                            <div class="fw-semibold">John Doe</div>
                                            <div class="small text-medium-emphasis"><span>New</span> | Registered: Jan 1, 2023</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Created a new page</td>
                                <td>2 minutes ago</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg class="icon">
                                                <use xlink:href="#cil-options"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Info</a>
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="align-middle">
                                <td>
                                    <div class="clearfix">
                                        <div class="float-start">
                                            <div class="fw-semibold">Sarah Miller</div>
                                            <div class="small text-medium-emphasis"><span>Member</span> | Registered: Jan 5, 2023</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Updated settings</td>
                                <td>15 minutes ago</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg class="icon">
                                                <use xlink:href="#cil-options"></use>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Info</a>
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item text-danger" href="#">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
