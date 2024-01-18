 @if($status)
    @if(count($artikel) > 0)
        @foreach ($artikel as $item)
            <div class="col-lg-4 col-sm-6 mb-3 col-sm-6"> 
                <div class="card" style="width: 18rem;">
                    <img src="{{ $item->foto }}" class="card-img-top" alt="no image">
                    <div class="card-body">
                        <h5 class="card-title">{{  $item->title }}</h5>
                        <div class="times-content d-flex">
                        <div class="col-4 times-card p-1 border-right d-none"><small>By Asuransi Astra</small></div>
                        <div class="col-6 times-card p-1 border-right"><small> {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }} </small></div>
                        <div class="col-6 times-card p-1"><small>Categories :  {{ $item->category->description}} </small></div>
                        </div>
                        <div style="min-height:150px !important">

                        <p class="card-text">{{ \Str::limit(strip_tags($item->body),200) }}</p>
                        </div>
                        <a href="{{ route('front.artikel.detail', ['slug'=> $item->slug ])}}">Selengkapnya <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div> 
        @endforeach 
    @else
        <div class="row ">
            <div class="col-md-12 text-center">
                <h2>Artikel tidak ditemukan....</h2>
            </div>
        </div>
    @endif 
@endif
