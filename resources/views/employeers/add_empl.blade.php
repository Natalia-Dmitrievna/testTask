@include('layouts.header')
<div class="container">
        <h3>Заповніть всі поля форми</h3>
        {!! Form::open(['route' => 'new_empl', 'enctype' => 'multipart/form-data', 'id' => 'create_prob']) !!}
        <div class="row">
            <div class="form-group col-md-6">
                {{Form::label('fname', 'Ім’‎я')}}
                {{Form::text('fname', null, ['class' => 'form-control' . ($errors->has('fname') ? ' is-invalid' : ''), 'placeholder' => 'Введіть ім’‎я'])}}
                <p class="text-danger">{{$errors->has('fname') ? 'Неправильно заповнене поле "Ім’‎я"' : ''}}</p>
            </div>
            <div class="form-group col-md-6">
                {{Form::label('sname', 'Прізвище')}}
                {{Form::text('sname', null, ['class' => 'form-control' . ($errors->has('sname') ? ' is-invalid' : ''), 'placeholder' => 'Введіть прізвище'])}}
                <p class="text-danger">{{$errors->has('sname') ? 'Неправильно заповнене поле "Прізвище"' : ''}}</p>
            </div>
            <div class="form-group col-md-6">
                {{Form::label('pname', 'По батькові')}}
                {{Form::text('pname', null, ['class' => 'form-control' . ($errors->has('pname') ? ' is-invalid' : ''), 'placeholder' => 'Введите отчество'])}}
                <p class="text-danger">{{$errors->has('pname') ? 'Неправильно заповнене поле "По батькові"' : ''}}</p>
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
       
        <div class="form-group">
            {{Form::submit('Додати', ['class' => 'btn btn-success'])}}
        </div>

        {!! Form::close() !!}
        
    </div>

    
@include('layouts.footer')
