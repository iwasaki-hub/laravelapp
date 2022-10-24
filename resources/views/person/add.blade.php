@extends('layouts.helloapp')

@section('title', "Add")

@section('menubar')
    @parent
    新規作成ページ
@endsection

@section('content')
    @if (count($errors) > 0)
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="/person/add" method="POST">
        <table>
            @csrf
            <tr>
                <th>Name: </th>
                <td><input type="text" name="name" value="{{old('name')}}"></td>
            </tr>
    
            <tr>
                <th>Mail: </th>
                <td><input type="email" name="mail" value="{{old('mail')}}"></td>
            </tr>
    
            <tr>
                <th>Age: </th>
                <td><input type="number" name="age" value="{{old('age')}}"></td>
            </tr>
    
            <tr>
                <th></th>
                <td><input type="submit" value="Add"></td>
            </tr>
        </table>
    </form>
@endsection

@section('footer')
    copyright 2022 tuyano.
@endsection