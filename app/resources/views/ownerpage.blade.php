@extends('layouts.app')

@section('content')
<div class="container">
    <h1>管理者専用ページ</h1>
    <p>ここは管理者のみがアクセスできるページです。</p>

    <a href="{{ route('admin.getReportedUsers') }}" class="btn btn-primary">報告件数が多いユーザー</a>
   
</div>
@endsection

