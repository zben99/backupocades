<section>
        <div class="background-holder overlay overlay-elixir"
            style="background-image:url(img/bg3.jpeg); background-size: cover"></div>
            <!--/.background-holder-->
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="media">
                            <span class="ion-android-checkmark-circle fs-5 color-warning mr-3"
                            style="transform: translateY(-1rem)"></span>
                            <div class="media-body">
                                <h2 class="color-warning fs-3 fs-lg-4">{{$config->nom}},<br /><span class="color-white">c'est ...</span>
                                </h2>
                                <div class="row mt-4 pr-lg-10">
                                    <div class="col-md-3 overflow-hidden" data-zanim-timeline="{}" data-zanim-trigger="scroll">
                                        <div class="fs-3 fs-lg-4 mb-0 lh-2 fw-700 color-white mt-lg-5 mt-3"
                                        data-zanim='{"delay":0.1}'>{{$progs}}</div>
                                        <h6 class="fs-0 color-white" data-zanim='{"delay":0.2}'>Programmes</h6>
                                    </div>
                                    <div class="col col-lg-3 overflow-hidden" data-zanim-timeline="{}"
                                    data-zanim-trigger="scroll">
                                    <div class="fs-3 fs-lg-4 mb-0 lh-2 fw-700 color-white mt-lg-5 mt-3"
                                    data-zanim='{"delay":0.1}'>{{$nbPart}}</div>
                                    <h6 class="fs-0 color-white" data-zanim='{"delay":0.2}'>Partenaires</h6>
                                </div>
                                <div class="w-100 d-flex d-lg-none"></div>
                                <div class="col-md-3 overflow-hidden" data-zanim-timeline="{}" data-zanim-trigger="scroll">
                                    <div class="fs-3 fs-lg-4 mb-0 lh-2 fw-700 color-white mt-lg-5 mt-3"
                                    data-zanim='{"delay":0.1}'>{{$nbProjet}}</div>
                                    <h6 class="fs-0 color-white" data-zanim='{"delay":0.2}'>Projets</h6>
                                </div>
                                <div class="col col-lg-3 overflow-hidden" data-zanim-timeline="{}"
                                data-zanim-trigger="scroll">
                                <div class="fs-3 fs-lg-4 mb-0 lh-2 fw-700 color-white mt-lg-5 mt-3"
                                data-zanim='{"delay":0.1}'>{{$nbActivite}}</div>
                                <h6 class="fs-0 color-white" data-zanim='{"delay":0.2}'>Activités réalisées</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.row-->
    </div>
    <!--/.container-->
</section>
