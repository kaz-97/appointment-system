@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8"> 
            <div class="card">
                <div class="card-header">Book an Appointment</div>
                <div class="card-body">
                   
                        <form method="POST" action="{{ route('admin.appointments.store') }}" enctype="multipart/form-data">
                        @csrf

						<div class="form-group">
							<label class="required" for="name">Select Student:</label>
									<select id="student_id" name="student_id" class="form-control select2" required>
										<option value="">Please select</option>
										@foreach($students as $student)
											<option value="{{ $student->id }}">{{ $student->name }}</option>
										@endforeach
									</select>
							</div>
							
							<div class="form-group">
							<label class="required" for="name">Select Option:</label>
									<select id="service_id" name="service_id" class="form-control select2" required>
										<option value="">Please select</option>
										@foreach($services as $service)
											<option value="{{ $service->id }}">{{ $service->name }}</option>
										@endforeach
									</select>
							</div>

							<div class="form-group">
                                    <label class="required" for="date">Date:</label>
                                    <input class="form-control date hasDatePicker" type="text" autocomplete="off" name="date" id="date" placeholder="YY-MM-DD" required>
                            </div>

							<div class="form-group" id="start_time" style="display: none;">
								<div class="col-xs-12 form-group">
									{!! Form::label('start_time', 'Start time*', ['class' => 'control-label']) !!}
									<div class="form-inline">
									<select name="starting_hour" id="starting_hour" class="form-control" required style="max-width: 85px;">
										<option value="-1" selected>Please select</option>
										<option value="09">09</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
										<option value="16">16</option>
										<option value="17">17</option>
										<option value="18">18</option>
									</select>
									:
									<select name="starting_minute" id="starting_minute" class="form-control" required style="max-width: 85px;">
										<option value="-1" selected>Please select</option>
										<option value="00">00</option>
										<option value="15">15</option>
										<option value="30">30</option>
										<option value="45">45</option>
									</select>
									</div>
								</div>
							</div>

							<div class="form-group" id="finish_time" style="display: none;">
								<div class="col-xs-12 form-group">
									{!! Form::label('finish_time', 'Finish time*', ['class' => 'control-label']) !!}
									<div class="form-inline">
									<select name="finish_hour" id="finish_hour" class="form-control" required style="max-width: 85px;">
										<option value="-1" selected>Please select</option>
										<option value="08">08</option>
										<option value="09">09</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
										<option value="16">16</option>
										<option value="17">17</option>
										<option value="18">18</option>
										<option value="19">19</option>
										<option value="20">20</option>
										<option value="21">21</option>
										<option value="22">22</option>
										<option value="23">23</option>
									</select>
									:
									<select name="finish_minute" id="finish_minute" class="form-control" required style="max-width: 85px;">
										<option value="-1" selected>Please select</option>
										<option value="00">00</option>
										<option value="15">15</option>
										<option value="30">30</option>
										<option value="45">45</option>
									</select>
									</div>
								</div>
							</div>

							<hr />
							<div id="results" style="display: none;">
							<p class="total_time"><strong>Total time: <span id="time">0</span> hour(s)</strong></p>
							</div>

							<div class="form-group">
                                <label for="description">Comments:</label>
                                <textarea class="form-control" name="comments" id="comments"></textarea>
                            </div>

							<div class="form-group">
								<button class="btn btn-danger" type="submit">
									Save
								</button>
                        	</div>
						</div>
					</div>
        </div>
	</div>
@endsection

@section('javascript')
	
<script>
		$("#service_id").on("change", function() {
			$("#price").val($('option:selected', this).attr('data-price'));
			var date = $("#date").val();
			var service_id = $("#service_id").val();
			UpdateUsers(service_id, date);
		});
	
		$("#date").change(function() {
			var service_id = $("#service_id").val();
			var date = $("#date").val();
			UpdateUsers(service_id, date);
		});
		
		$('body').on("change", "input[type=radio][name=instructor_id]", function() {
			var instructor_id = $(this).val();
			var starting_hour = parseInt($(".starting_hour_"+instructor_id).text());
			var starting_minute = $(".starting_minute_"+instructor_id).text();
			var finish_hour = starting_hour+1;
			if(finish_hour < 10) {
				finish_hour = "0"+finish_hour;
			}
			if(starting_hour < 10) {
				starting_hour = "0"+starting_hour;
			}
			$('#starting_hour option[value='+starting_hour+']').prop('selected','true');
			$('#starting_minute option[value='+starting_minute+']').prop('selected','true');
			$('#finish_hour option[value='+finish_hour+']').prop('selected','true');
			$('#finish_minute option[value='+starting_minute+']').prop('selected','true');
			$("#start_time, #finish_time").show();
			CountPrice();
		});
		
		function CountPrice() {
			var start_hour = parseInt($("#starting_hour").val());
			var start_minutes = parseInt($("#starting_minute").val());
			var finish_hour = parseInt($("#finish_hour").val());
			var finish_minutes = parseInt($("#finish_minute").val());
			var total_hours = (((finish_hour*60+finish_minutes)-(start_hour*60+start_minutes))/60);
			var price = parseFloat($("#price").val());
			$("#price_total").html(price*total_hours);
			$("#time").html(total_hours);
			if(start_hour != -1 && start_minutes != -1 && finish_hour != -1 && finish_minutes != -1) {
				$("#results").show();
			}
		}
		
		function UpdateUsers(service_id, date)
		{
			if(service_id != "" && date != "") {
				$.ajax({
					url: '{{ url("admin/get-users") }}',
					type: 'GET',
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					data: {service_id:service_id, date:date},
					success:function(option){
						//alert(option);
						$(".users").remove();
						$("#date").closest(".row").after(option);
						$("#start_time, #finish_time").hide();
						$("#results").hide();
					}
				});
			}
		}
	</script>


@endsection

