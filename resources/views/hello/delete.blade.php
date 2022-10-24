@extends('layouts.helloapp')

@section('title', "Delete")
    
@section('menubar')
    @parent
    削除ページ
@endsection

@section('content')
    <form action="/helloo/del" method="POST">
        <table>
            @csrf
            <input type="hidden" name="id" value="{{$form->id}}">

            <tr>
                <th>Name: </th>
                <td>{{$form->name}}</td>
            </tr>

            <tr>
                <th>Mail: </th>
                <td>{{$form->mail}}</td>
            </tr>

            <tr>
                <th>Age: </th>
                <td>{{$form->age}}</td>
            </tr>

            <tr>
                <th></th>
                <td><input type="submit" value="delete"></td>
            </tr>

        </table>
    </form>
    
@endsection

@section('footer')
copyright 2022 tuyano.
@endsection