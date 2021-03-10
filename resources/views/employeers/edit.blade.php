@include('layouts.header')


<div class="container">
 <div class="text">
  <div class="container marginbot-50">
   <div class="row">
    <div class="col-lg-8 col-lg-offset-2">

     <div class="section-heading text-center">

       <h2 align="center">Редагувати </h2>
       <div class="divider-header"></div>
     </div>

   </div>
 </div>

</div>
</div>
<form name = "upload" action="{{route('edit_empl',$employeer->id)}}" enctype="multipart/form-data" method="post" >


 <div class="text">
  <div class="row">
    <div class="col-sm-2">
    </div>

    <div class="col-sm-8">


      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="inputEmail4">Ім'я</label>
          <input type="text" class="form-control" id="fname" name="fname" placeholder="Ім'я" value={{$employeer->fname}}>
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4">Прізвище</label>
          <input type="text" class="form-control" id="sname" name="sname" placeholder="Прізвище" value={{$employeer->sname}}>
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4">По батькові</label>
          <input type="text" class="form-control" id="pname" name="pname" placeholder="По батькові" value={{$employeer->pname}}>
        </div>
        <div class="form-group col-md-6">
          <select  name="department_id">
            <option value="">Відділ</option>
            @foreach ($departments as $department)
            <option value="{{$department->dep_id}}">{{$department->name}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Зберегти</button>
    </div>

    <div class="col-sm-2">
    </div>
  </div>
</div>
</div>
{{ csrf_field() }}
</form>
@include('layouts.footer')
