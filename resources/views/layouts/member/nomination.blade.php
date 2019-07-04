@extends('layouts.member.master')

@section('content')

<div class="container-fluid">

  <div class="row">
          <div class="col-lg-12 col-md-12">
              <div class="card">
                  <div class="card-header card-header-tabs card-header-primary">
                      <div class="nav-tabs-navigation">
                          <div class="nav-tabs-wrapper">
                              <h3 class="nav-tabs-title"><i class="material-icons">content_paste</i>Nominations</h3>
                          </div>
                      </div>
                  </div>
                  <div class="card-body">
                      <div class="tab-content">
                         
                          <nominations-index></nominations-index>
                      </div>
                  </div>
              </div>
          </div>
          
      </div>
      @if($count< 4 && $count >0)
      <div class="row" >
          <div class="col-lg-2 col-sm-12">
                @if($setting && !$setting->application_on)
                    <button class="btn btn-primary add"  id="add-more" >
                        Add More
                    </button>
                @elseif($setting->application_on)
                
                <button class="btn btn-primary add disabled" disabled id="add-more">
                    Add More
                    </button>
                @endif
          </div>
        </div>
        @endif
        <div class="row" id="add-more-area" style="display: none" >
            <div class="col-lg-12 col-sm-12">
                <div class="card">
                <add-nominee></add-nominee>
            </div>
          </div>
        </div>
        
</div>


  @endsection