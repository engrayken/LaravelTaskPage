
@extends('dashboard.app')

@section('content')

<style>
   .switch {
     position: relative;
     display: inline-block;
     width: 60px;
     height: 34px;
   }

   .switch input {
     opacity: 0;
     width: 0;
     height: 0;
   }

   .slider {
     position: absolute;
     cursor: pointer;
     top: 0;
     left: 0;
     right: 0;
     bottom: 0;
     background-color: #ccc;
     -webkit-transition: .4s;
     transition: .4s;
   }

   .slider:before {
     position: absolute;
     content: "";
     height: 26px;
     width: 26px;
     left: 4px;
     bottom: 4px;
     background-color: white;
     -webkit-transition: .4s;
     transition: .4s;
   }

   input:checked + .slider {
     background-color: #2196F3;
   }

   input:focus + .slider {
     box-shadow: 0 0 1px #2196F3;
   }

   input:checked + .slider:before {
     -webkit-transform: translateX(26px);
     -ms-transform: translateX(26px);
     transform: translateX(26px);
   }

   /* Rounded sliders */
   .slider.round {
     border-radius: 34px;
   }

   .slider.round:before {
     border-radius: 50%;
   }
   </style>
<div class="content">
   <div class="row">

     <div class="col-lg-6 col-md-12">
       <div class="card ">
         <div class="card-header">
           <h4 class="card-title"> Admin Panel</h4>
         </div>
         <div class="card-body">
           <div class="table-responsive">
             <form action="#" method="POST">
                @csrf
                @if (Session::has('failed'))
<div class="alert alert-danger">{{ Session::get('failed') }}</div>
@endif


@if (Session::has('success'))
<div class="alert alert-success">{{ Session::get('success') }}</div>
@endif
                <span id="success" class="text-success"></span> <br>
                <span id="failed" class="text-danger"></span> <br>
                <span id="taskadd">
                <label for="add">Add Task</label>
                <input type="text" name="task" id="task" placeholder="Add Task" value="{{ old('task') }}" class="form-control" required>
                <span id="error" class="text-danger"></span> <br>
                <button type="submit" class="btn-info" style="border-radius:4px; margin:2px" name="submit" id="addtask">Add Task</button>
            </span>

            <span id="taskedit">
                <label for="add">Edit Task</label>
                <input type="hidden" name="taskid" id="taskid" placeholder="Add Task" value="" class="form-control" required>
                <input type="text" name="task" id="taskt" placeholder="Add Task" value="{{ old('task') }}" class="form-control" required>
                <span id="error" class="text-danger"></span> <br>
                <button type="submit" class="btn-info" style="border-radius:4px; margin:2px" name="submit" id="editedtask">Edited Task</button>
            </span>

            </form>

             <br>
           @foreach ($showtask as $item)
            <div class="form-control"> {{ $item->task }} <span style="float:right"><a class="try" href="" id="{{ $item->id }}" id2="{{ $item->task }}">E</a> | <a href="/delete/{{ $item->id }}">x</a></div> </span> <br>
           @endforeach
        </div>
         </div>
       </div>
     </div>
   </div>
 </div>
 <script src="{{ url('/js/jquery.min.js') }}">
 </script>
 <script>
      $(document).ready(function() {

        $('.try').click(function(e){
    e.preventDefault();

    $('#taskadd').hide();
    $('#taskedit').show();


    var id2= $(this).attr('id2');
    var id1= $(this).attr('id');

    $('#taskt').val(id2);
    $('#taskid').val(id1);
    // var name= $(this).attr('value');
   //var week = $("#week").val();
//    var student = idd;
// alert(idd);
        })

        $('#taskedit').hide();
$('#addtask').click(function(e){
// alert('dghkjhg');
e.preventDefault(e);

var task=$('#task').val();
if(task==''){
    $('#error').html('Task cant be empty');
} else {

    $('#success').hide();
    $('#failed').hide();
    // var examid="kdff";

$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  $.ajax({
    type:'POST',
          url:'{{ route('addtask') }}',
          //dataType: 'json',
        //   data:{'week':answer,'_token':$('input[name=_token]').val()},
          data:{'task':task,'_token':$('input[name=_token]').val()},


success:function(data) {

 if(data=='true'){
$('#success').html('Task Added Successful');
$('#success').show();
    $('#failed').hide();
    window.location='../dashboard/';

} else{
    $('#failed').html('Task could not add');
    $('#success').hide();
    $('#failed').show();
    window.location='../dashboard/';

}

},
error: function(xhr, status, error) {
//   var err = eval(+ xhr.responseText + );
var err = eval("(" + xhr.responseText + ")");

   $('#error').html(err.errors.week);

//    alert('dfghj');

}

  });
}

});

$('#editedtask').click(function(e){
// alert('dghkjhg');
e.preventDefault(e);

var taskid=$('#taskid').val();
var task=$('#taskt').val();
if(task==''){
    $('#error').html('Task cant be empty');
} else {

    $('#success').hide();
    $('#failed').hide();
    // var examid="kdff";

$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  $.ajax({
    type:'POST',
          url:'{{ route('edittask') }}',
          //dataType: 'json',
        //   data:{'week':answer,'_token':$('input[name=_token]').val()},
          data:{'task':task,'taskid':taskid,'_token':$('input[name=_token]').val()},


success:function(data) {

 if(data=='true'){
$('#success').html('Task Edited Successful');
$('#success').show();
    $('#failed').hide();
    setTimeout(() => {
    // alert('done');

    window.location='../dashboard/';

}, 1000);
} else{
    $('#failed').html('Task could not Edit');
    $('#success').hide();
    $('#failed').show();

    setTimeout(() => {
    // alert('done');

window.location='../dashboard/';

}, 1000);
}

},
error: function(xhr, status, error) {
//   var err = eval(+ xhr.responseText + );
var err = eval("(" + xhr.responseText + ")");

   $('#error').html(err.errors.week);

//    alert('dfghj');

}

  });
}

});

      });
 </script>
 @endsection
