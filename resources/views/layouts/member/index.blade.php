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
                          <h5>Please follow the instructions</h5>
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
                              {{-- <ul class="nav nav-tabs" data-tabs="tabs">
                                  <li class="nav-item">
                                      <a class="nav-link active" href="#profile" data-toggle="tab">
                                          <i class="material-icons">bug_report</i> Bugs
                                          <div class="ripple-container"></div>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#messages" data-toggle="tab">
                                          <i class="material-icons">code</i> Website
                                          <div class="ripple-container"></div>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#settings" data-toggle="tab">
                                          <i class="material-icons">cloud</i> Server
                                          <div class="ripple-container"></div>
                                      </a>
                                  </li>
                              </ul> --}}
                          </div>
                      </div>
                  </div>
                  <div class="card-body">
                      <div class="tab-content">
                          {{-- <div class="tab-pane active" id="profile">
                              <table class="table">
                                  <tbody>
                                      <tr>
                                          <td>
                                              <div class="form-check">
                                                  <label class="form-check-label">
                                                      <input class="form-check-input" type="checkbox" value="" checked>
                                                      <span class="form-check-sign">
                                                          <span class="check"></span>
                                                      </span>
                                                  </label>
                                              </div>
                                          </td>
                                          <td>Sign contract for "What are conference organizers afraid of?"</td>
                                          <td class="td-actions text-right">
                                              <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                                  <i class="material-icons">edit</i>
                                              </button>
                                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                                  <i class="material-icons">close</i>
                                              </button>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>
                                              <div class="form-check">
                                                  <label class="form-check-label">
                                                      <input class="form-check-input" type="checkbox" value="">
                                                      <span class="form-check-sign">
                                                          <span class="check"></span>
                                                      </span>
                                                  </label>
                                              </div>
                                          </td>
                                          <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                                          <td class="td-actions text-right">
                                              <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                                  <i class="material-icons">edit</i>
                                              </button>
                                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                                  <i class="material-icons">close</i>
                                              </button>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>
                                              <div class="form-check">
                                                  <label class="form-check-label">
                                                      <input class="form-check-input" type="checkbox" value="">
                                                      <span class="form-check-sign">
                                                          <span class="check"></span>
                                                      </span>
                                                  </label>
                                              </div>
                                          </td>
                                          <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                                          </td>
                                          <td class="td-actions text-right">
                                              <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                                  <i class="material-icons">edit</i>
                                              </button>
                                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                                  <i class="material-icons">close</i>
                                              </button>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>
                                              <div class="form-check">
                                                  <label class="form-check-label">
                                                      <input class="form-check-input" type="checkbox" value="" checked>
                                                      <span class="form-check-sign">
                                                          <span class="check"></span>
                                                      </span>
                                                  </label>
                                              </div>
                                          </td>
                                          <td>Create 4 Invisible User Experiences you Never Knew About</td>
                                          <td class="td-actions text-right">
                                              <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                                  <i class="material-icons">edit</i>
                                              </button>
                                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                                  <i class="material-icons">close</i>
                                              </button>
                                          </td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
                          <div class="tab-pane" id="messages">
                              <table class="table">
                                  <tbody>
                                      <tr>
                                          <td>
                                              <div class="form-check">
                                                  <label class="form-check-label">
                                                      <input class="form-check-input" type="checkbox" value="" checked>
                                                      <span class="form-check-sign">
                                                          <span class="check"></span>
                                                      </span>
                                                  </label>
                                              </div>
                                          </td>
                                          <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                                          </td>
                                          <td class="td-actions text-right">
                                              <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                                  <i class="material-icons">edit</i>
                                              </button>
                                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                                  <i class="material-icons">close</i>
                                              </button>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>
                                              <div class="form-check">
                                                  <label class="form-check-label">
                                                      <input class="form-check-input" type="checkbox" value="">
                                                      <span class="form-check-sign">
                                                          <span class="check"></span>
                                                      </span>
                                                  </label>
                                              </div>
                                          </td>
                                          <td>Sign contract for "What are conference organizers afraid of?"</td>
                                          <td class="td-actions text-right">
                                              <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                                  <i class="material-icons">edit</i>
                                              </button>
                                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                                  <i class="material-icons">close</i>
                                              </button>
                                          </td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
                          <div class="tab-pane" id="settings">
                              <table class="table">
                                  <tbody>
                                      <tr>
                                          <td>
                                              <div class="form-check">
                                                  <label class="form-check-label">
                                                      <input class="form-check-input" type="checkbox" value="">
                                                      <span class="form-check-sign">
                                                          <span class="check"></span>
                                                      </span>
                                                  </label>
                                              </div>
                                          </td>
                                          <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                                          <td class="td-actions text-right">
                                              <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                                  <i class="material-icons">edit</i>
                                              </button>
                                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                                  <i class="material-icons">close</i>
                                              </button>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>
                                              <div class="form-check">
                                                  <label class="form-check-label">
                                                      <input class="form-check-input" type="checkbox" value="" checked>
                                                      <span class="form-check-sign">
                                                          <span class="check"></span>
                                                      </span>
                                                  </label>
                                              </div>
                                          </td>
                                          <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
                                          </td>
                                          <td class="td-actions text-right">
                                              <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                                  <i class="material-icons">edit</i>
                                              </button>
                                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                                  <i class="material-icons">close</i>
                                              </button>
                                          </td>
                                      </tr>
                                      <tr>
                                          <td>
                                              <div class="form-check">
                                                  <label class="form-check-label">
                                                      <input class="form-check-input" type="checkbox" value="" checked>
                                                      <span class="form-check-sign">
                                                          <span class="check"></span>
                                                      </span>
                                                  </label>
                                              </div>
                                          </td>
                                          <td>Sign contract for "What are conference organizers afraid of?"</td>
                                          <td class="td-actions text-right">
                                              <button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm">
                                                  <i class="material-icons">edit</i>
                                              </button>
                                              <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm">
                                                  <i class="material-icons">close</i>
                                              </button>
                                          </td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div> --}}
                          <nominations-index></nominations-index>
                      </div>
                  </div>
              </div>
          </div>
          
      </div>
  </div>

@endsection
