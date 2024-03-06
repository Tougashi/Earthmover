@extends('Layouts.index')
@section('content')
    
<div class="container-fluid px-md-5">
    <div class="row">
        <div class="card shadow custom-rounded">
            <div class="card-content">
                <div class="row row-group row-cols-1 row-cols-xl-3">
                    <div class="col">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0">Total Orders</p>
                                    <h4 class="mb-0 text-primary">{{ $totalOrders }}</h4>
                                </div>
                                <div class="ms-auto"><i class="bx bx-cart font-35 text-primary"></i>
                                </div>
                            </div>
                            <div class="progress radius-10 my-2" style="height:4px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $percentageChangeTotalOrders }}%"></div>
                            </div>
                            <p class="mb-0 font-13">{{ $percentageChangeTotalOrders }}% from last month</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div>
                                    <p class="mb-0">Total Revenue</p>
                                    <h4 class="mb-0 text-success">${{ $totalRevenue }}</h4>
                                </div>
                                <div class="ms-auto"><i class="bx bx-wallet font-35 text-success"></i>
                                </div>
                            </div>
                            <div class="progress radius-10 my-2" style="height:4px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percentageChangeTotalRevenue }}%"></div>
                            </div>
                            <p class="mb-0 font-13">{{ $percentageChangeTotalRevenue }}% from last month</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card-body">
                            <div class="d-flex  justify-content-center">
                                <div>
                                    <p class="mb-0">Total Customers</p>
                                    <h1 class="mb-0 text-warning"> 
                                        {{ $totalCustomers }}
                                    </h1>
                                </div>
                                <div class="ms-auto"><i class="bx bx-group font-35 text-warning"></i></div>
                            </div>
                            <p class="mb-0 font-13"></p>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="mx-auto mt-4">
            <div class="card  custom-rounded shadow">
                <div class="card-body">
                    <div class="chart-container1">
                        <canvas id="chart1" width="700" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@push('scripts')
<script src="{{ asset('assets/plugins/chartjs/js/Chart.min.js') }}"></script>
<script src="{{ asset('assets/plugins/chartjs/js/chartjs-custom.js') }}"></script>
<script>
    $(document).ready(function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session("success") }}',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
    });

    $(function () {
        "use strict";
        var ctx = document.getElementById('chart1').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
                datasets: [{
                    label: 'Orders',
                    data: {!! json_encode($orderCounts) !!},
                    backgroundColor: "transparent",
                    borderColor: "#0d6efd",
                    pointRadius: "0",
                    borderWidth: 4
                }, {
                    label: 'Revenue',
                    data: {!! json_encode($revenueCounts) !!},
                    backgroundColor: "transparent",
                    borderColor: "#f41127",
                    pointRadius: "0",
                    borderWidth: 4
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: true,
                    labels: {
                        fontColor: '#585757',
                        boxWidth: 40
                    }
                },
                tooltips: {
                    enabled: false
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontColor: '#585757'
                        },
                        gridLines: {
                            display: true,
                            color: "rgba(0, 0, 0, 0.07)"
                        },
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontColor: '#585757',
                            max: Math.max(...{!! json_encode($revenueCounts) !!}) + 10
                        },
                        gridLines: {
                            display: true,
                            color: "rgba(0, 0, 0, 0.07)"
                        },
                    }]
                }
            }
        });
    });
    </script>
@endpush
@endsection