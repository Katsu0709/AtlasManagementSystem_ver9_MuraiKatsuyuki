<x-sidebar>
  <div class="vh-100 d-flex">
    <div class="w-50 mt-5">
      <div class="m-3 p-1 detail_container rounded-lg">
        <div class="p-3">
          @if($errors->has('post_title') || $errors->has('post_body'))
          <div class="text-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          <div class="detail_inner_head">
            <div>
              <div class="m-1">
                @foreach($post->subCategories as $subCategory)
                <span class="badge badge-info">{{ $subCategory->sub_category }}</span>
                @endforeach
              </div>
            </div>
            <div>
              @if($post->user_id == Auth::id())
              <span class="edit-modal-open btn btn-primary py-1"
                post_title="{{ $post->post_title }}"
                post_body="{{ $post->post }}"
                post_id="{{ $post->id }}">編集</span>

              <span class="delete-modal-open btn btn-danger py-1 mr-3">削除</span>
              @endif
            </div>
          </div>

          <div class="contributor d-flex justify-content-between align-center mt-1">
            <p style="font-size: 1.1rem;">
              <span>{{ $post->user->over_name }}</span>
              <span>{{ $post->user->under_name }}</span>
              さん
            </p>
            <span class="text-secondary mr-3" style="font-size: small;">{{ $post->created_at }}</span>
          </div>
          <div class="detail_post_title" style="font-size:1.2rem;">{{ $post->post_title }}</div>
          <div class="mt-3 detail_post" style="font-size:1.1rem;">{{ $post->post }}</div>
        </div>
        <div class=" p-3">
          <div class="comment_container">
            <span class="m-1">コメント</span>
            @foreach($post->postComments as $comment)
            <div class="comment_area border-top">
              <p>
                <span>{{ $comment->commentUser($comment->user_id)->over_name }}</span>
                <span>{{ $comment->commentUser($comment->user_id)->under_name }}</span>さん
              </p>
              <p>{{ $comment->comment }}</p>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
    <div class="w-50 p-3">
      <div class="comment_container border m-5 rounded-lg">
        <div class="comment_area p-3">
          @error('comment')
          <div class="text-danger">{{ $message }}</div>
          @enderror
          <p class="my-1">コメントする</p>
          <textarea class="w-100 form-control" rows="12" name="comment" form="commentRequest"></textarea>
          <div class="d-flex justify-content-end">
            <input type="hidden" name="post_id" form="commentRequest" value="{{ $post->id }}">
            <input type="submit" class="btn btn-primary px-3 my-2" form="commentRequest" value="投稿">
          </div>
          <form action="{{ route('comment.create') }}" method="post" id="commentRequest">{{ csrf_field() }}</form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
      <form action="{{ route('post.edit') }}" method="post">
        <div class="w-100">
          <div class="modal-inner-title w-50 m-auto">
            <input type="text" name="post_title" placeholder="タイトル" class="w-100">
          </div>
          <div class="modal-inner-body w-50 m-auto pt-3 pb-3">
            <textarea placeholder="投稿内容" name="post_body" class="w-100"></textarea>
          </div>
          <div class="w-50 m-auto edit-modal-btn d-flex">
            <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
            <input type="hidden" class="edit-modal-hidden" name="post_id" value="">
            <input type="submit" class="btn btn-primary d-block" value="編集">
          </div>
        </div>
        {{ csrf_field() }}
      </form>
    </div>
  </div>
  <div class="modal js-modal-delete">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content_delete">
      <form action="{{ route('post.delete', ['id' => $post->id]) }}" method="post">
        <div class="w-100 text-center p-3">
          <p>削除してよろしいですか？</p>
          <div class="w-50 m-auto d-flex justify-content-around">
            <a class="js-modal-close btn btn-secondary" href="">キャンセル</a>
            <input type="submit" class="btn btn-danger" value="削除">
          </div>
        </div>
        {{ csrf_field() }}
      </form>
    </div>
  </div>
</x-sidebar>
