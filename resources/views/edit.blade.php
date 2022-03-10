@extends('layouts.app')

@section('javascript')
<script src="/js/confirm.js"></script>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        メモ編集
        <form id="delete-form" action="{{ route('destroy') }}" method="post" >
            @csrf
            <input type="hidden" name="memo_id" value="{{ $edit_memo[0]->id }}">
            <i class="fa-solid fa-trash mr-4" onclick="deleteHandle(event);"></i>
        </form>
    </div>
    <form class="card-body my-card-body" action="{{ route('update') }}" method="POST">
        @csrf
        <input type="hidden" name="memo_id" value="{{ $edit_memo[0]->id }}">
        <div class="mb-3">
            <textarea class="form-control" name="content" rows="3" placeholder="ここにメモを入力してください">{{ $edit_memo[0]->content }}</textarea>
        </div>
        @error('content')
            <div class="alert alert-danger">メモ内容を入力してください</div>
        @enderror
        @foreach($tags as $t)
            <input class="form-check-input" type="checkbox" name="tags[]" id="{{ $t['id'] }}" value="{{ $t['id'] }}"
            {{ in_array($t['id'], $include_tags) ? 'checked' : '' }}>
            <label class="form-check-label" for="{{ $t['id'] }}">{{ $t['name'] }}</label>
        @endforeach
        <input type="text" class="form-control w-50 mb-3" name="new_tag" placeholder="新しいタグを入力">
        <button type="submit" class="btn btn-primary">更新</button>
    </form>
</div>
@endsection
