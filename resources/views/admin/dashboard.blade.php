@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Total Orders Block -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success">
                <div class="card-header">Total Orders</div>
                <div class="card-body">
                    <h5 class="card-title">150</h5>
                    <p class="card-text">Orders processed today</p>
                </div>
            </div>
        </div>

        <!-- Today Orders Block -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-header">Today Orders</div>
                <div class="card-body">
                    <h5 class="card-title">50</h5>
                    <p class="card-text">Orders placed today</p>
                </div>
            </div>
        </div>

        <!-- Today Sale Block -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success">
                <div class="card-header">Today Sale</div>
                <div class="card-body">
                    <h5 class="card-title"> <i class="fa fa-rupee"></i> 12000</h5>
                    <p class="card-text">Total sale today</p>
                </div>
            </div>
        </div>

        <!-- Month Sale Block -->
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-warning">
                <div class="card-header">Month Sale</div>
                <div class="card-body">
                    <h5 class="card-title"> <i class="fa fa-rupee"></i> 25,000</h5>
                    <p class="card-text">Total sales for this month</p>
                </div>
            </div>
        </div>
    </div>
</div>@endsection