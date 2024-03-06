@extends('layouts.app')
@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
  <div class="card-header"class="btn mt-2" style="background-color: #DBBAD9;">{{ __('Create Product') }}</div>
                    <div class="card-body">
<div class="card-header">
<div class="card-body">
<form action="" method="post"
enctype="multipart/form-data">
@csrf
<div class="form-group">
<label>Name</label>
<input type="text" name="name" placeholder="Name"
class="form-control">
</div>
<div class="form-group">
<label>Description</label>
<input type="text" name="description"
placeholder="Description" class="form-control">
</div>
<div class="form-group">
<label>Price</label>
<input type="number" name="price" placeholder="Price"
class="form-control">
</div>
<div class="form-group">
<label>Stock</label>
<input type="number" name="stock" placeholder="Stock"
class="form-control">
</div>
<div class="form-group">
<label><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
    <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z"/>
  </svg> Image</label>
<input type="file" name="image" class="form-control">
</div>
<button type="submit" class="btn btn-primary mt-3">Submit 
data</button>
</form>
</div>
</div>
</div>
</div>
</div>
@endsection
    </body>
</html>