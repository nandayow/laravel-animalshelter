                            
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 </head>
 <body>

<div class="card">
  <img src="{{asset( '/storage/public/images//'.$details['image'])}}" alt="John" style="width:100%">
  <h1>{{$details['animal_name']}}</h1>
  <p class="title">{{$details['gender']}}</p>
  <p>{{$details['healthstatus']}}</p> 
  <p><button>© 2021 Solleza'AniShelter. All rights reserved.</button></p>
</div>
 </body>

 <style>
     .card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}
</style>
 </html>