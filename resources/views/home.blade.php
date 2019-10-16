@extends('layouts.master')

@section('content')
    <div class="block-header">
        <h2>DASHBOARD</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            Welcome
        </div>

    </div>

    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card">
                <div class="card-title">
                    <span class="label label-info lead">Storage Disk Free Space : </span>
                    <span class="badge badge-primary">
                    {{ round(disk_free_space(storage_path())/(1024*1024*1024), 2) }} GB /  {{ round(disk_total_space(storage_path())/(1024*1024*1024), 2) }} GB
                </span>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/js/pages/index.js"></script>
@endsection
