@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">
    <style type="text/css">
        p.title_thongke{
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }

    </style>
    <div class="row">
        <p class="title_thongke">Thong ke don hang doanh so</p>
        <form autocomplete="off">
            @csrf
            <div class="col-md-2">
                <p>Tu Ngay: <input type="text" id="datepicker" class="form-control"></p>
                <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Loc Ket Qua"></p>

            </div>
            <div class="col-md-2">
                <p>Đến Ngày: <input type="text" id="datepicker2" class="form-control">
                </p>
                
            </div>
            <div class="col-md-2">
                <p>
                    Lọc theo:
                    <select class="dashboard-filter form-control">
                    <option value="">Lọc </option>
                        <option value="7ngay">7 ngày qua </option>
                        <option value="thangtruoc">Tháng trước </option>
                        <option value="thangnay">Tháng nay </option>
                        <option value="365ngayqua">Năm nay</option>
                    </select>
                </p>
            </div>
        </form>
        <div class="col-md-12">
            <div id="myfirstchart" style="height: 150px;"></div>

        </div>

    </div>
    <div class="row">
        <style type="text/css">
            table.table.table-dark{
                background:#32383e;

            } table.table.table-dark tr th{
                color: #fff;
            }

        </style>
    <p class="title_thongke">Thống kê truy cập </p>
    <table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">Đang Online</th>
      <th scope="col">Tổng tháng trước</th>
      <th scope="col">Tổng tháng này</th>
      <th scope="col">Tổng năm nay</th>
      <th scope="col">Tổng truy cập</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <td>{{$visitor_count}}</td>
      <td>{{$visitor_lastmonth_count}}</td>
      <td>{{$visitor_thismonth_count}}</td>
      <td>{{$visitor_thisyear_count}}</td>
      <td>{{$visitor_total}}</td>
    </tr>
  
  </tbody>
</table>

    </div>
<div class="row">
    <div class="col-md-4 col-xs-12">
        <p class="title_thongke">Thống kê tổng số lượng</p>
        <div id="donut" class="morris-donut-inverse"></div>

        
    </div>


<div class="col-md-4 col xs-12">
    <style type='text/css'>
        ol.list_views{
            margin: 10px 0;
            color:darkred;
        }
        ol.list_views a{
            color:#fff;
            font-weight: 400;
        }
    </style>
    <h3>Sản phẩm xem nhiều</h3>
    <ol class="list_views">
        @foreach($product_views as $key =>$product)
        <li>
            <a target="_blank" href="{{URL::to('/chi-tiet/'.$product->product_id)}}">{{$product->product_name}}
                <span style="color:red">{{$product->product_views}}</span>(views)
            </a>
        </li>
        @endforeach

    </ol>

</div>
</div>


</div>

@endsection