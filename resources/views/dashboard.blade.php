@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard</h2>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Expenses (All-Time)</div>
                <div class="card-body">
                    <h4 class="card-title">KES {{ number_format($totalAllTime) }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">This Month</div>
                <div class="card-body">
                    <h4 class="card-title">KES {{ number_format($totalThisMonth) }}</h4>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Today</div>
                <div class="card-body">
                    <h4 class="card-title">KES {{ number_format($totalToday) }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
