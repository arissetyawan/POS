{{-- THIS IS THE FOOTER --}}
{{$GNU}}
<div class="navbar navbar-inverse navbar-fixed-bottom footer">
	<div class="container">
	    <div class="row-fluid">
		    <div class="span12">
		    	<div class="span9">
					<p>&copy; {{Systemsetting::getx('name')}} {{date('Y')}}</p>
				</div>
				<div class="span3">
					<div class="pull-right bolder">
						<span id="aboutSoftware" class="inline btn btn-minier btn-purple">{{Config::get('software.karanamkiahe')}}</span>

						<span id="softwareVersion" class="inline btn btn-minier btn-danger" style="margin-left:-4px;"> {{Config::get('software.version')}}</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

{{Larasset::start('footer')->show('scripts')}}

	<script type="text/javascript">
		$(document).ready(function(){
			/* MODAL-BOX*/
			$('.myModalCloned').modal({
				keyboard:true,
				show: false,
				backdrop: false
			});


			$(document).on('hidden', '.myModalCloned', function(){
				//_debug('hidden');
				$(this).remove();
			});

			//Modal call about this software
			var aboutSoftware = function (e){
				e.preventDefault();

				var $that = $(this), url = "{{URL::route('aboutsoftware')}}";

				$that.off('click.aboutSoftware', aboutSoftware);

				$.get(url, function(data){
					cloneModalbox( $('#myModal') )
					.css({'width':'600px'})
					.centerModal()
					.find('.modal-body').html( data )
					.end()
					.find('.modal-header h3')
					.text('About this software')
					.end()
					.find('.modal-footer [data-ref="submit-form"]')
					.hide()
					.end()
					.modal();

				$that.on('click.aboutSoftware', aboutSoftware);
				});
			}

			$('#aboutSoftware').on('click.aboutSoftware', aboutSoftware);

		});
	</script>

{{Larasset::start()->get_inlineScript()}}

{{--@include('keyboard_types.qwerty')--}}
