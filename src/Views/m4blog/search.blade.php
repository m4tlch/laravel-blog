@extends("layouts.app",['title'=>$title])
@section("content")

    {{--https://nikacrm.com/laravel/packages/m4blog-blog-system-for-your-laravel-app/help-documentation/laravel-blog-package-m4blog#guide_to_views--}}

    <div class='row'>
        <div class='col-sm-12'>
            <h2>Search Results for {{$query}}</h2>

            @forelse($search_results as $result)

                <?php $post = $result->indexable; ?>
                @if($post && is_a($post,\M4tlch\LaravelBlog\Models\M4BlogPost::class))
                    <h2>Search result #{{$loop->count}}</h2>
                    @include("m4blog::partials.index_loop")
                @else

                    <div class='alert alert-danger'>Unable to show this search result - unknown type</div>
                @endif
            @empty
                <div class='alert alert-danger'>Sorry, but there were no results!</div>
            @endforelse


            @include("m4blog::sitewide.search_form")

        </div>
    </div>


@endsection