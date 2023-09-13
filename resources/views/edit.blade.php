@extends('layouts.layout')
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@section('form')
    <form action="{{route('de.update',$record)}}" method="POST">
        @CSRF
        @method('patch')
        <div class="row g-1">
            <div class="col-1 field">
                <input type="text" class="form-control" placeholder="網址" value="{{$record->url}}" id="url" name="url">
            </div>
            <div class="col-1 field">
                <input type="text" class="form-control" placeholder="網站名稱" value="{{$record->name}}" id="name" name="name">
            </div>
            <div class="col-1 field">
                <input type="text" class="form-control" placeholder="關鍵字" value="{{$record->key}}" id="key" name="key">
            </div>
            <div class="actions col-1">
                <button type="submit" class="btn btn-primary">修改</button>
            </div>
        </div>
    </form>
@endsection
@section('table')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">時間</th>
            <th scope="col">短網址</th>
            <th scope="col">網站名稱</th>
            <th scope="col">關鍵字</th>
            <th scope="col">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($datas as $data)
            <tr>
                <td>{{ $data->created_at }}</td>
                <td><a href="{{ route('short_url_redirect', ['shortCode' => $data->short_url]) }}">{{$data->short_url}}</a></td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->key }}</td>
                <td>
                    <a href="{{ route('short_url_redirect', ['shortCode' => $data->short_url]) }}" class="btn btn-primary">進入</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
