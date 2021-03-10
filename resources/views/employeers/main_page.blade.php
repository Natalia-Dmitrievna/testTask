
@include('layouts.header')
<main role="main">


 <div class="album py-5 bg-light">

  <div class="container">
    @if(Auth::check())
   <a href="add" class="btn btn-primary my-2">Додати співробітника</a>
   @endif
    <form action="{{route('searchSimple')}}" method="GET" class="search-simple">
      <div class="row">
        <div class="col-xs-10">
          <div class="form-group">
            <input type="text" class="form-control" name="q" value="" required>
          </div>
        </div>
        <div class="col-xs-2">
          <div class="form-group">
            <input class="btn btn-info" type="submit" value="Искать">
          </div>
        </div>
      </div>
    </form>
    <div class="row">

     <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Ім'я</th>
          <th scope="col">Прізвище</th>
          <th scope="col">По батькові</th>
          <th scope="col">Відділ</th>
          @if(Auth::check())
          <th scope="col"></th>
          <th scope="col"></th>
          @endif
        </tr>
      </thead>
      <tbody>
        @foreach ($employeers as $employeer)
        <tr>
          <th scope="row">{{ $employeer->id }}</th>
          <td>{{ $employeer->fname }}</td>
          <td>{{ $employeer->sname }}</td>
          <td>{{ $employeer->pname }}</td>
          <td>{{ $employeer->name }}</td>
          @if(Auth::check())
          <td><a href="{{$employeer->id}}/edit" class="btn btn-sm btn-outline-secondary"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
          <td><a href="{{$employeer->id}}/delete" class="btn btn-sm btn-outline-secondary"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
          @endif
        </tr>
        @endforeach
      </tbody>
    </table>
    {{$employeers->render()}}
  </div>
</div>
</div>

</main>

@include('layouts.footer')
