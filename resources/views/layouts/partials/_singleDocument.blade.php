<div class="col-md-6 col-lg-4 py-0 mt-4 @if($key>2) 'mt-lg-5'@else 'mt-lg-0'@endif ">
    <div class="background-white pb-4 h-100 radius-secondary">
    <img class="w-100 radius-tr-secondary radius-tl-secondary" style="height: 300px;" src="{{asset('logo/'.$document->logo)}}" alt="Image de couverture" />

    <div
        style="padding: 10px"
        data-zanim-timeline="{}"
        data-zanim-trigger="scroll"
    >
        <div class="overflow-hidden">
        <a href="{{ route('document-details', ['id'=>$document->id]) }}"
            ><h5 data-zanim='{"delay":0}'>
            {{truncate($document->nom,60)}}
            </h5></a
        >
        </div>
        <div class="overflow-hidden">

            <p style="font-size: 15px" data-zanim='{"delay":0.2}'>
                {{ truncate($document->resume,60) }}
            </p>
            </div>
        <div class="overflow-hidden">
        <p class="text-success float-md-left" data-zanim='{"delay":0.2}'>par {{$document->auteur}} le {{\Carbon\Carbon::parse($document->date_publication)->translatedFormat('d M Y')}} | {{$document->nb_pages}} pages.</p>
        </div>

        <div class="overflow-hidden text-left">
                <div class="d-inline-block" data-zanim='{"delay":0.3}'>
                    <a class="btn btn-outline-primary btn-capsule btn-sm border-2x fw-700 mr-md-1" href="{{ route('document-details', ['id'=>$document->id]) }}"><i class="fa fa-eye" aria-hidden="true"></i></i> Voir détails</a>
                </div>
            </div>
        </div>
    </div>
</div>
