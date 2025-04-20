<div class="mb-4">
    <h6 class="section-header"><i class="fas fa-money-bill-wave me-2"></i>PAYMENTS</h6>
    <div class="table-responsive mt-2">
        <table class="table table-bordered" id="paymentsTable">
            <thead class="header-row">
                <tr>
                    <th>Date</th>
                    <th>Currency</th>
                    <th>Amount</th>
                    <th>Mode</th>
                    <th>Details</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="paymentBody">
                @if($reservation->payments && $reservation->payments->count())
                    @foreach($reservation->payments as $index => $payment)
                        <tr class="payment-row">
                            <td><input type="date" name="payment_date[]" class="form-control form-control-sm"
                                value="{{ old('payment_date.' . $index, $payment->payment_date) }}"></td>

                            <td>
                                <select name="currency_id[]" class="form-select form-select-sm">
                                    @foreach($currencies as $currency)
                                        <option value="{{ $currency->id }}" {{ $currency->id == $payment->currency_id ? 'selected' : '' }}>
                                            {{ $currency->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>

                            <td><input type="number" name="payment_amount[]" class="form-control form-control-sm payment-amount"
                                value="{{ old('payment_amount.' . $index, $payment->payment_amount) }}" step="0.01" min="0"></td>

                            <td>
                                <select name="payment_mode[]" class="form-select form-select-sm">
                                    <option {{ $payment->payment_mode == 'Client' ? 'selected' : '' }}>Client</option>
                                    <option {{ $payment->payment_mode == 'Company' ? 'selected' : '' }}>Company</option>
                                </select>
                            </td>

                            <td><input type="text" name="payment_details[]" class="form-control form-control-sm"
                                value="{{ old('payment_details.' . $index, $payment->payment_details) }}"></td>

                            <td>
                                <button type="button" class="btn btn-sm btn-outline-success add-row"><i class="fas fa-plus"></i></button>
                                @if($index >0)
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="fas fa-trash"></i></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="payment-row">
                        <td><input type="date" name="payment_date[]" class="form-control form-control-sm"></td>
                        <td>
                            <select name="currency_id[]" class="form-select form-select-sm">
                                @foreach($currencies as $currency)
                                    <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name="payment_amount[]" class="form-control form-control-sm payment-amount" step="0.01" min="0"></td>
                        <td>
                            <select name="payment_mode[]" class="form-select form-select-sm">
                                <option>Client</option>
                                <option>Company</option>
                            </select>
                        </td>
                        <td><input type="text" name="payment_details[]" class="form-control form-control-sm"></td>
                        <td>
                            <button type="button" class="btn btn-sm btn-outline-success add-row"><i class="fas fa-plus"></i></button>
                        </td>
                    </tr>
                @endif

                <tr>
                    <td colspan="5" class="text-end fw-bold">TOTAL</td>
                    <td class="fw-bold" id="totalAmount">0.00</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
