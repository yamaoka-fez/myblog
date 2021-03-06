<h2 class="comment-listings">コメント一覧</h2><hr>
<table>
  <thead>
    <tr>
      <th>コメントした人</th>
      <th>Email</th>
      <th>記事名</th>
      <th>承認</th>
      <th>削除</th>
      <th>閲覧</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($comments as $comment)
    <tr>
      <td>{{{$comment->commenter}}}</td>
      <td>{{{$comment->email}}}</td>
      <td>{{$comment->post->title}}</td>
      <td>
        {{Form::open(['route'=>['comment.update',$comment->id]])}}
        {{Form::select('status',['yes'=>'はい','no'=>'いいえ'],$comment->approved,['style'=>'margin-bottom:0','onchange'=>'submit()'])}}
        {{Form::close()}}
      </td>
      <td>{{HTML::linkRoute('comment.delete','削除する',$comment->id)}}</td>
      <td>{{HTML::linkRoute('comment.show','閲覧する',$comment->id,['data-reveal-id'=>'comment-show','data-reveal-ajax'=>'true'])}}</td>
    </tr>
  @endforeach
  </tbody>
</table>
{{$comments->links()}}
