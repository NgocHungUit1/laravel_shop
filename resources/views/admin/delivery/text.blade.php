@extends('admin_layout')
@section('admin_content')
   <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê vận chuyển
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            
            
           
            
            <th>Tên thanh Pho</th> 
            <th>Tên quận huyện</th> 
            <th>Tên xã phường</th>
           
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($feeship as $key => $fee)
          <tr>
           
            <td>{{ $fee->city->name_city }}</td>
            <td>{{ $fee->province->name_quanhuyen }}</td>
            <td>{{ $fee->wards->name_xaphuong }}</td>
           
            <td><span class="text-ellipsis">
              
            </span></td>
           
           
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
          
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection