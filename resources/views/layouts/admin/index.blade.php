@extends('layouts.admin.master')

@section('content')




<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    
  </div>

</div>
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