@extends('layouts.helloapp')

@section('title', "Index")

@section('menubar')
    @parent
    インデックスページ
@endsection

@section('content')

    <nav>
        <a href="/person/find">検索ページ</a>
        <a href="/person/add">新規作成ページ</a>
    </nav>
    
    <table>
        <tr><th>Name</th><th>Mail</th><th>Age</th><th>Delete</th></tr>
        @foreach ($items as $item)
            <tr>
                <td>
                    <a href="/person/edit?id={{$item->id}}">{{$item->name}}</a>
                </td>
                <td>{{$item->mail}}</td>
                <td>{{$item->age}}</td>
                <td>
                    <a href="/person/del?id={{$item->id}}">del</a>
                </td>
            </tr>
        @endforeach
    </table>

    {{-- リレーション (has One)--}}
    <h3>has One</h3>
    <table>
        <tr><th>Person</th><th>Board</th></tr>
        @foreach ($items as $item)
            <tr>
                <td>{{$item->getData()}}</td>
                <td>
                    @if ($item->board != null)
                    {{$item->board->getData()}}
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

    {{-- リレーション (has Many)--}}
    <h3>has Many</h3>
    <table>
        <tr><th>Person</th><th>Board</th></tr>
        @foreach ($items as $item)
            <tr>
                <td>{{$item->getData()}}</td>
                <td>
                    @if ($item->boards != null)
                        <table width="100%">
                            @foreach ($item->boards as $obj)
                                <tr>
                                    <td>{{$obj->getData()}}</td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

    {{-- 投稿をもつ持たない--}}
    <div>
        <h3>hasItems & noItems</h3>
        <table>
            @foreach ($hasItems as $item)
                <tr>
                    <td>{{$item->getData()}}</td>
                    <td>
                        <table width="100%">
                            @foreach ($item->boards as $obj)
                                <tr>
                                    <td>{{$obj->getData()}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </td>
                </tr>
            @endforeach
        </table>
            <div style="margin: 5px; background-color: aqua;"></div>
        <table>
            <tr><td>Person</td></tr>
            @foreach ($noItems as $item)
                <tr>
                    <td>{{$item->getData()}}</td>
                </tr>
            @endforeach
        </table>

    </div>




    <table>
        <tr><th>getData()</th></tr>
        @foreach ($items as $item)
            <tr>
                <td>{{$item->getData()}}</td>
            </tr>
        @endforeach
    </table>
@endsection

@section('footer')
    copyright 2022 tuyano.
@endsection