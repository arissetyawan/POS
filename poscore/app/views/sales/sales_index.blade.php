<div class="page-header position-relative">
	<div class="row-fluid">
		<div class="span12">
			<div class="span3">
				<h1>
					Sales Records
				</h1>
			</div>

			<div class="span4">
				@if(User::permitted( 'role.admin'))
			 	{{Form::open(array('route'=>'todaysale', 'method' => 'get', 'id'=>'recordsearchform', 'class'=>'form-inline', 'style'=>'display:inline-block; margin-top:10px; margin-bottom:0 ') ) }}
					<div class="control-group">
						<!--<div class="inline">
							<select name="record_type" id="record_type" class="hide">
								<?php //$record_types = array('sales'=>'Sales') ?>
								{{--@foreach($record_types as $v=>$op)
									<option value="{{$v}}" @if( isset($_GET['record_type']) && $_GET['record_type'] === $v ) selected="selected" @endif> {{$op}}
								@endforeach--}}
							</select>
						</div>-->

						<div class="inline input-prepend">
							<span class="add-on">
								<i class="icon-calendar"></i>
							</span>
							{{Form::text('record_range', '', array('placeholder'=>'Date range', 'class'=>'span8', 'id'=>'record_range'))}}
							<button type="submit" class="btn btn-warning"><i class="icon-search"></i> Search</button>
						</div>
					</div>
				{{Form::close()}}
				@endif
			</div>

			<div class="span5">

				<div class="inline pull-right alert alert-info bolder">
					<i class="icon-time"></i>
					<span class="record_date">
					 {{display_date_range($fromdate, $todate, false, "Today's sales")}}
					</span>
				</div>
			</div>
		</div>
	</div>
</div>


<div class=""> 
@include($view_file)
</div>

{{Larasset::start('footer')->only('ace-element', 'moment', 'daterangepicker', 'dataTables-min', 'dataTables-bootstrap')->show('scripts')}}

<script>
$(document).ready(function(){
	$('#frontpageTopmenu > li').eq(1).addClass('active');
	//Adding active to the topmenu submenu
	$('#frontpageTopmenu > li.active > ul li').eq(0).addClass('active');

	//Calling date rangepicker feature
	$('#record_range').daterangepicker().prev().on(ace.click_event, function(){
		$(this).next().focus();
	});
});
</script> 