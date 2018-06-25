@extends('layouts.admin.master')

@section('content')




<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <table id="nomination_table" class="display">
        
      <thead>
          <tr>
                  <th></th>
              <th>Category</th>
              <th>Name</th>
              <th>Title</th>
              <th>Total Score</th>
              {{-- <th>Q2</th>
              <th>Q3</th>
              <th>Q4</th>
              <th>Q5</th> --}}
              <th>Hotel</th>
              <th>Nominated by</th>
              <th>Nominated on</th>
          </tr>
      </thead>
      
  </table>
  </div>

</div>
<br />






@endsection

@section('javascript')

  
@endsection