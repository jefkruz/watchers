@extends('layouts.main')


@section('content')
    <div class="row">
        @foreach($resources as $post)
            <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6">
                <a href="{{route('viewResource', [$post->id, $post->slug])}}">
                    <div class="card">
                        @if($post->image)

                            <img class="card-img-top img-fluid" src="{{url($post->image)}}" alt="{{$post->title}}">
                        @endif
                            <div class="card-header">
                                <h5 class="card-title">{{$post->title}}</h5>
                            </div>
                        <div class="card-body">
                            <p>{!! html_entity_decode(Str::limit($post->content, 200)) !!}</p>

                        </div>
                        <div class="card-footer ">
                            <div class="media mt-0">

                                <div class="media-body">
                                    <h6 class="mb-0 mt-2 ms-2"><i class="fa fa-clock"></i> {{$post->created_at->diffForHumans()}}</h6>
                                </div>
                                <div class="ms-auto">
                                    <div class="d-flex mt-1">
                                        <a class="new me-2 text-muted fs-16" href="JavaScript:void(0);"><span class=""><i class="fe fe-message-square"></i>{{$post->comments()->count()}}</span></a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        @endforeach
    </div>
    <!-- Row starts -->
    <div class="row">
        <!-- Column starts -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header d-block">
                    <h4 class="card-title">IMPACT LEVELS </h4>

                </div>
                <div class="card-body">
                    <!-- Default accordion -->

                    <div class="accordion accordion-primary" id="accordion-one">
                        <div class="accordion-item">
                            <div class="accordion-header  rounded-lg" id="headingOne" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-controls="collapseOne"   aria-expanded="true" role="button">
                                <span class="accordion-header-icon"></span>
                                <span class="accordion-header-text">GEM INFLUENCER</span>
                                <span class="accordion-header-indicator"></span>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordion-one">
                                <div class="accordion-body-text">
                                    A <b>GEM</b> influencer is someone who has recruited 10 active influencers, raised 10 Your Loveworld Specials Magazine Sponsors, and reached 100 people to participate in ministry programs/events.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <div class="accordion-header collapsed rounded-lg" id="headingTwo" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-controls="collapseTwo"   role="button" aria-expanded="true">
                                <span class="accordion-header-text">PREMIUM INFLUENCER </span>
                                <span class="accordion-header-indicator"></span>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#accordion-one">
                                <div class="accordion-body-text">
                                    A <b>PREMIUM</b> influencer is someone who has recruited 100 active influencers, raised 100 Your Loveworld Specials Magazine Sponsors, and reached 1000 people to participate in ministry programs.
                                     </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <div class="accordion-header collapsed rounded-lg" id="headingThree" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-controls="collapseThree"  role="button"  aria-expanded="true">
                                <span class="accordion-header-text">LUMINARY INFLUENCER</span>
                                <span class="accordion-header-indicator"></span>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-bs-parent="#accordion-one">
                                <div class="accordion-body-text">
                                    A <b>LUMINARY</b> influencer is someone who has recruited 500 active influencers, raised 500 Your Loveworld Specials Magazine Sponsors, and reached 5000 people to participate in ministry programs.
                                     </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <div class="accordion-header collapsed rounded-lg" id="headingFour" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-controls="collapseFour"  role="button"  aria-expanded="true">
                                <span class="accordion-header-text">GALAXY INFLUENCER</span>
                                <span class="accordion-header-indicator"></span>
                            </div>
                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-bs-parent="#accordion-one">
                                <div class="accordion-body-text">
                                    A <b>GALAXY</b> influencer is someone who has recruited 1000 active influencers, raised Your Loveworld Specials Magazine Sponsors, and reached 10,000 people to participate in ministry programs.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <div class="accordion-header collapsed rounded-lg" id="headingFive" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-controls="collapseFive"  role="button"  aria-expanded="true">
                                <span class="accordion-header-text">STAR INFLUENCER</span>
                                <span class="accordion-header-indicator"></span>
                            </div>
                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-bs-parent="#accordion-one">
                                <div class="accordion-body-text">
                                    A <b>STAR</b> influencer is someone who has recruited 5000 active influencers, raised 5000 Your Loveworld Specials Magazine Sponsors, and reached 50,000 people to participate in ministry programs
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <div class="accordion-header collapsed rounded-lg" id="headingSix" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-controls="collapseSix"  role="button"  aria-expanded="true">
                                <span class="accordion-header-text">VIP INFLUENCER</span>
                                <span class="accordion-header-indicator"></span>
                            </div>
                            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-bs-parent="#accordion-one">
                                <div class="accordion-body-text">
                                    A <b>VIP</b> influencer is someone who has recruited 10,000 active influencers, raised 10,000 Your Loveworld Specials Magazine Sponsors, and reached 100,000 people to participate in ministry programs.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Column ends -->
    </div>
@endsection
