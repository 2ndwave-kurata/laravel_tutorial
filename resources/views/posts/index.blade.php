@extends('layouts.app')

@section('title','記事一覧')

@section('script')
<script>
function delPostConfirm() {
  if(confirm('削除しますか？')) {
  } else {
      return false;
  }
}
</script>
@endsection

@section('content')

@if(Session::has('message'))
<div class="alert alert-success" >
  {{ session('message') }}
</div>
@endif
  <div class="blogindex">
    <table>
      
      <tr>
        <th >タイトル</th>
        <th>本文</th>
        <th>投稿時間</th>
        <th></th>
      </tr>
  
  @foreach($posts as $post)
  <tr>
    <td><li>{{ link_to_route('posts.show',$post->title,[$post->id]) }}</li></td>
    <td>{{ $post->content }}</td>
    <td>{{ $post->created_at }}</td>
  

      <td>{{ link_to_route('posts.edit','編集',[$post->id],['class'=>'btn btn-primary btn-sm' ]) }}</td>
       <td>
         {{ Form::open(['route'=>['posts.destroy',$post->id],'onSubmit'=>'return delPostConfirm();','method'=>'delete']) }}
         {{ Form::submit('削除',['class'=>'btn btn-danger btn-sm']) }}
         {{ Form::close() }}
       </td>
  </tr>
  <div>
  @endforeach
    <div class="blog_create">
        {{ link_to_route('posts.create','記事作成',[$post->id],['class'=>'btn btn-primary btn-sm1']) }}
    </div>
  </table>
  <div class="paginations">
  {{ $posts->links() }}
</div>
@endsection

@section('footer')

@endsection