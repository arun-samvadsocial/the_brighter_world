@foreach($posts as $post_row)
<div class="item col-md-6 col-lg-4">
    <div class="col-md-12 wow fadeInUp ">
        <div class="main_services text-left">
            <a href="{!! url('detail/'.$post_row->post_url.'/'.Helper::base64url_encode($post_row->post_id)) !!}">
                <div class="img-thumbnail text-center">
                    <img src="{{url($post_row->img_path)}}" class="img-thumbnail" height="142px" alt="">
                </div>
                <div class="card_detail">
                    <h4 class="mt-3 card_title_ellipsis" title="{{ $post_row->title }}" t>{{ $post_row->title }}</h4>
                    <p class="card_text_ellipsis">{!! strip_tags($post_row->description) !!}</p>
            </a>
            <div class="card_footer row">
                <div class="col-6 text-grey">
                    {!! Helper::formatDate($post_row->published_date) !!}
                </div>
                <div class="col-6 d-flex flex-row-reverse">
                    <div class="post_category category_name_clamp">

                        {{ $post_row->category_name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endforeach