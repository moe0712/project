@extends('layouts.app')  {{-- app.blade.php レイアウトを継承する --}}

@section('content')
<h1 class="mb-4">新規登録完了しました。</h1>
<a href="{{ route('logout') }}" class="btn btn-primary"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
   ログイン画面へ
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

</div>
@endsection
