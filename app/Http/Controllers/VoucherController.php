<?php

namespace App\Http\Controllers;

use App\Models\voucher;
use App\Models\reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\room;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(voucher $voucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(voucher $voucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, voucher $voucher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(voucher $voucher)
    {
        //
    }

    public function print(Request $request)
    {
        return response()->json([
            'message' => 'Voucher sent to print',
            'redirect' => route('vouchers.pdf', ['type' => 'print']) // Add this if you want to open PDF in new tab
        ]);
    }

    public function duplicate(Request $request)
    {
        return response()->json([
            'message' => 'Duplicate voucher sent to printer',
            'redirect' => route('vouchers.pdf', ['type' => 'duplicate'])
        ]);
    }

    public function amend(Request $request)
    {
        return response()->json([
            'message' => 'Amended voucher being processed',
            'redirect' => route('vouchers.pdf', ['type' => 'amend'])
        ]);
    }

    public function email(Request $request)
    {
        // Simulate email sending
        Mail::raw('Your voucher details...', function ($message) {
            $message->to('client@example.com')->subject('Your Voucher');
        });

        return response()->json([
            'message' => 'Voucher emailed successfully'
        ]);
    }
    public function printContent($id)
    {
        $voucher = Reservation::with(['user', 'payments','accommodation'])->findOrFail($id);

        // dd($voucher->accommodation->name);
        $rooms = [];
        $title = 'Voucher';

        $roomIds = json_decode($voucher->room_detail, true);
        $selectedRooms = Room::whereIn('id', $roomIds)->get();

        $roomCounts = [
            'Single' => 0,
            'Double' => 0,
            'Triple' => 0,
            'Suite' => 0
        ];

        foreach ($selectedRooms as $room) {
            $type = strtolower($room->name);
            if (str_contains($type, 'single')) {
                $roomCounts['Single']++;
            } elseif (str_contains($type, 'double') || str_contains($type, 'twin')) {
                $roomCounts['Double']++;
            } elseif (str_contains($type, 'triple')) {
                $roomCounts['Triple']++;
            } elseif (str_contains($type, 'suite')) {
                $roomCounts['Suite']++;
            }
        }
        // var_dump($voucher);
        // die();
        return view('vouchers.print', compact('voucher','rooms', 'title','roomCounts',
        'selectedRooms' ));
    }
}