<!DOCTYPE html>
<html lang="en">
<head>
    <x-head :head="$head"/>
    <link rel="stylesheet" href="{{ asset('user-site/build/css/bootstrap.css') }}" media="screen">
    @stack('scripts')
</head>
<body>

<x-navbar :navbar="$navbar"/>

<div class="container" {{--style="background:url('user-site/build/fonts/grid.svg')"--}}>

    <!--  MY    -->

    <x-breadcrumb :breadcrumbs="$breadcrumbs"/>

    <div class="bs-docs-section">
        <div class="page-header">
            <div class="row">

                <div class="col-lg-8">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header">
                                <h1 id="containers">Containers</h1>
                            </div>
                            <div class="bs-component">
                                <div class="jumbotron">
                                    <h1 class="display-3">Hello, world!</h1>
                                    <p class="lead">This is a simple hero unit, a simple jumbotron-style component for
                                        calling extra attention to featured content or information.</p>
                                    <hr class="my-4">
                                    <p>It uses utility classes for typography and spacing to space content out within
                                        the larger container.</p>
                                    <p class="lead">
                                        <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="page-header">
                                <h1 id="containers">List cats</h1>
                            </div>
                            <div class="bs-component">
                                <div class="card text-white bg-primary mb-3">
                                    <div class="card-header">Header</div>
                                    <div class="card-body">
                                        <h4 class="card-title">Primary card title</h4>
                                        <p class="card-text">Some quick example text to build on the card title and make
                                            up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="bs-component">
                        <h2>Emphasis classes</h2>
                        <p class="text-muted">Fusce dapibus, tellus ac cursus commodo, tortor mauris nibh.</p>
                        <p class="text-primary">Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        <p class="text-secondary">Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
                        <p class="text-warning">Etiam porta sem malesuada magna mollis euismod.</p>
                        <p class="text-danger">Donec ullamcorper nulla non metus auctor fringilla.</p>
                        <p class="text-success">Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>
                        <p class="text-info">Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <footer>
        <p>© Company 2013</p>
    </footer>
    <!--  MY    -->
    <!-- Dialogs
    ================================================== -->
    <div class="bs-docs-section">

        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h1 id="dialogs">Dialogs</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h2>Modals</h2>
                <div class="bs-component">
                    <div class="modal" style='display:block;position:relative'>
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="modal-title">Modal title</div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">x</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Modal body text goes here.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h2>Popovers</h2>
                <div class="bs-component">
                    <button type="button" class="btn btn-secondary" title="Popover Title" data-container="body"
                            data-toggle="popover" data-placement="right"
                            data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">Right
                    </button>

                    <button type="button" class="btn btn-secondary" title="Popover Title" data-container="body"
                            data-toggle="popover" data-placement="left"
                            data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">Left
                    </button>

                    <button type="button" class="btn btn-secondary" title="Popover Title" data-container="body"
                            data-toggle="popover" data-placement="top"
                            data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">Top
                    </button>

                    <button type="button" class="btn btn-secondary" title="Popover Title" data-container="body"
                            data-toggle="popover" data-placement="bottom" data-content="Vivamus
              sagittis lacus vel augue laoreet rutrum faucibus.">Bottom
                    </button>

                </div>
                <h2>Tooltips</h2>
                <div class="bs-component">
                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="right"
                            title="Tooltip on right">Right
                    </button>

                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="left"
                            title="Tooltip on left">Left
                    </button>

                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top"
                            title="Tooltip on top">Top
                    </button>

                    <button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom"
                            title="Tooltip on bottom">Bottom
                    </button>

                </div>
                <h2>Toasts</h2>
                <div class="bs-component">
                    <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <strong>Bootstrap</strong>
                            <small>11 mins ago</small>
                            <button type="button" class="close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                        </div>
                        <div class="toast-body">
                            Hello, world! This is a toast message.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="source-modal" class="modal fade" tabindex='-1'>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Source Code</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
                </div>
                <div class="modal-body">
                    <pre contenteditable></pre>
                </div>
            </div>
        </div>
    </div>


</div>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="user-site/build/js/bootstrap.bundle.js"></script>
</body>
</html>
<script>
    (function () {
        _386.magicCursor();
        _386.scrollLock();
        $('[data-toggle="tooltip"]').tooltip();
        $('[data-toggle="popover"]').popover();

        $(window).scroll(function () {
            var top = $(document).scrollTop();
            if (top > 50)
                $('#home > .navbar').removeClass('navbar-transparent');
            else
                $('#home > .navbar').addClass('navbar-transparent');
        });

        $("a[href='#']").click(function (e) {
            e.preventDefault();
        });

    })();
</script>
