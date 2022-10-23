@extends('layouts.helloapp')

@section('title', "Index")

@section('menubar')
    @parent
    インデックスページ
@endsection

@section('content')
    <p>ここが本文のコンテンツです。</p>
    <p>必要なだけ記述できます。</p>

    @component('components.message')
    {{-- @slotは、{{}}で指定された変数に値を設定する --}}
    @slot('msg_title')
    CAUTION!
    @endslot

    @slot('msg_content')
    これはメッセージの表示です。
    @endslot
    @endcomponent

    {{-- サブビューとして読み込む --}}
    @include('components.message', ["msg_title"=>"OK", "msg_content"=>"サブビューです。"])

    {{-- @eachを使って、表示 --}}
    <p>ここが本文のコンテンツです。</p>
    <ul>
        {{-- @each('components.item', $data, "item") --}}
    </ul>

    {{-- ビューコンポーザーを利用する --}}
    <p>ここが本文のコンテンツです。</p>
    {{-- <p>Controller value<br>"message" = {{$message}}</p> --}}
    <p>ViewComposer value<br>"view_message" = {{$view_message}}</p>

    {{-- ミドルウェアの変数$dataを表示 --}}
    <p>ここが本文のコンテンツです。</p>
    {{-- <table>
        @foreach ($data as $item)
        <tr>
            <th>{{$item['name']}}</th>
            <td>{{$item['mail']}}</td>
        </tr>      
        @endforeach
    </table> --}}

    {{-- 後処理ミドルウェアを追加 --}}
    <p>ここが本文のコンテンツです。</p>
    <p>これは、<middleware>google.com</middleware>へのリンクです。</p>
    <p>これは、<middleware>yahoo.co.jp</middleware>へのリンクです。</p>

    {{-- バリデーション --}}
    <p>{{$msg}}</p>
    {{-- バリデーションのエラーメッセージ --}}
    @if (count($errors) > 0 )
        <p style="font-size: 20px; color: red;">入力に問題があります。再入力して下さい</p>
    @endif

    {{-- 一括表示 --}}
    @if (count($errors) > 0 ){
        <div>
            <ul style="color: red">
                @foreach($errors->all() as $error)
                <li>{{ $error}}</li>
                @endforeach
            </ul>
        </div>
    }
    @endif

    <form action="/helloo" method="POST">
        <table>
            @csrf
            
            @if ($errors->has('name'))
                <tr><th>ERROR</th><td style="color: brown">{{$errors->first('name')}}</td></tr>
                {{-- すべてのエラーを取得 get()--}}
                    <tr><th>ERROR</th>
                    @foreach ($errors->get("name") as $message)
                    <td style="color: brown">
                        {{$message}}
                    </td>
                    @endforeach
                    </tr>
            @endif
            <tr>
                <th>Name: </th><td><input type="text" name="name" value="{{old('name')}}" placeholder="Name..."></td>
            </tr>

            @if ($errors->has('mail'))
            <tr><th>ERROR</th><td style="color: brown">{{$errors->first('mail')}}</td></tr>
            @endif

            {{-- @errorディレクティブ --}}
            @error('mail')
                <tr>
                    <th>Error</th>
                    <td style="color: blue">{{$message}} from Errorディレクティブ </td>
                </tr>
            @enderror

            <tr>
                <th>Mail: </th><td><input type="mail" name="mail" value="{{old('mail')}}" placeholder="Mail..."></td>
            </tr>

            @if ($errors->has('age'))
            <tr><th>ERROR</th><td style="color: brown">{{$errors->first('age')}}</td></tr>
            @endif

             {{-- @errorディレクティブ --}}
             @error('age')
             <tr>
                 <th>Error</th>
                 <td style="color: blue">{{$message}} from Errorディレクティブ </td>
             </tr>
            @enderror

            <tr>
                <th>Age: </th><td><input type="number" name="age" value="{{old('age')}}"placeholder="Age..."></td>
            </tr>

            <tr>
                <th></th><td><input type="submit" value="send"></td>
            </tr>
        </table>
    </form>


    <h3 style="color: black">クッキーの読み書き</h3>
    <p>{{$msg}}</p>
    @if (count($errors) > 0)
    <p>入力に問題があります。再入力してください。from クッキーフォーム</p>    
    @endif
    <form action="/helloo" method="POST">
        <table>
            @csrf
            @if ($errors->has("msg"))
                <tr><th>ERROR</th><td>{{$errors->first('msg')}}</td></tr>
            @endif
            <tr>
                <th>Message: </th>
                <td><input type="text" name="msg" value="{{old("msg")}}"></td>
            </tr>

            <tr>
                <th></th>
                <td><input type="submit" value="send"></td>
            </tr>
        </table>
    </form>

    


    
    
@endsection

@section('footer')
    copyright 2022 tuyano.
@endsection





