@extends('layouts.helloapp')

@section('title', "Index")

@section('menubar')
    @parent
    ボードページ
@endsection

@section('content')

    <nav>
        <a href="/board/add">新規作成ページ</a>
    </nav>

    {{-- all --}}
    <h3>all</h3>
    <table>
        <tr><th>Data</th></tr>
        @foreach ($items as $item)
            <tr>
                <td>{{$item->getData()}}</td>
            </tr>
        @endforeach
    </table>

    {{-- with 省エネ--}}
    <h3>with 省エネ</h3>
    <table>
        <tr><th>Message</th><th>Name</th></tr>
        @foreach ($items as $item)
            <tr>
                <td>{{$item->message}}</td>
                <td>{{$item->person->name}}</td>
            </tr>
        @endforeach
    </table>

@endsection

@section('footer')
    copyright 2022 tuyano.
@endsection