@extends('layouts.app')

@section('title', 'Give Certificate')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">Add Question Paper</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @component('components.file-uploader',['upload_type'=>'papers','classes'=>$classes])
                    @endcomponent
                    {{-- @component('components.uploaded-files-list',['files'=>$certificates,'upload_type'=>'certificate'])
                    @endcomponent --}}
                    <h3>Question Papers</h3>
                    @component('components.uploaded-files-list',['files'=>$files,'parent'=>($class_id !== 0)?'class':'','upload_type'=>'papers'])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
