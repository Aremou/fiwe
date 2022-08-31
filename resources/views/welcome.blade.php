@extends('layouts.master', ['title'=>'Tableau de bord'])

@section('container')
<div class="row">
    <div class="col-sm-12">
        <div class="float-right page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Tableau de bord</a></li>
                <li class="breadcrumb-item active">Accueil</li>
            </ol>
        </div>
        <h5 class="page-title">Tableau de bord</h5>
    </div>
</div>

<div class="row">
    <div class="col-xl-3  col-md-6">
        <div class="card mini-stat m-b-30">
            <div class="p-3 text-white" style="{{ background_color_1() }}">
                <div class="mini-stat-icon">
                    <i class="fa fa-shopping-bag float-right mb-0"></i>
                </div>
                <h6 class="text-uppercase mb-0">étudiants</h6>
            </div>
            <div class="card-body">
                <div class="border-bottom pb-4">
                </div>
                <div class="mt-4 text-muted">

                    <h5 class="m-0"><i class="mdi mdi-arrow-up ml-2" style="{{ color_1() }}"></i>

                    </h5>

                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat m-b-30">
            <div class="p-3 text-white" style="{{ background_color_1() }}">
                <div class="mini-stat-icon">
                    <i class="fa fa-address-book-o float-right mb-0"></i>
                </div>
                <h6 class="text-uppercase mb-0">Filière</h6>
            </div>
            <div class="card-body">
                <div class="border-bottom pb-4">
                </div>
                <div class="mt-4 text-muted">
                    <h5 class="m-0"><i class="mdi mdi-arrow-up ml-2" style="{{ color_1() }}"></i>

                    </h5>

                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat m-b-30">
            <div class="p-3 text-white" style="{{ background_color_1() }}">
                <div class="mini-stat-icon">
                    <i class="fa fa-address-book-o float-right mb-0"></i>
                </div>
                <h6 class="text-uppercase mb-0">Niveau</h6>
            </div>
            <div class="card-body">
                <div class="border-bottom pb-4">
                </div>
                <div class="mt-4 text-muted">
                    <h5 class="m-0"><i class="mdi mdi-arrow-up ml-2" style="{{ color_1() }}"></i>

                    </h5>

                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card mini-stat m-b-30">
            <div class="p-3 text-white" style="{{ background_color_1() }}">
                <div class="mini-stat-icon">
                    <i class="fa fa-paper-plane-o float-right mb-0"></i>
                </div>
                <h6 class="text-uppercase mb-0">Inscrits</h6>
            </div>
            <div class="card-body">
                <div class="border-bottom pb-4">
                </div>
                <div class="mt-4 text-muted">
                    <h5 class="m-0"> <i class="mdi mdi-arrow-up ml-2" style="{{ color_1() }}"></i>

                    </h5>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')

<!-- jQuery  -->
<script src="{{ asset('dashboard/js/jquery.min.js ') }}"></script>

@endsection
