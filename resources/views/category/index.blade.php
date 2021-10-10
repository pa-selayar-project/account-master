@extends('layout.app')

@section('title','Category')

@section('style')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
@endsection

@section('content')
  <h1 class="text-center text-primary">Daftar Kategori</h1>
  <div class="float-right mb-3">
    <button type="button" class="btn btn-primary rounded addData" data-toggle="modal" data-target="#modal">Tambah Data</button>
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

  <table id="tabel" class="display" style="width:100%">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Kategory</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $d)  
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$d->category_name}}</td>
        <td>
          <button type="button" class="btn btn-warning rounded border-0 editData" data-id="{{$d->id}}" data-category="{{$d->category_name}}" data-toggle="modal" data-target="#modal">
            <i class="fa fa-edit"></i>
          </button>
          <button class="btn btn-danger rounded border-0" type="button">
            <i class="fas fa-trash"></i>
          </button>
        </td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <th>No</th>
        <th>Nama Kategory</th>
        <th>Action</th>
      </tr>
    </tfoot>
  </table>
@endsection

@section('modal')
  <div class="modal fade" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Kategori</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" action="#">
          @csrf
          <p class="patch"></p>
          <div class="modal-body">
            <div class="form-group">
              <label for="category_name">Kategori</label>
              <input type="text" name="category_name" id="category_name" class="form-control form-control-sm rounded-40">
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

      $('.addData').on('click',()=>{
        $('#modal form').attr('action','{{url('category')}}');
        $('.modal-title').html('Tambah Data');
        $('form .patch').html('');
        $('#category_name').val('');
      });

      $('.editData').on('click',function(){
        const id = $(this).data('id'),
              category = $(this).data('category');
        
        $('#modal form').attr('action','{{url('category')}}/'+id);
        $('.modal-title').html('Ubah Data');
        $('form .patch').html(`@method('patch')`);
        $('#category_name').val(category);
      });
    });
  </script>
@endsection