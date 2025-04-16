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
        $reservations = Reservation::all();
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
        $reservationCode = 'RES-' . str_pad(Reservation::count() + 1, 3, '0', STR_PAD_LEFT);
        $title='Create Reservations';
        return view('reservations.create', compact('rooms', 'users', 'title', 'countries', 'reservationCode', 'lodges', 'agents', 'roomTypes', 'currencies'));	
    }

    public function store(ReservationRequest $request)
    {
 
        $validated = $request->validated();

        Reservation::create($validated);

        // Save payments
        if ($request->has('payment_date')) {
            $dates = $request->payment_date;
            $currencies = $request->payment_currency;
            $amounts = $request->payment_amount;
            $modes = $request->payment_mode;
            $details = $request->payment_details;

            foreach ($dates as $index => $date) {
                if ($date && isset($currencies[$index], $amounts[$index], $modes[$index])) {
                    Payment::create([
                        'reservation_id' => $reservation->id,
                        'date' => $date,
                        'currency_id' => $currencies[$index],
                        'amount' => $amounts[$index],
                        'payment_method' => $modes[$index], // or rename `payment_method` to something meaningful
                        'mode' => $modes[$index],
                        'details' => $details[$index] ?? null,
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
        $title='Edit Reservations';
        return view('reservations.edit', compact('reservation', 'rooms', 'users', 'title'));
    }

    public function update(ReservationRequest $request, Reservation $reservation)
    {
        $validated = $request->validated();

        $reservation->update($validated);
        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully.');
    }

    public function destroy(Reservation $reservation)
    {
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
