@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }} - <small>dados referente ao mês {{$month}} de {{$year}}</small></div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Total de manutenções Realizadas</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_maintenance}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-cogs fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                        <a target="_blank" href='{{url("report/maintenances/expenses/pdf?initial_date=$year-$month-01&final_date=$year-$month-31")}}'>
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Gastos com manutenções</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">R$ {{$maintenance_expenses}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                            Total de manutenções adiadas</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$maintenance_postpones}}</div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-calendar-times fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Avisos</h6>
                                </div>
                                <div class="card-body">
                                   	@if(isset($noticeMaintenance) && count($noticeMaintenance)> 0)
                                        @foreach($noticeMaintenance as $maintenance)
                                            <a href='{{url("$maintenance->machine_id/maintenanceCheck/")}}' class="list-group-item list-group-item-action {{ $maintenance->status ==  '1' ? 'list-group-item-danger':'list-group-item-warning' }}">
                                                <p>
                                                    <h6>Maquinario: {{$maintenance->description}} ID:{{$maintenance->id_number}}</h6> 
                                                    <b>{{$maintenance->quant}}</b> {{ $maintenance->status ==  '1' ? 'manutenções pendentes.':'manutenções serão necessárias a curto prazo.'}}
                                                </p>
                                            </a>
                                        @endforeach
                                        @else
                                        Não há manutenções pendentes.
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
