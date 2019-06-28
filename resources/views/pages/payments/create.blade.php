@extends('layouts.master')

@section('title', '')

@section('content')

<div class="row">
	<div class="col-md-2"></div>	
	<div class="col-md-8">
		<div class="box box-primary">
			<div class="box-header"></div>
			<div class="box-body">
				<form role="form" action="{{ isset($payment) ? route('payments.update', ['id' => $payment->id]) : route('payments.store')}}" method="POST">
			    	@csrf

				    <div class="modal-body">
						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group @error('customer_id') has-error @enderror">
				                    <label for="customer_id">{{ __('Customer Name') }} </label>
				                    <select type="combobox" class="form-control" id="customer_id" name="customer_id" required disabled>
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
		                            <input type="number" step="any" class="form-control" id="pay_amount" name="pay_amount" value="{{ isset($payment) ? $payment->total_payment_amt : old('pay_amount') }}" placeholder="Enter Payment Amount" required>
		                        
		                            @error('pay_amount')
		                                <span class="help-block">
		                                    {{ $message }}
		                                </span>
		                            @enderror
		                        </div>

				                <div class="form-group @error('amount_paid') has-error @enderror">
		                            <label for="amount_paid">{{ __('Partial payment') }} </label>
		                            <input type="number" step="any" class="form-control" id="amount_paid" name="amount_paid" value="{{ isset($payment) ? $payment->amount_paid : old('amount_paid') }}" placeholder="Enter partial payment" required>
		                        
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
						</div>

						@if(isset($payment))

							<div class="row">
								<div class="col-md-6">
									@foreach($penalties as $penalty)
										<input type="checkbox" name="penalties" id="{{ $penalty->id}}" value="{{ $penalty->penalty}}">
										<label for="{{ $penalty->id}}">{{ $penalty->description}} ( {{ number_format($penalty->penalty, 2) }} {{ $penalty->per}} ) </label>
										<br />
									@endforeach
								</div>
							</div>
							<hr>
							<p style="text-align: justify;">Balance       : {{ $payment->balance}}</p>
							<p style="text-align: justify;">SubTotal      : 0 </p>
							<p style="text-align: justify;">Total Payment : </p>

						@endif
				    </div>

				    <div class="modal-footer">
				        <button type="submit" class="btn btn-primary btn-flat">{{ isset($payment) ? __('Save') : __('Submit') }}</button>
				        <a href="{{ route('payments.index') }}" class="btn btn-danger btn-flat">Close</a>
				    </div>
			  	</form>
			</div>
		</div>
	</div>	
	<div class="col-md-2"></div>	
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
	})
</script>

@endsection