{{ Form::open(['url' => 'search', 'method'=>'get']) }}
  <div class="row">
    <div class="small-8 large-8  column">
      {{ Form::text('s', Input::old('username'), ['placeholder'=>'ブログ連携']) }}
    </div>
      {{ Form::submit('検索する', ['class'=>'button tiny radies']) }}
  </div>
{{ Form::close() }}
<div>
  <h3>最近の記事</h3>
  <ul>
  @foreach ($recentPosts as $post)
    <li>{{link_to route('pst.now', $psot->title, $post->id)}}</li>
  @endforeach
  </ul>
</div>
