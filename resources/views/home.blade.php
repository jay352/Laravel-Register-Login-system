@extends('layouts.app')

@section('content')

<head> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<!--for mark status-->
<script type="text/javascript">
   $(document).ready(function(){
        $("#status").on(function(){
            var status = $(this).val();
            //alert(id);
            $.ajax({
                type:"GET",
                 cache:false,
                 url:"http://127.0.0.1:8000/api/task/{task_id}",
                 dataType:"json",
                 data:{status},
 
                 success:function(data){

                    if(data.status=="success")\
                    {
                    alert('success');
                   }
                   else{
                    alert('error');
                   }
                }
            });
        });
    });
</script>


<!--add task script-->

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
       $(document).ready(function())
       {

$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
        $("#saveBtn").click(function(){
        var task = $('#taskForm').serialize();

      if(task!=="")
{
         $.ajax({
            type:"POST",
            url:"create-task",
            data:task:task,
            dataType:"json",
            cache:false,        

                 success:function(response){
                    if(response.status=="success")
                    {
                        alert("success"); 
                    }
                    else
                    {
                  alert("Error");
              }
           
           }
        });

         else{
            alert('please fill task field');
         }
     }
     });

            

    </script> 
        

<script type="text/javascript">
  
  function show()
    {
        var x=document.getElementById("hide");
     
        if(x.style.display!=="none")
        {
            x.style.display="none";
        }
        else
        {
           x.style.display="block";
        }
    }       
</script>
</head>



<!--button for show hide add task division-->
    <button onclick="show()">Add tasks</button>show/hide on click



<!--add task-->
    <div id="hide" class="mb-3 ">
         <div class="card-body">
            <form method="POST" id="taskForm">
                {{csrf_field()}}
                <div class="form-group" class="col-md-6">
                    <input type="text" name="Enter task" id="task" placeholder="Enter task name and discription" class="form-control">
               </div>
               <div class="form-group">                    <button type="button" id="saveBtn" class="btn btn-primary mb-3">Save task</button>
               </div>
           </form>
       </div>
   </div>


<div  class="container">
    <div  class="row justify-content-center">
        <div  class="col-md-8">
            <div  class="card">
                  <div  class="card-header">{{ __('Dashboard') }}
                  </div>
                  <div class="bg-success p-2 text-dark bg-opacity-25" class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
             



<h1>Task</h1>
<table class="table" border="1px">
    <tr class="table-info">
        <th class="table-info">Index</th>
        <th class="table-info">Task</th>
        <th class="table-info">Status</th>
    </tr>
    @foreach($data as $value)
    <tr class="table-info">
        <td class="table-info">{{$value->id}}</td>
         <td class="table-info"> {{$value->task}}</td>
          <td class="table-info">{{ $value->status? 'Completed' : 'Not Completed' }}</td>
    </tr>
@endforeach
</table>
<div class="status">
</div>        
              </div>
            </div>
        </div>
    </div>

@endsection
