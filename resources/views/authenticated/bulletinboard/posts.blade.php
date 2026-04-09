<x-sidebar>
  <div class="board_area w-100 m-auto d-flex">
    <div class="post_view w-75 mt-5">
      <p class="w-75 m-auto">投稿一覧</p>
      @foreach($posts as $post)
      <div class="post_area border w-75 m-auto p-3">
        <p class="post_username"><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
        <p class="font-weight-bold mb-3"><a href="{{ route('post.detail', ['id' => $post->id]) }}" style="color: black; font-size:1.1rem;">{{ $post->post_title }}</a></p>
        <div class="post_bottom_area d-flex">
          @foreach($post->subCategories as $subCategory)
          <span class="badge badge-info">{{ $subCategory->sub_category }}</span>
          @endforeach
          <div class="post_icon d-flex post_status mr-3" style="color: gray;">
            <div class="mr-5">
              <i class="fas fa-comment"></i>
              <span class="comment_count">{{ $post->post_comments_count }}</span>
            </div>
            <div>
              @if(Auth::user()->is_Like($post->id))
              <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i>
                <span class="like_counts{{ $post->id }}">{{ $post->likes->count() }}</span>
              </p>
              @else
              <p class="m-0"><i class="far fa-heart like_btn" post_id="{{ $post->id }}"></i>
                <span class="like_counts{{ $post->id }}">{{ $post->likes->count() }}</span>
              </p>
              @endif
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="other_area w-25 m-5">
      <div class="m-4">
        <a href="{{ route('post.input') }}" class="post_btn btn btn-info w-100 mb-3">投稿</a>
        <form action="{{ route('post.show') }}" method="get" id="postSearchRequest">
          <div class="search_area d-flex my-2">
            <input type="text" class="search_box" placeholder="キーワードを検索" name="keyword">
            <button class="search_btn btn btn-info text-white" type="submit">検索</button>
          </div>
          <div class="d-flex my-4">
            <input type="submit" name="like_posts" class="btn btn-pink w-50" value="いいねした投稿" form="postSearchRequest">
            <input type="submit" name="my_posts" class="btn btn-orange w-50" value="自分の投稿" form="postSearchRequest">
          </div>
        </form>

        <div class="category-menu">
          <p class="category_search">カテゴリー検索</p>
          @foreach($main_categories as $main_category)
          <details class="category-group">
            <summary class="main-category">
              <span>{{ $main_category->main_category }}</span>
            </summary>

            <ul class="sub-category-list">
              @foreach($main_category->subCategories as $sub_category)
              <li class="sub-category-item">
                <a href="{{ route('post.show', ['category_word' => $sub_category->sub_category]) }}" class="sub-category-link">
                  {{ $sub_category->sub_category }}
                </a>
              </li>
              @endforeach
            </ul>

          </details>
          @endforeach
        </div>
      </div>
    </div>
    <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
  </div>
</x-sidebar>
