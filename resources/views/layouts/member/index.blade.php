@extends('layouts.member.master')

@section('content')


  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-8 col-md-6 col-sm-6">
              <div class="card card-stats">
                  <div class="card-header card-header-warning card-header-icon">
                      <div class="card-icon">
                            <i class="material-icons">
                                    notification_important
                                    </i>
                      </div>
                      {{-- <p class="card-category">Used Space</p> --}}
                      <h3 class="card-title">Instructions
                          
                      </h3>
                  </div>
                  <div class="card-footer">
                      <div class="stats">
                          
                          <h5 style="white-space: pre-wrap;color:black">{!! $messenge->text !!}</h5>
                      </div>
                  </div>
              </div>
          </div>
          
          <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                              <i class="material-icons">
                                    account_box
                                      </i>
                        </div>
                        {{-- <p class="card-category">Used Space</p> --}}
                        <h3 class="card-title">{{ auth()->user()->name }}
                            
                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                                
                                <ul class="list-group">
                                    
                                        <li class="list-group-item">{{ $profile->company }}</li>
                                        <li class="list-group-item">{{ $profile->address }}</li>
                                        <li class="list-group-item">{{ $profile->title }}</li>
                                        <li class="list-group-item">{{ $profile->phone }}</li>
                                        {{-- @foreach ($profile as $key => $value)
                                        <li class="list-group-item">{{ $key }}</li>
                                        @endforeach --}}
                                </ul>
                                
                        </div>
                    </div>
                </div>
            </div>
      </div>
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
  </div>

@endsection
