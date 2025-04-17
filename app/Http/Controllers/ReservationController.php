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
use App\Models\Payment;


class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::latest()->paginate(10); 
        $title='Reservations';
        return view('reservations.index', compact('reservations','title'));
    }

    public function create()
    {
        $rooms = Room::all();
        $users = User::all();
        $lodges = Lodge::all();
        $agents = Agent::all();
        $countries = Country::all();
        $currencies = Currency::all();
        $roomTypes = Room::all();
        $reservationNumber = Reservation::max('id') + 1;
        $reservationCode = 'RES-' . str_pad($reservationNumber, 4, '0', STR_PAD_LEFT) . '/' . now()->format('Y');
        $title='Create Reservations';
        return view('reservations.create', compact('rooms', 'users', 'title', 'countries', 'reservationCode', 'lodges', 'agents', 'roomTypes', 'currencies'));	
    }

    public function store(ReservationRequest $request)
    {
        $validated = $request->validated();
        $validated['room_detail'] = json_encode($request['room_detail']);

        $latestId = Reservation::max('id') + 1;
        $validated['reservation_code'] = 'RES-' . str_pad($latestId, 4, '0', STR_PAD_LEFT) . '/' . now()->format('Y');
        

        $reservation = Reservation::create($validated);

        // Save payments
        if ($request->has('payment_date')) {
            $dates = $request->payment_date;
            $currencies = $request->currency_id;
            $amounts = $request->payment_amount;
            $modes = $request->payment_mode;
            $details = $request->payment_details;


            foreach ($dates as $index => $date) {
                if ($date && isset($currencies[$index], $amounts[$index], $modes[$index])) {
                    Payment::create([
                        'reservation_id'  => $reservation->id,
                        'date'            => $request->date[$index] ?? now()->toDateString(),
                        'payment_date'    => $request->payment_date[$index] ?? now()->toDateString(),
                        'currency_id'     => $request->currency_id[$index] ?? null,
                        'payment_amount'  => $amounts[$index] ?? null,
                        'payment_mode'    => $request->payment_mode[$index] ?? '',
                        'payment_details' => $request->payment_details[$index] ?? null,
                    ]);


                }
            }
        }
        return redirect()->route('reservations.index')->with('success', 'Reservation created successfully.');
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
