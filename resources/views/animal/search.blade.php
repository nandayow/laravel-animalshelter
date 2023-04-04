@extends('layouts.base')
@section('body')

<h1>Search</h1>

There are {{ $searchResults->count() }} results.

@foreach($searchResults->groupByType() as $type => $modelSearchResults)
   <h2>{{ $type }}</h2>
   
   @foreach($modelSearchResults as $searchResult)
                              <div class="card trending-item">
                                  <div class="trending-card"> 
                                    <img  class="display-dog" src=" https://i.pinimg.com/originals/61/3c/01/613c0187b0955042fdd95358efbbb023.png"> 
                                        <h1>{{ $searchResult->title }}</h1>
                                         <p class="title">{{ $searchResult->title }}</p>
                                                     <a href="{{ $searchResult->url }}"> View Profile  </a> 
                                        </div>
                                    </div>                   
   @endforeach
@endforeach
@endsection


 


 