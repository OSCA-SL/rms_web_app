@extends('layouts.royalty')

@section('content')
    <div class="block-header container">
        <h2>Royalty Information</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif



            <div class="row">
                <div class="col-sm-10 mx-auto">
                    <a class="btn btn-info" target="_blank" href="/application.pdf">Download Application</a>
                </div>
                <div class="col-sm-10 mx-auto">
                    <embed src="/application.pdf" type="application/pdf" width="100%" height="500px" internalinstanceid="25">
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="/js/pages/index.js"></script>
@endsection
