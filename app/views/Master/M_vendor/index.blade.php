@extends('Parent.master')

@section('styles')
<link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Master Vendor
            <div class="pull-right" >
                <a class="btn btn-primary bn-sm" href="master/vendor/new" >New</a>
            </div>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box" >
                    <div class="box-header" >
                        <h3 class="box-title">Filter {{(isset($isfilter)?'{<i><b>'.$filter_col.':'.$filter_val.'</b></i>}':'')}}</h3>
                        <div class='box-tools'>
                            <button id="btnFilter" class="btn btn-box-tool" data-widget='collapse'><i class='fa fa-minus'></i></button>
                        </div>
                    </div>
                    <div class="box-body" >
                        <form role="form" id="formFilter" action="master/vendor/filter" method="POST">
                            <div class="box-body no-padding">
                                <div class="form-vendor">
                                    <label for="exampleInputEmail1">Column</label>
                                    {{Form::select('column',$colarr,(isset($isfilter)?$filter_col:null),array('class'=>'form-control'))}}
                                </div>
                                <div class="form-vendor">
                                    <label for="exampleInputPassword1">Value</label>
                                    <input value="{{isset($isfilter)?$filter_val:''}}" type="text" class="form-control" name="value" required>
                                </div>
                            </div><!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                @if(isset($isfilter))
                                <a class="btn btn-danger" href="master/vendor" >Clear Filter</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title">Data Table</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-condensed table-striped table-hover ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Vendor ID</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Contact Person</th>
                                    <th>Alamat</th>
                                    <th>User Pembuat</th>
                                    <th>Tanggal Pembutan</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $rownum = ($data->getCurrentPage() - 1) * Helpers::constval('show_number_datatable') + 1; ?>
                                @foreach($data as $dt)
                                <tr>
                                    <td class="text-right">{{$rownum++}}.</td>
                                    <td>{{$dt->fcvendorid}}</td>
                                    <td>{{$dt->fcname}}</td>
                                    <td>{{$dt->fcdesc}}</td>
                                    <td>{{$dt->fccontperson}}</td>
                                    <td>{{$dt->fcaddress}}</td>
                                    <td>{{$dt->fcuserid}}</td>
                                    <td>{{date('d-m-Y', strtotime($dt->fctanggal))}}</td>
                                    <td class="text-right">
                                        <a class="btn btn-xs btn-success" href="master/vendor/edit/{{$dt->rowguid}}" >Edit</a>
                                        <a class="btn btn-xs btn-danger btn-delete" href="master/vendor/delete/{{$dt->rowguid}}" >Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                        </table>

                        {{$data->links()}}
                    </div><!-- /.box-body -->
                </div><!-- /.box -->  
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
@stop

@section('scripts')
<!-- DATA TABES SCRIPT -->
<script src="plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">
    $(function () {
        //sembunyikan form filter
        var isfilter = '{{isset($isfilter)?$isfilter:""}}';
        $('#formFilter').hide();
        if (!isfilter) {
            $('#btnFilter').click();
        }
        $('#formFilter').show();
        $('.btn-delete').click(function () {
            if (confirm('Hapus data ini?')) {

            } else {
                return false;
            }
        });

    });
</script>
@stop