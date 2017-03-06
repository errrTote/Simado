@extends ('layouts.calendario')

@section('title', 'Panel')

@section('content')

    <div class="container">
		
		<div class="row">
			<div class="page-header">

				<div class="pull-right form-inline">
					<div class="btn-group">
						<button class="btn btn-primary" data-calendar-nav="prev"><< Ant</button>
						<button class="btn" data-calendar-nav="today">Hoy</button>
						<button class="btn btn-primary" data-calendar-nav="next">Sig >></button>
					</div>
					<div class="btn-group">
						<button class="btn btn-warning" data-calendar-view="year">Año</button>
						<button class="btn btn-warning active" data-calendar-view="month">Mes</button>
						<button class="btn btn-warning" data-calendar-view="week">Semana</button>
						<button class="btn btn-warning" data-calendar-view="day">Dia</button>
					</div>
				</div>

				<h3></h3>
			</div>
			<input type="hidden" name="sourceDB" value ="{{route('actividad.getAll', Auth::user()->indicador) }}">
			
		</div>
		<hr>
		<div class="row">
			<div id="calendar"></div>
		</div>
		<!--ventana modal para el calendario-->
		<div class="modal fade" id="events-modal">
		    <div class="modal-dialog">
			    <div class="modal-content">
			        <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				        <h4 class="modal-title">Modal title</h4>
			        </div>
				    <div class="modal-body" style="height: 400px">
				        <p>One fine body&hellip;</p>
				    </div>
			        <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <button type="button" class="btn btn-primary">Save changes</button>
			        </div>
			    </div><!-- /.modal-content -->
		    </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div>
    
    

    <script>
	(function($){
		//creamos la fecha actual
		var date = new Date();
		var yyyy = date.getFullYear().toString();
		var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
		var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();
		var sourceVal = $("[name='sourceDB']").val();

		//establecemos los valores del calendario
		var options = {
			events_source: sourceVal,
			view: 'month',
			language: 'es-ES',
			tmpl_path: 'librerias/bower_components/bootstrap-calendar/tmpls/',
			tmpl_cache: false,
			day: yyyy+"-"+mm+"-"+dd,
			time_start: '07:00',
			format12: true,
			time_end: '17:30',
			time_split: '30',
			width: '100%',			
			onAfterEventsLoad: function(events) {
				if(!events) {
					return;
				}
				var list = $('#eventlist');
				list.html('');

				$.each(events, function(key, val) {
					$(document.createElement('li'))
						.html('<a href="{{route("actividad.showModal", ' + val.url + ')}}">gerger' + val.title + '</a>')
						.appendTo(list);
				});
			},
			onAfterViewLoad: function(view) {
				$('.page-header h3').text(this.getTitle());
				$('.btn-group button').removeClass('active');
				$('button[data-calendar-view="' + view + '"]').addClass('active');
			},
			classes: {
				months: {
					general: 'label'
				}
			}
		};

		var calendar = $('#calendar').calendar(options);

		$('.btn-group button[data-calendar-nav]').each(function() {
			var $this = $(this);
			$this.click(function() {
				calendar.navigate($this.data('calendar-nav'));
			});
		});

		$('.btn-group button[data-calendar-view]').each(function() {
			var $this = $(this);
			$this.click(function() {
				calendar.view($this.data('calendar-view'));
			});
		});
	}(jQuery));
    </script>
@endsection