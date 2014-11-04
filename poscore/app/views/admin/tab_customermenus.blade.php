@section('sidebar')

@include('admin.usersplace_sidemenu')

@stop
<div class="widget-box">
	<div class="widget-header">
		<h4> <i class="red icon-rss bigger-140"></i> CUSTOMER AREA </h4>

		<div class="widget-toolbar no-border">
			<ul id="myTab" class="nav nav-tabs padding-32">
				<li class="active">
					<a href="#listofcustomers" data-toggle="tab" class="ajaxable" data-mode="listofcustomers" data-url={{URL::route('adminlistcustomers')}} >
						<i class="green icon-reorder bigger-120"></i>
						 LIST ALL OF CUSTOMERS:
					</a>
				</li>

				<li class="">
					<a href="#createnewcustomer" data-toggle="tab" class="ajaxable" data-mode="createnewcustomer" data-url={{URL::route('adminshowcustomerform')}} >
					<i class="orange icon-pencil bigger-120"></i>
						CREATE NEW CUSTOMER:
					</a>
				</li>
			</ul>

		</div>
	</div>

	<div class="widget-body">
		<div class="widget-main">
			<div class="padding-8 overflow-visible tab-content">
				<div class="tab-pane active" id="listofcustomers">
						@include('admin.listcustomers')
				</div>
			</div>
		</div>
	</div>

</div>


<script type="text/javascript">

$(function(){
	$('form').iePlaceholder();

	$('.ajaxable').ajaxLoadTabContent({
		extraParamsCallback: "getTarget(that)",
		loader: '<span style="text-align:center"><i class="icon-spinner icon-spin"></i> Loading...</span>',
		loaderTargetPlace: '.loadertargetplace',
	});

	//Would add active feature to side menu
	$(this).find('#admin_sidemenu_customermenu').addClass('active');

	//Adding active to the topmenu
	$('#adminTopmenu > li').eq(2).addClass('active');
	//Adding active to the topmenu submenu
	$('#adminTopmenu > li.active > ul li').eq(0).addClass('active');
});

function getTarget(that){
	targetDiv = that.attr('data-mode');
	$('.tab-content > div').attr('id', targetDiv);
	return targetDiv;
}

</script>