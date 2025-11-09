@extends('backend.layouts.app')
@section('title') General Statistics @endsection
@section('content')
@section('content-header') General Statistics @endsection
@section('card-title') Add User @endsection
@section('main-content')

<div class="col-md-12">
  <div class="container-fluid">

    {{-- ===================== EXISTING STUDENT STATS (UNCHANGED) ===================== --}}
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><i class="far fa-chart-bar"></i> 2025 WISE Students Info</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row text-center">
              <div class="col-6 col-md-3">
                <input type="text" class="knob" value="30" data-width="90" data-height="90" data-fgColor="#3ef73bff">
                <div class="knob-label">Enrolled Students</div>
              </div>
              <div class="col-6 col-md-3">
                <input type="text" class="knob" value="70" data-width="90" data-height="90" data-fgColor="#d35cfbff">
                <div class="knob-label">Successful Students</div>
              </div>
              <div class="col-6 col-md-3">
                <input type="text" class="knob" value="-80" data-min="-150" data-max="150" data-width="90"
                  data-height="90" data-fgColor="#53e9a6ff">
                <div class="knob-label">Failed Students</div>
              </div>
              <div class="col-6 col-md-3">
                <input type="text" class="knob" value="40" data-width="90" data-height="90" data-fgColor="#00c0ef">
                <div class="knob-label">Graduated Students</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- ===================== NEW KPI CARDS SECTION ===================== --}}
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-tachometer-alt"></i> Key Performance Indicators (KPIs)</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box bg-primary">
            <span class="info-box-icon"><i class="fas fa-chart-line"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Average GPA</span>
              <span class="info-box-number">3.4</span>
              <div class="progress">
                <div class="progress-bar" style="width: 80%"></div>
              </div>
              <span class="progress-description">↑ 5% from last semester</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box bg-success">
            <span class="info-box-icon"><i class="fas fa-user-check"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Retention Rate</span>
              <span class="info-box-number">88%</span>
              <div class="progress">
                <div class="progress-bar" style="width: 88%"></div>
              </div>
              <span class="progress-description">↑ 3% from 2024</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box bg-warning">
            <span class="info-box-icon"><i class="fas fa-user-times"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Dropout Rate</span>
              <span class="info-box-number">6%</span>
              <div class="progress">
                <div class="progress-bar" style="width: 60%"></div>
              </div>
              <span class="progress-description">↓ 2% from 2024</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box bg-danger">
            <span class="info-box-icon"><i class="fas fa-trophy"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Top Department</span>
              <span class="info-box-number">Computer Science</span>
              <div class="progress">
                <div class="progress-bar" style="width: 90%"></div>
              </div>
              <span class="progress-description">Most enrolled students</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


      {{-- ===================== CHARTS ===================== --}}
<div class="col-md-12">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"><i class="far fa-chart-bar"></i> Number of Enrolled Students Last 2 Years (Bar Chart)</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div id="bar-chart" style="height: 300px;"></div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"><i class="far fa-chart-bar"></i> Ranks of Enrolled Students Last 2 Years (Donut Chart)</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div id="donut-chart" style="height: 300px;"></div>
            </div>
          </div>
        </div>
      </div> <!-- /.row -->
    </div> <!-- /.card-body -->
  </div> <!-- /.card -->
</div> <!-- /.col-md-12 -->


    {{-- ===================== APP INFO BOXES ===================== --}}
    <h5 class="mt-4 mb-2">Info Box From the App <code>UniGuide</code></h5>
   <div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h5 class="card-title"><i class="fas fa-layer-group"></i> App Engagement & Activities</h5>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box bg-info">
            <span class="info-box-icon"><i class="far fa-bookmark"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Bookmarks On Tree</span>
              <span class="info-box-number">41,410</span>
              <div class="progress"><div class="progress-bar" style="width: 70%"></div></div>
              <span class="progress-description">70% Increase in 30 Days</span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box bg-success">
            <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Likes</span>
              <span class="info-box-number">41,410</span>
              <div class="progress"><div class="progress-bar" style="width: 70%"></div></div>
              <span class="progress-description">70% Increase in 30 Days</span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box bg-warning">
            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Events</span>
              <span class="info-box-number">41,410</span>
              <div class="progress"><div class="progress-bar" style="width: 70%"></div></div>
              <span class="progress-description">70% Increase in 30 Days</span>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box bg-danger">
            <span class="info-box-icon"><i class="fas fa-comments"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Chats With Chatbot</span>
              <span class="info-box-number">41,410</span>
              <div class="progress"><div class="progress-bar" style="width: 70%"></div></div>
              <span class="progress-description">70% Increase in 30 Days</span>
            </div>
          </div>
        </div>
      </div> <!-- /.row -->
    </div> <!-- /.card-body -->
  </div> <!-- /.card -->
</div> <!-- /.col-md-12 -->


    {{-- ===================== NEW APP ACTIVITY SECTION ===================== --}}
    <h5 class="mt-4 mb-2">App Engagement & Activities</h5>
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h5 class="card-title mb-0">App Engagement & Activities</h5>
    </div>
    <div class="card-body">
      <div class="row">
        <!-- Most Active Users -->
        <div class="col-md-6">
          <div class="card card-outline card-success">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-users"></i> Most Active Users</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table table-striped mb-0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Interactions</th>
                    <th>Last Active</th>
                  </tr>
                </thead>
                <tbody>
                  <tr><td>1</td><td>Ahmad Khaled</td><td>254</td><td>Today</td></tr>
                  <tr><td>2</td><td>Rana Salem</td><td>230</td><td>1 day ago</td></tr>
                  <tr><td>3</td><td>Omar Alzoubi</td><td>218</td><td>2 days ago</td></tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Upcoming Events -->
        <div class="col-md-6">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title"><i class="fas fa-bell"></i> Upcoming Events</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <ul class="mb-0">
                <li>AI Workshop – 10 Nov 2025</li>
                <li>Career Fair – 15 Nov 2025</li>
                <li>Data Science Bootcamp – 20 Nov 2025</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



  </div>
</div>

{{-- ===================== SCRIPTS ===================== --}}
@section('script')
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ asset('plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('plugins/flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('plugins/flot/jquery.flot.pie.js') }}"></script>

<script>
$(function () {
  $('.knob').knob();

  // Bar Chart
  var bar_data = { data: [[1,5000],[2,10000],[3,15000],[4,20000],[5,25000],[6,30000]], bars:{show:true} };
  $.plot('#bar-chart', [bar_data], {
    grid:{borderWidth:1,borderColor:'#07ff38ff',tickColor:'#bfff00ff'},
    series:{bars:{show:true,barWidth:0.5,align:'center'}},
    colors:['#4ce2abff'],
    xaxis:{ticks:[[1,'Winter24'],[2,'Summer24'],[3,'Fall24'],[4,'Winter25'],[5,'Summer25'],[6,'Fall25']]}
  });

  // Donut Chart
  var donutData = [
    { label:'Excellent', data:40, color:'#005040ff' },
    { label:'Good', data:30, color:'#808b41ff' },
    { label:'Needs Improvement', data:30, color:'#3c8dbc' }
  ];
  $.plot('#donut-chart', donutData, {
    series:{pie:{show:true,radius:1,innerRadius:0.5,label:{show:true,radius:2/3,formatter:labelFormatter,threshold:0.1}}},
    legend:{show:false}
  });

  function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color:#fff; font-weight:600;">'+label+'<br>'+Math.round(series.percent)+'%</div>';
  }
});
</script>
@endsection
@endsection
@endsection
