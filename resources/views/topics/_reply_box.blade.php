
@include('shared.__error')
<div>
    <form action="{{ route('replies.store') }}" method="post" accept-charset="UTF-8">
        <input type="hidden" name="topic_id" value="{{ $topic->id }}">
        @csrf
        <div class="form-group">
            <textarea name="content" class="form-control" rows="3"
            placeholder="请分享你的见解"></textarea>
        </div>
        <button class="btn btn-primary btn-sm"><i class="fa fa-share mr-1"></i>回复 </button>
    </form>
</div>
<hr>
