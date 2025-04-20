<?php

namespace App\Http\Controllers;

use App\Models\reservation;
use App\Models\room;
use App\Models\country;
use App\Models\currency;
use App\Models\agent;
use App\Models\lodge;
use App\Models\user;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Models\Accommodation;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\ServiceProvider;
use App\Models\voucher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    public function index($booking_id = null)
    {
        $bookingDetails = Booking::find($booking_id);
        $reservations = Reservation::latest()->paginate(10); 
        $title='Reservations';
        return view('reservations.index', compact('reservations','title'));
    }

    public function make(Request $request)
    {
        $booking_id = $request->input('booking_id');
        $booking = Booking::find($booking_id);
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }
        dd($booking);
        $rooms = Room::all();
        $users = User::all();
        $lodges = Lodge::all();
        $agents = ServiceProvider::where('type', 'agent')->get();
        $countries = Country::all();
        $currencies = Currency::all();
        $roomTypes = Room::all();
        $reservationNumber = Reservation::max('id') + 1;
        $reservationCode = 'RES-' . str_pad($reservationNumber, 4, '0', STR_PAD_LEFT) . '/' . now()->format('Y');
        $title='Create Reservations';
        return view('reservations.create', compact('rooms', 'users', 'title', 'countries', 'reservationCode', 'lodges', 'agents', 'roomTypes', 'currencies'));	
    }

    public function create(Request $request)
    {
        $booking_id = $request->input('booking_id');
        $booking = Booking::find($booking_id);
        $latestId = voucher::max('id')+1;
        // dd($booking);
        if (!$booking) {
            return redirect()->back()->with('error', 'Booking not found.');
        }
        $otherReservations = Reservation::where('booking_id', $booking_id)->get();
        $rooms = Room::all();
        $users = User::all();
        $lodges = Accommodation::all();
        $agents = ServiceProvider::where('type', 'agent')->get();
        $countries = Country::all();
        $currencies = Currency::all();
        $roomTypes = Room::all();
        $reservationNumber = Reservation::max('id') + 1; //
        $reservationCode = Reservation::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(); //Starts zero each month
        $reservationCode = "RES-".str_pad($reservationCode+1, 3, '0', STR_PAD_LEFT) . "/" . now()->format('m/Y');
        $title='Create Reservations';
        return view('reservations.create', compact('latestId','otherReservations','booking','rooms', 'users', 'title', 'countries', 'reservationCode', 'lodges', 'agents', 'roomTypes', 'currencies'));
    }

    // public function store(Request $request)
    // {

    //     // $validated = $request->validated();
    //     $validated = $request->all();
    //     $validated['room_detail'] = json_encode($request['room_detail']);
        
        
    //     dd(json_encode($validated));
    //     $reservation = Reservation::create($validated);

    //     // Save payments
    //     if ($request->has('payment_date')) {
    //         $dates = $request->payment_date;
    //         $currencies = $request->currency_id;
    //         $amounts = $request->payment_amount;
    //         $modes = $request->payment_mode;
    //         $details = $request->payment_details;


    //         foreach ($dates as $index => $date) {
    //             if ($date && isset($currencies[$index], $amounts[$index], $modes[$index])) {
    //                 Payment::create([
    //                     'reservation_id'  => $reservation->id,
    //                     'date'            => $request->date[$index] ?? now()->toDateString(),
    //                     'payment_date'    => $request->payment_date[$index] ?? now()->toDateString(),
    //                     'currency_id'     => $request->currency_id[$index] ?? null,
    //                     'payment_amount'  => $amounts[$index] ?? null,
    //                     'payment_mode'    => $request->payment_mode[$index] ?? '',
    //                     'payment_details' => $request->payment_details[$index] ?? null,
    //                 ]);


    //             }
    //         }
    //     }
    //     return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
    // }

    public function store(Request $request)
    {
        
        DB::beginTransaction();

        try {
            // Validate the request inputs
            $validated = $request->all();

            // Encode room details if provided
            if ($request->has('room_detail')) {
                $validated['room_detail'] = json_encode($request->room_detail);
            }

            $reservation = new Reservation();
            // Create reservation
            $reservation->booking_id    = $validated['booking_id'] ?? NULL;
            $reservation->guest_name    = $validated['guest_name'] ?? NULL;
            $reservation->agent_id      = $validated['agent_id'] ?? NULL;
            $reservation->lodge_id      = $validated['lodge_id'] ?? NULL;
            $reservation->booking_code  = $validated['booking_code'] ?? NULL;
            $reservation->arrival       = $validated['arrival'] ?? NULL;
            $reservation->departure     = $validated['departure'] ?? NULL;
            $reservation->nights        = $validated['nights'] ?? NULL;
            $reservation->arrival_time  = $validated['arrival_time'] ?? NULL;
            $reservation->total_pax     = $validated['total_pax'] ?? NULL;
            $reservation->total_rooms   = $validated['total_rooms'] ?? NULL;
            $reservation->current_version   = $validated['current_version'] ?? NULL;
            $reservation->voucher_issue_date    = $validated['voucher_issue_date'] ?? NULL;
            $reservation->issue_date            = $validated['voucher_issue_date'] ?? NULL;
            $reservation->prior_version         = $validated['prior_version'] ?? NULL;
            $reservation->lodge_code            = $validated['lodge_code'] ?? NULL;
            $reservation->property_name         = $validated['property_name'] ?? NULL;
            $reservation->adults             = $validated['adults'] ?? 0;
            $reservation->children           = $validated['children'] ?? 0;
            $reservation->juniors            = $validated['juniors'] ?? 0;
            $reservation->infants            = $validated['infants'] ?? 0;
            $reservation->day_room           = $validated['day_room'] ?? NULL;
            $reservation->user_id            = Auth::user()->id;
            $reservation->booking_date      = $validated['booking_date'] ?? NULL;
            $reservation->internal_ref      = $validated['internal_ref'] ?? NULL;
            $reservation->reservation_code  = $validated['reservation_code'] ?? NULL;
            $reservation->room_detail       = $validated['room_detail'] ?? NULL;
            $reservation->guest_notes       = $validated['guest_notes'] ?? NULL;
            $reservation->internal_remarks  = $validated['internal_remarks'] ?? NULL;
            $reservation->status            = $validated['status'] ?? 'active';
            Log::info('Reservation data: ', $reservation->toArray());
            // Log::info('Reservation data: ', $validated);
            // $reservation = Reservation::create($validated);
            $reservation->save();
            
            // Create associated payments if provided
            if ($request->has('payment_date')) {
                $paymentDates  = $request->payment_date;
                $currencies    = $request->currency_id;
                $amounts       = $request->payment_amount;
                $modes         = $request->payment_mode;
                $details       = $request->payment_details;

                foreach ($paymentDates as $index => $paymentDate) {
                    if ($paymentDate && isset($currencies[$index], $amounts[$index], $modes[$index])) {
                        Payment::create([
                            'reservation_id'  => $reservation->id,
                            'date'            => now()->toDateString(),
                            'payment_date'    => $paymentDate ?? now()->toDateString(),
                            'currency_id'     => $currencies[$index] ?? null,
                            'payment_amount'  => $amounts[$index] ?? null,
                            'payment_mode'    => $modes[$index] ?? '',
                            'payment_details' => $details[$index] ?? null,
                        ]);
                    }
                }
            }

            // Create associated voucher for the reservation
            Voucher::create([
                'ref_id'         => $reservation->id,
                'voucher_type'   => 'reservation',
                'status'         => 'active',
                'issue_date'     => $validated['voucher_issue_date'] ?? NULL,
                'current_version'=> 1,
                'prior_version'  => null,
                'payment_status' => 0, // assuming unpaid by default, adjust if necessary
            ]);

            DB::commit();

            return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');

        } catch (\Throwable $e) {
            DB::rollBack();

            // Log the detailed error for auditing and debugging
            Log::error('Failed to create reservation: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->all()
            ]);

            return redirect()->back()->with('error', 'An error occurred while creating the reservation. Please try again.');
        }
    }

    public function show(Reservation $reservation)
    {
        $title='Reservation Details';
        return view('reservations.show', compact('reservation', 'title'));
    }

    public function edit(Reservation $reservation)
    {
        $rooms = Room::all();
        $users = User::all();
        $lodges = Lodge::all();
        $agents = Agent::all();
        $countries = Country::all();
        $currencies = Currency::all();
        $roomTypes = Room::all();
        $title = 'Edit Reservations';
        $reservation['room_detail'] = json_decode($reservation['room_detail'], true);
        $reservationCode = $reservation->reservation_code;
        $reservation->load('payments'); 

        return view('reservations.edit', compact('rooms', 'users', 'title', 'countries', 'reservationCode', 'lodges', 'agents', 'roomTypes', 'currencies', 'reservation'));
    }
    

    public function update(ReservationRequest $request, Reservation $reservation)
    {
        // var_dump($request->all());
        // die();
        $validated = $request->validated();
        $validated['room_detail'] = json_encode($request['room_detail']);
    
        // Update reservation
        $reservation->update($validated);
    
        // Delete old payments
        $reservation->payments()->delete();
    
        // Save updated payments
        if ($request->has('payment_date')) {
            $dates = $request->payment_date;
            $currencies = $request->currency_id;
            $amounts = $request->payment_amount;
            $modes = $request->payment_mode;
            $details = $request->payment_details;
    
            foreach ($dates as $index => $paymentDate) {
                if (
                    $paymentDate &&
                    isset($currencies[$index], $amounts[$index], $modes[$index])
                ) {
                    Payment::create([
                        'reservation_id'  => $reservation->id,
                        'date'            => $request->date[$index] ?? now()->toDateString(),
                        'payment_date'    => $paymentDate,
                        'currency_id'     => $currencies[$index],
                        'payment_amount'  => $amounts[$index],
                        'payment_mode'    => $modes[$index],
                        'payment_details' => $details[$index] ?? null,
                    ]);
                }
            }
        }
    
        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
    }
    

    public function destroy(Reservation $reservation)
    {
        // Delete old payments
        $reservation->payments()->delete();
        $reservation->delete();
        return redirect()->route('reservations.index')->with('success', 'Reservation deleted successfully.');
    }
    public function confirm(Reservation $reservation)
    {
        // Mark the reservation as confirmed
        $reservation->status = 'confirmed'; // assuming 'status' column exists
        $reservation->save();

        // Optionally, trigger an email or notification
        // $this->sendConfirmationEmail($reservation);

        return redirect()->route('reservations.index')->with('success', 'Reservation confirmed successfully.');
    }
}
