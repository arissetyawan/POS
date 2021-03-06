{{--Larasset::start('header')->only('bootstrap-datepicker')->show('styles')--}}
<div class="bank_eidtentry" id="bank_editentry">
	{{Form::open(array('route'=>'vendor.saveedit', 'id'=>'form_editentry', 'class'=>'form-horizontal'))}}
		{{Form::hidden('id', $row['id'])}}
		
		<div class="control-group">
			<label class="control-label" for="name">Vendor's name</label>
			<div class="controls">
				{{Form::text('name', istr::title($row['name']), array('id'=>'name', 'validate'=>'required'))}}
			</div>
		</div>
		
		<div class="control-group">
			<label for="email" class="control-label">Vendor's email</label>
			<div class="controls">
				{{Form::text('email', $row['email'], array('id'=>'email', 'validate'=>'required|email'))}}
			</div>
		</div>
		
		<div class="control-group">
			<label for="phone" class="control-label">Vendor's phone number</label>

			<div class="controls">
				{{Form::text('phone', $row['phone'], array('id'=>'phone', 'validate'=>'required|phone'))}}
			</div>
		</div>

		<div class="control-group">
			<label for="address" class="control-label">Vendor's address</label>

			<div class="controls">
				{{Form::textarea('address', $row['address'], array('id'=>'address', 'rows'=>'3', 'placeholder'=>''))}}
			</div>
		</div>
		
		<div class="control-group">
			<label for="comment" class="control-label">Comment <small class="muted">e.g <em>lorem ipsum</em></small></label>

			<div class="controls">
				{{Form::textarea('comment', $row['comment'], array('id'=>'comment', 'rows'=>'3', 'placeholder'=>''))}}
			</div>
		</div>
		
		<div id="entry-msg-error" class="entry-error"></div>

		<div class="form-actions">
			<button class="btn btn-info" type="submit" name="editentry_submit">
				<i class="icon-ok bigger-110"></i>
				Update changes
			</button>

			&nbsp; &nbsp; &nbsp;
			<button class="btn" type="reset">
				<i class="icon-undo bigger-110"></i>
				Reset
			</button>

			&nbsp; &nbsp; &nbsp;
			<span id="create-task-ajaxloader" class="ajaxloader" style="display:none;">{{HTML::image('vendor/bucketcodes/img/ajax-loader.gif')}}</span>
		</div>
		
	{{Form::close()}}
</div>
{{--Larasset::start('footer')->only('bootstrap-datepicker', 'ace-element')->show('scripts')--}}

<script type="text/javascript">
$(function(){
	
	$('button[name="editentry_submit"]').on('click',function(e){
	e.preventDefault();
		$(this).ajaxrequest_wrapper({
			validate: {vtype:'inline', etype:'inline'},
			wideAjaxStatusMsg: '.entry-error',
			immediatelyAfterAjax_callback: response,
		});
	});
	
	function response(data){
		var result = data.message, row, rowspan, vx, cl;
		
		row = $('table#vendors-table').find('tbody tr#data-'+result.id);
		
		$.each(result, function(i,v){
		rowspan = row.find('td span.'+i);
			if( i !== '_token' ){
				
				//We check if it's comment and if it's not empty
				if( i === 'comment' && v !== ''){
				
					//We check if there's already tag representing comment
					if( row.find('td i.'+i).attr('title') !== undefined ){
					
						//If yes with just update the comment value
						row.find('td i.'+i).attr('title', v);
					}else{
					
						//If no comment exists on this row.. Then we'll create a comment tag with it's value
						row.find('td span.name').before('<i class="icon-book orange comment" title="'+v+'" style="cursor:pointer"></i> ');
					}
					return;
				}else if(i === 'comment' && v === ''){ //If comment is set but empty value
					if( row.find('td i.'+i).attr('title') !== undefined ){ // If comment already exist in this row..
						
						//Then we'll delete comment tag
						row.find('td i.'+i).remove();
					}
					return;
				}

				rowspan.text(v);
			}
		});
		
		//Closing the modalbox
		$('.myModalCloned').modal('hide');
	}
	
	$(document).on('hidden', '.myModalCloned', function(){
		
		//Removing the highlight in this row
		$('table#vendors-table tbody tr').removeClass('khaki-bg');
		
		//Deleting the current cloned modalbox on closing the modalbox
		$('.myModalCloned').remove();
	});
	
});
</script>

