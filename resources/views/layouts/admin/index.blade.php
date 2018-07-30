@extends('layouts.admin.master')

@section('content')



@if($winners)
<div class="row">
  <h2>Final Winners</h2>
@foreach ($winners as $winner)

  <div class="col-md-3 col-sm-12 col-xs-12">
    <div class="x_panel tile fixed_height_600">
      <div class="x_title">
        <h5>{{ $winner->category }}</h5>
        
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

            <table style="width:100%">
                <tr>
                  <th>Name:</th>
                  <td>{{$winner->name}} </td>
                </tr>
                <tr>
                  <th>Hotel:</th>
                  <td>{{$winner->hotel}}</td>
                </tr>
                <tr>
                  <th>Title:</th>
                  <td>{{$winner->title}}</td>
                </tr>
                <tr>
                    <th>Final Score:</th>
                    <td>{{$winner->total_final_score}}</td>
                  </tr>
              </table>
        
      </div>
    </div>
  </div>

  @endforeach

</div>
@endif
<br />




<div class="row">


  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel tile fixed_height_600">
      <div class="x_title">
        <h2>Notification and instruction</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <messenge-vue>
        </messenge-vue>
        

      </div>
    </div>
  </div>

  

</div>




@endsection

@section('javascript')

  
@endsection