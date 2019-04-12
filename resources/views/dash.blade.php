<div class="small-9 large-9 column">
  <div class="content">
    <!-- foundationのReveal Modal pluginがajaxをサポートしています -->
    <!-- 最後のdiv要素はAjaxでコンテンツを出力しますが、これはfoundationのReveal Modal pluginが利用されています -->
    @if(Session::has('success'))
    <div data-alert class="alert-box round">
      {{Session::get('success')}}
      <a href="#" class="close">&times;</a>
    </div>
    @endif
    {{$content}}
  </div>
  <div id="comment-show" class="reveal-modal small" data-reveal>
    {{-- Ajaxを利用 --}}
  </div>
</div>
