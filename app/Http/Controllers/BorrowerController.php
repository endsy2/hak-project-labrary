<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use Illuminate\Http\Request;

class BorrowerController extends Controller
{
    public function index()
    {
        $borrowers = Borrower::all();
        return view('borrower', compact('borrowers'));
    }

    public function store(Request $request)
    {
        Borrower::create($request->all());
        return redirect()->route('borrowers.index')->with('success', 'Borrower added successfully');
    }

    public function update(Request $request, $id)
    {
        $borrower = Borrower::findOrFail($id);
        $borrower->update($request->all());
        return redirect()->route('borrowers.index')->with('success', 'Borrower updated successfully');
    }

    public function destroy($id)
    {
        Borrower::findOrFail($id)->delete();
        return redirect()->route('borrowers.index')->with('success', 'Borrower deleted successfully');
    }
}


// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Borrower;

// class BorrowerController extends Controller
// {
//     // Show all borrowers
//     public function index()
//     {
//         $borrowers = Borrower::all();
//         return view('borrower', compact('borrowers'));
//     }

//     // Store a new borrower
//     public function store(Request $request)
//     {
//         $request->validate([
//             'member_id' => 'required',
//             'first_name' => 'required',
//             'last_name' => 'required',
//             'address' => 'required',
//             'book_id' => 'required',
//             'mobile_phone' => 'required',
//             'member_type' => 'required',
//             'book_status' => 'required',
//             'borrow_date' => 'nullable|date',
//             'due_date' => 'nullable|date',
//             'return_date' => 'nullable|date',
//         ]);

//         Borrower::create($request->all());

//         return redirect()->route('borrowers.index')->with('success', 'Borrower added successfully!');
//     }

//     // Delete a borrower
//     public function destroy($id)
//     {
//         $borrower = Borrower::findOrFail($id);
//         $borrower->delete();

//         return redirect()->route('borrowers.index')->with('success', 'Borrower deleted successfully!');
//     }
// }
