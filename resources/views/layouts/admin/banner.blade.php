<div class="row tile_count">
    <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Members</span>
    <div class="count">{{$members}}</div>
    <span class="count_bottom"><i class="green">{{$memberIncrease}}</i> From last Week</span>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-clock-o"></i> Total Hotels</span>
    <div class="count">{{$hotels}}</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>{{$hotelIncrease}}</i> From last Week</span>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total Nominations</span>
    <div class="count green">{{$nominations}}</div>
      <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>{{$nominationIncrease}} </i> From last Week</span>
    </div>
    
  </div>