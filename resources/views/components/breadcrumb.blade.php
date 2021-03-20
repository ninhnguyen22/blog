<div class="bs-docs-section">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-12">
                <h1 id="buttons"></h1>
                <div class="bs-component">
                    <ol class="breadcrumb">
                        @foreach($breadcrumbs->getBreadcrumbs() as $breadcrumb)
                            @if($breadcrumb->isActive())
                                <li class="breadcrumb-item active">{{ $breadcrumb->getName() }}</li>
                            @else
                                <li class="breadcrumb-item {{ $breadcrumb->isActive() ? 'active' : '' }}"><a
                                        href="{{ $breadcrumb->getUrl() }}">{{ $breadcrumb->getName() }}</a></li>
                            @endif
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
