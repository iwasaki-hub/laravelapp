@extends('layouts.helloapp')

@section('title', "Show")
    
@section('menubar')
    @parent
    詳細ページ
@endsection

@section('content')
    <table>
        <tr>
            <th>ID: </th>
            <td>{{$item->id}}</td>
        </tr>

        <tr>
            <th>Name: </th>
            <td>{{$item->name}}</td>
        </tr>

        <tr>
            <th>Mail: </th>
            <td>{{$item->mail}}</td>
        </tr>

        <tr>
            <th>Age: </th>
            <td>{{$item->age}}</td>
        </tr>

    </table>

    {{-- 複数のレコードを表示 --}}
    @if ($items != null)
        @foreach($items as $item)
        <table width="400px">
            <tr>
                <th width="50px">ID: </th>
                <td width="50px">{{$item->id}}</td>

                <th width="50px">Name: </th>
                <td width="50px">{{$item->name}}</td>
            </tr>

        </table>
        @endforeach
    @endif


    
@endsection

@section('footer')
copyright 2022 tuyano.
@endsection