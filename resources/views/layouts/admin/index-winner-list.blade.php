@extends('layouts.admin.master')

@section('content')

@if($winners)
<div class="row">
  


  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel tile fixed_height_600">
      <div class="x_title">

            <h2>Final Winners</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
            
            <table id="winner-table" style="width:100%">
                    <thead>
                    <tr>
                            <th>Category:</th>
                            <th>Name:</th>
                            <th>Hotel:</th>
                            <th>Title:</th>
                            <th>Final Score:</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                                @foreach ($winners as $winner)
                                <tr>
                                    <td>{{ $winner->category }}</td>
                                    <td>{{$winner->name}} </td>
                                  <td>{{$winner->hotel}}</td>
                                  <td>{{$winner->title}}</td>
                                  <td>{{$winner->total_final_score}}</td>
                                </tr>
                                @endforeach
                        </tbody>
                          
              </table>
              
      </div>
    </div>
  </div>

 

</div>
@endif

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <table id="winner_list_table" class="display">
        
      <thead>
          <tr>
                
                <th>Category</th>
              <th>Name</th>
              <th>Title</th>
              <th>Hotel</th>
              <th>Alan Steel</th>
              <th>Bjorn Hanson, Ph.D.</th>
              <th>Almerinda Forte</th>
              <th>Larry's Lawrence</th>
          </tr>
      </thead>
      
  </table>
  </div>

</div>
<br />


@section('style')
<style>
#winner-table  {
            /* font-family: arial, sans-serif; */
            border-collapse: collapse;
            width: 100%;
            
        }
        
        #winner-table td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            
        }
        
        /* tr:nth-child(even) {
            background-color: #dddddd;
        } */
</style>
        
@endsection

@endsection

@section('javascript')

  
@endsection

