@extends('tpl.master')
@section('title', $title?$title:'Welcome to Glade Assessment Solution')
@section('content')
<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns">

    @includeIf('tpl.sidemenu')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            @includeIf($corefile)
        </div>
    </div>
@endsection