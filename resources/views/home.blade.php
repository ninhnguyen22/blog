@extends('layouts.blog')
@section('content')
    <!--Section: Content-->
    <section style="margin-top: 4rem!important;">
        <div class="row gx-5">
            @foreach($_data as $article)
                <x-article :article="$article"/>
            @endforeach
        </div>
    </section>
    <!--Section: Content-->

    <!-- Pagination -->
    <nav class="my-4" aria-label="...">
        {{ $_data->links() }}
    </nav>
@endsection
