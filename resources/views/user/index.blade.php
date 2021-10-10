@extends('layout.app')

@section('title','Dashboard User')

@section('style')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
@endsection

@section('content')
  <h1 class="text-center text-primary">Daftar Akun Aplikasi dan Password</h1>
  <div class="float-right mb-3">
    <button type="button" id="addData" class="btn btn-primary rounded" data-toggle="modal" data-target="#modal">Tambah Data</button>
  </div>
  
  @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <table id="tabel" class="display text-center" style="width:100%">
    <thead>
      <tr>
        <th width="5%">No</th>
        <th width="20%">Nama Aplikasi</th>
        <th width="15%">Kategori</th>
        <th width="15%">Password</th>
        <th width="30%">Action</th>
        <th width="15%">Link</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $d)  
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$d->app_name}}</td>
        <td>{{$d->category->category_name}}</td>
        <td>
          <input class="form-control form-control-sm mr-1" type="password" id="{{$d->id}}" value="{{$d->app_pass}}"> 
        </td>
        <td>
          <button type="button" class="btn btn-secondary rounded border-0" data-id="{{$d->id}}">
            <i class="fa fa-eye"></i>
          </button>
          <button class="btn btn-primary rounded border-0" type="button" onclick="myFunction({{$d->id}})">
            <i class="fas fa-copy"></i>
          </button>
          <button class="btn btn-warning rounded border-0" type="button" data-edit="{{$d->id}}" data-toggle="modal" data-target="#modal">
            <i class="fas fa-edit"></i>
          </button>
          <button class="btn btn-danger rounded border-0" type="button" data-hapus="{{$d->id}}">
            <i class="fas fa-trash"></i>
          </button>
          <form class="hapusData" method="post">
            @csrf
            @method('delete')
          </form>
        </td>
        <td>
          <a href="http://{{$d->app_link}}" target="_blank">Link <i class="fas fa-paper-plane"></i></a>
        </td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <th width="5%">No</th>
        <th width="20%">Nama Aplikasi</th>
        <th width="15%">Kategori</th>
        <th width="15%">Password</th>
        <th width="30%">Action</th>
        <th width="15%">Link</th>
      </tr>
    </tfoot>
  </table>
@endsection

@section('modal')
  <div class="modal fade" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" action="#">
          <div class="modal-body">
            @csrf
            <p class="patch"></p>
            <div class="form-group">
              <label for="app_name">Nama Aplikasi</label>
              <input type="text" name="app_name" id="app_name" class="form-control form-control-sm rounded-40">
            </div>
            <div class="form-group">
              <label for="app_pass">Password</label>
              <input type="password" name="app_pass" id="app_pass" class="form-control form-control-sm rounded-40">
            </div>
            <div class="form-group">
              <label for="app_link">Link</label>
              <input type="text" name="app_link" id="app_link" class="form-control form-control-sm rounded-40">
            </div>
            <div class="form-group">
              <label for="category_id">Kategori</label>
              <select name="category_id" id="category_id" class="form-control form-control-sm rounded-40">
                @foreach($select as $s)
                  <option class="pilih" value="{{$s->id}}">{{$s->category_name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
  <script>
    $(document).ready(function() {
      $('#tabel').DataTable();

      $('.btn-secondary').on('click',function(){
        const id = $(this).data('id');
        $('#'+id).attr('type','text');
      });

      $('#addData').on('click',()=>{
        $('#modal form').attr('action','{{url('user')}}');
        $('form .patch').html('');
        $('#app_name').val('');
        $('#app_pass').val('');
        $('#app_link').val('');
      });

      $('.btn-warning').on('click',function(){
        const edit = $(this).data('edit');
        
        $('#modal form').attr('action','{{url('user')}}/'+edit);
        $('.modal-title').html('Ubah Data');
        $('form .patch').html(`@method('patch')`);
        
        $.ajax({
          url:'user/get_data/'+edit+'/hasil',
          type:'GET',
          success:function(e){
            $('#app_name').val(e.app_name);
            $('#app_pass').val(e.app_pass);
            $('#app_link').val(e.app_link);
          }
        })
      });

      $('.btn-danger').on('click',function(){
        // console.log($(this).data('hapus'))
        alert('Apakah mau menghapus data ini?');
        $('.hapusData').attr('action',`{{url('user')}}`+'/'+ $(this).data('hapus'));
        $('.hapusData').submit();
      });

    });

    function myFunction(id) {
      /* Get the text field */
      var copyText = document.getElementById(id);

      /* Select the text field */
      copyText.select();
      copyText.setSelectionRange(0, 99999); /* For mobile devices */

      /* Copy the text inside the text field */
      navigator.clipboard.writeText(copyText.value);
    }
    
  </script>
@endsection