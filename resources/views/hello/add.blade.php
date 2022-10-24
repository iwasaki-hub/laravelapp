@extends('layouts.helloapp')

@section('title', "Add")
    
@section('menubar')
    @parent
    新規作成ページ
@endsection

@section('content')
    <form action="/helloo/add" method="POST">
        <table>
            @csrf
            <tr>
                <th>Name: </th>
                <td><input type="text" name="name" placeholder="Name..."></td>
            </tr>

            <tr>
                <th>Mail: </th>
                <td><input type="email" name="mail" placeholder="Email..."></td>
            </tr>

            <tr>
                <th>Age: </th>
                <td><input type="number" name="age" placeholder="Age..."></td>
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