@extends('layouts.base')
@section('title', 'Antar Bahan / Rujukan')
@section('assets')
<link rel="stylesheet" type="text/css" href="/assets/js/plugin/datatables-1.12.1/src/css/dataTables.bootstrap.min.css">

<script src="/assets/js/plugin/datatables-1.12.1/src/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/plugin/datatables-1.12.1/src/js/dataTables.bootstrap4.min.js"></script>

@endsection
@section('content')
<div class="card">
	<div class="card-header">
		<h4 class="card-title">Antar Bahan / Rujukan</h4>
	</div>
	<div class="card-body">
		<div class="d-flex gap-4 justify-content-around bd-highlight">
			<div class="input-group">
		        <div class="input-group-prepend">
		          <span class="input-group-text"><i class="fa fa-calendar"></i></span>
		        </div>
		        <input type="date" class="form-control form-control-sm" placeholder="Tanggal" id="tgl-dari">
	      	</div>
	      	&nbsp;
	      	<div class="input-group">
	      		<div class="input-group-prepend">
		      		<span class="input-group-text"><i class="fa fa-calendar"></i></span>
		      	</div>
		      	<input type="date" class="form-control form-control-sm" placeholder="Tanggal" id="tgl-sampai" />
		    </div>
		    &nbsp;
	      	<div class="input-group">
	      		<div class="input-group-prepend">
		      		<span class="input-group-text"><i class="fa fa-user"></i></span>
		      	</div>
		      	<select class="form-control form-control-sm" id="user_id">
					<option value="">Pilih PU</option>
					@foreach($user as $item)
					<option value="{{$item->id}}">{{$item->namalengkap}}</option>
					@endforeach
				</select>
	    	</div>
		    &nbsp;
		    <div class="input-group">
		    	<button title="Cari" class="btn btn-primary btn-sm" onclick="get_list_data()"><i class="fa fa-search" style="font-size: 14px;"></i></button>
		    	&nbsp;
		    	<button title="Refresh" class="btn btn-primary btn-border btn-sm" onclick="get_list_data()"><i class="fa fa-history" style="font-size: 14px;"></i></button>
		    	&nbsp;
		    	<a id="cetak-laporan" href="javascript:void(0)" target="_blank" title="Cetak Laporan" class="btn btn-success btn-sm"><i class="fa fa-print" style="font-size: 14px;"></i></a>
		    </div>
		</div>
		<hr/>
		<div class="table-responsive">
			<table id="basic-datatables" class="display table table-bordered table-striped table-hover" style="width: 100%;">
				<thead>
					<tr>
						<th style="width:3%">No</th>
						<th>Tanggal</th>
						<th>Nama Petugas</th>
						<th>Tujuan Lab</th>
						<th>Nama Penerima</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>
	</div>
</div>

@section('script')
<script type="text/javascript">
var table;
var data_selected=null;
var pk_selected=null;

$(document).ready(function(){
	// $('#birth').datetimepicker({
	// 	format: 'MM/DD/YYYY'
	// });
	// $('#basic-datatables').DataTable();
	//$.fn.dataTableExt.sErrMode = 'throw';
    $.fn.dataTable.ext.errMode = 'none';
    table = $('#basic-datatables').DataTable({
	    "processing": true, //Feature control the processing indicator.
	    "serverSide": true, //Feature control DataTables' server-side processing mode.
	    // Load data for the table's content from an Ajax source
	    "ajax": {
	        "url": "{{url('antarbahan/all')}}",
	        "type": "GET"
	    },
	    columns: [
	        {
	            searchable: false,
	            render: function (data, type, row, meta) {
	                return '<small class="h6">'+ parseInt(meta.row + meta.settings._iDisplayStart + 1) +'</small>'
	            }
	        },
	        {
	        	data: "created_at",
	        	searchable:false,
	            render: function (data, type, row, meta) {
	                // return moment(row.created_at).locale('id').format('LLL');
	                return '<span class="badge badge-dark">'+moment(row.created_at).locale('id').format('LLL')+'</span>'
	            }
	        },
	        {
	        	data: "user_id",
	        	searchable:false,
	            render: function (data, type, row, meta) {
	                return '<small class="h6">'+row?.user?.namalengkap+'</small>'
	            }
	        },
	        {
	        	data: "lab_id",
	            render: function (data, type, row, meta) {
	                return '<small class="h6">'+ row?.lab?.nama +'</small>'
	            }
	        },
	        // {data: "penerima"},
	        {
	        	data: "penerima",
	            render: function (data, type, row, meta) {
	                if(row.penerima != null){
	            			return '<small class="h6">'+row.penerima+'</small>'
	            		}
	                return ''
	            }
	        },
	        
	    ],
	    "language": {
            "lengthMenu": "_MENU_",
            // "processing": "<img src='/img/loading.gif' />"
            'paginate': {
            	'first':'',
            	'last':'',
		      	'previous': '<i class="fa fa-arrow-left"></i>',
		      	'next': '<i class="fa fa-arrow-right"></i>'
		    },
		    "decimal":        "",
		    "emptyTable":     "Data tidak tersedia",
		    "info":           "_START_ / _END_ Total _TOTAL_ ",
		    "infoEmpty":      "0 / 0 Total 0",
		    "infoFiltered":   "(filtered from _MAX_ total entries)",
		    "infoPostFix":    "",
		    "thousands":      ",",
		    "loadingRecords": "Loading...",
		    "processing":     "",
		    "search":         "Cari:",
		    "zeroRecords":    "Tidak ada kecocokan data",
		    "aria": {
		        "sortAscending":  ": activate to sort column ascending",
		        "sortDescending": ": activate to sort column descending"
		    }
	    },
	    "order": [[ 1, 'desc' ]],
	    "sDom": "<'row'<'col-sm-1'l><'col-sm-8'<'dt_actions'>><'col-sm-3'f>r>t<'row'<'col-sm-5'i><'col-sm-7'p>>",
  	});
  	//$("div.toolbar").html(' <select class="form-control input-sm"><option value="">a</option></select>');
  	// $('#basic-datatables tbody').on( 'click', 'tr', function(){
	  //   if ($(this).hasClass('selected')) {
	  //       $(this).removeClass('selected');
	  //   }
	  //   else {
	  //       table.$('tr.selected').removeClass('selected');
	  //       $(this).addClass('selected');
	  //   }
	  //   // data_selected = table.row( this ).data();
	  //   // console.log(data_selected)
  	// });
  	// $('.dt_actions').html($('.dt_index_actions').html());
  	$('#basic-datatables tbody').on('dblclick', 'tr', function () {
		var data = table.row( this ).data();
		// set_data(data)
	});
});


function convert_date(tgl) {
	var date = new Date(tgl);
	var day = date.getDate();
	var month = date.getMonth() + 1;
	var year = date.getFullYear();
	return year+'-'+month+'-'+day;
}

function get_list_data(){
	var tgl_dr = $('#tgl-dari').val()
    table.ajax.url('{{url('antarbahan/all')}}?user_id='+$('#user_id').val()+'&tgl-dari='+$('#tgl-dari').val()+'&tgl-sampai='+$('#tgl-sampai').val()).load();
    $('#cetak-laporan').attr('href','/antarbahan/laporan?user_id='+$('#user_id').val()+'&from='+$('#tgl-dari').val()+'&to='+$('#tgl-sampai').val())
    //table.ajax.reload(null,false);
}

</script>
@endsection
@endsection