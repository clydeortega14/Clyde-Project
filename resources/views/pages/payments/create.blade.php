@extends('layouts.master')

@section('title', '')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header"></div>
			<div class="box-body">
				<form role="form" action="{{ isset($payment) ? route('payments.update', ['id' => $payment->id]) : route('payments.store')}}" method="POST">
			    	@csrf
					@if(isset($payment))
						@method('PUT')
					@endif
				    <div class="modal-body">

						<div class="row">
							
							<div class="col-md-6">
								<div class="form-group @error('customer_id') has-error @enderror">
				                    <label for="customer_id">{{ __('Customer Name') }} </label>
				                    <select type="combobox" class="form-control" id="customer_id" name="customer_id" required>
				                    	<option value="">{{ old('customer_id') }}</option>
				                    	@foreach($rents as $rent)
											<option value="{{ $rent->customer->id }}" {{ isset($payment) && $payment->customer_id == $rent->customer_id ? 'selected' : '' }}>{{ $rent->customer->name }}</option>
				                    	@endforeach
				                    </select>
				                
				                    @error('customer_id')
				                        <span class="help-block">
				                            {{ $message }}
				                        </span>
				                    @enderror
				                </div>

				                <div class="form-group @error('pay_amount') has-error @enderror">
		                            <label for="pay_amount">{{ __('Payment Amount') }} </label>
		                            <input type="number" step="any" class="form-control" id="pay_amount" name="pay_amount" value="{{ isset($payment) ? $payment->payment_amount : old('pay_amount') }}" placeholder="Enter Payment Amount" required>
		                        
		                            @error('pay_amount')
		                                <span class="help-block">
		                                    {{ $message }}
		                                </span>
		                            @enderror
		                        </div>

				                <div class="form-group @error('amount_paid') has-error @enderror">
		                            <label for="amount_paid">{{ __('Partial payment') }} </label>
		                            <input type="number" step="any" class="form-control" id="amount_paid" name="amount_paid" value="{{ isset($payment) ? $payment->partial_pay : old('amount_paid') }}" placeholder="Enter partial payment" required>
		                        
		                            @error('amount_paid')
		                                <span class="help-block">
		                                    {{ $message }}
		                                </span>
		                            @enderror
		                        </div>

		                         <div class="form-group @error('balance') has-error @enderror">
		                            <label for="balance">{{ __('Balance') }} </label>
		                            <input type="number" step="any" class="form-control" id="balance" name="balance" value="{{ isset($payment) ? $payment->balance : old('balance') }}" placeholder="Balance" required>
		                        
		                            @error('balance')
		                                <span class="help-block">
		                                    {{ $message }}
		                                </span>
		                            @enderror
		                        </div>
							</div>

							<div class="col-md-6">
								<br>
								@foreach($penalties as $penalty)
									<div class="form-group">
						                <label for="{{ $penalty->id}}">
											@if(isset($payment))
							                	@php
							                		$checked = '';

							                		if(count($payment->customer->penalties) > 0){

							                			foreach($payment->customer->penalties as $cust_penal){

							                				if($cust_penal->id == $penalty->id){

							                					$checked = 'checked';
							                				}
							                			}
							                		}
							                	@endphp
						                	@endif
						                  <input type="checkbox" class="minimal" name="penalties[]" id="{{ $penalty->id}}" value="{{ $penalty->id }}" rel="{{ $penalty->penalty}}" @if(isset($payment)) {{ $checked }} @endif
						                  	{{ !isset($payment) ? 'disabled' : ''}}
						                  >
						                  	{{ $penalty->description}} ( {{ number_format($penalty->penalty, 2)}} / {{ $penalty->per}} )
						                </label>
						            </div>
						            <br>
								@endforeach
								<br>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
				                            <label for="total_penalties">{{ __('Total Penalties') }} </label>
				                            <input type="number" step="any" class="form-control" id="total_penalties" name="total_penalties" value="{{ isset($payment) ? $payment->total_penalties : old('total_penalties') }}" {{ !isset($payment) ? 'disabled' : ''}}>
				                        </div>
									</div>
									<div class="col-md-6">
										<div class="form-group @error('total_pay') has-error @enderror">
				                            <label for="total_pay">{{ __('Total Payable Amount') }} </label>
				                            <input type="number" step="any" class="form-control" id="total_pay" name="total_pay" value="{{ isset($payment) ? $payment->total_payment : old('total_pay') }}" {{ !isset($payment) ? 'disabled' : ''}}>
				                        
				                            @error('total_pay')
				                                <span class="help-block">
				                                    {{ $message }}
				                                </span>
				                            @enderror
				                        </div>
									</div>
								</div>
							</div>
						</div>
				    </div>
				    <div class="modal-footer">
				        <button type="submit" class="btn btn-primary btn-flat">{{ isset($payment) ? __('Save') : __('Submit') }}</button>
				        <a href="{{ route('payments.index') }}" class="btn btn-danger btn-flat">Close</a>
				    </div>
			  	</form>
			</div>
		</div>
	</div>		
</div>

@endsection

@section('custom_js')
<script type="text/javascript">
	
	$(function(){

		$('#customer_id').change(function(){ //CHANGE PAYMENT AMOUNT VALUE EVENT

			let id = $(this).val();
			getRate(id);
		})

		function getRate(id) // GET DESTINATION RATE FUNCTION
		{
			const options = {

				url : `/get-destination-rate/${id}`,
				method : `GET`,
			}

			$.ajax(options).done(function(response){
				
				$('#pay_amount').val(response.customerID);

			}).fail(function(error){

				console.log(error);
			})
		}

		//AUTOMATIC DISPLAY BALANCE
        $('input[name="amount_paid"]').on("input", function(){

            let balance = $('input[name="pay_amount"]').val() - $('input[name="amount_paid"]').val();

            $('input[name="balance"]').val(balance);
        })

        //iCheck for checkbox and radio inputs
	    $('input[type="checkbox"].minimal').iCheck({
	      checkboxClass: 'icheckbox_minimal-blue',
	      radioClass   : 'iradio_minimal-blue'
	    });


	    /*
			=============== PENALTIES AND TOTAL PAYMENTS FUNCTION =======
	    */

	    var $penalties = $('#total_penalties').val()
	    var $total = $('#total_pay').val()
	    var $balance = $('#balance').val()

	    $('input[type="checkbox"].minimal').on(('ifToggled'), function(e){

	    	let $value = $(this).attr('rel')

	    	if($(this).prop('checked') === true){

	    		$penalties = parseFloat($penalties) + parseFloat($value)
	    		$total = parseFloat($balance) + $penalties

	    	}else if($(this).prop('checked') === false){

	    		$total = parseFloat($total) - parseFloat($value)
	    		$penalties = parseFloat($penalties) - parseFloat($value)
	    	}

	    	$('#total_pay').val($total)
	    	$('#total_penalties').val($penalties)

	    })

	    /*
			=========== END PENALTIES etc... function =====================
	    */

	})
</script>

@endsection