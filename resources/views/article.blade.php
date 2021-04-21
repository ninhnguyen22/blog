@extends('layouts.blog')
@section('content')
    <!--Section: Content-->
    <section style="margin-top: 4rem!important;">
        <div class="row gx-5">
            <!--Section: Post data-mdb-->
            <section class="border-bottom mb-4">
                {{--                <img src="https://mdbootstrap.com/img/Photos/Slides/img%20(144).jpg"--}}
                {{--                     class="img-fluid shadow-2-strong rounded mb-4" alt=""/>--}}

                <div class="row align-items-center mb-4">
                    <div class="col-lg-6 text-center text-lg-start mb-3 m-lg-0">
                        <x-article.author
                            :authorName="$_data->user->name"
                            :authorAvatar="$_data->user->avatar"
                            :publishedAt="$_data->updated_at"
                        />
                    </div>
                    <div class="col-lg-6 text-center text-lg-end">
                        <button type="button" class="btn btn-primary px-3 me-1" style="background-color: #3b5998;">
                            <i class="fab fa-facebook-f"></i>
                        </button>
                        <button type="button" class="btn btn-primary px-3 me-1" style="background-color: #55acee;">
                            <i class="fab fa-twitter"></i>
                        </button>
                        <button type="button" class="btn btn-primary px-3 me-1" style="background-color: #0082ca;">
                            <i class="fab fa-linkedin"></i>
                        </button>
                        <button type="button" class="btn btn-primary px-3 me-1">
                            <i class="fas fa-comments"></i>
                        </button>
                    </div>
                </div>
            </section>

            <section class="markdown" id="markdown">
                {!! Markdown::convertToHtml($_data->content) !!}
            </section>

            <!--Section: Text-->

            <!--Section: Share buttons-->
            <section class="text-center border-top border-bottom py-4 mb-4">
                <p><strong>Share with your friends:</strong></p>

                <button type="button" class="btn btn-primary me-1" style="background-color: #3b5998;">
                    <i class="fab fa-facebook-f"></i>
                </button>
                <button type="button" class="btn btn-primary me-1" style="background-color: #55acee;">
                    <i class="fab fa-twitter"></i>
                </button>
                <button type="button" class="btn btn-primary me-1" style="background-color: #0082ca;">
                    <i class="fab fa-linkedin"></i>
                </button>
                <button type="button" class="btn btn-primary me-1">
                    <i class="fas fa-comments me-2"></i>Add comment
                </button>
            </section>
            <!--Section: Share buttons-->

        </div>
    </section>
    <!--Section: Content-->

@endsection
