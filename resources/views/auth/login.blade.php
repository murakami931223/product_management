@extends('layouts.app')

@section('content')

<div class="container">

            <div class="card">
                <div class="card_header">ユーザーログイン画面</div>

                <div class="card_body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                            <div class="col_md_6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"
                                placeholder="パスワード">

                                @error('password')
                                    <p class="invalid_feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                @enderror
                            </div>


                            <div class="col_md_6">
                                <input id="email" type="email" class="form_control 
                                @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="アドレス">

                                @error('email')
                                    <p class="invalid_feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                @enderror
                            </div>



                            <div class="btn_area">
                                    <button type="button" class="btn1 btn_primary" onclick="location.href='{{ route('register') }}'">
                                    新規登録
                                    </button>
                                
                                    <button type="submit" class="btn2 btn_primary" >
                                    ログイン
                                    </button>
                            </div>
                    </form>
                </div>
            </div>

</div>
@endsection