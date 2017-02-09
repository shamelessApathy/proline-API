@if ($errors->count())
   <div class="alert danger">
       <strong>Whoops!</strong> There were some problems with your input.

       <ul>
           @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
           @endforeach
       </ul>
   </div>
@endif

@if (isset($success) || Session::has('success'))
   <div class="alert success">
       <strong>Success!</strong>

       <ul>
           <li>{!! isset($success) ? $success : Session::get('success') !!}</li>
       </ul>
   </div>
@endif

@if (isset($info) || Session::has('info'))
   <div class="alert info">
       <strong>Notice</strong>

       <ul>
           <li>{!! isset($info) ? $info : Session::get('info') !!}</li>
       </ul>
   </div>
@endif

@if (isset($warning) || Session::has('warning'))
   <div class="alert warning">
       <strong>Warning!</strong>

       <ul>
           <li>{!! isset($warning) ? $warning : Session::get('warning') !!}</li>
       </ul>
   </div>
@endif

@if (isset($danger) || Session::has('danger'))
   <div class="alert danger">
       <strong>Danger!</strong>

       <ul>
           <li>{!! isset($danger) ? $danger : Session::get('danger') !!}</li>
       </ul>
   </div>
@endif

@if (Session::has('exam-failure'))
   <div class="alert exam-failure">
       <strong>Exam Failed</strong>

       <ul>
           <li>{!! Session::get('exam-failure') !!}</li>
       </ul>
   </div>
@endif

@if (isset($status) || Session::has('status'))
   <div class="alert success">
       <strong>Success!</strong>

       <ul>
           <li>{!! isset($status) ? $status : Session::get('status') !!}</li>
       </ul>
   </div>
@endif