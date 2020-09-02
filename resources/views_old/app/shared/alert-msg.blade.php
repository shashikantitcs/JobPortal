


@if ($errors->any())
<div class="row">
<div class="col-md-12">
<div class="alert alert-danger" role="alert">
    <ul>
    @foreach ($errors->all() as $e)
       <li><strong>{{$e}}</strong></li>
    @endforeach
   </ul>
</div>
</div>
</div>
@endif

@if (session()->has('success'))
<div class="row">
    <div class="col-md-12">
    <div class="alert alert-success" role="alert">
        <strong>{{session()->get('success')}}</strong>
    </div>
</div>
</div>
@endif

@if (session()->has('error'))
<div class="row">
    <div class="col-md-12">
    <div class="alert alert-danger" role="alert">
        <strong>{{session()->get('error')}}</strong>
    </div>
</div>
</div>
@endif
